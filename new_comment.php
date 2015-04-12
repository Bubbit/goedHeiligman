<?php
require_once("connection.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysql_real_escape_string($_POST['name']);
    $email = mysql_real_escape_string($_POST['email']);
    $comment = mysql_real_escape_string($_POST['comment']);
    $place = mysql_real_escape_string($_POST['place']);
    $answer = $_POST['answer'];
    
    if($answer == '2') {
      $sql = "INSERT INTO guestbook (name, email, comment, place, date) VALUES ('$name', '$email', '$comment', '$place', CURDATE())";
      $result = mysql_query($sql) or die(mysql_error());
    }
    
    header("Location: gastenboek.php");
  }
?>