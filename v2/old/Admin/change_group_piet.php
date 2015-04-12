<?php
require_once("../connection.php");
include("lock.php");
include("functions.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$group_id = $_POST['group'];
	$id = $_POST['id'];
	
	$sql = "UPDATE pieten SET group_id=".$group_id." WHERE id = ".$id;
	echo $sql;
	$result = mysql_query($sql) or die(mysql_error());	
}

header("Location: ./indeling.php");
?>