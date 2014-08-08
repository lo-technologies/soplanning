<?php

require 'base.inc';
require BASE . '/../config.inc';

require (BASE . '/../includes/xajax_common.inc');

function ajoutProjet($origine) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || (!$user->checkDroit('projects_manage_all') && !$user->checkDroit('projects_manage_own'))) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	$projet = new Projet();
	// si droit limité, on ne permet pas le choix du createur
	if($user->checkDroit('projects_manage_own')) {
		$projet->createur_id = $user->user_id;
	}
	$smarty->assign('projet', $projet->getSmartyData());

	// recupere les infos du owner/createur du projet
	$createur = new User();
	if($projet->createur_id != '') {
		$createur->db_load(array('user_id', '=', $projet->createur_id));
	}
	$smarty->assign('createur', $createur->getSmartyData());

	$smarty->assign('origine', $origine);

	$usersOwner = new GCollection('User');
	$usersOwner->db_load(array(), array('nom' => 'ASC'));
	$smarty->assign('usersOwner', $usersOwner->getSmartyData());

	$groupes = new GCollection('Groupe');
	$groupes->db_load(array(), array('ordre' => 'ASC', 'nom' => 'ASC'));
	$smarty->assign('groupes', $groupes->getSmartyData());

	$objResponse->addScript('jQuery("#myModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('ajax_titreCreationProjet')) . '")');
	$objResponse->addScript('jQuery("#myModal .modal-body").html("' . xajaxFormat($smarty->getHtml('projet_form.tpl')) . '")');
	$objResponse->addScript('jQuery("#myModal").modal()');

	$objResponse->addScript("myPicker = new jscolor.color(document.getElementById('couleur'), {});myPicker.fromString('" . $projet->couleur . "')");

	$objResponse->addScript('jQuery("#livraison").datepicker();');
	$objResponse->addScript('jQuery("#livraison").datepicker( "option", "dateFormat", "dd/mm/yyyy");');
	return $objResponse->getXML();
}

function modifProjet($projet_id, $origine) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || (!$user->checkDroit('projects_manage_all') && !$user->checkDroit('projects_manage_own'))) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}

	$projet = new Projet();
	$projet->db_load(array('projet_id', '=', $projet_id));
	$smarty->assign('projet', $projet->getSmartyData());

	$usersOwner = new GCollection('User');
	$usersOwner->db_load(array(), array('nom' => 'ASC'));
	$smarty->assign('usersOwner', $usersOwner->getSmartyData());

	// recupere les infos du owner/createur du projet
	$createur = new User();
	if($projet->createur_id != '') {
		$createur->db_load(array('user_id', '=', $projet->createur_id));
	}
	$smarty->assign('createur', $createur->getSmartyData());

	if($user->checkDroit('tasks_modify_own_project') && $projet->createur_id != $user->user_id) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	$smarty->assign('origine', $origine);

	$groupes = new GCollection('Groupe');
	$groupes->db_load(array(), array('ordre' => 'ASC', 'nom' => 'ASC'));
	$smarty->assign('groupes', $groupes->getSmartyData());

	$objResponse->addScript('jQuery("#myModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('ajax_titreCreationProjet')) . '")');
	$objResponse->addScript('jQuery("#myModal .modal-body").html("' . xajaxFormat($smarty->getHtml('projet_form.tpl')) . '")');
	$objResponse->addScript('jQuery("#myModal").modal()');

	$objResponse->addScript("myPicker = new jscolor.color(document.getElementById('couleur'), {});myPicker.fromString('" . $projet->couleur . "')");
	$objResponse->addScript('jQuery("#livraison").datepicker();');

	return $objResponse->getXML();
}

