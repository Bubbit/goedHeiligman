<?php
require_once("../connection.php");
include("lock.php");

$id = mysql_real_escape_string($_GET['id']);

$sql = "SELECT * FROM images WHERE id = '$id'";
$img_info = mysql_fetch_array(mysql_query($sql)) or die(mysql_error());

unlink('../Images/'.$img_info['name']);
$sql = "DELETE FROM images WHERE id = '$id'";
$result = mysql_query($sql) or die(mysql_error());

header("Location: ./Foto.php");

?>