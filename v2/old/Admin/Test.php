<?php

  require_once("../connection.php");
  
  $sql = "SELECT * FROM videos";
  $result = mysql_query($sql) or die(mysql_error());
  
  while($video = mysql_fetch_array($result)) {
    echo $video['title'].'<br />';
    echo '<iframe width="560" height="315" src="'.$video['name'].'?rel=0" frameborder="0" allowfullscreen></iframe><br />';
  }

