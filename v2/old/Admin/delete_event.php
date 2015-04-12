<?php
require_once("../connection.php");
include("lock.php");

$id = mysql_real_escape_string($_GET['id']);

$event_info = mysql_query("SELECT * FROM events WHERE id = '$id'";) or die(mysql_error());

$sql = "DELETE FROM events WHERE id = '$id'";
$result = mysql_query($sql) or die(mysql_error());

$group_info = mysql_query("SHOW COLUMNS FROM groepen") or die(mysql_error());
while($col = mysql_fetch_array($group_info)) {
	if($col['Field'] == 'd_'.$id) {
		$event_date = $event_info['date'];
		$other_events = mysql_query("SELECT * FROM EVENTS WHERE date = '$event_date' ORDER BY id";) or mysql_error());
		if(mysql_num_rows($other_events) > 0) {
			$new_event = mysql_fetch_array($other_events);
			$add = mysql_query("ALTER TABLE groepen ADD d_".$new_event['id']." varchar(100)") or die(mysql_error());
			$change = mysql_query("UPDATE groepen SET d_".$id." = d_".$new_event['id']) or die(mysql_error());
		}
		$drop_it = mysql_query("ALTER TABLE groepen DROP d_".$id) or die(mysql_error());
	}
}


header("Location: ./Agenda.php");

?>