<?php

require('./base.inc');
require(BASE . '/../config.inc');

$smarty = new MySmarty();

require BASE . '/../includes/header.inc';

$html = '';
$js = '';

$joursFeries = getJoursFeries();

// PARAMÈTRES ////////////////////////////////
$dateDebut = new DateTime();

// chargement date de début
if(isset($_COOKIE['date_debut_affiche'])) {
	$_SESSION['date_debut_affiche'] = $_COOKIE['date_debut_affiche'];
}
if (isset($_SESSION['date_debut_affiche'])) {
	$dateDebut->setDate(substr($_SESSION['date_debut_affiche'],6,4), substr($_SESSION['date_debut_affiche'],3,2), substr($_SESSION['date_debut_affiche'],0,2));
} else {
	$dateDebut->modify('-' . CONFIG_DEFAULT_NB_PAST_DAYS . ' days');
	$_SESSION['date_debut_affiche'] = $dateDebut->format('d/m/Y');
}

// chargement nb mois affichés
if(isset($_COOKIE['nb_mois'])) {
	$_SESSION['nb_mois'] = $_COOKIE['nb_mois'];
}
if (isset($_SESSION['nb_mois'])) {
	$nbMois = $_SESSION['nb_mois'];
} else {
	$nbMois = CONFIG_DEFAULT_NB_MONTHS_DISPLAYED;
	$_SESSION['nb_mois'] = $nbMois;
}

// si param livraison existe, veut dire qu'on vient des projets et qu'on affiche la semaine demandée
if(isset($_GET['livraison'])) {
	if($_GET['livraison'] != '') {
		$dateDebut->setDate(substr($_GET['livraison'],0,4), substr($_GET['livraison'],5,2), substr($_GET['livraison'],8,2));
		// on affiche 5 jours avant la semaine voulue
		$dateDebut->modify('-5 days');
		$_SESSION['date_debut_affiche'] = $dateDebut->format('d/m/Y');
	} else {
		$dateDebut->modify('-5 days');
		$_SESSION['date_debut_affiche'] = $dateDebut->format('d/m/Y');
	}
}

if(isset($_COOKIE['inverserUsersProjets'])) {
	$_SESSION['inverserUsersProjets'] = $_COOKIE['inverserUsersProjets'];
}
if (!isset($_SESSION['inverserUsersProjets'])) {
	$_SESSION['inverserUsersProjets'] = false;
}

if(isset($_GET['affichageLarge'])) {
	if($_GET['affichageLarge'] == '1') {
		$_SESSION['affichageLarge'] = true;
	} else {
		$_SESSION['affichageLarge'] = false;
	}
} elseif (!isset($_SESSION['affichageLarge'])) {
	$_SESSION['affichageLarge'] = false;
}

if(!isset($_SESSION['filtreGroupeProjet'])) {
	$_SESSION['filtreGroupeProjet'] = array();
}

if(!isset($_SESSION['filtreGroupeUser'])) {
	$_SESSION['filtreGroupeUser'] = array();
}

if(!isset($_SESSION['filtreUser'])) {
	$_SESSION['filtreUser'] = array();
}

if(!isset($_SESSION['filtreTexte'])) {
	$_SESSION['filtreTexte'] = '';
}

if(!isset($_SESSION['filtreStatutTache'])) {
	$_SESSION['filtreStatutTache'] = array();
}

$triPlanningPossibleUser = array('nom asc', 'nom desc', 'user_id asc', 'user_id desc', 'team_nom asc, nom asc', 'team_nom desc, nom desc', 'team_nom asc, user_id asc', 'team_nom desc, user_id desc');
$triPlanningPossibleProjet = array('nom asc', 'nom desc', 'projet_id asc', 'projet_id desc', 'groupe_nom asc, nom asc', 'groupe_nom desc, nom desc', 'groupe_nom asc, projet_id asc', 'groupe_nom desc, projet_id desc');
if((isset($_COOKIE['triPlanning']) && (in_array($_COOKIE['triPlanning'], $triPlanningPossibleUser) || in_array($_COOKIE['triPlanning'], $triPlanningPossibleProjet)))) {
	$_SESSION['triPlanning'] = $_COOKIE['triPlanning'];
}
if((isset($_SESSION['triPlanning']) && !in_array($_SESSION['triPlanning'], $triPlanningPossibleUser) && !in_array($_SESSION['triPlanning'], $triPlanningPossibleProjet)) || !isset($_SESSION['triPlanning'])) {
	$_SESSION['triPlanning'] = 'nom asc';
}

// chargement nb lignes affichées
if(isset($_COOKIE['nb_lignes'])) {
	$_SESSION['nb_lignes'] = $_COOKIE['nb_lignes'];
}
if (isset($_SESSION['nb_lignes'])) {
	$nbLignes = $_SESSION['nb_lignes'];
} else {
	$nbLignes = CONFIG_DEFAULT_NB_ROWS_DISPLAYED;
	$_SESSION['nb_lignes'] = $nbLignes;
}
if (isset($_SESSION['page_lignes'])) {
	$pageLignes = $_SESSION['page_lignes'];
} else {
	$pageLignes = 1;
	$_SESSION['page_lignes'] = $pageLignes;
}

// chargement affichage lignes vides ou pas
if(isset($_COOKIE['masquerLigneVide'])) {
	$_SESSION['masquerLigneVide'] = $_COOKIE['masquerLigneVide'];
}
if (isset($_SESSION['masquerLigneVide'])) {
	$masquerLigneVide = $_SESSION['masquerLigneVide'];
} else {
	$masquerLigneVide = 0;
	$_SESSION['masquerLigneVide'] = $masquerLigneVide;
}

// chargement affichage lignes vides ou pas
if(isset($_COOKIE['afficherLigneTotal'])) {
	$_SESSION['afficherLigneTotal'] = $_COOKIE['afficherLigneTotal'];
}
if (isset($_SESSION['afficherLigneTotal'])) {
	$afficherLigneTotal = $_SESSION['afficherLigneTotal'];
} else {
	$afficherLigneTotal = 0;
	$_SESSION['afficherLigneTotal'] = $afficherLigneTotal;
}

$_SESSION['planningView'] = 'mois';


$DAYS_INCLUDED = explode(',', CONFIG_DAYS_INCLUDED);

// FIN PARAMÈTRES ////////////////////////////////

$now = new DateTime();

$dateFin = clone $dateDebut;
$dateFin->modify('+' . $nbMois . ' months');
$dateFin->modify('-1 days');

$dateBoutonInferieur = clone $dateDebut;
$dateBoutonInferieur->modify('-1 month');

$dateBoutonSuperieur = clone $dateDebut;
$dateBoutonSuperieur->modify('+1 month');

