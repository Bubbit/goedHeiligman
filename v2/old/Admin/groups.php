<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Sinterklaas</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="keywords" content="" />
  <link href="../style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="../js/jquery.ba-hashchange.js"></script>
  <script type='text/javascript' src='../js/dynamicpage.js'></script>
  <script type="text/javascript" src="../js/highlight.pack.js"></script>
  <script type="text/javascript" src="../js/tabifier.js"></script>
 <?php 
  require_once("../connection.php");
  include("lock.php");

  $sql = "SELECT * FROM groepen";
  $groups = mysql_query($sql) or die(mysql_error());
  ?>
</head>
<body>
  <center>
    <div class="container">
      <div class="mid_column">
        <div class="header">
          <div class="header_left">
          </div>
          <img src="../Images/buttons/header.jpg"/>
          <div class="header_right">
          </div>      
        </div>
        <div class="nav" id="nav">
          <ul>
            <li>
              <a href="Index.php"> Home </a>
            </li>
						
            <li>
              <a href="Foto.php"> Foto's </a>
            </li>
            
            <li>
              <a href="Video.php"> Video's </a>
            </li>
            
            <li>
              <a href="Agenda.php"> Agenda </a>
            </li>
            
            <li>
              <a href="gastenboek.php"> Gastenboek </a>
            </li>
            
            <li>
              <a href="partners.php"> Partners </a>
            </li>
            
            <li>
              <a href="Pieten.php" target="_blank"> Pieten </a>
            </li>
                        
            <li>
              <a href="Logout.php"> Logout </a>
            </li>
          </ul>
        </div>
        <section id="main-content">
        <div id="guts" class="index">
          <div class="title">
            Indeling groepen
          </div>
            <?php if(mysql_num_rows($groups)) {
			  echo '<table><tr><th>'; 
              while($group = mysql_fetch_array($groups)) {
                echo 'Naam: '.$group['naam'].'<br />';
			    $sql = "SELECT ". dateFormat('l d F', 'date'). "as nl_date, id FROM events ORDER BY date, tijd";
				$result = mysql_query($sql) or die(mysql_error());
				$done = array();
				while($event = mysql_fetch_array($result)) { 
				if(!list_check($event['nl_date'], $done)) {
				  $done[] = $event['nl_date'];
				?>
			  <input type="checkbox" name="<?php echo $event['id']; ?>" /> <?php echo $event['nl_date']; ?> <br />
			  <?php } }
              echo '<a href="delete_group.php?id='.$group['id'].'">Verwijder Partner</a><br /><br />';
            } } ?>
          <br />
          <form action="new_group.php" method="post">
            <input type="text" name="name" placeholder="Naam" class="input"/><br />
            <input type="submit" value="Submit" class="submit"/>          
          </form>
          <br />
        </div>
        </section>
      </div>
    </div>
  </center>
</body>
</html>
 