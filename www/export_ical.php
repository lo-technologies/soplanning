<?php

require('./base.inc');
require(BASE . '/../config.inc');

// phase de login auto avec param de l'url (car accès depuis calendrier externe)
if(isset($_GET['login'])) {
	if(!isset($_GET['hash'])) {
		$_SESSION['message'] = 'erreur_bad_login';
		header('Location: ../index.php');
		exit;
	}
	$user = New User();
	if(!$user->db_load(array('login', '=', $_GET['login']))) {
		$_SESSION['message'] = 'erreur_bad_login';
		header('Location: ../index.php');
		exit;
	}

	$hashUser = md5($user->login . '¤¤' . $user->password);
	if($hashUser != $_GET['hash']) {
		$_SESSION['message'] = 'erreur_bad_login';
		header('Location: ../index.php');
		exit;
	}
	//$_SESSION['user_id'] = $user->user_id;
} else {
	// accès normal depuis le site
	require BASE . '/../includes/header.inc';
}

$smarty = new MySmarty();

$joursFeries = getJoursFeries();

// PARAMÈTRES ////////////////////////////////
$dateDebut = new DateTime();

$DAYS_INCLUDED = explode(',', CONFIG_DAYS_INCLUDED);

// FIN PARAMÈTRES ////////////////////////////////

$now = new DateTime();

$dateFin = clone $dateDebut;
$dateFin->modify('+120 months');

$v = new vcalendar( array( 'unique_id' => 'SOPlanning'));
$v->setProperty( 'X-WR-CALNAME', 'SOPlanning calendar');
$v->setProperty( 'X-WR-CALDESC', 'Calendar generated from SOPlanning (http://www.soplanning.org)');


// recuperation des projets couvrant la période, pour le filtre de projets
$projetsFiltre = new GCollection('Projet');
$sql = "SELECT distinct pp.*, pg.nom AS groupe_nom
		FROM planning_projet pp
		INNER JOIN planning_periode pd ON pp.projet_id = pd.projet_id
		LEFT JOIN planning_groupe AS pg ON pp.groupe_id = pg.groupe_id ";
if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
	// on filtre sur les projets de l'équipe de ce user
	$sql .= " INNER JOIN planning_user AS pu ON pd.user_id = pu.user_id ";
}
$sql .= "WHERE (
			(pd.date_debut <= '" . $dateDebut->format('Y-m-d') . "'
			AND pd.date_fin >= '" . $dateDebut->format('Y-m-d') . "')
			OR
			(pd.date_debut <= '" . $dateFin->format('Y-m-d') . "'
			AND pd.date_debut >= '" . $dateDebut->format('Y-m-d') . "')
	)";
if($user->checkDroit('tasks_view_own_projects')) {
	// on filtre sur les projets dont le user courant est propriétaire ou assigné
	$sql .= " AND (pp.createur_id = '" . $user->user_id . "' OR pd.user_id = '" . $user->user_id . "')";
}
if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
	// on filtre sur les projets de l'équipe de ce user
	$sql .= " AND pu.user_groupe_id = " . $user->user_groupe_id;
}
$sql .= "	GROUP BY pp.nom, pp.projet_id
			ORDER BY pp.groupe_id, pp.nom";
$projetsFiltre->db_loadSQL($sql);
$smarty->assign('listeProjets', $projetsFiltre->getSmartyData());
if($user->checkDroit('tasks_view_own_projects')) {
	$listeProjetsPossibles = $projetsFiltre->get('projet_id');
}
if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
	$listeProjetsPossibles = $projetsFiltre->get('projet_id');
}

// recuperation de la liste des utilisateurs pour filtre sur users
$usersFiltre = new GCollection('User');
$sql = "SELECT * FROM planning_user WHERE visible_planning = 'oui' ORDER BY nom";
$usersFiltre->db_loadSQL($sql);
$smarty->assign('listeUsers', $usersFiltre->getSmartyData());

// CHARGEMENT DES LIGNES (PROJET SI INVERSÉ)
$lines = new GCollection('Projet');
$sql = "SELECT * 
		FROM planning_projet ";
