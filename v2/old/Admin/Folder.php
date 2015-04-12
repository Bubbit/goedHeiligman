<?php
  include("../connection.php");
  
  $sql = "SELECT * FROM folders";
  $folders = mysql_query($sql) or die(mysql_query());
?>
  Folders:
  <?php while($folder = mysql_fetch_array($folders)) {
    echo $folder['name'];  
    echo ' <a href="delete_folder.php?id='.$folder['id'].'">Verwijder map</a><br />';    
  } ?>
  <form method="post" action="add_folder.php">
  <label>Maak een nieuwe map aan</label><br />
  <input type="text" name="name"/><br />
  <input type="submit" value="Submit"/>
  </form>