function ajoutPeriode($dateDebut = '', $user_id = '', $periode_id = '', $heureDebut = '') {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || $user->checkDroit('tasks_readonly')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	// liste de tous les projets
	$listeProjets = new GCollection('Projet');
	if($user->checkDroit('tasks_modify_own_project')) {
		$listeProjets->db_load(array('createur_id', '=', $user->user_id, 'statut', 'IN', array('a_faire','en_cours')), array('nom' => 'ASC'));
	} elseif ($user->checkDroit('tasks_modify_own_task')) {
		$listeProjets->db_loadSQL("SELECT DISTINCT ppr.* FROM planning_projet AS ppr INNER JOIN planning_periode AS ppe ON ppr.projet_id = ppe.projet_id WHERE ppe.user_id = '" . $user->user_id . "' AND statut IN ('a_faire','en_cours') ORDER BY nom ASC");
	} else {
		$listeProjets->db_load(array('statut', 'IN', array('a_faire','en_cours')), array('nom' => 'ASC'));
	}
	$smarty->assign('listeProjets', $listeProjets->getSmartyData());

	// liste de tous les utilisateurs
	$listeUsers = new GCollection('User');
	if($user->checkDroit('tasks_modify_all') || $user->checkDroit('tasks_modify_own_project') || $user->checkDroit('tasks_modify_own_task')) {
		$listeUsers->db_load(array('visible_planning', '=', 'oui'), array('nom' => 'ASC'));
	}
	$smarty->assign('listeUsers', $listeUsers->getSmartyData());

	// si il y a un user pré-choisi, on le sélectionne
	if($user_id != '') {
		$smarty->assign('user_id_choisi', $user_id);
	}

	$periode = new Periode();

	if(isset($dateDebut)) {
		$periode->date_debut = $dateDebut;
	} else {
		$periode->date_debut = date('Y-m-d');
	}
	if ($heureDebut != '') {
		$periode->duree = '01:00:00';
		if ($heureDebut == 23) {
			$periode->duree_details = '23:00:00;23:59:00';
		} else {
			$periode->duree_details = usertime2sqltime($heureDebut) . ';' . usertime2sqltime($heureDebut+1);
		}
	}

	// si periode_id present, veut dire qu'on duplique une période, donc charge les données
	if($periode_id != '') {
		$periodeCopie = new Periode();
		if($periodeCopie->db_load(array('periode_id', '=', $periode_id))) {
			$data = $periodeCopie->getData();
			$data['periode_id'] = 0;
			$data['saved'] = 0;
			$periode->setData($data);
		}
	}

	if(CONFIG_DEFAULT_PERIOD_LINK != '') {
		$periode->lien = CONFIG_DEFAULT_PERIOD_LINK;
	}
	$smarty->assign('periode', $periode->getSmartyData());

	$objResponse->addScript('jQuery("#myBigModal").modal("hide")');
	$objResponse->addScript('jQuery("#myBigModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('ajax_titreGestionPeriode')) . '")');
	$objResponse->addScript('jQuery("#myBigModal .modal-body").html("' . xajaxFormat($smarty->getHtml('periode_form.tpl')) . '")');

	// Initialize select2 box by generic function
	$objResponse->addScript('initselect2()');
	// refresh title box when element is selected
	$objResponse->addScript('jQuery("#projet_id").on("select2-selecting", function(e){xajax_autocompleteTitreTache(e.val);});');
	$objResponse->addScript('jQuery("#myBigModal").modal()');

	$objResponse->addScript('jQuery("#date_debut").datepicker();');
	$objResponse->addScript('jQuery("#date_fin").datepicker();');
	$objResponse->addScript('jQuery("#dateFinRepetition").datepicker();');
	$objResponse->addScript('jQuery("#btnGotoLien").tooltip();');
	$objResponse->addScript('document.getElementById("projet_id").focus();');

	return $objResponse->getXML();
}

function modifPeriode($periode_id) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$periode = new Periode();
	$periode->db_load(array('periode_id', '=', $periode_id));
	$smarty->assign('periode', $periode->getSmartyData());

	$projet = new Projet();
	$projet->db_load(array('projet_id', '=', $periode->projet_id));
	$smarty->assign('projet', $projet->getSmartyData());

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || $user->checkDroit('tasks_readonly') || ($user->checkDroit('tasks_modify_own_project') && $projet->createur_id != $user->user_id)) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	// liste de tous les projets
	$listeProjets = new GCollection('Projet');
	if($user->checkDroit('tasks_modify_own_project')) {
		$listeProjets->db_load(array('createur_id', '=', $user->user_id, 'statut', 'IN', array('a_faire','en_cours')), array('nom' => 'ASC'));
	} elseif ($user->checkDroit('tasks_modify_own_task')) {
		$listeProjets->db_loadSQL("SELECT DISTINCT ppr.* FROM planning_projet AS ppr INNER JOIN planning_periode AS ppe ON ppr.projet_id = ppe.projet_id WHERE ppe.user_id = '" . $user->user_id . "' AND statut IN ('a_faire','en_cours') ORDER BY nom ASC");
	} else {
		$listeProjets->db_load(array('statut', 'IN', array('a_faire','en_cours')), array('nom' => 'ASC'));
	}
	$smarty->assign('listeProjets', $listeProjets->getSmartyData());


	// liste de tous les utilisateurs
	$listeUsers = new GCollection('User');
	if($user->checkDroit('tasks_modify_all') || $user->checkDroit('tasks_modify_own_project') || $user->checkDroit('tasks_modify_own_task')) {
		$listeUsers->db_load(array('visible_planning', '=', 'oui'), array('nom' => 'ASC'));
	}
	$smarty->assign('listeUsers', $listeUsers->getSmartyData());


	// comptage du nombre de jours de la période
	$nbJours = 0;
	if(!is_null($periode->date_fin)) {
		$nbJours = getNbJours($periode->date_debut, $periode->date_fin);
	}
	$smarty->assign('nbJours', $nbJours);

	if($periode->estFilleOuParente()) {
		$smarty->assign('estFilleOuParente', '1');
		$smarty->assign('prochaineOccurence', $periode->prochaineOccurence());
	}

	$objResponse->addScript('jQuery("#myBigModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('ajax_titreGestionPeriode')) . '")');
	$objResponse->addScript('jQuery("#myBigModal .modal-body").html("' . xajaxFormat($smarty->getHtml('periode_form.tpl')) . '")');
	$objResponse->addScript('jQuery("#myBigModal").modal()');

	// Initialize select2 box by generic function
	$objResponse->addScript('initselect2()');
	// init select and title box typehead
	$objResponse->addScript('var projet = jQuery("#projet_id").val();xajax_autocompleteTitreTache(projet);');
	// refresh title box when element is selected
	$objResponse->addScript('jQuery("#projet_id").on("select2-selecting", function(e){xajax_autocompleteTitreTache(e.val);});');

	// hack pour textarea (sauts de ligne, et auto-ajustement)
	$objResponse->addScript('$("notes").value = $("notes").value.replace(/¤/g, "\n");');

	$objResponse->addScript('jQuery("#date_debut").datepicker();');
	$objResponse->addScript('jQuery("#date_fin").datepicker();');
	$objResponse->addScript('jQuery("#btnGotoLien").tooltip();');
	$objResponse->addScript('document.getElementById("projet_id").focus();');

	return $objResponse->getXML();
}


// check si l'identifiant de projet est disponible
function checkProjetId($newProjet_id, $currentProjet_id) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	if((preg_match("/^[a-zA-Z0-9]+$/", $newProjet_id) == 0) || strlen($newProjet_id) > 10) {
		$objResponse->addAssign('divStatutCheckProjetId', 'innerHTML', '<font color="#FF3300"><b>' . $smarty->get_config_vars('ajax_IDProjetNonValide') . '</b></font>');
		return $objResponse->getXML();
	}

	$projetTest = new Projet();
	$sql = 'SELECT * FROM planning_projet WHERE projet_id = ' . val2sql($newProjet_id);
	if($currentProjet_id != '') {
		$sql .= ' AND projet_id <> ' . val2sql($currentProjet_id);
	}

	if($projetTest->db_loadSQL($sql)) {
		$objResponse->addAssign('divStatutCheckProjetId', 'innerHTML', '<font color="#FF3300"><b>' . $smarty->get_config_vars('ajax_IDDejaPris') . '</b></font>');
	} else {
		$objResponse->addAssign('divStatutCheckProjetId', 'innerHTML', '<img src="assets/img/pictos/ok.gif" width="12" height="12" border="0">');
	}

	return $objResponse->getXML();
}


