<?php
    require_once("../includes/config.php");

    $sql = "SELECT * FROM folder";
    $result = mysql_query($sql) or die(mysql_error());

    $rows = array();
    while($event = mysql_fetch_array($result)) {
        $rows[] = $event;
    }

    echo json_encode($rows);
?>