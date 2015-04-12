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
    include("functions.php");
    include("lock.php");

    $sql = "SELECT ".dateFormat('l d F', 'date')." as date, place, name, email, comment, id FROM guestbook ORDER BY id DESC";
    
    if(isset($_GET['pagenum'])) {
      $pagenum = addslashes($_GET['pagenum']);
    } else {
      $pagenum = "";
    }
  
    $page_url = $_SERVER['REQUEST_URI'];
    
    $results = paging($pagenum, $page_url, $sql, 8);

    $pagenum = $results[0];
    $page_url = $results[1];
    $sql = $results[2];
    $last = $results[3];
    $page_rows = $results[4];
    $rows = $results[5];
    
    $result = mysql_query($sql) or die(mysql_error());
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
              Gastenboek:
            </div>
            <?php if(mysql_num_rows($result) > 0) { ?>
              <?php if(!strpos($page_url, "?")) {
                if($pagenum == 1) { } else {?>
                <a href="gastenboek.php?pagenum=1"> eerste</a>
                <?php $prev = $pagenum - 1; ?>
                <a href="gastenboek.php?pagenum=<?php echo $prev; ?>"> vorige</a> 
              <?php } ?>
              <?php echo ($page_rows * ($pagenum-1) + 1); ?> - <?php 
                  if($page_rows * $pagenum > $rows) {
                    echo $rows;
                  } else {
                    echo $page_rows * $pagenum ;
                  }?> 
                  van <?php echo $rows; ?> comments
              <?php if($pagenum == $last) { } else { ?>
                <?php $next = $pagenum + 1; ?>
                <a href="gastenboek.php?pagenum=<?php echo $next; ?>"> volgende</a> 
                <a href="gastenboek.php?pagenum=<?php echo $last; ?>"> laatste </a>
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
                  van <?php echo $rows; ?> comments
              <?php if($pagenum == $last) { } else { ?>
                <?php $next = $pagenum + 1; ?>
                <a href="<?php echo $page_url; ?>&pagenum=<?php echo $next; ?>"> volgende</a> 
                <a href="<?php echo $page_url; ?>&pagenum=<?php echo $last; ?>"> laatste </a>
              <?php } }?> 
              <div class="guestbook">
              <?php while($input = mysql_fetch_array($result)) { ?>
                <div class="comment_frame">
                  <div class="guest_info">
                    <?php echo $input['name']; ?> <br />
                    <?php echo $input['place']; ?> <br />
                    <?php echo $input['date']; ?> <br />
                    <?php echo $input['email']; ?> <br />                  
                  </div>
                  <div class="comment">
                    <?php echo $input['comment']; ?>
                  </div>
                  <div style="clear:both"></div>
                </div>
                <a href="delete_comment.php?id=<?php echo $input['id']; ?>">Verwijder comment</a>
              <?php } ?>
            <?php } ?>
            <div style="clear:both"></div>
          </div>
        </section>	
      </div>
    </div>
  </center>
  </div>
</body>
</html>