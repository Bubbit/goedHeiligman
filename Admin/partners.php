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

  $sql = "SELECT * FROM partners";
  $partners = mysql_query($sql) or die(mysql_error());
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
        <div class="nav_admin" id="nav">
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
			  <a href="indeling.php"> Indeling </a>
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
        <div id="guts" class="index_admin">
          <div class="title">
            Partners
          </div>
            <?php if(mysql_num_rows($partners)) {
              while($partner = mysql_fetch_array($partners)) {
              echo 'Naam: '.$partner['title'].'<br />';
              echo 'Url: '.$partner['link'].'<br />';
              echo '<a href="delete_partner.php?id='.$partner['id'].'">Verwijder Partner</a><br /><br />';
            } } ?>
          <br />
          <form action="new_partner.php" method="post">
            <input type="text" name="name" placeholder="Naam" class="input"/><br />
            <input type="text" name="link" placeholder="Url" class="input"/><br />
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
 