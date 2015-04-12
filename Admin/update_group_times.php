<?php
require_once("../connection.php");
include("lock.php");
include("functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$sql = "SELECT * FROM events ORDER BY date, id";
	$result = mysql_query($sql) or die(mysql_error());
	$done = array();
	$id = mysql_real_escape_string($_POST['id']);
	while($event = mysql_fetch_array($result)) {
		if(!list_check($event['date'], $done)) {
			$col = 'd_'.$event['id'];
			if(!empty($_POST[$col])) {
				$value = mysql_real_escape_string($_POST[$col]);
				$sql = "UPDATE groepen SET ".$col."=".$value." WHERE id = ".$id;
				$sql_res = mysql_query($sql) or die(mysql_error());
			}
			$done[] = $event['date'];
		}
	}
}

header("Location: ./indeling.php");
?>