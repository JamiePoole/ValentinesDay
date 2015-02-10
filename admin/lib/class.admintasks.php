<?php
class adminTasks {

	protected static $instance;

	private $db;
	private $ut;

	public function __construct($db, $ut){
		$this->db = $db;
		$this->ut = $ut;
	}

	public static function getInstance(dbConnection $db, util $ut){
		if(!self::$instance)
			self::$instance = new self($db, $ut);
		return self::$instance;
	}

	/* Return an array of Database entries.
	 * @param	$count		boolean		Return only count value
	 *			$table		string		`table_name`
	 *			$order		string		`column`
	 *			$sort		string		`ASC` or `DESC`
	 *			$limit		int			`limit amount`
	 * 
	 * @return 	$rows		array
	 *			On error returns false
	 */
	public function getEntries($count = false, $table = null, $order = null, $sort = 'DESC', $limit = null){
		try {
			if($count){
				$sql = "SELECT COUNT(*) FROM `$table`";
			} else {
				if($table != null){
					$sql = "SELECT * FROM `$table`";
					if($order) $sql .= " ORDER BY `$order` $sort";
					if($limit) $sql .= " LIMIT $limit";
				}
			}
			$result = $this->db->prepare($sql);
			$result->execute();
			if($count) $rows = $result->fetchColumn();
			else $rows = $result->fetchAll(PDO::FETCH_ASSOC);
		} catch(PDOException $e){
			$this->ut->log($e);
		}

		return (isset($rows)) ? $rows : false;
	}

	/* Delete an entry from the database
	 * @param 	$table 		string
	 *			$column 	string 		WHERE
	 *			$id 		int 		Identifier
	 *
	 * @return  $success 	boolean
	 */
	public function deleteEntry($table, $column, $id){
		try {
			$sql = "DELETE FROM `$table` WHERE `$column` = `$id`";
			$result = $this->db->prepare($sql);
			$result->execute();
			return true;
		} catch(PDOException $e){
			$this->ut->log($e);
			return false;
		}
	}

	public function getStatistics(){
		// TO DO
	}

	public function getTime($date, $granularity = 2){
		date_default_timezone_set('Europe/London');

		$date = strtotime($date);
		$diff = time() - $date;
		$return = '';
		$periods = array(
			//'decade'	=> 315360000,
			'y'		=> 31536000,
			'mo'	=> 2628000,
			'w'		=> 604800,
			'd'		=> 86400,
			'h'		=> 3600,
			'm'		=> 60,
			's'		=> 1);

		foreach($periods as $abbr => $seconds){
			if($diff >= $seconds){
				$time = floor($diff/$seconds);
				$diff %= $seconds;
				$return = $time . $abbr . ' ago';
				$granularity--;
			}
			if($granularity == '0'){ break; }
		}
		return $return;
	}

	public function hasMessages(){
		// TO DO
	}


}