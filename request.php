<?php
  require_once("connection.php");
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysql_real_escape_string($_POST['email']);
    $extra = mysql_real_escape_string($_POST['extra']);
    
    $naaradres = "stichtingdegoedheiligman@gmail.com";
    $onderwerp = "Vraag via Website";
    $bericht = "Aanvraag van: ".$email."<br />";
    $bericht .= $extra;
    $header = "From: Sinterklaas@degoedheiligman.nl\r\n";
    $header .= "Content-type: text/html \r\n";
    $mail = mail($naaradres, $onderwerp, $bericht, $header);
    
    if($mail) {
      header("Location: ./Succes_aanvraag.php");
    } else {
      header("Location: ./Geen_Succes_aanvraag.php");
    }
  }
?>