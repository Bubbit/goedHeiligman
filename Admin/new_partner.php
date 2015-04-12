<?php
require_once("../connection.php");
include("lock.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = mysql_real_escape_string($_POST['name']);
  $link = mysql_real_escape_string($_POST['link']);

  $sql = "INSERT INTO partners (title, link) VALUES ('$name', '$link')";
  $result = mysql_query($sql) or die(mysql_error());
}

header("Location: ./partners.php");
?>