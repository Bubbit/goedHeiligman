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

    $sql = "SELECT * FROM static WHERE id = '3'";
    $page_info = mysql_fetch_array(mysql_query($sql)) or die(mysql_error());
    
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
            <?php echo $page_info['text']; ?>
          </div>
        </section>	
      </div>
      <div class="right_column">
      </div>
    </div>
  </center>
 </body>
</html>