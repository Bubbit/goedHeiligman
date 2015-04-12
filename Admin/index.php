<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Sinterklaas</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="keywords" content="" />
  <link href="../style.css" rel="stylesheet" type="text/css">
  <script type="text/javascript" src="../js/jquery-1.7.1.min.js"></script>
  <script type="text/javascript" src="../js/jquery.ba-hashchange.js"></script>
  <script type="text/javascript">
    function toggle_visibility(id) {
      var e = document.getElementById(id);
      if(e.style.display == 'block')
        e.style.display = 'none';
      else
        e.style.display = 'block';
    }
    
    function popup(url) {
      window.open(url,'Home', 'resizable=yes,toolbar=no,location=no,scrollbars=yes,width=800,height=800')
    }
  </script> 
  <?php
    require_once("../connection.php");
    include("functions.php");
    include("lock.php");

    $sql = "SELECT * FROM account WHERE admin_lvl = '0'";
    $piet_account = mysql_fetch_array(mysql_query($sql)) or die(mysql_error());

    $sql = "SELECT * FROM account WHERE admin_lvl = '1'";
    $foto_account = mysql_fetch_array(mysql_query($sql)) or die(mysql_error());
    
    $sql = "SELECT * FROM static";
    $static = mysql_query($sql) or die(mysql_error());
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
          <form method="post" action="update_account.php">
            <input type="text" name="name" value="<?php echo $piet_account['name']; ?>" class="input"/><br />
            <input type="text" name="password" value="<?php echo $piet_account['password']; ?>" class="input"/><br />
            <input type="hidden" name="id" value="<?php echo $piet_account['id']; ?>"/>
            <input type="submit" value="Aanpassen" class="submit"/><br /><br />
          </form>

          <form method="post" action="update_account.php">
            <input type="text" name="name" value="<?php echo $foto_account['name']; ?>" class="input"/><br />
            <input type="text" name="password" value="<?php echo $foto_account['password']; ?>" class="input"/><br />
            <input type="hidden" name="id" value="<?php echo $foto_account['id']; ?>"/>
            <input type="submit" value="Aanpassen" class="submit"/><br /><br />
          </form>
          <?php while($page = mysql_fetch_array($static)) {
            echo $page['title'];
          ?>      
          <a href="javascript:popup('static.php?id=<?php echo $page['id']; ?>')">Pas aan</a><br /><br />    
          <?php
          } ?>
        </div>
      </div>
    </div>
  </center>
</body>
</html>