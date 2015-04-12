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
  <script type="text/javascript" src="fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
	<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>
  <link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
  <script>
  $(document).ready(function() {
 		$("a.fancybox").fancybox({
      'transitionIn'		: 'none',
      'transitionOut'		: 'none',
      'titlePosition' 	: 'over',
      'titleFormat'		: function(title, currentArray, currentIndex, currentOpts) {
        return '<span id="fancybox-title-over">Image ' + (currentIndex + 1) + ' / ' + currentArray.length + (title.length ? ' &nbsp; ' + title : '') + '</span>';
      }
    });
  });
  </script>
 <?php 
  require_once("connection.php");
  include("Admin/functions.php");
  
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $sel_folder = $_POST['folder'];
    if($sel_folder) {
      $sql = "SELECT * FROM images WHERE part = '0' AND folder = '$sel_folder'";
      if(!$sel_folder) {
        unset($_SESSION['folder']);
      } else {
        $_SESSION['folder'] = $sel_folder;
      }
    } else {
      $sql = "SELECT * FROM images WHERE part = '0'";
    } 
  } else {
    if(isset($_SESSION['folder'])) {
      $sel_folder = $_SESSION['folder'];
      $sql = "SELECT * FROM images WHERE part = '0' AND folder = '$sel_folder'";
    } else {    
      $sql = "SELECT * FROM images WHERE part = '0'";
    }
  }
  
  if(isset($_GET['pagenum'])) {
    $pagenum = addslashes($_GET['pagenum']);
  } else {
    $pagenum = "";
  }
  
  $page_url = $_SERVER['REQUEST_URI'];
  
  $results = paging($pagenum, $page_url, $sql, 18);

  $pagenum = $results[0];
  $page_url = $results[1];
  $pic_sql = $results[2];
  $last = $results[3];
  $page_rows = $results[4];
  $rows = $results[5];
  
  $pic = mysql_query($pic_sql) or die(mysql_error());
  
  $sql = "SELECT * FROM folder";
  $folders = mysql_query($sql) or die(mysql_error());
  
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
            Foto's
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
          <?php if(!strpos($page_url, "?")) {
            if($pagenum == 1) { } else {?>
            <a href="foto.php?pagenum=1"> eerste</a>
            <?php $prev = $pagenum - 1; ?>
            <a href="foto.php?pagenum=<?php echo $prev; ?>"> vorige</a> 
          <?php } ?>
          <?php echo ($page_rows * ($pagenum-1) + 1); ?> - <?php 
              if($page_rows * $pagenum > $rows) {
                echo $rows;
              } else {
                echo $page_rows * $pagenum ;
              }?> 
              van <?php echo $rows; ?> foto's
          <?php if($pagenum == $last) { } else { ?>
            <?php $next = $pagenum + 1; ?>
            <a href="foto.php?pagenum=<?php echo $next; ?>"> volgende</a> 
            <a href="foto.php?pagenum=<?php echo $last; ?>"> laatste </a>
          <?php } 
          } else { 
            if($pagenum == 1) { } else {?>
            <a href="<?php echo $page_url; ?>&pagenum=1"> eerste</a>
            <?php $prev = $pagenum - 1; ?>
            <a href="<?php echo $page_url; ?>&pagenum=<?php echo $prev; ?>"> vorige</a> 
          <?php } ?>
          <?php echo ($page_rows * ($pagenum-1) + 1); ?> - <?php 
              if($page_rows * $pagenum > $rows) {
                echo $rows;
              } else {
                echo $page_rows * $pagenum ;
              }?> 
              van <?php echo $rows; ?> foto's
          <?php if($pagenum == $last) { } else { ?>
            <?php $next = $pagenum + 1; ?>
            <a href="<?php echo $page_url; ?>&pagenum=<?php echo $next; ?>"> volgende</a> 
            <a href="<?php echo $page_url; ?>&pagenum=<?php echo $last; ?>"> laatste </a>
          <?php } }?>  
          <div class="picture_block">
            <?php while($pic_info = mysql_fetch_array($pic)) { ?>
              <a rel="foto" href="Images/uploads/<?php echo $pic_info['name']; ?>" class="fancybox" title="">
                <div class="picture" style="background-image:url('Images/uploads/tn_<?php echo $pic_info['name']; ?>'); background-repeat: no-repeat; background-position: center;">
                </div>
              </a>
            <?php
              }
            ?>
          </div>
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