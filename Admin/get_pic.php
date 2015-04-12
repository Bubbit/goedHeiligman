<?php
  require_once("../connection.php");
  
  $folder = $_GET['id'];
  $sql = "SELECT * FROM images WHERE folder = '$folder' AND part = '0'";
  $pic = mysql_query($sql) or die(mysql_error());
?>
  <ul id="itemContainer">
  <?php while($pic_info = mysql_fetch_array($pic)) {
	echo '<li>';
    echo $pic_info['name'];
    echo '<a href="delete_image.php?id='.$pic_info['id'].'">Verwijder foto</a>';
	echo '</li>';
  } ?>
  </ul>
  <div id="holder"></div>