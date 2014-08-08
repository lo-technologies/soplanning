<?php

function xajaxFormat($string) {
	return str_replace(array('"', "\r\n", "\n", "\'", "\\\\"), array('\"', "", "", "\\\'", "\\\\\\\\"), trim($string));
}

function afficherErreur($objResponse, $message) {
	$objResponse->addScript('win.destroy();');
	$objResponse->addScript('win = new Window({className: "charte1", title: "Message", width:430, height:200, destroyOnClose: true, recenterAuto:true});');
	$objResponse->addScript('win.setHTMLContent("' . xajaxFormat($message) . '");');
	$objResponse->addScript('win.showCenter();');
	return $objResponse->getXML();
}

// dates au format YYYY-DD-MM
function getNbJours($date_debut, $date_fin) {
	global $lang;
	$DAYS_INCLUDED = explode(',', CONFIG_DAYS_INCLUDED);
	$joursFeries = getjoursFeries();

	$nbJours = 1;
	$dateDebut = new DateTime();
	$dateDebut->setDate(substr($date_debut,0,4), substr($date_debut,5,2), substr($date_debut,8,2));
	while($dateDebut->format('Y-m-d') < $date_fin) {
		$dateDebut->modify('+1 days');
		if (in_array($dateDebut->format('w'), $DAYS_INCLUDED) && !in_array($dateDebut->format('Y-m-d'), $joursFeries)) {
			$nbJours++;
		}
	}
	return $nbJours;
}

function calculerDateFin($date_debut, $nbJours) {
	global $lang;
	$DAYS_INCLUDED = explode(',', CONFIG_DAYS_INCLUDED);
	$joursFeries = getjoursFeries();

	$dateFin = new DateTime();
	$dateFin->setDate(substr($date_debut,0,4), substr($date_debut,5,2), substr($date_debut,8,2));
	$i = 1;
	while($i < $nbJours) {
		$dateFin->modify('+1 days');
		if (in_array($dateFin->format('w'), $DAYS_INCLUDED) && !in_array($dateFin->format('Y-m-d'), $joursFeries)) {
			$i++;
		}
	}
	return $dateFin->format('Y-m-d');
}

// format hh:mm
function ajouterDuree($total, $ajout) {
	$dataTotal = explode(':', $total);
	$dataAjout = explode(':', $ajout);
	$heures = $dataTotal[0] + $dataAjout[0];
	$minutes = $dataTotal[1] + $dataAjout[1];
	if($minutes >= 60) {
		$heures += 1;
		$minutes -= 60;
	}
	$final = (strlen($heures) == 1 ? '0' . $heures : $heures) . ':' . (strlen($minutes) == 1 ? '0' . $minutes : $minutes);
	//echo '<br>total : ' . $total . ' - ajout : ' . $ajout . ' - final : ' . $final;
	return $final;
}

// calculer diff entre 2 heures (la 1ere est la plus tôt). format hh:mm
function soustraireDuree($heure1, $heure2) {
	$h1 = strtotime($heure1);
	$h2 = strtotime($heure2);
	$final = gmdate('H:i:s',$h2-$h1);
	return $final;
}

function getJoursFeries() {
	$joursFeries = array();
	$feries = new GCollection('Ferie');
	$feries->db_load(array());
	while($ferie = $feries->fetch()) {
		$joursFeries[] = $ferie->date_ferie;
	}
	return $joursFeries;
}

// 2004-01-15 => 15/01/2004
function sqldate2userdate($s, $noYear = false){
	if ($s == '') {
		return '';
	}
    return substr($s,8,2).'/'.substr($s,5,2). (!$noYear ? '/'.substr($s,0,4) : '');
}
// 2004-01-15 => 15/01/04
function sqldate2userdateShort($s){
	if ($s == '') {
		return '';
	}
    return substr($s,8,2).'/'.substr($s,5,2).'/'.substr($s,2,2);
}
// 15/01/2004 => 2004-01-15
function userdate2sqldate($s){
	if ($s == '') {
		return '';
	}
    return substr($s,6,4).'-'.substr($s,3,2).'-'.substr($s,0,2);
}

// 02:35:00 => 02:35
function sqltime2usertime($s) {
    return substr($s,0,5);
}

// 2:35 => 02:35
// 2 => 02:00
// 2.5 => 02:30
function usertime2sqltime($s, $formatComplet = 'ok') {
	if(strpos($s, '.')) {
		$data = explode('.', $s);
		// on replace la partie decimale par son equivalent en minute
		if(isset($data[1]) && strlen($data[1]) > 0) {
			$s = $data[0] . ':' . ($data[1] * 6);
		} else {
			$s = $data[0];
		}
	}
	if(strlen($s) == 0) {
		$s = '00:00';
	}
	if(strlen($s) == 1) {
		$s = '0' . $s . ':00';
	}
	if(strlen($s) == 2) {
		$s = $s . ':00';
	}
	if(strlen($s) == 4) {
		$s = '0' . $s;
	}
	if($formatComplet == 'ok') {
		$s .= ':00';
	}
	return $s;
}


