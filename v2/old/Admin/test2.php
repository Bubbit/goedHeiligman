<?php
require_once("../connection.php");
include("lock.php");

$group_info = mysql_query("SHOW COLUMNS FROM groepen") or die(mysql_error());
while($col = mysql_fetch_array($group_info)) {
	echo $col['Field'];
}
?>