/* drag and drop d'une case
	param $casePeriode, de la forme : c_PERIODEID_DATEJOUR, exemple : c_25_20081103
	param $jourCible, de la forme : td_USERID_DATEJOUR, exemple : td_RS_20081225
	si $copie = true, on ne deplace pas la case, on la copie simplement
*/
function moveCasePeriode($casePeriode, $jourCible, $copie = false) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	// check securité
	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || $user->checkDroit('tasks_readonly')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}

	// découpage des chaine pour récup des valeurs
	$chaines1 = explode('_', $casePeriode);
	$chaines2 = explode('_', $jourCible);

	// chargement de la période
	$periode = new Periode();
	if(!$periode->db_load(array('periode_id' , '=', $chaines1[1]))) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_periodeIntrouvable')));
		return $objResponse->getXML();
	}

	// reformatage de la date du jour d'origine
	$jourOrigine = substr($chaines1[2], 0, 4) . '-' . substr($chaines1[2], 4, 2) . '-' . substr($chaines1[2], 6, 2);
	// reformatage de la date du jour de destination
	$jourDestination = substr($chaines2[2], 0, 4) . '-' . substr($chaines2[2], 4, 2) . '-' . substr($chaines2[2], 6, 2);

	$userCible = new User();
	if($userCible->db_load(array('user_id', '=', $chaines2[1]))) {
		// si on change de user
		if($user->checkDroit('tasks_modify_own_task') && $userCible->user_id != $user->user_id) {
			// si droit modif des taches assignées uniquement, on check le user final
			$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_deplacementImpossible')));
			$objResponse->addScript('location.reload();');
			return $objResponse->getXML();
		}
	} else {
		// si pas un user, veut dire que c'est peut-être un projet (si affichage par projet et non par user)
		$projetCible = new Projet();
		if(!$projetCible->db_load(array('projet_id', '=', $chaines2[1])) || $user->checkDroit('tasks_readonly') || ($user->checkDroit('tasks_modify_own_project') && $projetCible->createur_id != $user->user_id)) {
			$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_deplacementImpossible')));
			$objResponse->addScript('location.reload();');
			return $objResponse->getXML();
		}
		if($user->checkDroit('tasks_modify_own_task')) {
			// si droits limités aux taches on checke que le projet cible est autorisé
			$projTmp = new Projet();
			if(!$projTmp->db_loadSQL("SELECT DISTINCT ppr.* FROM planning_projet AS ppr INNER JOIN planning_periode AS ppe ON ppr.projet_id = ppe.projet_id WHERE ppe.user_id = '" . $user->user_id . "' AND ppr.projet_id = '" . $projetCible->projet_id . "'")) {
				$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_deplacementImpossible')));
				$objResponse->addScript('location.reload();');
				return $objResponse->getXML();
			}
		}
	}

	if($copie == 'true') {
		$copie = new Periode();
		$data = $periode->getData();
		unset($data['saved']);
		$copie->setData($data);
		if(isset($projetCible)) {
			$copie->projet_id = $projetCible->projet_id;
		} else {
			$copie->user_id = $userCible->user_id;
		}
		if(!is_null($periode->date_fin)) {
			$nbJours = 0;
			$nbJours = getNbJours($periode->date_debut, $periode->date_fin);
			$copie->date_fin = calculerDateFin($jourDestination, $nbJours);
		}
		$copie->date_debut = $jourDestination;

		// si on vient du planning par jour on modifie la tranche horaire
		if(count($chaines2) == 4 && strlen($copie->duree_details) == 17) {
			$dureeData = explode(';', $copie->duree_details);
			$duree = soustraireDuree($dureeData[0], $dureeData[1]);
			$heureDebut = usertime2sqltime($chaines2[3]);
			$heureFin = usertime2sqltime(ajouterDuree($heureDebut, $duree));
			$copie->duree_details = $heureDebut . ';' . $heureFin;
			$copie->duree = usertime2sqltime($duree);
		}

		if(CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY == 1) {
			//on checke qu'il n'y ait aucun jour en commun entre cette tâche et les autres tâches du même user
			$sql = "SELECT * FROM planning_periode ";
			if(!is_null($copie->date_fin)) {
					$sql .= " WHERE	((date_debut >= '" . $copie->date_debut . "' 	AND	date_debut <= '" . $copie->date_fin . "')";
					$sql .= " OR (date_fin IS NOT NULL AND date_fin >= '" . $copie->date_debut . "' AND date_fin <= '" . $copie->date_fin . "')";
			} else {
					$sql .= " WHERE	((date_fin IS NOT NULL AND date_debut <= '" . $copie->date_debut . "' AND	date_fin >= '" . $copie->date_debut . "')";
					$sql .= " OR (date_fin IS NULL AND date_debut = '" . $copie->date_debut . "')";
			}
			$sql .= " ) 	AND user_id = '" . $copie->user_id . "'";
			if($copie->isSaved()) {
				$sql .= ' AND periode_id <> ' . $copie->periode_id;
			}
			$periodesTest = new GCollection('Periode');
			$periodesTest->db_loadSQL($sql);
			if($periodesTest->getCount() > 0) {
				$periodeTmp = $periodesTest->fetch();
				$projetTmp = new Projet();
				$projetTmp->db_load(array('projet_id', '=', $periodeTmp->projet_id));
				$objResponse->addAlert(addslashes(sprintf($smarty->get_config_vars('ajax_jourDejaOccupe'), $projetTmp->nom, $periodeTmp->date_debut, $periodeTmp->date_fin)));
				$objResponse->addScript('location.reload();');
				return $objResponse->getXML();
			}
		}

		if(!$copie->db_save()){
			$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_erreurDeplacement')));
			return $objResponse->getXML();
		}

		// on fait la notification ici et non dans le db_save() sinon ça va s'appliquer à toutes les taches filles
		// on envoie que si la personne assignée n'est pas la personne connectée
		if($copie->user_id != $user->user_id) {
			$copie->envoiNotification('modification');
		}


	} else {
		// mise à jour des infos de la période déplacée
		if(isset($projetCible)) {
			$periode->projet_id = $projetCible->projet_id;
		} else {
			$periode->user_id = $userCible->user_id;
		}
		// calcul du nombre de jour de la période pour report sur la nouvelle date
		if(!is_null($periode->date_fin)) {
			$nbJours = 0;
			$nbJours = getNbJours($periode->date_debut, $periode->date_fin);
			$periode->date_fin = calculerDateFin($jourDestination, $nbJours);
		}
		$periode->date_debut = $jourDestination;

		// si on vient du planning par jour on modifie la tranche horaire
		if(count($chaines2) == 4 && strlen($periode->duree_details) == 17) {
			$dureeData = explode(';', $periode->duree_details);
			$duree = soustraireDuree($dureeData[0], $dureeData[1]);
			$heureDebut = usertime2sqltime($chaines2[3]);
			$heureFin = usertime2sqltime(ajouterDuree($heureDebut, $duree));
			$periode->duree_details = $heureDebut . ';' . $heureFin;
			$periode->duree = usertime2sqltime($duree);
		}

		if(CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY == 1) {
			//on checke qu'il n'y ait aucun jour en commun entre cette tâche et les autres tâches du même user
			$sql = "SELECT * FROM planning_periode ";
			if(!is_null($periode->date_fin)) {
					$sql .= " WHERE	((date_debut >= '" . $periode->date_debut . "' 	AND	date_debut <= '" . $periode->date_fin . "')";
					$sql .= " OR (date_fin IS NOT NULL AND date_fin >= '" . $periode->date_debut . "' AND date_fin <= '" . $periode->date_fin . "')";
			} else {
					$sql .= " WHERE	((date_fin IS NOT NULL AND date_debut <= '" . $periode->date_debut . "' AND	date_fin >= '" . $periode->date_debut . "')";
					$sql .= " OR (date_fin IS NULL AND date_debut = '" . $periode->date_debut . "')";
			}
			$sql .= " ) 	AND user_id = '" . $periode->user_id . "'";
			if($periode->isSaved()) {
				$sql .= ' AND periode_id <> ' . $periode->periode_id;
			}
			$periodesTest = new GCollection('Periode');
			$periodesTest->db_loadSQL($sql);
			if($periodesTest->getCount() > 0) {
				$periodeTmp = $periodesTest->fetch();
				$projetTmp = new Projet();
				$projetTmp->db_load(array('projet_id', '=', $periodeTmp->projet_id));
				$objResponse->addAlert(addslashes(sprintf($smarty->get_config_vars('ajax_jourDejaOccupe'), $projetTmp->nom, $periodeTmp->date_debut, $periodeTmp->date_fin)));
				$objResponse->addScript('location.reload();');
				return $objResponse->getXML();
			}
		}

		if(!$periode->db_save()){
			$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_erreurDeplacement')));
			return $objResponse->getXML();
		}


		// on fait la notification ici et non dans le db_save() sinon ça va s'appliquer à toutes les taches filles
		// on envoie que si la personne assignée n'est pas la personne connectée
		if($periode->user_id != $user->user_id) {
			$periode->envoiNotification('modification');
		}

	}


	// chargement de la fenetre de réussite
	//$objResponse->addScript('windowDeplacementOK();');
	$objResponse->addScript('location.reload();');

	return $objResponse->getXML();
}


