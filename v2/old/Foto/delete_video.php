<?php
require_once("../connection.php");
include("lock.php");

$id = mysql_real_escape_string($_GET['id']);

$sql = "DELETE FROM videos WHERE id = '$id'";
$result = mysql_query($sql) or die(mysql_error());

header("Location: ./#Video");

?>