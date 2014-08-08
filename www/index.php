<?php

require_once('./base.inc');
require_once(BASE . '/../config.inc');

// redirection possible vers l'installeur / upgrade
$checkInstall = $version->checkInstall();
if(!$checkInstall) {
	header('Location: ' . BASE . '/install/');
	exit;
}

/* autoconnect if already opened session */
if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != '') {
	$user = New User();
	if($user->db_load(array('user_id', '=', $_SESSION['user_id']))) {
		header('Location: planning.php');
		exit;
	}
}

$smarty = new MySmarty();

// header connecté non inclus sur la page de login, check de version ici
$version = new Version();
$smarty->assign('infoVersion', $version->getVersion());

$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->display('www_index.tpl');

?>