// filtre la liste des projets dans le formulaire de période
function filtreProjet($chaine) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	// check securité
	$user = new User();
	if($user->chargerUserFromSession() !== TRUE) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}

	$listeProjets = new GCollection('Projet');
	$sql = "SELECT planning_projet.*, planning_groupe.nom AS nom_groupe FROM planning_projet
			LEFT JOIN planning_periode ON planning_projet.projet_id = planning_periode.projet_id
			LEFT JOIN planning_groupe ON planning_groupe.groupe_id = planning_projet.groupe_id
			WHERE 0 = 0 ";
	if($chaine != "") {
		$sql .= "AND (planning_projet.nom LIKE '%" . addslashes($chaine) . "%'
			OR planning_projet.projet_id LIKE '%" . addslashes($chaine) . "%'
			OR planning_projet.iteration LIKE '%" . addslashes($chaine) . "%') ";
	}
	if ($user->checkDroit('projects_manage_all')) {
			// tous les droits
	} elseif($user->checkDroit('tasks_modify_own_project')){
		$sql .= "AND planning_projet.createur_id = '". $user->user_id . "' ";

	} elseif ($user->checkDroit('tasks_modify_own_task')){
		$sql .= "AND planning_periode.user_id = '". $user->user_id . "' ";
	}
	$sql .= " AND statut IN ('a_faire','en_cours') ";
	$sql .= " GROUP BY planning_projet.projet_id ORDER BY planning_projet.nom";
	$listeProjets->db_loadSQL($sql);

	// vidage du menu déroulant
	$objResponse->addScript("while (document.getElementById('projet_id').options.length>0) {document.getElementById('projet_id').options[0] = null;}");

	if($listeProjets->getCount() > 0){
		while($projet = $listeProjets->fetch()){
			$objResponse->addScript("document.getElementById('projet_id').options[document.getElementById('projet_id').length] = new Option('" . addslashes($projet->nom) . " (" . addslashes($projet->projet_id) . ")" . "','" . addslashes($projet->projet_id) . "');");
		}
	} else {
		$objResponse->addScript("document.getElementById('projet_id').options[document.getElementById('projet_id').length] = new Option('" . $smarty->get_config_vars('ajax_aucunProjetFiltre') . "','');");
	}

	return $objResponse->getXML();
}

function checkAvailableVersion() {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	if(isset($_COOKIE['infosVersionInactif'])) {
		return $objResponse->getXML();
	}

	$version = new Version();
	$infos = $version->checkAvailableVersion();

	if(!$infos) {
		return $objResponse->getXML();
	}

	$smarty = new MySmarty();

	$smarty->assign('infos', $infos);
	$objResponse->addAssign('infosVersion', 'innerHTML', $smarty->getHtml('version.tpl'));
	$objResponse->addAssign('infosVersion', 'style.display', 'block');

	return $objResponse->getXML();
}


function choixPDF() {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	if(isset($_COOKIE['pdf_orientation'])) {
		$smarty->assign('pdf_orientation', $_COOKIE['pdf_orientation']);
	} else {
		$smarty->assign('pdf_orientation', 'paysage');
	}
	if(isset($_COOKIE['pdf_format'])) {
		$smarty->assign('pdf_format', $_COOKIE['pdf_format']);
	} else {
		$smarty->assign('pdf_format', 'A4');
	}

	$objResponse->addScript('masquerSousMenu("divOptions");');

	$objResponse->addScript('jQuery("#myModal .modal-header h3").html("PDF")');
	$objResponse->addScript('jQuery("#myModal .modal-body").html("' . xajaxFormat($smarty->getHtml('choix_pdf.tpl')) . '")');
	$objResponse->addScript('jQuery("#myModal").modal()');

	return $objResponse->getXML();
}

