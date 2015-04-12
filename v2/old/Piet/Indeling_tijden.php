<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>Sinterklaas</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
  <meta name="keywords" content="" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
      <link href='http://fonts.googleapis.com/css?family=Lobster|Roboto+Slab:300' rel='stylesheet' type='text/css'>
  <link href="../../includes/style.css" rel="stylesheet" type="text/css">
    <script src="../../includes/jquery-2.1.1.min.js"></script>
    <script src="../../includes/angular.min.js"></script>
    <script src="../../includes/angular-touch.min.js"></script>
  <script type="text/javascript" src="../js/jquery.ba-hashchange.js"></script>
  <script type='text/javascript' src='../js/dynamicpage.js'></script>
  <script src="../../js/remcoGlobal.js"></script>
  <script src="../../js/viewportSize.js"></script>
  <script src="../../js/docked.js"></script>
  <script src="../../js/login.js"></script>
  <script src="../../js/rImageViewer.js"></script>
  <script src="../../js/goedheiligmanApp.js"></script>
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
//
<body ng-controller="appCtrl">
    <div class="nav-bar">
        <nav>
            <div class="logo"></div>
            <div class="nav-toggle" ng-click="toggleMenu()"><i class="icon-menu"></i></div>
            <ul ng-class="{showMenu: openMenu}">
                <li><a href="index.html">Home</a></li>
                <li><a href="agenda.html">Agenda</a></li>
                <li><a href="media.html">Media</a></li>
                <li><a href="geschiedenis.html">Geschiedenis</a></li>
                <li><span ng-click="loginService.loginToggle()">Login</span></li>
            </ul>
        </nav>
    </div>
    <header style="background-image: url('includes/images/Intocht1.jpg')">
    </header>
    <div class="bar"></div>
    <div login></div>
    <main>
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
    </main>
        <footer r-docked class="">
            <div class="footer">
                <div class="footer-links">
                    <ul>
                        <li><a href="http://www.guidedtours.nl" target="_blank">Guided Tours</a></li>
                        <li><a href="http://www.dezottezwanen.nl" target="_blank">De Zotte Zwanen</a></li>
                        <li><a href="http://www.http://sinterklaasmijnhobby.jouwweb.nl" target="_blank">Sinterklaas Hobby</a></li>
                    </ul>
                </div>
                <div class="footer-icons">
                    <ul>
                        <li><a href="mailto:remco090@gmail.com"><i class="icon-mail-alt"></i></a></li>
                        <li><a href="http://www.facebook.com" target="_blank"><i class="icon-facebook_alt"></i></a></li>
                    </ul>
                </div>
            </div>
        </footer>
</body>
</html>