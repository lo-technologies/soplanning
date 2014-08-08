<?php

if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
	$_SESSION['message'] = 'erreur_fin_connexion';
	header('Location: ' . BASE);
	exit;
}

$user = New User();
if(!$user->db_load(array('user_id', '=', $_SESSION['user_id']))) {
	$_SESSION['message'] = 'erreur_fin_connexion';
	header('Location: ' . BASE);
	exit;
}

if(isset($smarty)) {
	$smarty->assign('user', $user->getSmartyData());

	$version = new Version();
	$infoVersion = $version->getVersion();
	$smarty->assign('infoVersion', $infoVersion);
}

?>