function choixIcal() {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	$urlSuggeree = getUrlInfo();
	$lienIcal = $urlSuggeree['root'] . substr($urlSuggeree['currentDir'], 0, strlen($urlSuggeree['currentDir'])-8) . 'export_ical.php?login=' . $user->login . '&hash=' . md5($user->login . '¤¤' . $user->password);
	$smarty->assign('lienIcal', $lienIcal);

	$objResponse->addScript('masquerSousMenu("divOptions");');

	$objResponse->addScript('jQuery("#myModal .modal-header h3").html("ICAL")');
	$objResponse->addScript('jQuery("#myModal .modal-body").html("' . xajaxFormat($smarty->getHtml('choix_ical.tpl')) . '")');
	$objResponse->addScript('jQuery("#myModal").modal()');

	return $objResponse->getXML();
}


function modifUser($user_id) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$user_form = new User();
	if($user_id != '') {
		$user_form->db_load(array('user_id', '=', $user_id));
	}
	$smarty->assign('user_form', $user_form->getSmartyData());

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('users_manage_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	$groupes = new GCollection('User_groupe');
	$groupes->db_load(array(), array('nom' => 'ASC'));
	$smarty->assign('groupes', $groupes->getSmartyData());

	$objResponse->addScript('jQuery("#myBigModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('ajax_ajoutModifuser')) . '")');
	$objResponse->addScript('jQuery("#myBigModal .modal-body").html("' . xajaxFormat($smarty->getHtml('user_form.tpl')) . '")');
	$objResponse->addScript('jQuery("#myBigModal").modal()');

	$objResponse->addScript("myPicker = new jscolor.color(document.getElementById('couleur'), {});myPicker.fromString('" . $user_form->couleur . "')");

	return $objResponse->getXML();
}



function submitFormUser($user_id, $user_id_origine, $user_groupe_id, $nom, $email, $login, $password, $visible_planningOui, $couleur, $notificationsOui, $envoiMailPwd, $droits) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('users_manage_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	$user_form = new User();
	if(!$user_form->db_load(array('user_id', '=', $user_id))) {
	}

	// on checke que le user_id n'existe pas déjà
	if($user_id_origine == '') {
		//si création de user
		$userTest = new USer();
		if($userTest->db_load(array('user_id', '=', $user_id))) {
			$objResponse->addAlert($smarty->get_config_vars('user_id_existant'));
			return $objResponse;
		}
		if(trim($login) != '' && $userTest->db_load(array('login', '=', $login))) {
			$objResponse->addAlert($smarty->get_config_vars('login_existant'));
			return $objResponse;
		}
	} else {
		// si user existant on vérifie que les champs ne vont pas écraser un existant (login et identifiant)
		$userTest = new USer();
		if($login != '' && $userTest->db_load(array('login', '=', $login, 'user_id', '<>', $user_form->user_id))) {
			$objResponse->addAlert($smarty->get_config_vars('login_existant'));
			return $objResponse;
		}
	}

	if(trim($user_id) == '') {
		$objResponse->addAlert($smarty->get_config_vars('user_user_idManquant'));
		return $objResponse;
	}
	if(trim($nom) == '') {
		$objResponse->addAlert($smarty->get_config_vars('user_nomManquant'));
		return $objResponse;
	}
	if(trim($email) != '' && !VerifierAdresseMail($email)) {
		$objResponse->addAlert($smarty->get_config_vars('user_emailInvalide'));
		return $objResponse;
	}

	if($user_id_origine == '') {
		// on met à jour le user_id uniquement à la creation pour éviter l'écrasement par un petit rusé
		$user_form->user_id = $user_id;
	}
	$user_form->nom = $nom;
	$user_form->email = ($email != '' ? $email : null);
	$user_form->user_groupe_id = ($user_groupe_id != '' ? $user_groupe_id : null);
	$user_form->login = ($login != '' ? $login : null);
	if($password != '') {
		$user_form->password = sha1("¤" . $password . "¤");
	}

	if($visible_planningOui == 'true') {
		$user_form->visible_planning = 'oui';
	} else {
		$user_form->visible_planning = 'non';
	}
	if($notificationsOui == 'true') {
		$user_form->notifications = 'oui';
	} else {
		$user_form->notifications = 'non';
	}
	$user_form->couleur = ($couleur != '' ? $couleur : null);
	$user_form->setDroits($droits);

	$test = $user_form->check();
	if($test !== TRUE) {
		if(!is_array($test)) {
			$objResponse->addAlert(addslashes($smarty->get_config_vars($test)));
			return $objResponse;
		}
	}

	if(!$user_form->db_save()) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('changeNotOK')));
		return $objResponse;
	}

	if($envoiMailPwd == 'true') {
		$user_form->mailChangerPwd();
	}

	$_SESSION['message'] = 'changeOK';
	$objResponse->addRedirect('user_list.php');
	return $objResponse;
}


function supprimerUser($user_id) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('users_manage_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	$user_form = new User();
	if($user_id == '' || !$user_form->db_load(array('user_id', '=', $user_id))) {
		$objResponse->addAlert($smarty->get_config_vars('changeNotOK'));
		return $objResponse;
	}

	// on reassigne les projets au user courant
	$sql = "UPDATE planning_projet
			SET createur_id = '{$user->user_id}'
			WHERE createur_id = '{$user_form->user_id}'";
	db_query($sql);

	// on empeche la suppression de l'admin
	if($user_form->user_id != 'ADM') {
		$user_form->db_delete();
	}

	$_SESSION['message'] = 'changeOK';
	$objResponse->addRedirect('user_list.php');
	return $objResponse;
}


function modifProfil() {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user_form', $user->getSmartyData());

	$objResponse->addScript('jQuery("#myModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('ajax_editionProfil')) . '")');
	$objResponse->addScript('jQuery("#myModal .modal-body").html("' . xajaxFormat($smarty->getHtml('profil_form.tpl')) . '")');
	$objResponse->addScript('jQuery("#myModal").modal()');


	return $objResponse->getXML();
}


function submitFormProfil($user_id, $email, $password, $notificationsOui) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || $user->user_id != $user_id) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	if(trim($password) != '') {
		$user->password = sha1("¤" . $password . "¤");
	}

	if(trim($email) != '' && !VerifierAdresseMail($email)) {
		$objResponse->addAlert($smarty->get_config_vars('user_emailInvalide'));
		return $objResponse;
	}

	$user->email = ($email != '' ? $email : null);

	if($notificationsOui == 'true') {
		$user->notifications = 'oui';
	} else {
		$user->notifications = 'non';
	}

	if(!$user->db_save()) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('changeNotOK')));
		return $objResponse;
	}

	$_SESSION['message'] = 'changeOK';
	$objResponse->addRedirect('planning.php');
	return $objResponse;
}