$smarty->assign('dateDebut', $dateDebut->format('d/m/Y'));
$smarty->assign('dateFin', $dateFin->format('d/m/Y'));
$smarty->assign('nbMois', $nbMois);
$smarty->assign('masquerLigneVide', $masquerLigneVide);
$smarty->assign('afficherLigneTotal', $afficherLigneTotal);
$smarty->assign('nbLignes', $nbLignes);
$smarty->assign('pageLignes', $pageLignes);
$smarty->assign('filtreGroupeUser', $_SESSION['filtreGroupeUser']);
$smarty->assign('filtreGroupeProjet', $_SESSION['filtreGroupeProjet']);
$smarty->assign('filtreStatutTache', $_SESSION['filtreStatutTache']);
$smarty->assign('filtreUser', $_SESSION['filtreUser']);
$smarty->assign('filtreTexte', $_SESSION['filtreTexte']);
$smarty->assign('triPlanning', $_SESSION['triPlanning']);
$smarty->assign('triPlanningPossibleUser', $triPlanningPossibleUser);
$smarty->assign('triPlanningPossibleProjet', $triPlanningPossibleProjet);
$smarty->assign('inverserUsersProjets', $_SESSION['inverserUsersProjets']);
$smarty->assign('affichageLarge', $_SESSION['affichageLarge']);
$smarty->assign('dateBoutonInferieur', $dateBoutonInferieur->format('d/m/Y'));
$smarty->assign('dateBoutonSuperieur', $dateBoutonSuperieur->format('d/m/Y'));
$smarty->assign('modeAffichage', $_SESSION['planningView']);

$headerMois = '' . CRLF;
$headerSemaines = '' . CRLF;
$headerNomJours = '' . CRLF;
$headerNumeroJours = '' . CRLF;
$colspanMois = '0';
$colspanSemaine = '1';
$tmpDate = clone $dateDebut;
$tmpMois = $smarty->get_config_vars('month_' . $tmpDate->format('n')) . ' ' . $tmpDate->format('Y');

// GESTION DES ENTETES DU TABLEAU (MOIS, SEMAINE ET JOUR)
while ($tmpDate <= $dateFin) {
	if (in_array($tmpDate->format('w'), $DAYS_INCLUDED) && !in_array($tmpDate->format('Y-m-d'), $joursFeries)) {
		$sClass = 'week';
	} else {
		$sClass = 'weekend';
	}
	if( $tmpDate->format('Y-m-d') == date('Y-m-d')) {
		$sClass .= ' today';
	}
	$headerNomJours .= '<th id="tdHeaderNomJours" class="' . $sClass . '"><div>' . strtoupper(substr($smarty->get_config_vars('day_' . $tmpDate->format('w')), 0, 1)) . '</div></th>' . CRLF;
	$headerNumeroJours .= '<th id="tdHeaderNumeroJours" class="' . $sClass . '">' . $tmpDate->format('j') . '</th>' . CRLF;

	$nomMoisCourant = $smarty->get_config_vars('month_' . $tmpDate->format('n'));
	if ($nomMoisCourant . ' ' . $tmpDate->format('Y') == $tmpMois) {
	    $colspanMois++;
	} else {
		$headerMois .= '<th colspan="' . $colspanMois . '">' . $tmpMois . '</th>' . CRLF;
		$colspanMois = '1';
		$tmpMois = $nomMoisCourant . ' ' . $tmpDate->format('Y');
	}
	// gestion des semaines
	if ($tmpDate->format('w') == 0) {
		$headerSemaines .= '<th colspan="' . $colspanSemaine . '">' . $smarty->get_config_vars('planning_semaine') . ' ' . $tmpDate->format('W') . '</th>' . CRLF;
		$colspanSemaine = 1;
	} else {
		$colspanSemaine++;
	}
	$tmpDate->modify('+1 day');
}
// on cloture le colspan du mois en cours
$headerMois .= '<th colspan="' . $colspanMois . '">' . $tmpMois . '</th>' . CRLF;
// on cloture le colspan de la semaine en cours
if($colspanSemaine != 1) {
	$headerSemaines .= '<th colspan="' . ($colspanSemaine-1) . '">' . $smarty->get_config_vars('planning_semaine') .  ' ' . $tmpDate->format('W') . '</th>' . CRLF;
}

$html .= '<table class="css_tableau" id="tabContenuPlanning">' . CRLF;
$html .= '<tr>' . CRLF;
$html .= '<th id="tdUser_0" rowspan="4"></th>' .CRLF;
$html .= $headerMois . CRLF;
$html .= '</tr>' . CRLF;
$html .= '<tr>' . CRLF;
$html .= $headerSemaines . CRLF;
$html .= '</tr>' . CRLF;
$html .= '<tr>' . CRLF;
$html .= $headerNomJours . CRLF;
$html .= '</tr>' . CRLF;
$html .= '<tr>' . CRLF;
$html .= $headerNumeroJours . CRLF;
$html .= '</tr>' . CRLF;
// FIN GESTION DES ENTETES DU TABLEAU (MOIS, SEMAINE ET JOUR)


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
$sql = "SELECT pu.*, pug.nom AS groupe_nom
		FROM planning_user pu
		LEFT JOIN planning_user_groupe pug ON pu.user_groupe_id = pug.user_groupe_id
		WHERE visible_planning = 'oui' ";
if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
	$sql .= " AND pu.user_groupe_id = " . $user->user_groupe_id;
}
$sql .=	" ORDER BY groupe_nom, pu.nom";
$usersFiltre->db_loadSQL($sql);
$smarty->assign('listeUsers', $usersFiltre->getSmartyData());


// CHARGEMENT DES LIGNES (USERS SI NORMAL, PROJET SI INVERSÉ)
if($_SESSION['inverserUsersProjets']) {
	$lines = new GCollection('Projet');
	$sql = "SELECT planning_projet.*, planning_groupe.nom AS groupe_nom
			FROM planning_projet
			LEFT JOIN planning_groupe ON planning_projet.groupe_id = planning_groupe.groupe_id
			WHERE 0=0 ";
	if(count($_SESSION['filtreGroupeProjet']) > 0) {
		$sql.= " AND projet_id IN ('" . implode("','", $_SESSION['filtreGroupeProjet']) . "')";
	}
	if($user->checkDroit('tasks_view_own_projects')) {
		$sql .= " AND projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
	}
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		// on filtre sur les projets de l'équipe de ce user
		$sql .= " AND projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
	}
	$sql .= " ORDER BY " . $_SESSION['triPlanning'];
} else {
	$lines = new GCollection('User');
	$sql = "SELECT planning_user.*, planning_user_groupe.nom AS team_nom
			FROM planning_user
			LEFT JOIN planning_user_groupe ON planning_user.user_groupe_id = planning_user_groupe.user_groupe_id
			WHERE visible_planning = 'oui'";
	if(count($_SESSION['filtreUser']) > 0) {
		$sql.= " AND user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
	}
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		$sql .= " AND planning_user.user_groupe_id = " . $user->user_groupe_id;
	}
	$sql .= " ORDER BY " . $_SESSION['triPlanning'];
}

