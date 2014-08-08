<?php

require 'base.inc';
require BASE . '/../config.inc';

require BASE . '/../includes/header.inc';

if(!$user->checkDroit('projectgroups_manage_all')) {
	$_SESSION['message'] = 'droitsInsuffisants';
	header('Location: index.php');
	exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete'){
	if (!isset($_GET['groupe_id'])){
		die('Index introuvable, suppression impossible');
	} else {
		$groupe = new groupe();
		
		if (!$groupe->db_load(array('groupe_id', '=', $_GET['groupe_id']))) {
			echo 'problème de chargement de cet enregistrement';
			die();
		}

		$groupe->db_delete();

		$_SESSION['message'] = 'changeOK';

		header('Location: ' . BASE . '/groupe_list.php');
		exit();
	}
} else {
	
	$groupe = new groupe();
	if($_POST['groupe_id'] != '' && $_POST['groupe_id'] != 0) {
		$groupe->db_load(array('groupe_id', '=', $_POST['groupe_id']));
	}

	$groupe->loadArray($_POST);

	if (is_array($groupe->check())) {
		$_SESSION['message'] = 'error_someWrongData';
		$_SESSION['error_fields'] = $groupe->check();
		$_SESSION['error_groupe'] = $groupe->getData();
		header('Location: ' . BASE . '/groupe_form.php?rand=' . rand());
		exit();
	}

	// on checke que le groupe_id n'existe pas déjà
	if(!$groupe->isSaved()) {
		$groupeTest = new groupe();
		if($groupeTest->db_load(array('groupe_id', '=', $_POST['groupe_id']))) {
			$_SESSION['message'] = 'groupe_id_existant';
			$_SESSION['error_fields'] = array('groupe_id');
			$_SESSION['error_groupe'] = $groupe->getData();
			die;
			header('Location: ' . BASE . '/groupe_form.php?rand=' . rand());
			exit();
		}
	}

	$groupe->db_save();
	$_SESSION['message'] = 'changeOK';	
	header('Location: ' . BASE . '/groupe_list.php');
	exit();
}

?>