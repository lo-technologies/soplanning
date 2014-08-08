<?php

require 'base.inc';
require BASE . '/../config.inc';

require BASE . '/../includes/header.inc';

if(!$user->checkDroit('parameters_all')) {
	$_SESSION['message'] = 'droitsInsuffisants';
	header('Location: ../index.php');
	exit;
}


if(isset($_POST['SOPLANNING_TITLE'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'SOPLANNING_TITLE'));
	$config->valeur = ($_POST['SOPLANNING_TITLE'] != '' ? $_POST['SOPLANNING_TITLE'] : NULL);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
	$config = new Config();
	$config->db_load(array('cle', '=', 'SOPLANNING_URL'));
	$config->valeur = ($_POST['SOPLANNING_URL'] != '' ? $_POST['SOPLANNING_URL'] : NULL);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DAYS_INCLUDED'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'DAYS_INCLUDED'));
	$config->valeur = implode(',', $_POST['DAYS_INCLUDED']);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['HOURS_DISPLAYED'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'HOURS_DISPLAYED'));
	$config->valeur = implode(',', $_POST['HOURS_DISPLAYED']);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DEFAULT_NB_MONTHS_DISPLAYED'])) {
	if(is_numeric($_POST['DEFAULT_NB_MONTHS_DISPLAYED']) && round($_POST['DEFAULT_NB_MONTHS_DISPLAYED']) > 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'DEFAULT_NB_MONTHS_DISPLAYED'));
		$config->valeur = $_POST['DEFAULT_NB_MONTHS_DISPLAYED'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
		// on change aussi la valeur en session
		$_SESSION['nb_mois'] = $config->valeur;
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DEFAULT_NB_DAYS_DISPLAYED'])) {
	if(is_numeric($_POST['DEFAULT_NB_DAYS_DISPLAYED']) && round($_POST['DEFAULT_NB_DAYS_DISPLAYED']) > 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'DEFAULT_NB_DAYS_DISPLAYED'));
		$config->valeur = $_POST['DEFAULT_NB_DAYS_DISPLAYED'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
		// on change aussi la valeur en session
		$_SESSION['nb_jours'] = $config->valeur;
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DEFAULT_NB_ROWS_DISPLAYED'])) {
	if(is_numeric($_POST['DEFAULT_NB_ROWS_DISPLAYED']) && round($_POST['DEFAULT_NB_ROWS_DISPLAYED']) > 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'DEFAULT_NB_ROWS_DISPLAYED'));
		$config->valeur = $_POST['DEFAULT_NB_ROWS_DISPLAYED'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
		// on change aussi la valeur en session
		$_SESSION['nb_lignes'] = $config->valeur;
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DEFAULT_NB_PAST_DAYS'])) {
	if(is_numeric($_POST['DEFAULT_NB_PAST_DAYS']) && round($_POST['DEFAULT_NB_PAST_DAYS']) >= 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'DEFAULT_NB_PAST_DAYS'));
		$config->valeur = $_POST['DEFAULT_NB_PAST_DAYS'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['PLANNING_LINE_HEIGHT'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'PLANNING_LINE_HEIGHT'));
	if(is_numeric($_POST['PLANNING_LINE_HEIGHT']) && round($_POST['PLANNING_LINE_HEIGHT']) > 0) {
		$config->valeur = $_POST['PLANNING_LINE_HEIGHT'];
	} else {
		$config->valeur = null;
	}
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY'));
	if($_POST['PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY'] == 0 || $_POST['PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY'] == 1) {
		$config->valeur = $_POST['PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY'];
	} else {
		$config->valeur = 0;
	}
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['REFRESH_TIMER'])) {
	if(is_numeric($_POST['REFRESH_TIMER']) && round($_POST['REFRESH_TIMER']) > 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'REFRESH_TIMER'));
		$config->valeur = $_POST['REFRESH_TIMER'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['PROJECT_COLORS_POSSIBLE'])) {
	if(strlen($_POST['PROJECT_COLORS_POSSIBLE']) == 0 || strlen($_POST['PROJECT_COLORS_POSSIBLE']) > 6) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'PROJECT_COLORS_POSSIBLE'));
		if(strlen($_POST['PROJECT_COLORS_POSSIBLE']) == 0) {
			$config->valeur = null;
		} else {
			$config->valeur = $_POST['PROJECT_COLORS_POSSIBLE'];
		}
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DEFAULT_PERIOD_LINK'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'DEFAULT_PERIOD_LINK'));
	if(strlen($_POST['DEFAULT_PERIOD_LINK']) == 0) {
		$config->valeur = null;
	} else {
		$config->valeur = $_POST['DEFAULT_PERIOD_LINK'];
	}
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['LOGOUT_REDIRECT'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'LOGOUT_REDIRECT'));
	if(strlen($_POST['LOGOUT_REDIRECT']) == 0) {
		$config->valeur = null;
	} else {
		$config->valeur = $_POST['LOGOUT_REDIRECT'];
	}
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DURATION_DAY'])) {
	if(is_numeric($_POST['DURATION_DAY']) && round($_POST['DURATION_DAY']) > 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'DURATION_DAY'));
		$config->valeur = $_POST['DURATION_DAY'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DURATION_AM'])) {
	if(is_numeric($_POST['DURATION_AM']) && round($_POST['DURATION_AM']) > 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'DURATION_AM'));
		$config->valeur = $_POST['DURATION_AM'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['DURATION_PM'])) {
	if(is_numeric($_POST['DURATION_PM']) && round($_POST['DURATION_PM']) > 0) {
		$config = new Config();
		$config->db_load(array('cle', '=', 'DURATION_PM'));
		$config->valeur = $_POST['DURATION_PM'];
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
	} else {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['SMTP_HOST'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'SMTP_HOST'));
	$config->valeur = ($_POST['SMTP_HOST'] != '' ? $_POST['SMTP_HOST'] : NULL);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
	$config = new Config();
	$config->db_load(array('cle', '=', 'SMTP_PORT'));
	$config->valeur = ($_POST['SMTP_PORT'] != '' ? $_POST['SMTP_PORT'] : NULL);
	if(!$config->db_save()) {
		die;
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
	$config = new Config();
	$config->db_load(array('cle', '=', 'SMTP_SECURE'));
	$config->valeur = ($_POST['SMTP_SECURE'] != '' ? $_POST['SMTP_SECURE'] : NULL);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
	$config = new Config();
	$config->db_load(array('cle', '=', 'SMTP_FROM'));
	$config->valeur = ($_POST['SMTP_FROM'] != '' ? $_POST['SMTP_FROM'] : NULL);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
	$config = new Config();
	$config->db_load(array('cle', '=', 'SMTP_LOGIN'));
	$config->valeur = ($_POST['SMTP_LOGIN'] != '' ? $_POST['SMTP_LOGIN'] : NULL);
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
	if($_POST['SMTP_PASSWORD'] != 'XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX') {
		// hack pour ne pas écraser le password si submit tel quel
		$config = new Config();
		$config->db_load(array('cle', '=', 'SMTP_PASSWORD'));
		$config->valeur = ($_POST['SMTP_PASSWORD'] != '' ? $_POST['SMTP_PASSWORD'] : NULL);
		if(!$config->db_save()) {
			$_SESSION['message'] = 'changeNotOK';
			header('Location: ../options.php');
			exit;
		}
	}
}

if(isset($_POST['PLANNING_REPEAT_HEADER'])) {
	$config = new Config();
	$config->db_load(array('cle', '=', 'PLANNING_REPEAT_HEADER'));
	if(is_numeric($_POST['PLANNING_REPEAT_HEADER']) && round($_POST['PLANNING_REPEAT_HEADER']) > 0) {
		$config->valeur = $_POST['PLANNING_REPEAT_HEADER'];
	} else {
		$config->valeur = null;
	}
	if(!$config->db_save()) {
		$_SESSION['message'] = 'changeNotOK';
		header('Location: ../options.php');
		exit;
	}
}

if(isset($_POST['mailTestDestinataire'])) {
	$mail = new Mailer($_POST['mailTestDestinataire'], 'SOPLANNING - test email', 'OK');
	try {
		$result = $mail->send();
	} catch (phpmailerException $e) {
		echo 'error while sending the email :';
		print_r($e);
		die;
	}

	$_SESSION['message'] = 'options_envoyerMailTest_envoye';
	header('Location: ../options.php');
	exit;
}

$_SESSION['message'] = 'changeOK';
header('Location: ../options.php');
exit;

?>