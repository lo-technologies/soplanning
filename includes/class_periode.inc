<?php

class Periode extends GObject
{
	protected $repetitionPossible = array('jour','mois','semaine');

	public function __construct()
	{
		$this->table = 'planning_periode';
		
		$this->fields['periode_id'] = new GInteger('planning_periode', 'periode_id', 11, FALSE, 0);
		$this->fields['parent_id'] = new GInteger('planning_periode', 'parent_id', 11, TRUE, NULL);
		$this->fields['projet_id'] = new GString('planning_periode', 'projet_id', 10, FALSE, '');
		$this->fields['user_id'] = new GString('planning_periode', 'user_id', 10, FALSE, '');
		$this->fields['date_debut'] = new GDate('planning_periode', 'date_debut', 10, FALSE, '0000-00-00');
		$this->fields['date_fin'] = new GDate('planning_periode', 'date_fin', 10, TRUE, NULL);
		$this->fields['duree'] = new Gtime('planning_periode', 'duree', 12, TRUE, NULL);
		$this->fields['duree_details'] = new GString('planning_periode', 'duree_details', 20, TRUE, NULL);
		$this->fields['titre'] = new GString('planning_periode', 'titre', 255, TRUE, NULL);
		$this->fields['notes'] = new GString('planning_periode', 'notes', 65000, TRUE, NULL);
		$this->fields['lien'] = new GString('planning_periode', 'lien', 65000, TRUE, NULL);
		$this->fields['statut_tache'] = new GEnum('planning_periode', 'statut_tache', array('a_faire','en_cours','fait','abandon'), FALSE, 'a_faire');
		$this->fields['livrable'] = new GEnum('planning_periode', 'livrable', array('oui','non'), FALSE, 'non');
		$this->fields['createur_id'] = new GString('planning_periode', 'createur_id', 10, TRUE, NULL);

		$this->primaryKeys = array('periode_id');

		parent::__construct();
	}

	
	public function db_save($updateData = array(), $insertData = array())
	{
		if (!$this->saved) {
			$result = db_query('SELECT MAX(' . $this->primaryKeys[0] . ') AS max FROM ' . $this->table);
			$new = 1;
			while ($var = db_fetch_array($result)) {
				$new = $var['max'] + 1;
			}
			$this->data[$this->primaryKeys[0]] = $new;
		}

		if($this->lien == CONFIG_DEFAULT_PERIOD_LINK) {
			$this->lien = NULL;
		}
		return parent::db_save($updateData, $insertData);
	}

	public function getSmartyData()
	{
		$data = parent::getSmartyData();
		$data['notes_xajax'] = str_replace(array("\r\n", "\n"), array("¤", "¤"), trim($data['notes']));
		if(strlen($this->duree_details) == 17) {
			$tmp = explode(';', $this->duree_details);
			$data['duree_details_heure_debut'] = $tmp[0];
			$data['duree_details_heure_fin'] = $tmp[1];
		}
		return $data;
	}

	public function getHeureDebutFin() {
		if(strlen($this->duree_details) == 17) {
			$tab = explode(';', $this->duree_details);
			return array('duree_details_heure_debut' => $tab[0], 'duree_details_heure_fin' => $tab[1]);
		}
		return NULL;
	}

	// repete la planif selon la période demandée : jour, semaine, mois
	// on repete la tache pendant 7 ans
	public function repeter($repetition, $dateFinRepetition) {
		@set_time_limit(180);

		$DAYS_INCLUDED = explode(',', CONFIG_DAYS_INCLUDED);
		$joursFeries = getjoursFeries();
		if(!in_array($repetition, $this->repetitionPossible)) {
			return false;
		}
		$tmpDate = new DateTime();
		$tmpDate->setDate(substr($this->date_debut,0,4), substr($this->date_debut,5,2), substr($this->date_debut,8,2));
		$dateFin = new DateTime();
		$dateFin->setDate(substr($dateFinRepetition,0,4), substr($dateFinRepetition,5,2), substr($dateFinRepetition,8,2));

		$nbJours = getNbJours($this->date_debut, $this->date_fin);
		$data = $this->getData();
		$data['periode_id'] = 0;
		$data['saved'] = 0;
		$compteurJoursSautes = 0;

		while ($tmpDate < $dateFin) {

			if($repetition != 'jour') {
				while($compteurJoursSautes > 0) {
					// on redecale la date dans le passé si la precedente iteration tombait sur un férié ou non travaillé
					// à ne pas faire pour repetition quotidienne
					$tmpDate->modify('-1 day');
					$compteurJoursSautes--;
				}
			}

			if($repetition == 'jour') {
				$tmpDate->modify('+1 day');
			} elseif($repetition == 'semaine') {
				$tmpDate->modify('+1 week');
			} elseif($repetition == 'mois') {
				$tmpDate->modify('+1 month');
			}

			// on decale pour eviter les jours non-inclus (Weekend) et jours fériés, mais on stocke le nombre de jours sautés pour repartir sur le bon calcul ensuite
			while(!in_array($tmpDate->format('w'), $DAYS_INCLUDED) || in_array($tmpDate->format('Y-m-d'), $joursFeries)) {
				$compteurJoursSautes++;
				$tmpDate->modify('+1 day');
			}

			$newPeriode = new Periode();
			$newPeriode->setData($data);
			$newPeriode->parent_id = $this->periode_id;
			$newPeriode->date_debut = $tmpDate->format('Y-m-d');
			if(!is_null($this->date_fin)) {
				$newPeriode->date_fin = calculerDateFin($newPeriode->date_debut, $nbJours);
			}
			$newPeriode->db_save();
		}

		return true;
	}

