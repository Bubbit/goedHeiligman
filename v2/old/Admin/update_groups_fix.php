<?php
require_once("../connection.php");
include("lock.php");
include("functions.php");

$sql = "SELECT * FROM events ORDER BY date, id";
$result = mysql_query($sql) or die(mysql_error());

$done = array();
while($event = mysql_fetch_array($result)) {
	if(!list_check($event['date'], $done)) {
		$sql = "ALTER TABLE groepen ADD d_".$event['id']." varchar(100)";
		$sql_res = mysql_query($sql) or die(mysql_error());
		$done[] = $event['date'];
	}
}
?>