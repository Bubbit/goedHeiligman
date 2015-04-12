<?php
	require_once("../connection.php");
  
  $sql = "SELECT * FROM request";
  $result = mysql_query($sql) or die(mysql_error());  
  
  while($agenda_punt = mysql_fetch_array($result)) {
    echo 'Locatie: '.$agenda_punt['place'].'<br />';
    echo 'Tijd: '.$agenda_punt['time'].'<br />';
    echo 'Datum: '.$agenda_punt['date'].'<br />';
    echo 'Extra: '.$agenda_punt['extra'].'<br />';
    echo 'Contact-name: '.$agenda_punt['name'].'<br />';
    echo 'Contact-email: '.$agenda_punt['email'].'<br />';
    echo '<a href="delete_request.php?id='.$agenda_punt['id'].'">Verwijder aanvraag</a><br /><br />';
  }
?>
