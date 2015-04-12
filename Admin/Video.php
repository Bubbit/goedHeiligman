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
  <script src="../js/js.js"></script>
	<script src="../js/jPages.js"></script>  
 <?php 
  require_once("../connection.php");
  include("functions.php");
  include("lock.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sel_folder = $_POST['folder'];
    if($sel_folder) {
      $sql = "SELECT * FROM videos WHERE part = '0' AND folder = '$sel_folder'";
      $sql_2 = "SELECT * FROM videos WHERE part = '1' AND folder = '$sel_folder'";
    } else {
      $sql = "SELECT * FROM videos WHERE part = '0'";
      $sql_2 = "SELECT * FROM videos WHERE part = '1'";
    }  
  } else {
    $sql = "SELECT * FROM videos WHERE part = '0'";
    $sql_2 = "SELECT * FROM videos WHERE part = '1'";    
  }
  
  if(isset($_GET['pagenum'])) {
    $pagenum = addslashes($_GET['pagenum']);
  } else {
    $pagenum = "";
  }
  
  $page_url = $_SERVER['REQUEST_URI'];
  
  $results = paging($pagenum, $page_url, $sql, 2);

  $pagenum = $results[0];
  $page_url = $results[1];
  $pic_sql = $results[2];
  $last = $results[3];
  $page_rows = $results[4];
  $rows = $results[5];
  
  $pic = mysql_query($pic_sql) or die(mysql_error());
  
  if(isset($_GET['pagenum_2'])) {
    $pagenum_2 = addslashes($_GET['pagenum_2']);
  } else {
    $pagenum_2 = "";
  }
  
  $page_url = $_SERVER['REQUEST_URI'];
  
  $results = paging($pagenum_2, $page_url, $sql_2, 2);

  $pagenum_2 = $results[0];
  $page_url = $results[1];
  $pic_sql_2 = $results[2];
  $last_2 = $results[3];
  $page_rows_2 = $results[4];
  $rows_2 = $results[5];
  
  $pic_2 = mysql_query($pic_sql_2) or die(mysql_error());
  
  $sql = "SELECT * FROM folder";
  $folders = mysql_query($sql) or die(mysql_error());
?> 
</head>
<body>
  <div id="page-wrap">
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
              Video's
            </div>
            <form action="" method="post">
            <select name="folder" onChange="this.form.submit();" class="styled-select">
              <option value=""> Alle </option>
              <?php while($folder = mysql_fetch_array($folders)) {
              if($sel_folder == $folder['id']) {
                echo '<option value="'.$folder['id'].'" selected> '.$folder['name'].'</option>';
              } else {
                echo '<option value="'.$folder['id'].'"> '.$folder['name'].'</option>';
              }
              }
              ?>
            </select>
            </form>
            Video's voor iedereen: <br />
            <?php if($pagenum == 1) { } else {?>
              <a href="Video.php?pagenum=1&pagenum_2=<?php echo $pagenum_2; ?>"> eerste</a>
              <?php $prev = $pagenum - 1; ?>
              <a href="Video.php?pagenum=<?php echo $prev; ?>&pagenum_2=<?php echo $pagenum_2; ?>"> vorige</a> 
            <?php } ?>
            <?php echo ($page_rows * ($pagenum-1) + 1); ?> - <?php 
                if($page_rows * $pagenum > $rows) {
                  echo $rows;
                } else {
                  echo $page_rows * $pagenum ;
                }?> 
                van <?php echo $rows; ?> video's
            <?php if($pagenum == $last) { } else { ?>
              <?php $next = $pagenum + 1; ?>
              <a href="Video.php?pagenum=<?php echo $next; ?>&pagenum_2=<?php echo $pagenum_2; ?>"> volgende</a> 
              <a href="Video.php?pagenum=<?php echo $last; ?>&pagenum_2=<?php echo $pagenum_2; ?>"> laatste </a>
            <?php } ?> 
              <div class="video_block">
                <?php while($pic_info = mysql_fetch_array($pic)) { ?>
                  <div class="clip">
                    <iframe width="560" height="315" src="<?php echo $pic_info['name']; ?>" frameborder="0" allowfullscreen></iframe><br />
                    <a href="delete_video.php?id=<?php echo $pic_info['id'] ?>">Verwijder clip</a><br />    
                  </div>
                <?php
                }
                ?>
              </div>
            <br />
            Video's voor alleen pieten: <br />
            <?php if($pagenum_2 == 1) { } else {?>
              <a href="Video.php?pagenum=<?php echo $pagenum; ?>&pagenum_2=1"> eerste</a>
              <?php $prev = $old_pagenum - 1; ?>
              <a href="Video.php?pagenum=<?php echo $pagenum; ?>&pagenum_2=<?php echo $prev; ?>"> vorige</a> 
            <?php } ?>
            <?php echo ($page_rows_2 * ($pagenum_2-1) + 1); ?> - <?php 
                if($page_rows_2 * $pagenum_2 > $rows_2) {
                  echo $rows_2;
                } else {
                  echo $page_rows_2 * $pagenum_2;
                }?> 
                van <?php echo $rows_2; ?> video's
            <?php if($pagenum_2 == $last_2) { } else { ?>
              <?php $next = $pagenum_2 + 1; ?>
              <a href="Video.php?pagenum=<?php echo $pagenum; ?>&pagenum_2=<?php echo $next; ?>"> volgende</a> 
              <a href="Video.php?pagenum=<?php echo $pagenum; ?>&pagenum_2=<?php echo $last_2; ?>"> laatste </a>
            <?php } ?> 
              <div class="video_block">
                <?php while($pic_info = mysql_fetch_array($pic_2)) { ?>
                  <div class="clip">
                    <iframe width="560" height="315" src="<?php echo $pic_info['name']; ?>" frameborder="0" allowfullscreen></iframe><br />
                    <a href="delete_video.php?id=<?php echo $pic_info['id'] ?>">Verwijder clip</a><br /> 
                  </div>
                <?php
                }
                ?>
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