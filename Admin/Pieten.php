<?php
	require_once("../connection.php");
  include("lock.php");
  include("functions.php");
  
  $sql = "SELECT * FROM pieten";
  $result = mysql_query($sql) or die(mysql_error());  
  
  $sql = "SELECT * FROM events ORDER BY date, id ASC";
  $events = mysql_query($sql) or die(mysql_error());
  
  $done = array();
  $new_event = array();
  while($event = mysql_fetch_array($events)) { 
    if(!list_check($event['date'], $done)) {
      $new_event[] = $event;
      $done[] = $event['date'];
    }
  }
  
  $events_list = array();
  echo "<table border='1px'><tr><th>Voornaam</th><th>Achternaam</th><th>BSN</th><th>Geboortedatum</th><th>email</th><th>telefoonnummer</th><th>eigen pak</th><th>Schmink</th>";
  foreach($new_event as $event) {
    echo "<td>".$event['date']."</td>";
    $events_list[] = $event;
  }
  echo "<th>Al eerder</th><th>Waar</th><th>Extra</th><th>Hoe</th><th>Kunstjes</th><th>Boot</th>";
  while($piet = mysql_fetch_array($result)) {
    echo "<tr>";
    echo "<td>".$piet['first_name']."</td>";
    echo "<td>".$piet['last_name']."</td>";
    echo "<td>".$piet['BSN']."</td>";
    echo "<td>".$piet['date_of_birth']."</td>";
    echo "<td>".$piet['email']."</td>";
    echo "<td>".$piet['phone']."</td>";
    echo "<td>".$piet['own_suit']."</td>";
    echo "<td>".$piet['size']."</td>";
    $avail = explode(",", $piet['dates']);
    foreach($events_list as $event) {
      if(in_array($event['id'], $avail)) {
        echo "<td> Ja </td>";
      } else {
        echo "<td> Nee </td>";
      }    
    }
    echo "<td>".$piet['prev']."</td>";
    echo "<td>".$piet['spot']."</td>";
    echo "<td>".$piet['extra']."</td>";
    echo "<td>".$piet['how']."</td>";
    echo "<td>".$piet['skill']."</td>";
    echo "<td>".$piet['boot']."</td>";
    echo "</tr>";
  }
?>