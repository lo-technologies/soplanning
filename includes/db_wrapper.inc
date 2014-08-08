<?php

function db_connect($cfgHostname, $cfgUsername, $cfgPassword, $cfgDatabase, $cfgSqlType)
{
	global $cfgConnection;
	switch ($cfgSqlType) {
		case 'mysql':
			$cfgConnection = @mysql_connect($cfgHostname, $cfgUsername, $cfgPassword);
			break;
		case 'psql':
			$cfgConnection = pg_connect("host=$cfgHostname dbname=$cfgDatabase user=$cfgUsername password=$cfgPassword");
			break;
		default:
			break;
	}
	if (!$cfgConnection) {
		//die("<br /><font color=\"RED\"><b>Error</b> : Unable to connect to database. Please verify parameters.</font><br /><br />\n");
		return false;
	}
	if(!mysql_select_db($cfgDatabase)) {
		return false;
	}
	return $cfgConnection;
}

                                       
function db_close()
{
	global $cfgConnection, $cfgSqlType;
	if (isset($cfgConnection)) {
		switch ($cfgSqlType) {
			case 'mysql':
				mysql_close($cfgConnection);
				break;
			case 'psql':
				pg_close($cfgConnection);
				break;
			default:
				break;
		}
		unset($GLOBALS['cfgConnection']);
	}
}


function db_query($query)
{
	global $cfgDatabase, $cfgConnection, $cfgSqlType, $cfgPrefix;

	if($cfgPrefix != 'planning_') {
		$query = str_replace('planning_', $cfgPrefix, $query);
	}

	//file_put_contents(BASE . '/../debug.txt', $query . "\r\n", FILE_APPEND);
	switch ($cfgSqlType) {
		case 'mysql':
			$result = mysql_query($query, $cfgConnection);
			break;
		case 'psql':			
			$result = pg_query($cfgConnection, $query);
			break;
		default:
			break;
	}
	if (!$result) {
		if(DEBUG) {
			echo '<pre>';
			print_r(debug_backtrace());
			echo '</pre>';
			echo "<br /><font color=\"RED\"><b>Error</b> : querying database failed :</font><br />\n<font color=\"GRAY\">\n$query\n</font><br /><br />\n";
			echo '<br>Error : ' . mysql_error();
		} else {
			//echo ("<br /><font color=\"RED\"><b>Error</b> : querying database failed : refresh the page. If the problem persists, verify your database parameters or turn on DEBUG param in config file (set TRUE) to capture error and report to the support team support@soplanning.org</font><br />\n");
		}
	}

	return $result;
}


function db_num_rows($handle = 0)
{
	global $cfgSqlType;
	switch ($cfgSqlType) {
		case 'mysql':
			return ($handle) ? mysql_num_rows($handle) : mysql_num_rows();
			break;
		case 'psql':		
			return ($handle) ? pg_num_rows($handle) : pg_num_rows();
			break;
		default:
			return ($handle);
			break;
	}
}

function db_result($handle, $row, $field)
{
	global $cfgSqlType;
	switch ($cfgSqlType) {
		case 'mysql':
			return mysql_result($handle, $row, $field);
			break;
		case 'psql':
			return pg_fetch_result($handle, $row, $field);
			break;
		default:
			break;
	}
}


function db_fetch_array($handle)
{
	global $cfgSqlType, $cfgConnection;
	switch ($cfgSqlType) {
		case 'mysql':
			$value = mysql_fetch_array($handle, MYSQL_ASSOC);
			return $value;
			break;
		case 'psql':
			$value =  pg_fetch_array($handle);
			return $value;
			break;
		default:
			return ($handle);
			break;
	}
}


function db_data_seek($handle, $row)
{
	global $cfgSqlType;
	switch ($cfgSqlType) {
		case 'mysql':
			return mysql_data_seek($handle, $row);
			break;
		default:
			return True;				
			break;
	}
}

?>
