<?php

/**
* Currency Model
*/
class Currency extends Illuminate\Database\Eloquent\Model
{
	public $timestamps = false;
	public $table = 'tasks';
	
	function __construct()
	{
		
	}

	// public static function first() {
	// 	$connection = mysql_connect('localhost', 'root', '');
	// 	if(!$connection) {
	// 		die('Could not connect: '. mysql_error());
	// 	}

	// 	mysql_set_charset('UTF8', $connection);
	// 	mysql_select_db('homestead', $connection);
	// 	$result = mysql_query('select * from tasks limit 0, 1');
	// 	if($row = mysql_fetch_assoc($result)) {
	// 		return $row;
	// 		// echo '<h1>'. $row['id']. '</h1>';
	// 		// echo '<h1>'. $row['user_id']. '</h1>';
	// 		// echo '<h1>'. $row['name']. '</h1>';
	// 	}

	// 	mysql_close($connection);
	// }
}