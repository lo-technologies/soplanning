<?php

class Debug
{
    /**
     * The debug array of the application.
     * @var		array 
     */
	protected $debugLog = array();

    /**
     * This is the constructor required to create an object.
     */
	public function __construct()
	{
	}

    /**
     * Print $debugLog array.
	 */
	public function printLogs()
	{
		reset($this->debugLog);
		$debugPrint = '<table width="100%" border="1" bgcolor="#ffffff">
						<tr align="center">
							<td>#</td>
							<td>Type</td>
							<td>Valeur</td>
						</tr>';
		foreach ( $this->debugLog as $key => $row) {
			$debugPrint .= '<tr>
								<td>' . $key . '</td>
								<td>' . $row['type'] . '</td>
								<td><pre>';
			switch ($row['type']) {
				case 'sql' :
					$sql = $row['value'];
					$sql = str_replace(' FROM ', "\nFROM ", $sql);
					$sql = str_replace(' WHERE ', "\nWHERE ", $sql);
					$sql = str_replace(' AND ', "\n\tAND ", $sql);
					$sql = str_replace(' GROUP BY ', "\nGROUP BY ", $sql);
					$sql = str_replace(' HAVING ', "\nHAVING ", $sql);
					$sql = str_replace(' ORDER BY ', "\nORDER BY ", $sql);
					$debugPrint .= htmlentities($sql);
					break;
				default :
					$debugPrint .= print_r($row['value']);
			}
			$debugPrint .= '	</pre></td>
							</tr>';
		}
		$debugPrint .= '</table>';
		echo $debugPrint;
	}

    /**
     * Add a trace on the $debugLog array.
	 * @param	string	$var	debug variable
	 * @param	string	$type	type of the debug varaible	
	 */
	public function add($var, $type = 'var')
	{
		if ($type == 'var') {
			$type = gettype($var);
		}
		$this->debugLog[] = array( 'type' => $type, 'value' => $var);
	}

}
?>