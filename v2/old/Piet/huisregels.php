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
 <?php 
  require_once("../connection.php");

  $sql = "SELECT * FROM static WHERE id = '5'";
  $page_info = mysql_fetch_array(mysql_query($sql)) or die(mysql_error());
?> 
</head>
<body>
  <div id="page-wrap">
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
          <img src="../Images/buttons/header.jpg"/>
          <div class="header_right">
          </div>
        </div>
        <div class="nav" id="nav">
          <ul>
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
              <a href="huisregels.php"> Huisregels </a>
            </li>
			
			<li>
              <a href="Indeling_tijden.php"> Tijden </a>
            </li>
                      
            <li>
              <a href="Logout.php"> Logout </a>
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
      <div class="right_column">.
      </div>
    </div>
  </center>
  </div>
</body>
</html>