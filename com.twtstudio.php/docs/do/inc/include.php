<?php
	
	require_once(dirname(__FILE__).'/../../functions.php');
	
	$conn = mysql_connect(DBHOST, DBUSER, DBPW);
	
	if(!$conn)
		die('FAIL TO CONNECT MYSQL SERVER. <br>'.mysql_error());
	
	mysql_select_db(DBNAME, $conn);
	
//	mysql_query('SET character_set_connection=utf8, character_set_results=utf8, character_set_client=binary', $conn);
	
	
?>