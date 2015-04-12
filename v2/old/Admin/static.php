<?php
  require_once("../connection.php");
  include('../js/tiny_mce.js');
  include("lock.php");

  $id = (int)$_GET['id'];
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = mysql_real_escape_string(addslashes($_POST['title']));
    $text = mysql_real_escape_string($_POST['text']);
    $id = $_POST['id'];
    
    $sql = "UPDATE static SET title = '$title', text = '$text' WHERE id = '$id'";
    $result = mysql_query($sql) or die(mysql_error());
  }
  
  $sql = "SELECT * FROM static WHERE id = '$id'";
  $result = mysql_fetch_array(mysql_query($sql)) or die(mysql_error());
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Statische pagina</title>
<link type="text/css" rel="stylesheet" href="../style.css">
</head>
<body>
<form action="" method="post" align="left">
<strong>Titel: <br /></strong><input type="text" name="title" value="<?php echo $result['title']; ?>"/><br /><br />
<strong>Tekst: <br /></strong><textarea name="text" cols="150" rows="30"><?php echo $result['text']; ?></textarea><br /><br />
<input type="hidden" name="id" value="<?php echo $id; ?>">
<input type="submit" value="Submit">
</form>
</body>
</html>