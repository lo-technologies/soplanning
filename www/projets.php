<?php

require('./base.inc');
require(BASE . '/../config.inc');

$smarty = new MySmarty();

require BASE . '/../includes/header.inc';

if(!$user->checkDroit('projects_manage_all') && !$user->checkDroit('projects_manage_own')) {
	$_SESSION['message'] = 'droitsInsuffisants';
	header('Location: ../index.php');
	exit;
}

// PARAMÈTRES
$dateDebut = new DateTime();

if (isset($_GET['nb_mois']) && is_numeric($_GET['nb_mois']) && round($_GET['nb_mois']) > 0) {
	$nbMois = $_GET['nb_mois'];
	$_SESSION['nb_mois'] = $_GET['nb_mois'];
} elseif (isset($_SESSION['nb_mois'])) {
	$nbMois = $_SESSION['nb_mois'];
} else {
	$nbMois = 2;
	$_SESSION['nb_mois'] = $nbMois;
}

$pattern = '/^([1-9]|0[1-9]|1[0-9]|2[0-9]|3[01])\/([1-9]|0[1-9]|1[012])\/(19[0-9][0-9]|20[0-9][0-9])$/';
if(isset($_SESSION['date_debut_affiche'])) {
	$_GET['date_debut_affiche'] = $_SESSION['date_debut_affiche'];
}
if (isset($_GET['date_debut_affiche']) && preg_match($pattern, $_GET['date_debut_affiche']) == 1) {
	$dateDebut->setDate(substr($_GET['date_debut_affiche'],6,4), substr($_GET['date_debut_affiche'],3,2), substr($_GET['date_debut_affiche'],0,2));
	$_SESSION['date_debut_affiche'] = $_GET['date_debut_affiche'];
} else {
	$dateDebut->modify('-' . CONFIG_DEFAULT_NB_PAST_DAYS . ' days');
	$_SESSION['date_debut_affiche'] = $dateDebut->format('d/m/Y');
}

if (isset($_GET['statut']) && is_array($_GET['statut'])) {
	$listeStatuts = $_GET['statut'];
} elseif (isset($_SESSION['statut']) && is_array($_SESSION['statut'])) {
	$listeStatuts = $_SESSION['statut'];
} else {
	$listeStatuts = array('a_faire', 'en_cours', 'fait');
}
$_SESSION['statut'] = $listeStatuts;

if (isset($_GET['filtrageProjet'])) {
	$filtrageProjet = $_GET['filtrageProjet'];
} elseif (isset($_SESSION['filtrageProjet'])) {
	$filtrageProjet = $_SESSION['filtrageProjet'];
} else {
	$filtrageProjet = 'tous';
}
$_SESSION['filtrageProjet'] = $filtrageProjet;

if (isset($_GET['order'])) {
	$order = $_GET['order'];
} elseif (isset($_SESSION['projet_order'])) {
	$order = $_SESSION['projet_order'];
} else {
	$order = 'nom';
}

if (isset($_GET['by'])) {
	$by = $_GET['by'];
} elseif (isset($_SESSION['projet_by'])) {
	$by = $_SESSION['projet_by'];
} else {
	$by = 'ASC';
}

// FIN PARAMÈTRES

$dateFin = clone $dateDebut;
$dateFin->modify('+' . $nbMois . ' months');
$dateFin->modify('-1 days');

$smarty->assign('dateDebut', $dateDebut->format('d/m/Y'));
$smarty->assign('dateFin', $dateFin->format('d/m/Y'));
$smarty->assign('nbMois', $nbMois);
$smarty->assign('listeStatuts', $listeStatuts);
$smarty->assign('filtrageProjet', $filtrageProjet);
$smarty->assign('order', $order);
$smarty->assign('by', $by);

$projets = new GCollection('Projet');

if(isset($_GET['rechercheProjet']) && $_GET['rechercheProjet'] != ''){
	$sql = "SELECT planning_projet.*, planning_groupe.nom AS nom_groupe, planning_user.nom AS nom_createur FROM planning_projet
			LEFT JOIN planning_groupe ON planning_groupe.groupe_id = planning_projet.groupe_id
			LEFT JOIN planning_user ON planning_user.user_id = planning_projet.createur_id
			WHERE planning_projet.nom LIKE '%" . addslashes($_GET['rechercheProjet']) . "%'
			OR planning_projet.iteration LIKE '%" . addslashes($_GET['rechercheProjet']) . "%'
			ORDER BY nom_groupe ASC," . $order . ' ' . $by;
	$smarty->assign('rechercheProjet', $_GET['rechercheProjet']);
}  else {
	// recuperation des projets couvrant la période
	$sql = "SELECT distinct planning_projet.*, planning_groupe.nom AS nom_groupe, planning_user.nom AS nom_createur FROM planning_projet
			LEFT JOIN planning_groupe ON planning_groupe.groupe_id = planning_projet.groupe_id
			LEFT JOIN planning_user ON planning_user.user_id = planning_projet.createur_id ";
	if($filtrageProjet != 'tous') {
		$sql .= "INNER JOIN planning_periode ON planning_periode.projet_id = planning_projet.projet_id AND ((planning_periode.date_debut <= '" . $dateDebut->format('Y-m-d') . "' AND planning_periode.date_fin >= '" . $dateDebut->format('Y-m-d') . "') OR (planning_periode.date_debut <= '" . $dateFin->format('Y-m-d') . "' AND planning_periode.date_debut >= '" . $dateDebut->format('Y-m-d') . "')) ";
	}
	$sql .= " WHERE planning_projet.statut in ('" . implode("','", $listeStatuts) . "')
			ORDER BY nom_groupe ASC," . $order . ' ' . $by;
	$smarty->assign('rechercheProjet', '');
 }

$projets->db_loadSQL($sql);
$smarty->assign('projets', $projets->getSmartyData());


$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->display('www_projets.tpl');

?>