function changerPwd($email) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	if(trim($email) == '') {
		return $objResponse;
	}
	$users = new Gcollection('User');
	$users->db_load(array('email', '=', $email));
	if($users->getCount() == 0) {
		$objResponse->addAlert($smarty->get_config_vars('rappelPwdKo'));
		return $objResponse;
	}
	while($userTmp = $users->fetch()) {
		$userTmp->mailChangerPwd();
	}

	$objResponse->addAlert($smarty->get_config_vars('rappelPwdOk'));
	return $objResponse;
}


function nouveauPwd($password) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	if(!isset($_SESSION['change_password'])) {
		$objResponse->addAlert($smarty->get_config_vars('erreur'));
		return $objResponse;
	}
	if(trim($password) == '') {
		return $objResponse;
	}
	$userTmp = new User();
	if(!$userTmp->db_load(array('user_id', '=', $_SESSION['change_password']))) {
		return $objResponse;
	}
	$userTmp->password = sha1("¤" . $password . "¤");
	if(!$userTmp->db_save()) {
		$objResponse->addAlert($smarty->get_config_vars('erreur'));
		return $objResponse;
	}

	unset($_SESSION['change_password']);
	$_SESSION['message'] = 'changeOK';
	$objResponse->addRedirect('index.php');
	return $objResponse;
}


