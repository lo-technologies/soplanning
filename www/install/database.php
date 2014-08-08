<?php

require 'base.inc';
require BASE . '/../config.inc';


// permet de checker que quelqu'un ne tente pas d'accéder à la page directement
if(!isset($_SESSION['installEnCours'])) {
	header('Location: ' . BASE . '/');
	exit;
}

// on ecrase les params
if(!isset($_POST['cfgHostname']) || !isset($_POST['cfgUsername']) || !isset($_POST['cfgPassword']) || !isset($_POST['cfgDatabase'])) {
	header('Location: ' . BASE . '/');
	exit;
}
$cfgHostname = $_POST['cfgHostname'];
$cfgUsername = $_POST['cfgUsername'];
$cfgPassword = $_POST['cfgPassword'];
$cfgDatabase = $_POST['cfgDatabase'];

// installation de la base
$version = new Version();
$res = $version->importDatabase();

if($res !== TRUE) {
	$_SESSION['message'] = $res;
	header('Location: ' . BASE . '/install/');
	exit;
} else {
	header('Location: ' . BASE . '/install/install_ok.php');
	exit;
}

?>