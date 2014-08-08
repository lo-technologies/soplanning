<?php
class Upgrade {
	
	function __construct() {
		global $sop_db_version;
		
		// Table exist ?
		$r = $this->tableExist('planning_options');
		if ( $r == null ) {
			$this->createTableOptions();
		}
		
		$db_version_option  = new Option('db_version');
		$current_db_version = $db_version_option->get();

		// We are up-to-date.  Nothing to do.
		if ( $sop_db_version == $current_db_version )
			return false;
		
		// Make upgrade
		if ( $current_db_version == false || $current_db_version < 1 ) {
			$this->upgrade_200();
			$db_version_option->add($sop_db_version);
		}
	}
	
	/**
	 * Test if a table exist or not...
	 *
	 * @param string $table 
	 * @return boolean
	 * @author Amaury Balmer
	 */
	function tableExist( $table ) {
		global $db;
		return $db->get_var("SHOW TABLES LIKE `$table`");
	}
	
	/**
	 * Create table option for upgrade
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function createTableOptions() {
		global $db;
		
		return $db->query("CREATE TABLE `planning_options` (
			`option_id` bigint(20) unsigned NOT NULL auto_increment,
			`option_name` varchar(64) NOT NULL default '',
			`option_value` longtext NOT NULL,
			PRIMARY KEY  (`option_id`),
			UNIQUE KEY `option_name` (`option_name`)
			) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;");
	}
	
	/**
	 * Make DB upgrade to v1.1x to 2.0.
	 * Add option with current DB version, convert password on MD5
	 *
	 * @return void
	 * @author Amaury Balmer
	 */
	function upgrade_200() {
		global $db;
		
		// Increase password size, TODO: pgsql ?
		$db->query("ALTER TABLE `planning_user` CHANGE `password` `password` VARCHAR(255)");
		
		// Hash all password on DB
		$users = $db->get_results("SELECT user_id, password FROM `planning_user`");
		foreach( $users as $user ) {
			$user->password = hash('sha1', $user->password );
			$db->query("UPDATE `planning_user` SET password = '$user->password' WHERE user_id = '$user->user_id'");
		}
		
		
	}
}
?>