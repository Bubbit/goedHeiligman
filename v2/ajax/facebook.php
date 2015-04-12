<?php
require_once '../includes/config.php'; // The mysql database connection script

$query="SELECT * FROM facebook";
$result = mysql_query($query) or die(mysql_error());

$r = mysql_fetch_array($result);

echo json_encode($r);
?>