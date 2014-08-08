<?php

require('./base.inc');
require BASE . '/../config.inc';

$smarty = new MySmarty();

require BASE . '/../includes/header.inc';

if(!$user->checkDroit('projectgroups_manage_all')) {
	$_SESSION['message'] = 'droitsInsuffisants';
	header('Location: index.php');
	exit;
}

if (isset($_GET['order'])) {
	$order = $_GET['order'];
} elseif (isset($_SESSION['groupe_order'])) {
	$order = $_SESSION['groupe_order'];
} else {
	$order = 'groupe_id';
}

if (isset($_GET['by'])) {
	$by = $_GET['by'];
} elseif (isset($_SESSION['groupe_by'])) {
	$by = $_SESSION['groupe_by'];
} else {
	$by = 'ASC';
}

$groupes = new GCollection('Groupe');

$groupes->db_loadSQL('SELECT distinct pg.groupe_id, pg.nom, pg.ordre, COUNT(pp.projet_id) as "totalProjets"
						FROM planning_groupe pg
						LEFT JOIN planning_projet pp ON pg.groupe_id = pp.groupe_id
						GROUP BY pg.groupe_id, pg.nom, pg.ordre
						ORDER BY '. $order . ' ' . $by);

$groupes->setPagination(1000);

if (!empty($_GET['page'])) {
	$groupes->setCurrentPage($_GET['page']);
} elseif (isset($_SESSION['groupe_currentPage'])) {
	$groupes->setCurrentPage($_SESSION['groupe_currentPage']);
} else {
	$groupes->setCurrentPage(1);
}

$smarty->assign('order', $order);
$smarty->assign('by', $by);
$smarty->assign('currentPage', $groupes->getCurrentPage());
$smarty->assign('nbPages', $groupes->getNbPages());

$_SESSION['groupe_order'] = $order;
$_SESSION['groupe_by'] = $by;
$_SESSION['groupe_currentPage'] = $groupes->getCurrentPage();

$smarty->assign('groupes', $groupes->getSmartyData(TRUE));

$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->display('www_groupe_list.tpl');
?>