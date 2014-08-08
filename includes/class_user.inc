<?php

class User extends GObject
{
	private $listeDroits = array('users_manage_all', 'projects_manage_all', 'projects_manage_own', 'projectgroups_manage_all', 'tasks_readonly', 'tasks_modify_all', 'tasks_modify_own_project', 'tasks_modify_own_task', 'tasks_view_all_projects', 'tasks_view_own_projects', 'tasks_view_team_projects', 'parameters_all');
	
	private $tabDroits = array();

	public function __construct()
	{
		$this->table = 'planning_user';

		$this->fields['user_id'] = new GString('planning_user', 'user_id', 10, FALSE, '');
		$this->fields['user_groupe_id'] = new GInteger('planning_user', 'user_groupe_id', 11, TRUE, NULL);
		$this->fields['nom'] = new GString('planning_user', 'nom', 50, FALSE, '');
		$this->fields['login'] = new GString('planning_user', 'login', 20, TRUE, NULL);
		$this->fields['password'] = new GString('planning_user', 'password', 50, TRUE, NULL);
		$this->fields['email'] = new GString('planning_user', 'email', 255, TRUE, NULL);
		$this->fields['visible_planning'] = new GEnum('planning_user', 'visible_planning', array('oui','non'), FALSE, 'non');
		$this->fields['couleur'] = new GString('planning_user', 'couleur', 6, TRUE, NULL);
		$this->fields['droits'] = new GString('planning_user', 'droits', 65000, TRUE, NULL);
		$this->fields['cle'] = new GString('planning_user', 'cle', 40, FALSE, md5(rand(0, 10000000)));
		$this->fields['notifications'] = new GEnum('planning_user', 'notifications', array('oui','non'), FALSE, 'non');

		$this->primaryKeys = array('user_id');

		parent::__construct();
	}

	public function db_loadArray($row)
	{
		parent::db_loadArray($row);
		$this->decoderDroits();
		return true;
	}

	public function chargerUserFromSession() {
		$messageErreur = 'Impossible de charger votre profil. Veuillez vous identifier à nouveau';
		if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] == '') {
			return ($messageErreur);
		}
		if (!$this->db_load(array('user_id', '=', $_SESSION['user_id']))) {
			return ($messageErreur);
		}
		return TRUE;
	}

	public function check() {
		$check = parent::check();
		if((preg_match("/^[a-zA-Z0-9]+$/", $this->user_id) == 0) || strlen($this->user_id) > 10) {
			return 'user_user_idManquant';
		}
		return $check;
	}

	public function mailChangerPwd() {
		if(is_null($this->email) ||is_null($this->login)) {
			return true;
		}
		$smarty = new MySmarty();
		$sujet = CONFIG_SOPLANNING_TITLE . ' - ' . $smarty->get_config_vars('mail_sujet_changerPwd');
		$smarty->assign('lien', CONFIG_SOPLANNING_URL . '/change_password.php?user_id=' . $this->user_id . '&date=' . date('Y-m-d') . '&hash=' . md5($this->user_id . '¤' . date('Y-m-d') . '¤' . CONFIG_SECURE_KEY));
		$corps = $smarty->getHtml('mail_changer_pwd.tpl');
		$mail = new Mailer($this->email, $sujet, $corps);
		$result = $mail->send();
		//echo $result;die;
		return $return;
	}

	public function checkDroit($droit) {
		return in_array($droit, $this->tabDroits);
	}

	public function setDroits($droits) {
		$droits = array_values(array_filter($droits));
		$this->tabDroits = $droits;
		$this->data['droits'] = json_encode($this->tabDroits);
		return true;
	}

	private function decoderDroits() {
		$this->tabDroits = json_decode(html_entity_decode($this->droits), true);
		if(!is_array($this->tabDroits)) {
			$this->tabDroits = array();
		}
	}

	public function getSmartyData()
	{
		$data = parent::getSmartyData();
		$data['tabDroits'] = $this->tabDroits;
		return $data;
	}
}

?>