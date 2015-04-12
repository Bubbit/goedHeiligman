<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Sinterklaas</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="keywords" content="" />
  <link href="style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="js/jquery.ba-hashchange.js"></script>
  <script type='text/javascript' src='js/dynamicpage.js'></script>  
 <?php 
  require_once("connection.php");
  include("Admin/functions.php");

  $sql = "SELECT * FROM partners";
  $partners = mysql_query($sql) or die(mysql_error());
?> 
</head>
<body>
   <center>
    <div class="container">
      <div class="mid_column">
	<div id="header">
		<div id="topbar">
		</div>
        <div id="sub-head">
			<div class="header">
			<div class="header_left">
			</div>
			<img src="Images/buttons/header.jpg"/>
			<div class="header_right">
			</div>
			</div>
			<div class="nav" id="nav">
			<ul>
				<li>
				<a href="index.php"> Home </a>
				</li>
            
				<li>
				<a href="geschiedenis.php"> Geschiedenis </a>
				</li>
            
				<li>
				Media
				<ul>
					<li><a href="foto.php"> Foto's </a></li>
					<li><a href="video.php"> Video's </a></li>
				</ul>
				</li>
				
				<li>
				<a href="agenda.php"> Agenda </a>
				</li>
				
				<li>
				<a href="gastenboek.php"> Gastenboek </a>
				</li>
            
				<li>
				<a href="aanvraag.php"> Contact </a>
				</li>
            
				<?php if(isset($partners)) { 
					if(mysql_num_rows($partners) > 0) { ?>
				<li>
				Partners
				<ul>
				<?php while($partner = mysql_fetch_array($partners)) { ?>
					<li><a href="http://<?php echo $partner['link']; ?>" target="_blank"><?php echo $partner['title']; ?></a></li>
				<?php } ?>
				</ul>
				</li>
				<?php } } ?>
            
				<li>
				<a href="login.php"> Login </a>
				</li>
			</ul>
			</div>
		</div>
	</div>
		<section id="main-content">
		<div id="guts" class="index">
      <div class="title">
        Evenementen voor Sinterklaas 2014
      </div>
	  <div>
		
	  </div>
     <?php
      $sql = "SELECT date, ".dateFormat('l d F', 'date'). "as nl_date FROM events ORDER BY date ASC";
      $result = mysql_query($sql) or die(mysql_error());

      $old_date = "";
      while($agenda_punt = mysql_fetch_array($result)) {
        if($old_date != $agenda_punt['date']) { 
          echo '<div class="new_date">';
          echo $agenda_punt['nl_date'];
          echo '</div><div class="event_bar"></div>';
          $old_date = $agenda_punt['date'];
          $sql = "SELECT ". dateFormat('l d F', 'date'). "as date, plaats, tijd FROM events WHERE date = '$old_date' ORDER BY tijd ASC";
          $events = mysql_query($sql) or die(mysql_error());
          
          while($event = mysql_fetch_array($events)) {
            echo '<div class="event">'; 
            echo '<div class="event_place">';
            echo $event['plaats']; 
            echo '</div><div class="event_time">';
            echo $event['tijd'].' uur';
            echo '</div></div>';           
          }
        }        
      }
      ?>
        </div>
		</section>	
      </div>
      <div class="right_column">
      </div>
    </div>
  </center>
  </div>
</body>
</html>