// valide une date au format dd/mm/yyyy
function controlDate($date) {
	if ($date != '' && !ereg("([0-9]{2})/([0-9]{2})/([0-9]{4})", $date, $regs)) {
		return false;
	}
	return true;
}

function val2sql($val)
{
	$val = trim($val);
	if (($val == '') || ($val == "\0")) {
	    return 'NULL';
	} else {
		return '\'' . addslashes($val) . '\'';
	}
}


// calcule la couleur (noir ou blanc) qui tranche le mieux avec celle passée en parametre
function buttonFontColor($bgcolor) {
	$values_array = array("0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "A", "B", "C", "D", "E", "F");
	
	if($bgcolor == '#black') {
		return "#FFFFFF";
	}

	if (strlen($bgcolor) != 7) {
		return false;
		break;
	}
	if (substr($bgcolor, 0, 1) != "#") {
		return false;
		break;
	}
	//$cpt = 0;
	$total = 0;
	for ($i = 1 ; $i < 7 ; $i++) {
		$mySubStr = strtoupper(substr($bgcolor, $i /*+ $cpt*/, 1));
		if (!in_array($mySubStr, $values_array)) {
			return false;
			break;
		} elseif ($i == 1) { // red
			if     ($mySubStr == "A") {$total += 10;}
			elseif ($mySubStr == "B") {$total += 11;}
			elseif ($mySubStr == "C") {$total += 12;}
			elseif ($mySubStr == "D") {$total += 13;}
			elseif ($mySubStr == "E") {$total += 14;}
			elseif ($mySubStr == "F") {$total += 15;}
			else {
				$total += $mySubStr;
			}
		} elseif ($i == 3 ) { // green big ponderation
			$pond = 9;
			if     ($mySubStr == "A") {$total += (10 );}
			elseif ($mySubStr == "B") {$total += (11 );}
			elseif ($mySubStr == "C") {$total += (12 + ($pond * 2));}
			elseif ($mySubStr == "D") {$total += (13 + ($pond * 2));}
			elseif ($mySubStr == "E") {$total += (14 + ($pond * 4));}
			elseif ($mySubStr == "F") {$total += (15 + ($pond * 4));}
			else {
				$total += $mySubStr;
			}
		} elseif ($i == 5) { // blue medium ponderation
			$pond = 5;
			if     ($mySubStr == "A") {$total += (10 );}
			elseif ($mySubStr == "B") {$total += (11 );}
			elseif ($mySubStr == "C") {$total += (12 + $pond);}
			elseif ($mySubStr == "D") {$total += (13 + $pond);}
			elseif ($mySubStr == "E") {$total += (14 + $pond);}
			elseif ($mySubStr == "F") {$total += (15 + $pond);}
			else {
				$total += $mySubStr;
			}                                
		}
	}
	if ($total < 36) {
		$fontColor = "#FFFFFF";
	} else {
		$fontColor = "#000000";
	}
	return $fontColor;
}

// récupère le message à afficher, en concaténant un eventuel code d'erreur
function formatMessage($smartyTexte) {
	global $lang;
	$smartyTemp = new MySmarty('fr');

	$temp = explode(';', $smartyTexte);
	if(count($temp) == 1) {
		$texte = $smartyTemp->get_config_vars($smartyTexte);
		if($texte == '') {
			$texte = $smartyTexte;
		}
	} else {
		$texte = $smartyTemp->get_config_vars($temp[0]) . $smartyTemp->get_config_vars('code_technique') . $temp[1];
	}
	return $texte;
}


function detectLanguage($default) {
	global $cfgAvailableLanguages;
	$language = '';
	if (!empty($_SERVER['HTTP_ACCEPT_LANGUAGE']))
		$HTTP_ACCEPT_LANGUAGE = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	if (!empty($_SERVER['HTTP_USER_AGENT']))
		$HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];

	if (empty($language) && !empty($HTTP_ACCEPT_LANGUAGE)) {
		$accepted    = explode(',', $HTTP_ACCEPT_LANGUAGE);
		$acceptedCnt = count($accepted);
		reset($accepted);
		for ($i = 0; $i < $acceptedCnt && empty($language); $i++) { 
			$tmpLang = $accepted[$i];

			// specific case for firefox
			$data = explode('-', $accepted[$i]);
			if(count($data) > 1) {
				$tmpLang = $data[0];
			}
			$data = explode(';', $accepted[$i]);
			if(count($data) > 1) {
				$tmpLang = $data[0];
			}

			if (array_key_exists($tmpLang, $cfgAvailableLanguages)) {
				$language = $tmpLang;				
			}
		}
	}

	// 2. try to findout users language by checking it's HTTP_USER_AGENT variable
	if (empty($language) && !empty($HTTP_USER_AGENT)) {
		$language = isAvailableLanguage($HTTP_USER_AGENT, 2);
	}

	// 3. Didn't catch any valid lang : we use the default settings
	if (empty($language) || is_null($language)) {
		$language = $default;
	}
	return $language;
}

