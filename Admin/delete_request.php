<?php
  require_once("../connection.php");

  $id = mysql_real_escape_string($_GET['id']);

  $sql = "DELETE FROM request WHERE id = '$id'";
  $result = mysql_query($sql) or die(mysql_error());

  header("Location: ./#Aanvragen");

?>