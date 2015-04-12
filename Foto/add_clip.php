<?php

  require_once("../connection.php");
  include("lock.php");
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysql_real_escape_string($_POST['title']);
    $name = mysql_real_escape_string($_POST['link']);
    $part = $_POST['part'];
    
    $sql = "SELECT * FROM videos WHERE name = '$name'";
    $result = mysql_query($sql) or die(mysql_error());
    
    if(mysql_num_rows == 0) {
      $sql = "INSERT INTO videos (title, name, part) VALUES ('$title', '$name', '$part')";
      $result = mysql_query($sql) or die(mysql_error());
      
    }
      
  }
  
  header("Location: ./Video.php");
?>