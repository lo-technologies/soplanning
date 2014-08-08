<?php

require('./base.inc');
require BASE . '/../config.inc';

// Déclaration de smarty
$smarty = new MySmarty();

require BASE . '/../includes/header.inc';

if(!$user->checkDroit('users_manage_all')) {
	$_SESSION['message'] = 'droitsInsuffisants';
	header('Location: index.php');
	exit;
}

if (isset($_GET['order'])) {
	$order = $_GET['order'];
} elseif (isset($_SESSION['user_order'])) {
	$order = $_SESSION['user_order'];
} else {
	$order = 'user_id';
}

if (isset($_GET['by'])) {
	$by = $_GET['by'];
} elseif (isset($_SESSION['user_by'])) {
	$by = $_SESSION['user_by'];
} else {
	$by = 'ASC';
}

$users = new GCollection('User');

$sql = 'SELECT distinct pu.nom, pu.email, pu.user_id, pu.login, pu.visible_planning, pu.couleur, pu.droits, pug.nom AS nom_groupe, COUNT(pp.periode_id) AS "totalPeriodes"
                    from planning_user pu
                    LEFT JOIN planning_periode pp ON pu.user_id = pp.user_id
					LEFT JOIN planning_user_groupe pug ON pug.user_groupe_id = pu.user_groupe_id
                    GROUP BY pu.nom, pu.user_id, pu.login, pu.visible_planning, pu.couleur, pu.droits, nom_groupe
                    ORDER BY '. $order . ' ' . $by;
$users->db_loadSQL($sql);

$users->setPagination(NB_RESULT_PER_PAGE);

if (!empty($_GET['page'])) {
	$users->setCurrentPage($_GET['page']);
} elseif (isset($_SESSION['user_currentPage'])) {
	$users->setCurrentPage($_SESSION['user_currentPage']);
} else {
	$users->setCurrentPage(1);
}

$smarty->assign('order', $order);
$smarty->assign('by', $by);
$smarty->assign('currentPage', $users->getCurrentPage());
$smarty->assign('nbPages', $users->getNbPages());

$_SESSION['user_order'] = $order;
$_SESSION['user_by'] = $by;
$_SESSION['user_currentPage'] = $users->getCurrentPage();

$smarty->assign('users', $users->getSmartyData(TRUE));

$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->display('www_user_list.tpl');
?>
