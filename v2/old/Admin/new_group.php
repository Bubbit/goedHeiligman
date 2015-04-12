<?php
require_once("../connection.php");
include("lock.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = mysql_real_escape_string($_POST['name']);

  $sql = "INSERT INTO groepen (naam) VALUES ('$name')";
  $result = mysql_query($sql) or die(mysql_error());
}

header("Location: ./indeling.php");
?>