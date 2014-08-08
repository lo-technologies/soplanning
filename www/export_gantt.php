<?php

@ini_set('memory_limit', '256M');
@set_time_limit(1000);

require('./base.inc');
require(BASE . '/../config.inc');

$smarty = new MySmarty();

require BASE . '/../includes/header.inc';

$joursFeries = getJoursFeries();

// PARAMÈTRES ////////////////////////////////
$dateDebut = new DateTime();

// chargement date de début
$dateDebut->setDate(substr($_SESSION['date_debut_affiche'],6,4), substr($_SESSION['date_debut_affiche'],3,2), substr($_SESSION['date_debut_affiche'],0,2));

$nbMois = $_SESSION['nb_mois'];

$nbLignes = $_SESSION['nb_lignes'];
$pageLignes = $_SESSION['page_lignes'];

$masquerLigneVide = $_SESSION['masquerLigneVide'];

$DAYS_INCLUDED = explode(',', CONFIG_DAYS_INCLUDED);

// FIN PARAMÈTRES ////////////////////////////////

$now = new DateTime();

$dateFin = clone $dateDebut;
$dateFin->modify('+' . $nbMois . ' months');
$dateFin->modify('-1 days');

$gantt = new Gantt();
// set grid type
$gantt->setGrid(1);
// set Gantt colors
$gantt->setColor("group","000000");
$gantt->setColor("progress","000099");

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
if(count($_SESSION['filtreGroupeProjet']) > 0) {
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
	$gantt->addGroup("G".$nbLine, $lineTmp->nom);

	// on charge les jours occupés pour cette ligne
	$periodes = new GCollection('Periode');
	$sql = "SELECT planning_periode.*, planning_user.*, planning_user.nom AS nom_user
			FROM planning_periode
			INNER JOIN planning_user ON planning_periode.user_id = planning_user.user_id";
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		// on filtre sur les projets de l'équipe de ce user
		$sql .= " INNER JOIN planning_user AS pu ON planning_periode.user_id = pu.user_id ";
	}
	$sql .= " WHERE projet_id = '" . $ligneId . "'";
	$sql .= "	AND (
							(planning_periode.date_debut <= '" . $dateDebut->format('Y-m-d') . "' AND planning_periode.date_fin >= '" . $dateDebut->format('Y-m-d') . "') 
								OR 
							(planning_periode.date_debut <= '" . $dateFin->format('Y-m-d') . "' AND planning_periode.date_debut >= '" . $dateDebut->format('Y-m-d') . "')
						)";
	if(count($_SESSION['filtreGroupeProjet']) > 0) {
		$sql.= " AND planning_periode.projet_id IN ('" . implode("','", $_SESSION['filtreGroupeProjet']) . "')";
	}
	if(count($_SESSION['filtreUser']) > 0) {
		$sql.= " AND planning_periode.user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
	}	
	if($user->checkDroit('tasks_view_own_projects')) {
		$sql .= " AND planning_periode.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
	}
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		// on filtre sur les projets de l'équipe de ce user
		$sql .= " AND pu.user_groupe_id = " . $user->user_groupe_id;
	}
	$sql.= " ORDER BY planning_periode.date_debut";
	$periodes->db_loadSQL($sql);

	$joursOccupes = array();
	// pour chaque période de cette ligne, on remplie le tableau des jours occupés
	
	while ($periode = $periodes->fetch()) {
		$nomTache = $periode->nom_user;
		if(!is_null($periode->titre)) {
			$nomTache .= ' : ' . $periode->titre;
		}
		if($periode->livrable == 'oui') {
			$gantt->addMilestone(rand(0,10000000), $periode->date_debut, $nomTache, "G".$nbLine);
		} else {
			$gantt->addTask(rand(0,10000000), $periode->date_debut, (!is_null($periode->date_fin) ? $periode->date_fin : $periode->date_debut), 0, $nomTache, "G".$nbLine);
		}
		
		$periode->getData();
	}
}


$gantt->outputGantt();

?>