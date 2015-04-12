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
  <script type="text/javascript">
  $(window).load(function() {
	var $rows = $('#table tr.name');
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
  include("../Admin/functions.php");

  $sql = "SELECT * FROM static WHERE id = '5'";
  $page_info = mysql_fetch_array(mysql_query($sql)) or die(mysql_error());
  
  $piet_info = mysql_query("SELECT * FROM pieten") or die(mysql_error());
  $group_info = mysql_query("SELECT * FROM groepen") or die(mysql_error());
  $event_info = mysql_query("SELECT * FROM events ORDER BY date, id") or die(mysql_error());
  
  $group_array = array();
  while($group = mysql_fetch_array($group_info)) {
	$group_array[$group['id']] = $group;
  }
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
		<div> Op dit tijdstip word je verwacht op de schmink locatie </div>
		<input type="text" id="search" placeholder="Type to search">
         <table id="table" class="pieten">
			<tbody>
				<tr>
					<th>Voornaam</th>
					<th>Achternaam</th>
					<?php
						$dates = array();
						$event_ids = array();
						while($event = mysql_fetch_array($event_info)) {
							if(!list_check($event['date'], $dates)) {
								echo "<th width='70px'>".$event['date']."</th>";
								$dates[] = $event['date'];
								$event_ids[] = $event['id'];
							}
						}
					?>
				</tr>
				<?php 
					while($piet = mysql_fetch_array($piet_info)) {
						echo "<tr class='name'><td>".$piet['first_name']."</td><td>".$piet['last_name']."</td>";
						$group = $group_array[$piet['group_id']];
						foreach($event_ids as $event) {
							if(!empty($group['d_'.$event])) {
								echo "<td>".$group['d_'.$event]."</td>";
							} else {
								echo "<td> - </td>";
							}
						}
						echo "</tr>";
					}
				?>
			</tbody>
		</table>
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