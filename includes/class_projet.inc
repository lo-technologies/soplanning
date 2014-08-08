<?php

class Projet extends GObject
{

	public function __construct()
	{
		$this->table = 'planning_projet';
		
		$this->fields['projet_id'] = new GString('planning_projet', 'projet_id', 10, FALSE, '');
		$this->fields['nom'] = new GString('planning_projet', 'nom', 30, FALSE, '');
		$this->fields['iteration'] = new GString('planning_projet', 'iteration', 255, TRUE, NULL);
		$this->fields['couleur'] = new GString('planning_projet', 'couleur', 6, FALSE, '');
		$this->fields['charge'] = new GFloat('planning_projet', 'charge', 11, TRUE, NULL);
		$this->fields['livraison'] = new GDate('planning_projet', 'livraison', 10, TRUE, NULL);
		$this->fields['statut'] = new GEnum('planning_projet', 'statut', array('a_faire','en_cours','fait','abandon'), FALSE, 'a_faire');
		$this->fields['groupe_id'] = new GInteger('planning_projet', 'groupe_id', 11, TRUE, NULL);
		$this->fields['createur_id'] = new GString('planning_projet', 'createur_id', 10, FALSE, '');

		$this->primaryKeys = array('projet_id');

		parent::__construct();
	}

	

}

?>