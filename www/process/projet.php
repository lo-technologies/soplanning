<?php

require 'base.inc';
require BASE . '/../config.inc';

require BASE . '/../includes/header.inc';

$smarty = new MySmarty();

if(!$user->checkDroit('projects_manage_all') && !$user->checkDroit('projects_manage_own')) {
	$_SESSION['message'] = 'droitsInsuffisants';
	header('Location: ../index.php');
	exit;
}

if (isset($_GET['action']) && $_GET['action'] == 'delete'){
	if (!isset($_GET['projet_id'])){
		die('Index introuvable, suppression impossible');
	} else {
		$projet = new projet();
		
		if (!$projet->db_load(array('projet_id', '=', $_GET['projet_id']))) {
			echo 'problème de chargement de cet enregistrement';
			die();
		}

		if(!$user->checkDroit('projects_manage_all') && $projet->createur_id != $user->user_id) {
			$_SESSION['message'] = 'droitsInsuffisants';
			header('Location: ../index.php');
			exit;
		}

		$projet->db_delete();

		$_SESSION['message'] = 'changeOK';
		if(isset($_GET['origine']) && $_GET['origine'] != '') {
			if($_GET['origine'] == 'projets') {
				header('Location: ../projets.php');
				exit;
			} else {
				header('Location: ../planning.php');
				exit;
			}
		}
	}
} else {
	if(!isset($_POST['old_projet_id'])) {
		$_SESSION['message'] = 'unexpected error';
		header('Location: ../index.php');
		exit;
	}

	$projetTest = new Projet();
	$sql = 'SELECT * FROM planning_projet WHERE projet_id = ' . val2sql($_POST['projet_id']);
	if($_POST['old_projet_id'] != '') {
		$sql .= ' AND projet_id <> ' . val2sql($_POST['old_projet_id']);
	}

	if($projetTest->db_loadSQL($sql)) {
		die('Existing project identifier');
	}

	// modification de la clé (projet_id) => update manuel
	if($_POST['old_projet_id'] != '' && $_POST['old_projet_id'] != $_POST['projet_id']) {
		$sql = 'UPDATE planning_projet SET projet_id = ' . val2sql($_POST['projet_id']) . ' WHERE projet_id = ' . val2sql($_POST['old_projet_id']);
		db_query($sql);
	}

/*
echo '<pre>';
print_r($_POST);
echo '</pre>';
die;
*/

	$projet = new Projet();
	if(isset($_POST['saved']) && $_POST['saved'] == 1) {
		$projet->db_load(array('projet_id', '=', $_POST['projet_id']));
	}
	$projet->loadArray($_POST);
	if($user->checkDroit('projects_manage_all')) {
		// rien à faire sur le createur_id, passé dans le POST
	} elseif($user->checkDroit('projects_manage_own')) {
		// si c'est un planner, on lui assigne le projet à la creation, et on checke qu'il n'a pas tenté de le changer en modif
		if($projet->isSaved() && $projet->createur_id != $user->user_id) {
			$_SESSION['message'] = 'droitsInsuffisants';
			header('Location: ../index.php');
			exit;
		} else {
			$projet->createur_id = $user->user_id;
		}		
	}

	if(!is_null($projet->livraison)) {
		$projet->livraison = userdate2sqldate($projet->livraison);
	}

	if(strpos($projet->couleur, '#') !== FALSE) {
		$projet->couleur = substr($projet->couleur, 1, 6);
	}

	if (is_array($projet->check())) {
		$_SESSION['message'] = $smarty->get_config_vars('erreurChamps') . '<br>' . print_r($projet->check(), true);
		$_SESSION['err_projet'] = $projet->getData();
		header('Location: ../projets.php');
		exit;
	}

	$projet->db_save();

	$_SESSION['message'] = 'changeOK';
	if(isset($_POST['origine']) && $_POST['origine'] != '') {
		if($_POST['origine'] == 'projets') {
			header('Location: ../projets.php');
			exit;
		} else {
			header('Location: ../planning.php');
			exit;
		}
	}
}

header('Location: ../projets.php');
exit;

?>