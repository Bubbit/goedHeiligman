<?php
  require_once("../connection.php");
  include("lock.php");
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysql_real_escape_string($_POST['name']);
	$link = $_POST['page'];
    
    $sql = "SELECT * FROM folder WHERE name = '$name'";
    $result = mysql_query($sql) or die(mysql_error());
    
    if(mysql_num_rows == 0) {
      $sql = "INSERT INTO folder (name) VALUES ('$name')";
      $result = mysql_query($sql) or die(mysql_error());
    }
  }
  
  header("Location: ./".$link);
?>