function submitFormPeriode($periode_id, $projet_id, $user_id, $date_debut, $conserver_duree, $date_fin, $nb_jours, $duree, $heure_debut, $heure_fin, $matin, $apresmidi, $repetition, $dateFinRepetition, $appliquerATous, $statut_tache, $livrable, $titre, $notes, $lien, $user_id2, $user_id3) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || $user->checkDroit('tasks_readonly')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	if($projet_id == '') {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('js_choisirProjet')));
		return $objResponse;
	}

	if ($date_debut == "") {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('js_choisirDateDebut')));
		return $objResponse;
	}

	if (!controlDate($date_debut) || !controlDate($date_fin)) {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('js_saisirFormatDate')));
		return $objResponse;
	}

	if ($conserver_duree === 'false' && $date_fin != '' && userdate2sqldate($date_fin) < userdate2sqldate($date_debut)) {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('js_dateFinInferieure')));
		return $objResponse;
	}

	if($repetition != '') {
		if($dateFinRepetition == '' || !controlDate($dateFinRepetition) || userdate2sqldate($dateFinRepetition) <= $periode->date_debut) {
			$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
			$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
			$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur_dateFinRepetition')));
			return $objResponse;
		}
	}

	$duree = usertime2sqltime($duree);
	$testDuree = new Gtime();
	if ($duree != '00:00:00' && !$testDuree->isValid($duree)) {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur_dureeNonValide')));
		return $objResponse;
	}
	$heure_debut = usertime2sqltime($heure_debut);
	$testHeureDebut = new Gtime();
	if ($heure_debut != '00:00:00' && !$testHeureDebut->isValid($heure_debut)) {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur_heureDebutNonValide')));
		return $objResponse;
	}

	$heure_fin = usertime2sqltime($heure_fin);
	$testHeureFin = new Gtime();
	if (($heure_debut != '00:00:00' &&  $heure_fin == '00:00:00') || ($heure_fin != '00:00:00' && !$testHeureFin->isValid($heure_fin)) || $heure_fin < $heure_debut) {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur_heureFinNonValide')));
		return $objResponse;
	}

	$periode = new Periode();
	if($periode_id != 0) {
		$periode->db_load(array('periode_id', '=', $periode_id));
	}
	$periode->projet_id = $projet_id;
	$periode->user_id = $user_id;

	$periode->titre = ($titre != '' ? $titre : null);
	$periode->statut_tache = ($statut_tache != '' ? $statut_tache : null);
	$periode->livrable = ($livrable != '' ? $livrable : null);
	$periode->notes = ($notes != '' ? $notes : null);
	$periode->lien = ($lien != '' ? $lien : null);
	$periode->date_debut = userdate2sqldate($date_debut);
	$periode->createur_id = $user->user_id;

	if($conserver_duree === 'true') {
		// on reprend la durée existante (seulement en modif de période)

		// on charge la période de la BD pour récupérer les anciennes date, pour calculer nb de jour
		$Oldperiode = new Periode();
		$Oldperiode->db_load(array('periode_id', '=', $periode_id));
		$nbJours = getNbJours($Oldperiode->date_debut, $Oldperiode->date_fin);
		$periode->date_fin = calculerDateFin($periode->date_debut, $nbJours);
		$periode->duree = NULL;
		$periode->duree_details = NULL;
	} elseif ($date_fin != '') {
		$periode->date_fin = userdate2sqldate($date_fin);
		$periode->duree = NULL;
		$periode->duree_details = NULL;
	} elseif ($nb_jours != '' && (int)$nb_jours > 1) {
		$joursFeries = getJoursFeries();
		// on calcule la date finale en rajoutant le nb de jours, sans les WE.
		// affiché seulement en création
		$dateFin = new DateTime();
		$dateFin->setDate(substr($periode->date_debut,0,4), substr($periode->date_debut,5,2), substr($periode->date_debut,8,2));
		$nbJours = (int)$nb_jours - 1;
		$i = 1;
		while($i <= $nbJours) {
			$dateFin->modify('+1 days');
			if (in_array($dateFin->format('w'), explode(',', CONFIG_DAYS_INCLUDED)) && !in_array($dateFin->format('Y-m-d'), $joursFeries)) {
				$i++;
			}
		}

		$periode->date_fin = $dateFin->format('Y-m-d');
		$periode->duree = NULL;
		$periode->duree_details = NULL;

	} else {
		// pas de date de fin renseignée, on gère la durée

		// si aucune info renseignée, on met la journée entière pour la tache
		if($duree == '00:00:00' && $heure_debut == '00:00:00' && $heure_fin == '00:00:00' && $matin == 'false' && $apresmidi == 'false') {
			$periode->duree = CONFIG_DURATION_DAY . ':00:00';
			if(strlen(CONFIG_DURATION_DAY) < 8) {
				$periode->duree = '0' . $periode->duree;
			}
			$periode->duree_details = 'duree';

		} elseif ($duree != '00:00:00') {
			$periode->duree= $duree;
			$periode->duree_details = 'duree';

		} elseif ($heure_debut != '00:00:00') {
			$periode->duree = soustraireDuree($heure_debut, $heure_fin);
			$periode->duree_details = $heure_debut . ';' . $heure_fin;

		} elseif ($matin == 'true') {
			$periode->duree = CONFIG_DURATION_AM . ':00:00';
			if(strlen(CONFIG_DURATION_AM) < 8) {
				$periode->duree = '0' . $periode->duree;
			}
			$periode->duree_details = 'AM';

		} elseif ($apresmidi == 'true') {
			$periode->duree = CONFIG_DURATION_PM . ':00:00';
			if(strlen(CONFIG_DURATION_PM) < 8) {
				$periode->duree = '0' . $periode->duree;
			}
			$periode->duree_details = 'PM';

		}

		if(!is_null($periode->duree)) {
			$periode->date_fin = NULL;
		}
	}

	if ($periode->check() !== TRUE) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	$projet = new Projet();
	$projet->db_load(array('projet_id', '=', $periode->projet_id));

	if($user->checkDroit('tasks_modify_own_project') && $projet->createur_id != $user->user_id) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	if($user->checkDroit('tasks_modify_own_task') && $projet->createur_id != $user->user_id && $periode->user_id != $user->user_id) {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		return $objResponse;
	}

	if(CONFIG_PLANNING_ONE_ASSIGNMENT_MAX_PER_DAY == 1) {
		//on checke qu'il n'y ait aucun jour en commun entre cette tâche et les autres tâches du même user
		$sql = "SELECT * FROM planning_periode ";
		if(!is_null($periode->date_fin)) {
				$sql .= " WHERE	((date_debut >= '" . $periode->date_debut . "' 	AND	date_debut <= '" . $periode->date_fin . "')";
				$sql .= " OR (date_fin IS NOT NULL AND date_fin >= '" . $periode->date_debut . "' AND date_fin <= '" . $periode->date_fin . "')";
		} else {
				$sql .= " WHERE	((date_fin IS NOT NULL AND date_debut <= '" . $periode->date_debut . "' AND	date_fin >= '" . $periode->date_debut . "')";
				$sql .= " OR (date_fin IS NULL AND date_debut = '" . $periode->date_debut . "')";
		}
		$sql .= " ) 	AND user_id = '" . $periode->user_id . "'";
		if($periode->isSaved()) {
			$sql .= ' AND periode_id <> ' . $periode->periode_id;
		}
		//return afficherErreur($objResponse, $sql);
		//die;
		$periodesTest = new GCollection('Periode');
		$periodesTest->db_loadSQL($sql);
		if($periodesTest->getCount() > 0) {
			$periodeTmp = $periodesTest->fetch();
			$projetTmp = new Projet();
			$projetTmp->db_load(array('projet_id', '=', $periodeTmp->projet_id));
			$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
			$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
			$objResponse->addAlert(addslashes(sprintf($smarty->get_config_vars('ajax_jourDejaOccupe'), $projetTmp->nom, $periodeTmp->date_debut, $periodeTmp->date_fin)));
			return $objResponse->getXML();
		}
	}

	// on fait la notification ici et non dans le db_save() sinon ça va s'appliquer à toutes les taches filles
	// on envoie que si la personne assignée n'est pas la personne connectée
	if($periode->user_id != $user->user_id) {
		$periode->envoiNotification('modification', $repetition);
	}

	if(!$periode->db_save()) {
		$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
		$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
		return $objResponse;
	}

	if ($user_id2 != '') {
		$data = $periode->getData();
		$data['saved'] = 0;
		$newPeriode = new Periode();
		$newPeriode->setData($data);
		$newPeriode->user_id = $user_id2;
		if ($newPeriode->check() !== TRUE) {
			$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
			$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
			$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
			return $objResponse;
		}
		if($newPeriode->user_id != $user->user_id) {
			$newPeriode->envoiNotification();
		}
		$newPeriode->db_save();

		if($repetition != '') {
			if(!$newPeriode->repeter($repetition, userdate2sqldate($dateFinRepetition))) {
				$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
				$objResponse->addScript('location.reload();');
				return $objResponse;
			}
		}
	}

	if ($user_id3 != '') {
		$data = $periode->getData();
		$data['saved'] = 0;
		$newPeriode = new Periode();
		$newPeriode->setData($data);
		$newPeriode->user_id = $user_id3;
		if ($newPeriode->check() !== TRUE) {
			$objResponse->addScript("document.getElementById('butSubmitPeriode').disabled=false;");
			$objResponse->addScript("document.getElementById('divPatienter').style.display='none';");
			$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
			return $objResponse;
		}
		if($newPeriode->user_id != $user->user_id) {
			$newPeriode->envoiNotification();
		}
		$newPeriode->db_save();

		if($repetition != '') {
			if(!$newPeriode->repeter($repetition, userdate2sqldate($dateFinRepetition))) {
				$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
				$objResponse->addScript('location.reload();');
				return $objResponse;
			}
		}
	}

	if($repetition != '') {
		if(!$periode->repeter($repetition, userdate2sqldate($dateFinRepetition))) {
			$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
			$objResponse->addScript('location.reload();');
			return $objResponse;
		}
	}

	if($appliquerATous === 'true') {
		$periode->updateOcurrences();
	} else {
		$periode->parent_id = NULL;
		$periode->db_save();
	}

	if($_SESSION['planningView'] == 'mois') {
		$objResponse->addRedirect('planning.php');
	} else {
		$objResponse->addRedirect('planning_per_day.php');
	}
	return $objResponse;
}


function supprimerPeriode($periode_id, $fullscope = 'true') {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || $user->checkDroit('tasks_readonly')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	$periode = new Periode();
	if(!$periode->db_load(array('periode_id', '=', $periode_id))) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
		$objResponse->addScript('location.reload();');
	}

	$projet = new Projet();
	$projet->db_load(array('projet_id', '=', $periode->projet_id));

	if($user->checkDroit('tasks_modify_own_project') && $projet->createur_id != $user->user_id) {
		$_SESSION['message'] = 'droitsInsuffisants';
		header('Location: ../index.php');
		exit;
	}

	// on fait la notification ici et non dans le db_save() sinon ça va s'appliquer à toutes les taches filles
	// on envoie que si la personne assignée n'est pas la personne connectée
	if($periode->user_id != $user->user_id) {
		$periode->envoiNotification('delete');
	}

	if($fullscope === 'true') {
		$periode->db_deleteAll();
	} else {
		$periode->db_delete();
	}
	$objResponse->addScript('location.reload();');
	return $objResponse;

}


