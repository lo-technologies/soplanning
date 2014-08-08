<?php

require('./base.inc');
require(BASE . '/../config.inc');

$smarty = new MySmarty();

require BASE . '/../includes/header.inc';

if(!$user->checkDroit('parameters_all')) {
	$_SESSION['message'] = 'droitsInsuffisants';
	header('Location: ../index.php');
	exit;
}

$feries = new GCollection('Ferie');
$feries->db_load(array(), array('date_ferie' => 'DESC'));
$smarty->assign('feries', $feries->getSmartyData());

$fichiers = glob(BASE . '/../holidays/*.*');
$smarty->assign('fichiers', $fichiers);

$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->display('www_feries.tpl');

?>