function isAvailableLanguage($str = '', $envType = '')
{
	global $cfgAvailableLanguages;

	$language = '';
	reset($cfgAvailableLanguages);
	while (list($key, $value) = each($cfgAvailableLanguages)) {
		if (($envType == 1 && preg_match('/^(' . $value[0] . ')(;q=[0-9]\\.[0-9])?$/i', $str)) ||
		($envType == 2 && preg_match('/(\(|\[|;[[:space:]])(' . $value[0] . ')(;|\]|\))/i', $str))) {
			$language     = $key;
			break;
		}
	}
	return $language;
}

function getUrlInfo()
{
	$root = 'http';
	if ( isset ($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on") {
		$root .= "s";
	}
	$root .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
		$root .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"];
	} else {
		$root .= $_SERVER["SERVER_NAME"];
	}

	$fileName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/")+1);
	$currentDir = substr($_SERVER["SCRIPT_NAME"], 0, strrpos($_SERVER["SCRIPT_NAME"], "/")+1);
	$result['root'] = $root;
	$result['currentDir'] = $currentDir;
	$result['fileName'] = $fileName;
	$result['currentUrl'] = $root.$currentDir.$fileName;
	$result['currentUrlWithArg'] = $root.$_SERVER['REQUEST_URI'];
	return $result;
}

function is__writable($path) {
//will work in despite of Windows ACLs bug
//NOTE: use a trailing slash for folders!!!
    if ($path{strlen($path)-1}=='/') // recursively return a temporary file path
        return is__writable($path.uniqid(mt_rand()).'.tmp');
    else if (is_dir($path))
        return is__writable($path.'/'.uniqid(mt_rand()).'.tmp');
    // check tmp file for read/write capabilities
    $rm = file_exists($path);
    $f = @fopen($path, 'a');
    if ($f===false)
        return false;
    fclose($f);
    if (!$rm)
        unlink($path);
    return true;
}


function VerifierAdresseMail($adresse) {
	$Syntaxe='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
	if(preg_match($Syntaxe,$adresse))
		return true;
	else  
		return false;
}


function xss_protect($data, $strip_tags = false, $allowed_tags = "") { 
	if(is_null($data) || is_bool($data) || is_array($data)) {
		return $data;
	}
	if($strip_tags) {
        $data = strip_tags($data, $allowed_tags . "<b>");
    }
    if(stripos($data, "script") !== false) {
        $result = str_replace("script","scr<b></b>ipt", htmlentities($data, ENT_QUOTES, "ISO-8859-1"));
    } else {
        $result = htmlentities($data, ENT_QUOTES, "ISO-8859-1");
    }
    return $result;
}

function detectionMobile() {
	$detect = new Mobile_Detect();
	if($detect->isMobile() || $detect->isTablet()) {
		return true;
	}
	return false;
}

// fonction pour affichage par jour
function couvreTranche($dureeDetails, $trancheHoraire) {
	if($dureeDetails == 'AM') {
		// on demarre la couverture sur les premieres heures autorisées dans la config, jusqu'à couvrir le nombre d'heures indiqué pour une matinée (config également)
		$tabTranchesHoraires = explode(',', CONFIG_HOURS_DISPLAYED);
		$tabTranchesHoraires = explode(',', CONFIG_HOURS_DISPLAYED);
		for($i=1; $i<=CONFIG_DURATION_AM; $i++) {
			if(array_shift($tabTranchesHoraires) == $trancheHoraire) {
				return true;
			}
		}
		return false;

	} elseif ($dureeDetails == 'PM') {
		// on demarre la couverture après que les heures du matin soient déduites
		$tabTranchesHoraires = explode(',', CONFIG_HOURS_DISPLAYED);
		for($i=1; $i<=CONFIG_DURATION_AM; $i++) {
			$tmp = array_shift($tabTranchesHoraires);
		}
		for($i=1; $i<=CONFIG_DURATION_PM; $i++) {
			if(array_shift($tabTranchesHoraires) == $trancheHoraire) {
				return true;
			}
		}
		return false;

	} elseif ($dureeDetails == 'duree') {
		// on couvre selon la durée, sur les heures selectionnées
		$tabTranchesHoraires = explode(',', CONFIG_HOURS_DISPLAYED);
		for($i=1; $i<=CONFIG_DURATION_DAY; $i++) {
			if(array_shift($tabTranchesHoraires) == $trancheHoraire) {
				return true;
			}
		}

	} elseif (strlen($dureeDetails) == 17) {
		// on calcule si l'horaire de début et de fin couvre.
		$data = explode(';', $dureeDetails);
		$heureDebut = $data[0];
		$heureFin = $data[1];
		$debutTranche = usertime2sqltime($trancheHoraire);
		$finTranche = usertime2sqltime($trancheHoraire + 1);
		if($heureDebut >= $debutTranche && $heureDebut < $finTranche) {
			return true;
		}
		if($heureFin > $debutTranche && $heureFin < $finTranche) {
			return true;
		}
		if($heureDebut < $debutTranche && $heureFin >= $finTranche) {
			return true;
		}
		return false;

	} else {
		// dans tous les autres cas on considère que ça couvre
		return true;
	}
}

?>