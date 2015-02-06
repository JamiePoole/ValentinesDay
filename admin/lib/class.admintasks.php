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
			'year'		=> 31536000,
			'month'		=> 2628000,
			'week'		=> 604800,
			'day'		=> 86400,
			'hour'		=> 3600,
			'minute'	=> 60,
			'second'	=> 1);

		foreach($periods as $abbr => $seconds){
			if($diff >= $seconds){
				$time = floor($diff/$seconds);
				$diff %= $seconds;
				$return .= ($return ? ' ' : '') . $time . ' ';
				$return .= (($time > 1) ? $abbr.'s' : $abbr) . ' ago';
				//$return .= $time.$abbr;
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