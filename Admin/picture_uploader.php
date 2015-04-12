<?php
error_reporting(E_ALL); 
ini_set("display_errors", 1); 

require_once("../connection.php");
include("functions.php");
include("lock.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$uploaddir = '../Images/uploads/';

  $uploadfile = $uploaddir.($_FILES['pic']['name']);
  $part = $_POST['part'];
  $folder = $_POST['folder'];
  
  unlink($uploadfile);
  if(move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
    $zip = new ZipArchive;
    $zip->open($uploadfile);
    
    for($i = 0; $i < $zip->numFiles; $i++) {
      $zip->extractTo($uploaddir, array($zip->getNameIndex($i)));
      $filename = $zip->getNameIndex($i);
      $fileinfo = pathinfo($filename);
      $basename = $fileinfo['basename'];
      $uploadname = $uploaddir.$basename;
      $sql = "SELECT * FROM images WHERE name = '$basename'";
      $result = mysql_query($sql) or die(mysql_error());
      if(mysql_num_rows($result) == 0) { 
        $sql = "INSERT INTO images (name, title, part, folder) VALUES ('$basename', '$basename', '$part', '$folder')";
        $result = mysql_query($sql) or die (mysql_error());
      }
      create_thumbnail($uploadname);
    }
    
    $zip->close(); 
  }
}

header("Location: ./Foto.php");


?>