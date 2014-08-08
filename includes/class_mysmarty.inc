<?php

if (phpversion() > '5.0.0' ) {
	error_reporting(E_ALL);
	require_once BASE . '/../smarty/libs/Smarty.class.php';
	require_once BASE . '/../smarty/libs/Config_File.class.php';
} else {
	require BASE . '/../smarty/libs/Smarty.class.php';	
}

class MySmarty extends Smarty {

	/**
     * This is the constructor required to create an object
	 * @global	array	$cfgAvailableLanguages	an array containing all available languages
	 */
    public function __construct($lang = 'fr', $module = array()) {
		global $cfgAvailableLanguages;

		if(isset($_SESSION['language'])){
			$lang = $_SESSION['language'];
		}
		
		$this->error_reporting = E_ALL;
		$this->Smarty();

		$this->template_dir = BASE . '/../templates/';
		$this->config_dir = BASE . '/../templates/languages/';
		$this->compile_dir = COMPIL_DIR;
		$this->cache_dir = BASE . '/../smarty/cache/';

		require BASE . '/../includes/smarty_data.inc';

		$this->assign('BASE', BASE);
		$this->assign('lang', $lang);

		// no boolean in the config file
		$this->config_booleanize = FALSE;

		// we load modules from the config file NOW
		if (count($module) > 0) {
			while (list($key, $value) = each($module)) {
				$this->config_load($cfgAvailableLanguages[$lang][1] . '.txt', $value);
			}
		} else {
			$this->config_load($cfgAvailableLanguages[$lang][1] . '.txt');
		}

	}

    public function config_load($file, $section = null, $scope = 'global')
    {
		error_reporting(E_ALL);
		parent::config_load($file, $section, $scope);
		error_reporting(E_ALL | E_STRICT);
    }

	/**
	 * returns the content of Smarty's output buffer instead of displaying it
	 * @param	string	$resourceName	the name of the template
	 * @param	integer	$cacheId		l'id du cache
	 * @param	integer	$compileId		l'id de la compil
	 * @return	string					some html code
	 */
    public function getHtml($resourceName, $cacheId = NULL, $compileId = NULL)
    {
        return $this->fetch($resourceName, $cacheId, $compileId, FALSE);
    }
}

?>