if(isset($_SESSION['filtreGroupeProjet']) && count($_SESSION['filtreGroupeProjet']) > 0) {
	$sql.= " WHERE projet_id IN ('" . implode("','", $_SESSION['filtreGroupeProjet']) . "')";
}
$sql .= " ORDER BY livraison";
$lines->db_loadSQL($sql);
$nbLignesTotal = $lines->getCount();

// FIN CHARGEMENT DES LIGNES (USERS SI NORMAL, PROJET SI INVERSÉ)
$nbLine = 0;
while($lineTmp = $lines->fetch()) {
	$nbLine++;
	$ligneId = $lineTmp->projet_id;

	// on charge les jours occupés pour cette ligne
	$periodes = new GCollection('Periode');
	$sql = "SELECT planning_periode.*, planning_user.*, planning_user.nom AS nom_user, planning_projet.nom AS nom_projet
			FROM planning_periode
			INNER JOIN planning_user ON planning_periode.user_id = planning_user.user_id
			INNER JOIN planning_projet ON planning_periode.projet_id = planning_projet.projet_id ";
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		// on filtre sur les projets de l'équipe de ce user
		$sql .= " INNER JOIN planning_user AS pu ON planning_periode.user_id = pu.user_id ";
	}
	$sql .= "  WHERE planning_periode.projet_id = '" . $ligneId . "'";
	$sql .= "	AND (
							(planning_periode.date_debut <= '" . $dateDebut->format('Y-m-d') . "' AND planning_periode.date_fin >= '" . $dateDebut->format('Y-m-d') . "') 
								OR 
							(planning_periode.date_debut <= '" . $dateFin->format('Y-m-d') . "' AND planning_periode.date_debut >= '" . $dateDebut->format('Y-m-d') . "')
						)";
	if(isset($_SESSION['filtreGroupeProjet']) && count($_SESSION['filtreGroupeProjet']) > 0) {
		$sql.= " AND planning_periode.projet_id IN ('" . implode("','", $_SESSION['filtreGroupeProjet']) . "')";
	}
	if(isset($_SESSION['filtreUser']) && count($_SESSION['filtreUser']) > 0) {
		$sql.= " AND planning_periode.user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
	}	
	if($user->checkDroit('tasks_view_own_projects')) {
		$sql .= " AND planning_periode.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
	}
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		// on filtre sur les projets de l'équipe de ce user
		$sql .= " AND pu.user_groupe_id = " . $user->user_groupe_id;
	}
	$sql .= ' AND planning_periode.date_debut >= \'' . date('Y-m-d') . '\'';
	$sql.= " ORDER BY planning_periode.date_debut";
	$periodes->db_loadSQL($sql);

	$joursOccupes = array();
	// pour chaque période de cette ligne, on remplie le tableau des jours occupés
	
	while ($periode = $periodes->fetch()) {
		$nomTache = $periode->nom_projet;
		if(!is_null($periode->titre)) {
			$nomTache .= ' : ' . $periode->titre;
		}
		$nomTache .= ' (' . $periode->nom_user . ')';
		$e = $v->newComponent('vevent');
		$e->setProperty('categories' , 'PLANNING');
		$v->setProperty( 'X-WR-TIMEZONE', date_default_timezone_get());
		if(!is_null($periode->duree)) {
			$e->setProperty('dtstart', substr($periode->date_debut, 0, 4), substr($periode->date_debut, 5, 2), substr($periode->date_debut, 8, 2), 9, 00, 00);
			$e->setProperty('duration', 0, 0, (int)substr($periode->duree, 0, 2));
		} else {
			$e->setProperty('dtstart', substr($periode->date_debut, 0, 4), substr($periode->date_debut, 5, 2), substr($periode->date_debut, 8, 2), 9, 00, 00);
			$e->setProperty('dtend', substr($periode->date_fin, 0, 4), substr($periode->date_fin, 5, 2), substr($periode->date_fin, 8, 2), 18, 00, 00);
		}

		$e->setProperty('summary' , $nomTache);
		$e->setProperty('description', $periode->notes);
		
		$periode->getData();
	}
}

if(isset($_GET['debug'])) {
	echo nl2br($v->createCalendar());
} else {
	$v->returnCalendar();
}

?>