$lines->db_loadSQL($sql);
$nbLignesTotal = $lines->getCount();

// on refiltre la liste des user sur le nombre max à afficher
$sql .= " LIMIT " . ($nbLignes*($pageLignes-1)) . "," . $nbLignes;
$lines->db_loadSQL($sql);

// on recupere le nombre de pages pour afficher le pager
$smarty->assign('nbPagesLignes', ceil($nbLignesTotal/$nbLignes));

// FIN CHARGEMENT DES LIGNES (USERS SI NORMAL, PROJET SI INVERSÉ)



$nbLine = 1;
$groupeCourant = false;
$idGroupeCourant = -1;
$totalParJour = array();

while($ligneTmp = $lines->fetch()) {
	if($_SESSION['inverserUsersProjets']) {
		$ligneId = $ligneTmp->projet_id;
	} else {
		$ligneId = $ligneTmp->user_id;
	}

	// every 10 lines, repeat days/month/etc rows
	if(CONFIG_PLANNING_REPEAT_HEADER > 0) {
		if (($nbLine % CONFIG_PLANNING_REPEAT_HEADER) == 0) {
				$html .= '<tr>' . CRLF;
				$html .= '<th>&nbsp;</th>' . CRLF;
				$html .= $headerMois . CRLF;
				$html .= '</tr>' . CRLF;
				$html .= '<tr>' . CRLF;
				$html .= '<th>&nbsp;</th>' . CRLF;
				$html .= $headerSemaines . CRLF;
				$html .= '</tr>' . CRLF;
				$html .= '<tr>' . CRLF;
				$html .= '<th>&nbsp;</th>' . CRLF;
				$html .= $headerNomJours . CRLF;
				$html .= '</tr>' . CRLF;
				$html .= '<tr>' . CRLF;
				$html .= '<th>&nbsp;</th>' . CRLF;
				$html .= $headerNumeroJours . CRLF;
				$html .= '</tr>' . CRLF;
		}
	}
	$nbLine++;

	// gestion de l'affichage des groupes (de user ou projet) dans le planning
	if(strpos($_SESSION['triPlanning'], 'groupe_nom') !== FALSE || strpos($_SESSION['triPlanning'], 'team_nom') !== FALSE) {
		if($_SESSION['inverserUsersProjets']) {
			if($ligneTmp->groupe_nom !== $groupeCourant) {
				$html .= '<tr>' . CRLF;
				$html .= '<th nowrap="nowrap" style="background-color:#AAAAAA;color:#000000" id="tdUser_' . $idGroupeCourant . '">&nbsp;' . ($ligneTmp->groupe_nom != '' ? xss_protect($ligneTmp->groupe_nom) : $smarty->get_config_vars('planning_pasDeGroupe')) . '&nbsp;' . CRLF;
				$html .= '</th>' . CRLF;
				$tmpDate = clone $dateDebut;
				while ($tmpDate <= $dateFin) {
					$html .= '<td style="background-color:#AAAAAA;">&nbsp;</td>' . CRLF;
					$tmpDate->modify('+1 day');
				}
				$html .= '</tr>' . CRLF;
				$idGroupeCourant--;
			}
			$groupeCourant = $ligneTmp->groupe_nom;
		} else {
			if($ligneTmp->team_nom !== $groupeCourant) {
				$html .= '<tr>' . CRLF;
				$html .= '<th nowrap="nowrap" style="background-color:#AAAAAA;color:#000000;" id="tdUser_' . $idGroupeCourant . '">&nbsp;' . ($ligneTmp->team_nom != '' ? xss_protect($ligneTmp->team_nom) : $smarty->get_config_vars('planning_pasDeTeam')) . '&nbsp;' . CRLF;
				$html .= '</th>' . CRLF;
				$tmpDate = clone $dateDebut;
				while ($tmpDate <= $dateFin) {
					$html .= '<td style="background-color:#AAAAAA;">&nbsp;</td>' . CRLF;
					$tmpDate->modify('+1 day');
				}
				$html .= '</tr>' . CRLF;
				$idGroupeCourant--;
			}
			$groupeCourant = $ligneTmp->team_nom;
		}
	}

	// on charge les jours occupés pour cette ligne
	$periodes = new GCollection('Periode');
	if( $_SESSION['inverserUsersProjets']) {
		$sql = "SELECT planning_periode.*, planning_user.*, planning_projet.createur_id, pc.nom AS nom_createur
				FROM planning_periode
				INNER JOIN planning_user ON planning_periode.user_id = planning_user.user_id
				INNER JOIN planning_projet ON planning_projet.projet_id = planning_periode.projet_id
				LEFT JOIN planning_user pc ON planning_periode.createur_id = pc.user_id
				WHERE planning_periode.projet_id = '" . $ligneId . "'";
	} else {
		$sql = "SELECT planning_periode.*, planning_projet.*, pc.nom AS nom_createur
				FROM planning_periode
				INNER JOIN planning_user ON planning_periode.user_id = planning_user.user_id
				INNER JOIN planning_projet ON planning_periode.projet_id = planning_projet.projet_id
				LEFT JOIN planning_user pc ON planning_periode.createur_id = pc.user_id
				WHERE planning_periode.user_id = '" . $ligneId . "'";
	}
	$sql .= "	AND (
					(planning_periode.date_debut <= '" . $dateDebut->format('Y-m-d') . "' AND planning_periode.date_fin >= '" . $dateDebut->format('Y-m-d') . "')
						OR
					(planning_periode.date_debut <= '" . $dateFin->format('Y-m-d') . "' AND planning_periode.date_debut >= '" . $dateDebut->format('Y-m-d') . "')
						)";
	if($user->checkDroit('tasks_view_own_projects')) {
		$sql .= " AND planning_periode.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
	}
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		$sql .= " AND planning_periode.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
		$sql .= " AND (planning_user.user_groupe_id IS NULL OR planning_user.user_groupe_id = " . $user->user_groupe_id . ')';
	}

	if(count($_SESSION['filtreStatutTache']) > 0) {
		$sql.= " AND planning_periode.statut_tache IN ('" . implode("','", $_SESSION['filtreStatutTache']) . "')";
	}
	if(count($_SESSION['filtreGroupeProjet']) > 0) {
		$sql.= " AND planning_periode.projet_id IN ('" . implode("','", $_SESSION['filtreGroupeProjet']) . "')";
	}
	if(count($_SESSION['filtreUser']) > 0) {
		$sql.= " AND planning_periode.user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
	}
	if($_SESSION['filtreTexte'] != "") {
		$sql.= " AND (planning_periode.notes LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') . " OR planning_periode.lien LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') ." OR planning_periode.titre LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') . " )";
	}
	$sql.= " ORDER BY planning_periode.date_debut";
	// echo $sql . '<br>';
	$periodes->db_loadSQL($sql);

	$ordreJourPrec = array();

	$joursOccupes = array();

	// pour chaque période de cette ligne, on remplie le tableau des jours occupés
	while ($periode = $periodes->fetch()) {
		$infosJour = $periode->getSmartyData();
		if( $_SESSION['inverserUsersProjets']) {
			$infosJour['projet_nom'] = xss_protect($ligneTmp->nom);
			$infosJour['user_nom'] = xss_protect($periode->nom);
		} else {
			$infosJour['projet_nom'] = xss_protect($periode->nom);
			$infosJour['user_nom'] = xss_protect($ligneTmp->nom);
		}

		$dateDebut_projet = new DateTime();
		$dateDebut_projet->setDate(substr($periode->date_debut,0,4), substr($periode->date_debut,5,2), substr($periode->date_debut,8,2));

		$dateFin_projet = new DateTime();

		$tmpDate = clone $dateDebut_projet;
		if (is_null($periode->date_fin)) {
			$dateFin_projet = clone $dateDebut_projet;
		}
		else {
			$dateFin_projet->setDate(substr($periode->date_fin,0,4), substr($periode->date_fin,5,2), substr($periode->date_fin,8,2));
		}

		while ($tmpDate <= $dateFin_projet) {
				if (isset($joursOccupes[$tmpDate->format('Y-m-d')])) {
					if(CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY == 0) {
						$tmpArray = $joursOccupes[$tmpDate->format('Y-m-d')];
						$tmpArray[] = $infosJour;
						$joursOccupes[$tmpDate->format('Y-m-d')] = $tmpArray;
					}
				} else {
					$tmpArray = array($infosJour);
					$joursOccupes[$tmpDate->format('Y-m-d')] = $tmpArray;
				}
			$tmpDate->modify('+1 day');
		}
	}

	// si option activée, on masque la ligne si elle est vide
	if($masquerLigneVide == 1 && count($joursOccupes) == 0) {
		continue;
	}

	$ordreJourCourant = array();

	// on genere la ligne courante
	$html .= '<tr>' . CRLF;
	$html .= '<th id="tdUser_' . ($nbLine-1) . '" nowrap="nowrap"' . ((!is_null($ligneTmp->couleur) && $ligneTmp->couleur != 'FFFFFF') ? ' style="background-color:#'.$ligneTmp->couleur. ';color:' . buttonFontColor('#' . $ligneTmp->couleur) . '"' : '') . '>&nbsp;';
	// si le user a le droit, on permet de cliquer pour afficher la fiche de l'item (user ou projet)
	if($_SESSION['inverserUsersProjets'] && $user->checkDroit('projects_manage_all')) {
		$html .= '<a style="color:' . (!is_null($ligneTmp->couleur) && $ligneTmp->couleur != 'FFFFFF' ? buttonFontColor('#' . $ligneTmp->couleur) . '"' : '#ffffff') . '" href="javascript:xajax_modifProjet(\'' . urlencode($ligneTmp->projet_id) . '\');undefined;">' . xss_protect($ligneTmp->nom) . '</a>';
	} elseif (!$_SESSION['inverserUsersProjets'] && $user->checkDroit('users_manage_all')) {
		$html .= '<a style="color:' . (!is_null($ligneTmp->couleur) && $ligneTmp->couleur != 'FFFFFF' ? buttonFontColor('#' . $ligneTmp->couleur) . '"' : '#ffffff') . '" href="javascript:xajax_modifUser(\'' . urlencode($ligneTmp->user_id) . '\');undefined;">' . xss_protect($ligneTmp->nom) . '</a>';
	} else {
		$html .= xss_protect($ligneTmp->nom);
	}
	$html .= '&nbsp;</th>' . CRLF;

	$tmpDate = clone $dateDebut;
	// on boucle sur la durée de l'affichage
	while ($tmpDate <= $dateFin) {
		// définit le style pour case semaine et WE
		if (!in_array($tmpDate->format('w'), $DAYS_INCLUDED) || in_array($tmpDate->format('Y-m-d'), $joursFeries)) {
			$classTD = 'weekend';
			$opacity = 'filter:alpha(opacity=60);-moz-opacity:.60;opacity:.60';
		} else {
			$classTD = 'week';
			$opacity = '';
		}
		if(CONFIG_PLANNING_LINE_HEIGHT > 0) {
			$styleLigne = ' style="height:' . CONFIG_PLANNING_LINE_HEIGHT . 'px;"';
		} else {
			$styleLigne = '';
		}

		if($user->checkDroit('tasks_modify_all') || $user->checkDroit('tasks_modify_own_project') || $user->checkDroit('tasks_modify_own_task')) {
			// on ajoute le jour à la liste des destinations possible pour drag and drop
			$js .= 'destinationsDrag[destinationsDrag.length] = "td_' . $ligneId . '_' . $tmpDate->format('Ymd')  . '";' . CRLF;
		}

		if (in_array($tmpDate->format('Y-m-d'), $joursFeries)) {
			// jours fériés
			$ferieObj = new Ferie();
			if($ferieObj->db_load(array('date_ferie', '=', $tmpDate->format('Y-m-d'))) && trim($ferieObj->libelle) != "") {
				$cooltip = '<b>' . $ferieObj->libelle . '</b>';
				$ferie = '<div class="caseFerie" onmouseover="return coolTip(\'' . addslashes($cooltip) . '\')"  onmouseout="nd()" onClick="event.cancelBubble=true;">' . $smarty->get_config_vars('planning_ferie') . '</div>' . CRLF;
			}
		} else {
			$ferie = false;
		}

		if (isset($joursOccupes[$tmpDate->format('Y-m-d')])) {
			// jours avec au moins une case remplie
			$html .= '<td ' . $styleLigne . ' valign="top" id="td_' . $ligneId . '_' . $tmpDate->format('Ymd') . '"';
			if($user->checkDroit('tasks_modify_all') || $user->checkDroit('tasks_modify_own_project') || $user->checkDroit('tasks_modify_own_task')) {
				$html .= ' onClick="Reloader.stopRefresh();xajax_ajoutPeriode(\'' . $tmpDate->format('Y-m-d') . '\', \'' . $ligneId . '\');"';
			}
			$html .= ' class="' . $classTD . (($tmpDate->format('Y-m-d') == date('Y-m-d')) ? ' today' : '') . '">' . CRLF;

			if($ferie !== false) {
				$html .= $ferie;
			}

			$niveauCourant = 0;
			// si il y a des periodes pour le jour courant, on boucle pour toutes les afficher
			foreach ($joursOccupes[$tmpDate->format('Y-m-d')] as $jour) {
				// generation des cellules vides pour aligner les cases d'une meme periode
				if(in_array($jour['periode_id'], $ordreJourPrec) && $niveauCourant != array_search($jour['periode_id'], $ordreJourPrec)) {
					for($i=1; $i<=(array_search($jour['periode_id'], $ordreJourPrec)-$niveauCourant); $i++) {
						$html .= '<div class="caseProjets">&nbsp;</div>' . CRLF;
					}
					$ordreJourCourant[array_search($jour['periode_id'], $ordreJourPrec)] = $jour['periode_id'];
					$niveauCourant = $niveauCourant + array_search($jour['periode_id'], $ordreJourPrec) + 1;
				} else {
					$ordreJourCourant[] = $jour['periode_id'];
					$niveauCourant++;
				}

				// mouseover sur la case
				$cooltip =  '<b>' . $smarty->get_config_vars('tab_projet') . '</b> : ' . $jour['projet_nom'] . ' (' . $jour['projet_id'] . ')<br/>'
									. '<b>' . $smarty->get_config_vars('tab_personne') . '</b> : ' . $jour['user_nom'] . ' (' . $jour['user_id'] . ')';
				if($jour['titre'] != '') {
					$cooltip .= '<br/><b>' . $smarty->get_config_vars('winPeriode_titre') . '</b> : ' . (str_replace(array("\r\n", "\n"), array("<br>", "<br>"), $jour['titre']));
				}
				if($jour['livrable'] == 'oui') {
					$cooltip .= '<br/><b>' . $smarty->get_config_vars('winPeriode_livrable') . '</b> : ' . (str_replace(array("\r\n", "\n"), array("<br>", "<br>"), $smarty->get_config_vars('oui')));
				}
				if($jour['statut_tache'] != '') {
					$cooltip .= '<br/><b>' . $smarty->get_config_vars('winPeriode_statut') . '</b> : ' . (str_replace(array("\r\n", "\n"), array("<br>", "<br>"), $smarty->get_config_vars('winPeriode_statut_' . $jour['statut_tache'])));
				}
				$cooltip .= '<br/><b>' . $smarty->get_config_vars('tab_dateDebut') . '</b> : ' . $jour['date_debut'];
				if($jour['date_fin'] != '') {
					$cooltip .= '<br/><b>'  . $smarty->get_config_vars('tab_dateFin') .  '</b> : ' . $jour['date_fin'];
				} else {
					$cooltip .= '<br/><b>' . $smarty->get_config_vars('tab_duree') . '</b> : ' . sqltime2usertime($jour['duree']);
					if(isset($jour['duree_details_heure_debut'])) {
						$cooltip .= ' (' . sqltime2usertime($jour['duree_details_heure_debut']) . ' => ' . sqltime2usertime($jour['duree_details_heure_fin']) . ')';
					}
					if($jour['duree_details'] == 'AM') {
						$cooltip .= ' (' . $smarty->get_config_vars('tab_matin') . ')';
					}
					if($jour['duree_details'] == 'PM') {
						$cooltip .= ' (' . $smarty->get_config_vars('tab_apresmidi') . ')';
					}
				}
				if($jour['notes'] != '') {
					$cooltip .= '<br/><b>' . $smarty->get_config_vars('tab_commentaires') . '</b> : ' . (str_replace(array("\r\n", "\n"), array("<br>", "<br>"), $jour['notes']));
				}
				if($jour['lien'] != '') {
					$cooltip .= '<br/><b>' . $smarty->get_config_vars('tab_lien') . '</b> : ' . ($jour['lien']);
				}
				if($jour['nom_createur'] != '') {
					$cooltip .= '<br/><b>' . $smarty->get_config_vars('tab_nomCreateur') . '</b> : ' . ($jour['nom_createur']);
				}

				// couleur du texte dans la case, selon la couleur de fond de la case
				$couleurTexte = buttonFontColor('#' . $jour['couleur']);

				// la case avec le code du projet
				$html .= '<div id="c_' . $jour['periode_id'] . '_' . $tmpDate->format('Ymd') . '" class="caseProjets" onmouseover="return coolTip(\'' . xss_protect(addslashes($cooltip)) . '\')"  onmouseout="nd()" onClick="event.cancelBubble=true;" onMouseUp="Reloader.stopRefresh();modifPeriode(this, ' . $jour['periode_id'] . ');" style="color:' . $couleurTexte . ';' . $opacity . ';background-color:#' . $jour['couleur'] . ';';
				if($jour['duree'] > 0 && $jour['duree'] < 8) {
					if($jour['lien'] != '') {
						$html .= 'background-image:url(\'assets/img/pictos/half_link.gif\'); background-repeat:no-repeat; background-position:bottom right;';
					} else {
						$html .= 'background-image:url(\'assets/img/pictos/half.gif\'); background-repeat:no-repeat; background-position:bottom left;';
					}
				} else {
					if($jour['lien'] != '') {
						$html .= 'background-image:url(\'assets/img/pictos/link.jpg\'); background-repeat:no-repeat; background-position:bottom right;';
					}
				}
				if($jour['statut_tache'] == 'fait' || $jour['statut_tache'] == 'abandon') {
					$html .= 'text-decoration:line-through;';
				}
				if(!$user->checkDroit('tasks_modify_all') && !($user->checkDroit('tasks_modify_own_project') && $jour['createur_id'] == $user->user_id) && !($user->checkDroit('tasks_modify_own_task') && ($jour['user_id'] == $user->user_id || $jour['createur_id'] == $user->user_id))) {
					//si pas les droits on affiche curseur interdit
					$html .= 'cursor:url(\'assets/img/pictos/interdit.png\'),default';
				}
				if( $_SESSION['inverserUsersProjets']) {
					$nom = substr($jour['user_id'], 0, 5);
				} else {
					$nom = substr($jour['projet_id'], 0, 5);
				}
				$html .= '">';
				if($jour['livrable'] == 'oui') {
					$html .= '<img src="assets/img/pictos/milestone.png" border="0" style="vertical-align:top" />';
				} else {
					$html .= $nom;
				}
				$html .= '</div>';

				if($user->checkDroit('tasks_modify_all') || ($user->checkDroit('tasks_modify_own_project') && $jour['createur_id'] == $user->user_id) || ($user->checkDroit('tasks_modify_own_task') && ($jour['user_id'] == $user->user_id || $jour['createur_id'] == $user->user_id))) {
					// on rend draggable la case du projet
					$js .= 'Drag.init(document.getElementById("c_' . $jour['periode_id'] . '_' . $tmpDate->format('Ymd') . '"));' . CRLF;
				}

				// on additionne le total des jours
				if(!isset($totalParJour[$tmpDate->format('Ymd')])) {
					$totalParJour[$tmpDate->format('Ymd')] = '00:00';
				}
				if($jour['date_fin'] != '') {
					$totalParJour[$tmpDate->format('Ymd')] = ajouterDuree($totalParJour[$tmpDate->format('Ymd')], usertime2sqltime(CONFIG_DURATION_DAY, false));
				} else {
					$totalParJour[$tmpDate->format('Ymd')] = ajouterDuree($totalParJour[$tmpDate->format('Ymd')], usertime2sqltime($jour['duree'], false));
					//echo $tmpDate->format('Ymd') . ' -- ' . $totalParJour[$tmpDate->format('Ymd')] . ' -- ' . $jour['duree'] . '<br>';
				}

			}

			$ordreJourPrec = $ordreJourCourant;
			$ordreJourCourant = array();

			// espace vide pour permettre de cliquer en dessous d'une case assignée
			$html.= '<div style="height:8px;padding:0px;margin:0px;font-size:0px"></div>';

			$html .= '</td>' . CRLF;

		} else {
			// jour vide
			$html .= '<td ' . $styleLigne . ' id="td_' . $ligneId . '_' . $tmpDate->format('Ymd') . '"';
			if($user->checkDroit('tasks_modify_all') || $user->checkDroit('tasks_modify_own_project') || $user->checkDroit('tasks_modify_own_task')) {
				$html .= ' onClick="Reloader.stopRefresh();xajax_ajoutPeriode(\'' . $tmpDate->format('Y-m-d') . '\', \'' . $ligneId . '\');"';
			}
			$html .= ' class="' . $classTD . (($tmpDate->format('Y-m-d') == date('Y-m-d')) ? ' today' : '') . '">';
			if($ferie !== false) {
				$html .= $ferie;
			} else {
				$html .= '&nbsp;';
			}
			$html .= '</td>' . CRLF;
		}
		$tmpDate->modify('+1 day');

	}
	$html .= '</tr>' . CRLF;
}

