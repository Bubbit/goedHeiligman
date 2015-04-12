<?php
require_once("../connection.php");
include("lock.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $title = mysql_real_escape_string(addslashes($_POST['title']));
  $text = mysql_real_escape_string(addslashes($_POST['text']));
  
  


}

?>