function modifFerie($date_ferie) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$ferie = new Ferie();
	if($date_ferie != '') {
		$ferie->db_load(array('date_ferie', '=', $date_ferie));
	}
	$smarty->assign('ferie', $ferie->getSmartyData());

	$objResponse->addScript('jQuery("#myModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('menuFeries')) . '")');
	$objResponse->addScript('jQuery("#myModal .modal-body").html("' . xajaxFormat($smarty->getHtml('ferie_form.tpl')) . '")');
	$objResponse->addScript('jQuery("#myModal").modal()');

	$objResponse->addScript('jQuery("#date_ferie").datepicker();');
	$objResponse->addScript('jQuery("#date_ferie").datepicker( "option", "dateFormat", "dd/mm/yyyy");');

	return $objResponse->getXML();
}


function submitFormFerie($date_ferie, $libelle) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('parameters_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	if(trim($date_ferie) == '' || !controlDate($date_ferie)) {
		$objResponse->addAlert($smarty->get_config_vars('feries_dateNonValide'));
		return $objResponse;
	}

	$ferie = new Ferie();
	$ferie->db_load(array('date_ferie', '=', userdate2sqldate($date_ferie)));
	$ferie->date_ferie = userdate2sqldate($date_ferie);
	$ferie->libelle = ($libelle != '' ? $libelle : null);

	if(!$ferie->db_save()) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('changeNotOK')));
		return $objResponse;
	}

	$_SESSION['message'] = 'changeOK';
	$objResponse->addRedirect('feries.php');
	return $objResponse;
}


function supprimerFerie($date_ferie) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('parameters_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	$ferie = new Ferie();
	if(!$ferie->db_load(array('date_ferie', '=', $date_ferie))) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
		$objResponse->addScript('location.reload();');
	}

	$ferie->db_delete();

	$_SESSION['message'] = 'changeOK';
	$objResponse->addRedirect('feries.php');
	return $objResponse;
}


function modifUserGroupe($user_groupe_id) {
	$objResponse = new xajaxResponse('ISO-8859-1');
	$smarty = new MySmarty();

	$groupe = new User_groupe();
	if($user_groupe_id != '') {
		$groupe->db_load(array('user_groupe_id', '=', $user_groupe_id));
	}
	$smarty->assign('groupe', $groupe->getSmartyData());

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('users_manage_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}
	$smarty->assign('user', $user->getSmartyData());

	$objResponse->addScript('jQuery("#myModal .modal-header h3").html("' . addslashes($smarty->get_config_vars('menuGroupesUsers')) . '")');
	$objResponse->addScript('jQuery("#myModal .modal-body").html("' . xajaxFormat($smarty->getHtml('user_group_form.tpl')) . '")');
	$objResponse->addScript('jQuery("#myModal").modal()');

	return $objResponse->getXML();
}


function submitFormUserGroupe($user_groupe_id, $nom) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('users_manage_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	if(trim($nom) == '') {
		$objResponse->addAlert($smarty->get_config_vars('user_groupe_nomInvalide'));
		return $objResponse;
	}

	$groupe = new User_groupe();
	if($user_groupe_id > 0) {
		$groupe->db_load(array('user_groupe_id', '=', $user_groupe_id));
	}
	$groupe->nom = $nom;

	if(!$groupe->db_save()) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('changeNotOK')));
		return $objResponse;
	}

	$_SESSION['message'] = 'changeOK';
	$objResponse->addScript('location.reload();');
	return $objResponse;
}


function supprimerUserGroupe($user_groupe_id) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE || !$user->checkDroit('users_manage_all')) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse;
	}

	$groupe = new User_groupe();
	if(!$groupe->db_load(array('user_groupe_id', '=', $user_groupe_id))) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('erreur')));
		$objResponse->addScript('location.reload();');
	}

	$groupe->db_delete();

	$_SESSION['message'] = 'changeOK';
	$objResponse->addScript('location.reload();');
	return $objResponse;
}


function autocompleteTitreTache($projet_id) {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	$user = new User();
	if($user->chargerUserFromSession() !== TRUE) {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('ajax_droitsInsuffisants')));
		$objResponse->addScript('location.reload();');
		return $objResponse->getXML();
	}

	// on recupere les titres existants pour le projet courant
	if($projet_id != '') {
		$taches = new GCollection('Periode');
		$sql = 'SELECT DISTINCT titre FROM planning_periode WHERE titre IS NOT NULL AND projet_id = ' . val2sql($projet_id) . ' ORDER BY titre';
		$taches->db_loadSQL($sql);
		$jsTitreAutocomplete = 'var listeTitres = [';
		while($tache = $taches->fetch()) {
			$jsTitreAutocomplete .= '"' . addslashes($tache->titre) . '", ';
		}
		$jsTitreAutocomplete .= '];';

		$jsTitreAutocomplete .= 'var autocomplete = jQuery("#titre").typeahead();autocomplete.data("typeahead").source = listeTitres;';
		$objResponse->addScript($jsTitreAutocomplete);
	}
	return $objResponse;

}


function submitFormContact($version = '', $email = '', $commentaire = '', $newsletter = '') {
	$objResponse = new xajaxResponse();
	$smarty = new MySmarty();

	if(trim($version) == '' || trim($email) == '' || trim($commentaire) == '' || trim($newsletter) == '') {
		$objResponse->addAlert(addslashes($smarty->get_config_vars('formContact_erreurChamps')));
		return $objResponse;
	}

	$infos = array();
	$context = @stream_context_create(array('http' => array('header'=>'Connection: close', 'timeout' => 3)));
	$url = 'http://www.soplanning.org/ws/form_contact.php?version=' . $version . '&email=' . $email . '&newsletter=' . $newsletter . '&commentaire=' . urlencode($commentaire);

	$data = @file_get_contents($url, false, $context);
	if(strlen($data) == 0 || trim($data) != 'OK') {
		$objResponse->addAlert($smarty->get_config_vars('formContact_envoiKO'));
		return $objResponse;
	}

	$objResponse->addAlert($smarty->get_config_vars('formContact_envoiOK'));
	return $objResponse;
}


$xajax->processRequests();
?>