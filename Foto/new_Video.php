<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Sinterklaas</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="keywords" content="" />
  <link href="../style.css" rel="stylesheet" type="text/css">
  <?php 
    require_once("../connection.php");
    include("functions.php");
    include("lock.php");
    $sql = "SELECT * FROM folder";
    $folders = mysql_query($sql) or die(mysql_error());
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
              <ul>
                <li><a href="New_Foto.php"> Nieuwe Foto </a></li>
              </ul>
            </li>
            
            <li>
              <a href="Video.php"> Video's </a>
              <ul>
                <li><a href="New_Video.php"> Nieuwe Video </a></li>
              </ul>
            </li>
            
            <li>
              <a href="Agenda.php"> Agenda </a>
            </li>
             
            <li>
              <a href="Logout.php"> Logout </a>
            </li>
          </ul>
        </div>
		</div>
        <section id="main-content">
          <div id="guts" class="index">
            <div class="title">
              Video's
            </div>
            <form method="post" action="add_clip.php" enctype="multipart/form-data">
            <label>Upload clip</label><br />
            <input type="text" name="title" class="input" placeholder="Titel"/><br />
            <input type="radio" name="part" value="0" checked/> Iedereen<br />
            <input type="radio" name="part" value="1" /> Pieten<br />
            <input type="text" name="link" class="input" placeholder="Link"/><br />
            <input type="submit" value="Voeg toe" class="submit"/>
            </form> <br />
            Folders: <br />
            <?php 
            $sql = "SELECT * FROM folder";
            $folders = mysql_query($sql) or die(mysql_error());
            while($folder = mysql_fetch_array($folders)) {
              echo $folder['name'];  
              echo ' <a href="delete_folder.php?id='.$folder['id'].'">Verwijder map</a><br />';    
            } ?>
            <form method="post" action="add_folder.php">
            <label>Maak een nieuwe map aan</label><br />
            <input type="text" name="name" class="input" placeholder="Titel"/><br />
            <input type="hidden" name="page" value="Video.php">
            <input type="submit" value="Maak aan" class="submit"/>
            </form>
          </div>
        </section>	
    </div>
  </center>
  </div>
</body>
</html>  