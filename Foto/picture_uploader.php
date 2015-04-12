<?php
require_once("../connection.php");
include("functions.php");
//include("lock.php");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$uploaddir = '../Images/uploads/';

	$part = $_POST['part'];
	$folder = $_POST['folder'];
	if(isset($_FILES['files'])) {
		foreach($_FILES['files']['tmp_name'] as $key => $tmp_name ){

			$file_name = $_FILES['files']['name'][$key];
			$file_size =$_FILES['files']['size'][$key];
			$file_tmp =$_FILES['files']['tmp_name'][$key];
			$file_type=$_FILES['files']['type'][$key];
			if(move_uploaded_file($file_tmp, $uploaddir.$file_name)) {
				$sql = "SELECT * FROM images WHERE name = '$file_name'";
				$result = mysql_query($sql) or die(mysql_error());
				if(mysql_num_rows($result) == 0) { 
					$sql = "INSERT INTO images (name, title, part, folder) VALUES ('$file_name', '$file_name', '$part', '$folder')";
					$result = mysql_query($sql) or die (mysql_error());
				}
				$uploadname = $uploaddir.$file_name;
				create_thumbnail($uploadname);
			}
		}
	}
/*		
  if ($zip->open($_FILES['pic']['tmp_name']) == true) {
    for($i = 0; $i < $zip->numFiles; $i++) {
      $filename = $zip->getNameIndex($i);
      $fileinfo = pathinfo($filename);
      $basename = $fileinfo['basename'];
      $uploadname = $uploaddir.$basename;
      copy("zip://".$_FILES['pic']['tmp_name']."#".$filename, $uploadname);
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
*/
}
?>