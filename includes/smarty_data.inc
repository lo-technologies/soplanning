<?php

$smartyData = array();

if (isset($_SESSION['message'])) {
	$smartyData['message'] = $_SESSION['message'];
	unset($_SESSION['message']);
}

$this->assign('smartyData', $smartyData);

?>