	// renvoie vrai si la tache est parente (a des filles), ou est la fille d'une tache
	public function estFilleOuParente() {
		if(!is_null($this->parent_id)) {
			return true;
		}
		$periodes = new GCollection('Periode');
		$periodes->db_load(array('parent_id', '=', $this->periode_id));
		if($periodes->getCount() > 0) {
			return true;
		}
		return false;
	}

	// applique les paramètres au parent et toutes les soeurs
	public function updateOcurrences() {
		$periodes = new Gcollection('Periode');
		if(is_null($this->parent_id)) {
			$periodes->db_loadSQL('SELECT * FROM planning_periode WHERE parent_id = ' . $this->periode_id . ' AND date_debut > \'' . $this->date_debut . '\'');
		} else {
			$periodes->db_loadSQL('SELECT * FROM planning_periode WHERE (parent_id = ' . $this->parent_id . ' OR periode_id = ' . $this->parent_id . ') AND date_debut > \'' . $this->date_debut . '\'');
		}

		while($periode = $periodes->fetch()) {
			$periode->projet_id = $this->projet_id;
			$periode->user_id = $this->user_id;
			$periode->notes = $this->notes;
			$periode->lien = $this->lien;
			$periode->db_save();
		}
	}

	// supprime la tache, sa mere et ses soeurs
	public function db_deleteAll() {
		if(is_null($this->parent_id)) {
			db_query('DELETE FROM planning_periode where parent_id = ' . $this->periode_id);
			return $this->db_delete();
		} else {
			db_query('DELETE FROM planning_periode where parent_id = ' . $this->parent_id);
			db_query('DELETE FROM planning_periode where periode_id = ' . $this->parent_id);
		}
		return true;
	}

	public function prochaineOccurence() {
		$sql = 'SELECT * FROM planning_periode WHERE (parent_id = ' . $this->periode_id . ' OR (parent_id IS NOT NULL AND parent_id = \'' . $this->parent_id . '\')) AND periode_id <> ' . $this->periode_id . ' AND date_debut > \'' . $this->date_debut . '\' ORDER BY date_debut LIMIT 1';
		$periode = new Periode();
		if(!$periode->db_loadSQL($sql)) {
			return false;
		}
		return $periode->date_debut;
	}

	
	// envoi un mail en cas de creation/modification de tache
	public function envoiNotification($action = false, $repetition = false) {
		$userAssigne = new User();
		if(!$userAssigne->db_load(array('user_id', '=', $this->user_id))) {
			return false;
		}
		$projet = new Projet();
		if(!$projet->db_load(array('projet_id', '=', $this->projet_id))) {
			return false;
		}

		if($userAssigne->notifications == 'oui' && !is_null($userAssigne->email)) {
			$smarty = new MySmarty();
			$smarty->assign('periode', $this->getData());
			$smarty->assign('projet', $projet->getData());
			if($action == 'delete') {
				$sujet = CONFIG_SOPLANNING_TITLE . ' - ' . $smarty->get_config_vars('mail_supprTache_sujet') . ($this->titre != '' ? ' - ' . $this->titre : '');
				$corps = $smarty->getHtml('mail_suppr_tache.tpl');
			} else {
				if($repetition !== FALSE && $repetition !== "" && !in_array($repetition, $this->repetitionPossible)) {
					return false;
				}
				$smarty->assign('repetition', $repetition);

				if(!$this->isSaved()) {
					$sujet = CONFIG_SOPLANNING_TITLE . ' - ' . $smarty->get_config_vars('mail_creationTache_sujet') . ($this->titre != '' ? ' - ' . $this->titre : '');
					$corps = $smarty->getHtml('mail_creation_tache.tpl');
				} else {
					$oldPeriode = new Periode();
					$oldPeriode->db_load(array('periode_id', '=', $this->periode_id));
					$smarty->assign('oldPeriode', $oldPeriode->getData());
					$oldProjet = new Projet();
					$oldProjet->db_load(array('projet_id', '=', $oldPeriode->projet_id));
					$smarty->assign('oldProjet', $oldProjet->getData());
					$sujet = CONFIG_SOPLANNING_TITLE . ' - ' . $smarty->get_config_vars('mail_modifTache_sujet')  . ($this->titre != '' ? ' - ' . $this->titre : '');
					$corps = $smarty->getHtml('mail_modif_tache.tpl');
				}
			}
			$mail = new Mailer($userAssigne->email, $sujet, $corps);
			try {
				$result = $mail->send();
			} catch (phpmailerException $e) {
				echo 'error while sending the email :';
				print_r($e);
			}
			return $result;
		}
		return true;
	}


}

?>