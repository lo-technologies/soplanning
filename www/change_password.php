<?php

require_once('./base.inc');
require_once(BASE . '/../config.inc');

$smarty = new MySmarty();

$userTmp = new User();
if(!isset($_GET['user_id']) || !$userTmp->db_load(array('user_id', '=', $_GET['user_id']))) {
	$_SESSION['message'] = 'Invalid URL';
	header('Location: index.php');
	exit;
}

if(!isset($_GET['date']) || $_GET['date'] < date('Y-m-d')) {
	$_SESSION['message'] = 'Invalid URL';
	header('Location: index.php');
	exit;
}

if(!isset($_GET['hash']) || $_GET['hash'] != md5($_GET['user_id'] . '�' . $_GET['date'] . '�' . CONFIG_SECURE_KEY)) {
	$_SESSION['message'] = 'Invalid URL';
	header('Location: index.php');
	exit;
}

// variable en session pour s�curit�
$_SESSION['change_password'] = $userTmp->user_id;

$smarty->assign('userTmp', $userTmp->getSmartyData());


$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->display('www_change_password.tpl');

?>