<?php

require('./base.inc');
require(BASE . '/../config.inc');

// on fait ce check avant la declaration de smarty pour faire le check d'�criture du repertoire templates_c
$version = new Version();
$checkInstall = $version->checkInstall();


if($checkInstall === TRUE) {
	header('Location: ' . BASE . '/');
	exit;
}

if(!isset($_SESSION['installEnCours'])) {
	$_SESSION['message'] = 'start_install';
}

// valeur � tester dans le fichier de process pour s'assurer que les donn�es viennent de la personne qui acc�de � cette page
$_SESSION['installEnCours'] = 1;

$smarty = new MySmarty();

$smarty->assign('xajax', $xajax->getJavascript("", BASE . "/assets/js/xajax.js"));

$smarty->assign('checkInstall', $checkInstall);

$smarty->assign('cfgHostname', $cfgHostname);
$smarty->assign('cfgDatabase', $cfgDatabase);
$smarty->assign('cfgUsername', $cfgUsername);
$smarty->assign('cfgPassword', $cfgPassword);

$smarty->display('install_index.tpl');

?>