// ligne de total
if($afficherLigneTotal == 1) {
	$html .= '<th id="tdUser_' . ($nbLine-1) . '" nowrap="nowrap">' . $smarty->get_config_vars('tab_totalJour') . '</th>' .CRLF;
	$tmpDate = clone $dateDebut;
	// on boucle sur la durée de l'affichage
	while ($tmpDate <= $dateFin) {
		// définit le style pour case semaine et WE
		if (!in_array($tmpDate->format('w'), $DAYS_INCLUDED) || in_array($tmpDate->format('Y-m-d'), $joursFeries)) {
			$classTD = 'weekend';
		} else {
			$classTD = 'week';
		}
		if(isset($totalParJour[$tmpDate->format('Ymd')])) {
			$html .= '<td class="' . $classTD . '" style="font-size:10px">' . $totalParJour[$tmpDate->format('Ymd')] . '</td>' . CRLF;
		} else {
			$html .= '<td class="' . $classTD . '" style="background-color:#E6E6E6">&nbsp;</td>' . CRLF;
		}
		$tmpDate->modify('+1 day');
	}
}

$html .= '</table>' . CRLF;

$smarty->assign('htmlTableau', $html);



if($_SESSION['inverserUsersProjets']) {
	//////////////////////////
	// TABLEAU RECAP DES PROJETS
	//////////////////////////
	$html = '<table border="0" id="divProjectTable" cellspacing="1" cellpadding="3" class="table table-striped" ' . (isset($_COOKIE['divProjectTable']) && $_COOKIE['divProjectTable'] == 'none' ? 'style="display:none;"' : '') . ' style="margin-top:5px;width:1180px;">' . CRLF;
	$html .= '	<tr>' . CRLF;
	$html .= '		<td width="25" valign="top" nowrap="nowrap">' . $smarty->get_config_vars('tab_code') . '</td>' . CRLF;
	$html .= '		<td valign="top" nowrap="nowrap">' . $smarty->get_config_vars('tab_projet2') . '</td>' . CRLF;
	$html .= '		<td valign="top" nowrap="nowrap">' . $smarty->get_config_vars('tab_periode2') . '</td>' . CRLF;
	$html .= '		<td valign="top" nowrap="nowrap" width="140">' . $smarty->get_config_vars('tab_charge') . '</td>' . CRLF;
	$html .= '	</tr>' . CRLF;
	// recuperation des projets couvrant la période, pour le filtre de projets
	$projets = new GCollection('Projet');
	$sql= "SELECT distinct pp.*, pg.nom AS groupe_nom
		FROM planning_projet pp
		INNER JOIN planning_periode pd ON pp.projet_id = pd.projet_id
		LEFT JOIN planning_groupe AS pg ON pp.groupe_id = pg.groupe_id ";
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		// on filtre sur les projets de l'équipe de ce user
		$sql .= " INNER JOIN planning_user AS pu ON pd.user_id = pu.user_id ";
	}
	$sql .= " WHERE (
			(pd.date_debut <= '" . $dateDebut->format('Y-m-d') . "'
			AND pd.date_fin >= '" . $dateDebut->format('Y-m-d') . "')
			OR
			(pd.date_debut <= '" . $dateFin->format('Y-m-d') . "'
			AND pd.date_debut >= '" . $dateDebut->format('Y-m-d') . "')
		)";
	if(count($_SESSION['filtreGroupeProjet']) > 0) {
		$sql .= " AND pp.projet_id IN ('" . implode("','", $_SESSION['filtreGroupeProjet']) . "')";
	}
	if(count($_SESSION['filtreUser']) > 0) {
		$sql.= " AND pd.user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
	}
	if($_SESSION['filtreTexte'] != "") {
		$sql.= " AND (pd.notes LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') . " OR pd.lien LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') ." )";
	}
	if($user->checkDroit('tasks_view_own_projects')) {
		$sql .= " AND pp.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
	}
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		$sql .= " AND pd.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
	}

	$sql .= "	GROUP BY pp.nom, pp.projet_id
				ORDER BY pp.groupe_id, pp.nom";
	$projets->db_loadSQL($sql);

	while($projet = $projets->fetch()) {
		$html .= '	<tr>' . CRLF;
		$couleurTexte = buttonFontColor('#' . $projet->couleur);
		$cooltipProjet = '<b>' . $smarty->get_config_vars('tab_projet') . '</b> : ' . $projet->nom . '(' . $projet->projet_id . ')<br />' .
							'<b>' . $smarty->get_config_vars('tab_statut') . '</b> :' . $projet->statut . '<br />' .
							'<b>' . $smarty->get_config_vars('tab_chargeEstimee') . '</b> : ' . $projet->charge . '<br />' .
							'<b>' . $smarty->get_config_vars('tab_livraison') . '</b> : ' . $projet->livraison .
							($projet->iteration != '' ? '<br /><b>' . $smarty->get_config_vars('tab_commentaire') . '</b> : ' . htmlentities($projet->iteration) : '');
		$html .= '<td onmouseover="return coolTip(\'' . addslashes($cooltipProjet) . '\', WIDTH, 400)"  onmouseout="nd()" onClick="javascript:Reloader.stopRefresh();xajax_modifProjet(\'' . $projet->projet_id . '\', \'planning\');undefined;" align="center" width="25" nowrap="nowrap" class="codesProjets" style="cursor:pointer;background:#' . $projet->couleur . ';color:' . $couleurTexte .';">' . $projet->projet_id . '</td>' . CRLF;
		$html .= '<td valign="top"><b>' . $projet->nom . '</b>' . (!is_null($projet->iteration) ? '<br />' . $projet->iteration : '');

		$html .= '<td valign="top">';
		// on charge les périodes liées à ce projet
		$periodes = new GCollection('Periode');
		$sql = "SELECT pp.*
				FROM planning_periode AS pp
				INNER JOIN planning_user ON planning_user.user_id = pp.user_id
				WHERE planning_user.visible_planning = 'oui'
				AND projet_id = '" . $projet->projet_id . "'
				AND (
					(pp.date_debut <= '" . $dateDebut->format('Y-m-d') . "' AND pp.date_fin >= '" . $dateDebut->format('Y-m-d') . "')
					OR (pp.date_debut <= '" . $dateFin->format('Y-m-d') . "' AND pp.date_debut >= '" . $dateDebut->format('Y-m-d') . "')
					)";
		if(count($_SESSION['filtreUser']) > 0) {
			$sql.= " AND pp.user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
		}
		if($_SESSION['filtreTexte'] != "") {
			$sql.= " AND (pp.notes LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') . " OR pp.lien LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') ." )";
		}
		$sql .= " ORDER BY pp.date_debut";
		//echo $sql . '<br>';
		$periodes->db_loadSQL($sql);

		// si aucune période dispo pour ce projet (par exemple si user non visible) on masque le projet
		if($periodes->getCount() == 0) {
			continue;
		}

		$totalJours = 0;
		$totalJoursPassed = 0;
		$totalHeures = "00:00";
		$totalHeuresPassed = "00:00";
		while ($periode = $periodes->fetch()) {
			$html .= '<div style="font-size:10px;">';
			if (is_null($periode->date_fin)) {
				$html .= sqldate2userdate($periode->date_debut) . ' => ' . sqltime2usertime($periode->duree) . ' (' . $periode->user_id . ')';
			} else {
				$html .= sqldate2userdate($periode->date_debut) . ' => ' . sqldate2userdate($periode->date_fin) . ' (' . $periode->user_id . ')';
			}
			if (!is_null($periode->titre)) {
				$html .= ' (' . xss_protect($periode->titre) . ')';
			}
			if (!is_null($periode->notes)) {
				$html .= '&nbsp;&nbsp;&nbsp;' . xss_protect($periode->notes);
			}
			if (!is_null($periode->lien)) {
				$html .= '&nbsp;&nbsp;&nbsp;<a href="' . xss_protect($periode->lien) . '" target="_blank">' . $smarty->get_config_vars('tab_lien') . '</a>';
			}
			$html .= '</div>';

			$date1 = new DateTime();
			$date1->setDate(substr($periode->date_debut,0,4), substr($periode->date_debut,5,2), substr($periode->date_debut,8,2));

			// on additionne les jours de travail
			if(!is_null($periode->date_fin)) {
				$date2 = new DateTime();
				$date2->setDate(substr($periode->date_fin,0,4), substr($periode->date_fin,5,2), substr($periode->date_fin,8,2));
				while ($date1 <= $date2) {
					// on ne compte pas le jour si c'est WE ou jour férié
					if (in_array($date1->format('w'), $DAYS_INCLUDED) && !in_array($date1->format('Y-m-d'), $joursFeries)) {
						$totalJours +=1;
						if($date1 < $now) {
							$totalJoursPassed +=1;
						}
					}
					$date1->modify('+1 day');
				}
			} else {
				$totalHeures = ajouterDuree($totalHeures, $periode->duree);
				if($date1 < $now) {
					$totalHeuresPassed = ajouterDuree($totalHeuresPassed, $periode->duree);
				}

			}
		}

		$html .= '</td>' . CRLF;
		$html .= '<td valign="top">' . CRLF;
		if(!is_null($projet->charge)) {
			$html .= $smarty->get_config_vars('tab_chargeProjet') . ' : ' . $projet->charge . $smarty->get_config_vars('tab_j') . '<br />' . CRLF;
		}
		if($totalJours > 0) {
			$html .= $smarty->get_config_vars('tab_total') . ' : '  . $totalJours . $smarty->get_config_vars('tab_j') . CRLF;
		}
		if($totalHeures != '00:00') {
			if($totalJours > 0) {
				$html .= '&nbsp;' . CRLF;
			} else {
				$html .= $smarty->get_config_vars('tab_total') . ' : ' . CRLF;
			}
			$html .= $totalHeures . CRLF;
		}
		$html .= '<br />' . CRLF;
		if($totalJoursPassed > 0) {
			$html .= $smarty->get_config_vars('tab_passe') . ' : ' . $totalJoursPassed . $smarty->get_config_vars('tab_j') . CRLF;
		}
		if($totalHeuresPassed > 0) {
			if($totalJoursPassed > 0) {
				$html .= '&nbsp;' . CRLF;
			} else {
				$html .= $smarty->get_config_vars('tab_passe') . ' : ' . CRLF;
			}
			$html .= $totalHeuresPassed . CRLF;
		}
		$html .= '</td>' . CRLF;
		$html .= '	</tr>' . CRLF;
	}
	$html .= '</table>' . CRLF;

} else {

	//////////////////////////
	// TABLEAU RECAP DES USERS
	//////////////////////////
	$html = '<table border="0" id="divProjectTable" cellspacing="1" cellpadding="3" class="table table-striped" ' . (isset($_COOKIE['divProjectTable']) && $_COOKIE['divProjectTable'] == 'none' ? 'style="display:none;"' : '') . ' style="margin-top:5px;width:1180px;">' . CRLF;
	$html .= '	<tr>' . CRLF;
	$html .= '		<td width="25" valign="top" nowrap="nowrap">' . $smarty->get_config_vars('tab_code') . '</td>' . CRLF;
	$html .= '		<td valign="top" nowrap="nowrap">' . $smarty->get_config_vars('tab_personne') . '</td>' . CRLF;
	$html .= '		<td valign="top" nowrap="nowrap">' . $smarty->get_config_vars('tab_periode2') . '</td>' . CRLF;
	$html .= '		<td valign="top" nowrap="nowrap" width="140">' . $smarty->get_config_vars('tab_charge') . '</td>' . CRLF;
	$html .= '	</tr>' . CRLF;

	// recuperation des personnes
	$users = new GCollection('User');
	$sql= "SELECT *
			FROM planning_user
			WHERE visible_planning = 'oui' ";
	if(count($_SESSION['filtreUser']) > 0) {
		$sql.= " AND user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
	}
	if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
		$sql .= " AND planning_user.user_groupe_id = " . $user->user_groupe_id;
	}
	if(strpos($_SESSION['triPlanning'], 'nom') !== FALSE) {
		$sql .= "	ORDER BY nom ASC";
	} else {
		$sql .= "	ORDER BY nom DESC";
	}
	$users->db_loadSQL($sql);

	while($userTemp = $users->fetch()) {
		$html .= '	<tr>' . CRLF;
		$couleurTexte = buttonFontColor('#' . $userTemp->couleur);
		$html .= '<td onClick="javascript:Reloader.stopRefresh();xajax_modifUser(\'' . $userTemp->user_id . '\');undefined;" align="center" width="25" nowrap="nowrap" class="codesProjets" style="cursor:pointer;background:#' . $userTemp->couleur . ';color:' . $couleurTexte .';">' . $userTemp->user_id . '</td>' . CRLF;
		$html .= '<td valign="top"><b>' . $userTemp->nom . '</b>';

		$html .= '<td valign="bottom">';
		// on charge les périodes liées aux projets
		$periodes = new GCollection('Periode');
		$sql = "SELECT pp.*
				FROM planning_periode AS pp
				INNER JOIN planning_user ON planning_user.user_id = pp.user_id
				WHERE planning_user.visible_planning = 'oui'
				AND pp.user_id = '" . $userTemp->user_id . "'
				AND (
					(pp.date_debut <= '" . $dateDebut->format('Y-m-d') . "' AND pp.date_fin >= '" . $dateDebut->format('Y-m-d') . "')
					OR (pp.date_debut <= '" . $dateFin->format('Y-m-d') . "' AND pp.date_debut >= '" . $dateDebut->format('Y-m-d') . "')
					)";
		if(count($_SESSION['filtreUser']) > 0) {
			$sql.= " AND pp.user_id IN ('" . implode("','", $_SESSION['filtreUser']) . "')";
		}
		if($_SESSION['filtreTexte'] != "") {
			$sql.= " AND (pp.notes LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') . " OR pp.lien LIKE " . val2sql('%' . $_SESSION['filtreTexte'] . '%') ." )";
		}
		if(count($_SESSION['filtreGroupeProjet']) > 0) {
			$sql .= " AND pp.projet_id IN ('" . implode("','", $_SESSION['filtreGroupeProjet']) . "')";
		}
		if($user->checkDroit('tasks_view_own_projects')) {
			$sql .= " AND pp.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
		}
		if ($user->checkDroit('tasks_view_team_projects') && !is_null($user->user_groupe_id)) {
			$sql .= " AND pp.projet_id IN ('" . implode("','", $listeProjetsPossibles) . "')";
		}

		$sql .= " ORDER BY pp.date_debut";
		//echo $sql . '<br>';
		$periodes->db_loadSQL($sql);

		// si aucune période dispo pour ce projet (par exemple si user non visible) on masque le projet
		if($periodes->getCount() == 0) {
			$html .= '</td>' . CRLF;
			$html .= '<td valign="top">' . CRLF;
			$html .= '</td>' . CRLF;
			continue;
		}

		$totalJours = 0;
		$totalJoursPassed = 0;
		$totalHeures = "00:00";
		$totalHeuresPassed = "00:00";
		while ($periode = $periodes->fetch()) {
			$html .= '<div style="font-size:10px;">';
			if (is_null($periode->date_fin)) {
				$html .= sqldate2userdate($periode->date_debut) . ' => ' . sqltime2usertime($periode->duree);
				$testHeures = $periode->getHeureDebutFin();
				if(!is_null($testHeures)) {
					$html .= ' (' . sqltime2usertime($testHeures['duree_details_heure_debut']) . ' => ' . sqltime2usertime($testHeures['duree_details_heure_fin']) . ')';
				}
				if($periode->duree_details == 'AM') {
					$html .= ' (' . $smarty->get_config_vars('tab_matin') . ')';
				}
				if($periode->duree_details == 'PM') {
					$html .= ' (' . $smarty->get_config_vars('tab_apresmidi') . ')';
				}
				$html .= ' (' . $periode->projet_id . ')';
			} else {
				$html .= sqldate2userdate($periode->date_debut) . ' => ' . sqldate2userdate($periode->date_fin) . ' (' . $periode->projet_id . ')';
			}
			if (!is_null($periode->titre)) {
				$html .= ' (' . xss_protect($periode->titre) . ')';
			}
			if (!is_null($periode->notes)) {
				$html .= '&nbsp;&nbsp;&nbsp;' . xss_protect($periode->notes);
			}
			if (!is_null($periode->lien)) {
				$html .= '&nbsp;&nbsp;&nbsp;<a href="' . xss_protect($periode->lien) . '" target="_blank">' . $smarty->get_config_vars('tab_lien') . '</a>';
			}
			$html .= '</div>';

			$date1 = new DateTime();
			$date1->setDate(substr($periode->date_debut,0,4), substr($periode->date_debut,5,2), substr($periode->date_debut,8,2));

			// on additionne les jours de travail
			if(!is_null($periode->date_fin)) {
				$date2 = new DateTime();
				$date2->setDate(substr($periode->date_fin,0,4), substr($periode->date_fin,5,2), substr($periode->date_fin,8,2));
				while ($date1 <= $date2) {
					// on ne compte pas le jour si c'est WE ou jour férié
					if (in_array($date1->format('w'), $DAYS_INCLUDED) && !in_array($date1->format('Y-m-d'), $joursFeries)) {
						$totalJours +=1;
						if($date1 < $now) {
							$totalJoursPassed +=1;
						}
					}
					$date1->modify('+1 day');
				}
			} else {
				$totalHeures = ajouterDuree($totalHeures, $periode->duree);
				if($date1 < $now) {
					$totalHeuresPassed = ajouterDuree($totalHeuresPassed, $periode->duree);
				}

			}
		}

		$html .= '</td>' . CRLF;
		$html .= '<td valign="top">' . CRLF;
		if($totalJours > 0) {
			$html .= $smarty->get_config_vars('tab_total') . ' : '  . $totalJours . $smarty->get_config_vars('tab_j') . CRLF;
		}
		if($totalHeures != '00:00') {
			if($totalJours > 0) {
				$html .= '&nbsp;' . CRLF;
			} else {
				$html .= $smarty->get_config_vars('tab_total') . ' : ' . CRLF;
			}
			$html .= $totalHeures . CRLF;
		}
		$html .= '<br />' . CRLF;
		if($totalJoursPassed > 0) {
			$html .= $smarty->get_config_vars('tab_passe') . ' : ' . $totalJoursPassed . $smarty->get_config_vars('tab_j') . CRLF;
		}
		if($totalHeuresPassed > 0) {
			if($totalJoursPassed > 0) {
				$html .= '&nbsp;' . CRLF;
			} else {
				$html .= $smarty->get_config_vars('tab_passe') . ' : ' . CRLF;
			}
			$html .= $totalHeuresPassed . CRLF;
		}
		$html .= '</td>' . CRLF;
		$html .= '	</tr>' . CRLF;
	}

	$html .= '</table>' . CRLF;

}

// anchor for show/hide, move the page to be the entire project table
$html .= '<a id="anchorProjectTable"></a>' . CRLF;

// pour savoir combien de groupes à afficher dans colonne de gauche
$smarty->assign('nbGroupes', ($idGroupeCourant+1));

$smarty->assign('htmlRecap', $html);

$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->assign('js', $js);

$smarty->display('www_planning.tpl');
