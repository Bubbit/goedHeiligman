<?php
require_once("../connection.php");
include("lock.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = mysql_real_escape_string(addslashes($_POST['name']));
  $pass = mysql_real_escape_string(addslashes($_POST['password']));
  $id = $_POST['id'];
  
  $sql = "UPDATE account SET name = '$name', password = '$pass' WHERE id = '$id'";
  $result = mysql_query($sql) or die(mysql_error());
  
}

header("Location: ./");
?>