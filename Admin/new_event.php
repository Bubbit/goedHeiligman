<?php
require_once("../connection.php");
include("lock.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $plaats = mysql_real_escape_string(addslashes($_POST['plaats']));
  $tijd = mysql_real_escape_string(addslashes($_POST['tijd']));
  $date = $_POST['date'];
  $extra = mysql_real_escape_string(addslashes($_POST['extra']));
  
  $sql = "SELECT * FROM events";
  $events = mysql_query($sql) or die(mysql_error());
  
  $new = 1;
  while($event_info = mysql_fetch_array($events)) {
    if($date == $event_info['date']) {
		new = 0;
		break;
	}
  }
  
  $sql = "INSERT INTO events (plaats, tijd, date, extra) VALUES ('$plaats', '$tijd', '$date', '$extra')";
  $result = mysql_query($sql) or die(mysql_error());
  
  if($new) {
	$event_id = mysql_insert_id();
	$sql = "ALTER TABLE groepen ADD d_".$event_id." varchar(100)";
  }
}

header("Location: ./Agenda.php");
?>