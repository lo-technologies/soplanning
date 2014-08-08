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


$urlSuggeree = getUrlInfo();
$smarty->assign('urlSuggeree', $urlSuggeree['root'] . $urlSuggeree['currentDir']);

$smarty->assign('xajax', $xajax->getJavascript("", "assets/js/xajax.js"));

$smarty->display('www_options.tpl');

?>