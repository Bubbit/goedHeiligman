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
  <script type="text/javascript">
  $(window).load(function() {
	var $rows = $('#table tr');
	$('#search').keyup(function() {
		var val = $.trim($(this).val()).replace(/ +/g, ' ').toLowerCase();
		
		$rows.show().filter(function() {
			var text = $(this).text().replace(/\s+/g, ' ').toLowerCase();
			return !~text.indexOf(val);
		}).hide();
	});
  });
  </script>
 <?php 
  require_once("../connection.php");
  include("lock.php");
  include("functions.php");

  $sql = "SELECT * FROM pieten";
  $pieten = mysql_query($sql) or die(mysql_error());
  
  $sql = "SELECT * FROM groepen";
  $groups = mysql_query($sql) or die(mysql_error());
  
  $group_array = array();
  while($group = mysql_fetch_array($groups)) {
	$group_array[] = $group;
  }
  
  $sql = "SELECT ". dateFormat('l d F', 'date'). "as nl_date, id, date FROM events ORDER BY date, id";
  $result = mysql_query($sql) or die(mysql_error());
  
  $dates = array();
  $event_ids = array();
  while($event = mysql_fetch_array($result)) { 
	if(!list_check($event['nl_date'], $dates)) {
	  $event_ids[] = $event['id'];
	  $dates[] = $event['nl_date'];
	}
  } 
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
            Indeling
          </div>
            <?php if(mysql_num_rows($pieten)) {
			  echo '<input type="text" id="search" placeholder="Type to search">'; 
			  echo '<table id="table">';
              while($piet = mysql_fetch_array($pieten)) {
				$sel_group = $piet['group_id'];
			    echo '<form name="pieten" action="change_group_piet.php" method="POST">';
				echo '<input type="hidden" name="id" value="'.$piet['id'].'">';
				echo '<tr><td>'.$piet['first_name'].' '.$piet['last_name'].'</td>';
				echo '<td><select name="group" onChange="this.form.submit();">';
				echo '<option value="0" selected></option>';
				foreach($group_array as $group_info) {
					if($sel_group == $group_info['id']) {
					    echo '<option value="'.$group_info['id'].'" selected> '.$group_info['naam'].'</option>';
					} else {	
					    echo '<option value="'.$group_info['id'].'"> '.$group_info['naam'].'</option>';
					}
				}
				echo '</select></td></tr>';
				echo '</form>';
			  }
              echo '</table>';			  
			} ?>
          <br />
          <form action="new_group.php" method="post">
            <input type="text" name="name" placeholder="Nieuwe groep" class="input"/><br />
            <input type="submit" value="Submit" class="submit"/>          
          </form>
          <br />
		  <table>
			<tr>
				<th>Naam</th>
				<?php foreach($dates as $event) {
					echo '<th>'.$event.'</th>';
				} ?>
			</tr>
			<?php foreach($group_array as $group_info) {
			  echo '<form name="input" action="update_group_times.php" method="POST">';
			  echo '<tr>';
			  echo '<td>'.$group_info['naam'].'</td>';
			  echo '<input type="hidden" name="id" value="'.$group_info['id'].'">';
			  foreach($event_ids as $event) {
			    $col_name = 'd_'.$event;
				echo '<td><input type="text" name="'.$col_name.'" value="'.$group_info[$col_name].'"></td>';
			  }
			  echo '<td><input type="submit" value="Pas aan"></td>';
			  echo '</tr>';
			  echo '</form>';
			}
			?>
		   </table>
        </div>
        </section>
      </div>
    </div>
  </center>
</body>
</html>
 