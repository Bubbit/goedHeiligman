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
  <script type='text/javascript' src='js/validate.js'></script>    
 <?php 
  require_once("connection.php");
  include("Admin/functions.php");

  $sql = "SELECT ". dateFormat('l d F', 'date'). "as nl_date, id FROM events ORDER BY date, tijd";
  $result = mysql_query($sql) or die(mysql_error());
  
  $sql = "SELECT * FROM partners";
  $partners = mysql_query($sql) or die(mysql_error());
?> 
  <script type="text/javascript" src="js/jquery.placeholder.js"></script>
  <script type="text/javascript">    
    $(document).ready(function() {
      $('input,textarea').placeholder();    
    });
  </script>
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
          Aanmeldingsformulier
        </div>
        <!-- <div> Vul hier uw tekst in, sluit af met </div> -->
        <form method="post" action="Add_piet.php" id="piet" onsubmit="validate_piet();">
          <input type="text" name="first_name" class="input" placeholder="Voornaam" onchange="validate_piet();"/>
          <input type="text" name="last_name" class="input" placeholder="Achternaam" onchange="validate_piet();"/><br />
          <input type="text" name="date_of_birth" class="input" placeholder="Geboortedatum: dd/mm/jjjj" onchange="validate_piet();"/>
          <input type="text" name="BSN" class="input" placeholder="BSN-nummer" onchange="validate_piet();"/><br />
          <input type="text" name="email" class="input" placeholder="Emailadres" onchange="validate_piet();"/>
          <input type="text" name="phone" class="input" placeholder="Telefoonnummr" onchange="validate_piet();"/><br />
          Heb je beschikking over eigen pak?
          <input type="radio" name="own_suit" value="0" checked/> Nee 
          <input type="radio" name="own_suit" value="1" /> Ja <br />
          Kledingmaat?
          <input type="radio" name="size" value="S" checked/> S 
          <input type="radio" name="size" value="M" /> M 
          <input type="radio" name="size" value="L" /> L 
          <input type="radio" name="size" value="XL" /> XL   
          <input type="radio" name="size" value="XXL" /> XXL <br />
          Op welke data wil je mee? <br />
          <?php
            $done = array();
            while($event = mysql_fetch_array($result)) { 
            if(!list_check($event['nl_date'], $done)) {
              $done[] = $event['nl_date'];
            ?>
          <input type="checkbox" name="<?php echo $event['id']; ?>" /> <?php echo $event['nl_date']; ?> <br />
          <?php } } ?>
          Heb je voorgaande jaren meegedaan?
          <select name="prev" class="styled-select">
          <option value="Nee"> Nee </option>
          <option value="Ja, 1 jaar"> Ja, 1 jaar </option>
          <option value="Ja, 2 jaar"> Ja, 2 jaar </option>
          <option value="Ja, 3 jaar"> Ja, 3 jaar </option>
          <option value="Ja, 4 jaar"> Ja, 4 jaar </option>
          <option value="Ja, 5 jaar"> Ja, 5 jaar </option>
          <option value="Ja, 6 jaar"> Ja, 6 jaar </option>
          <option value="Ja, 7 jaar"> Ja, 7 jaar </option>
          <option value="Ja, 8 jaar"> Ja, 8 jaar </option>
          <option value="Ja, 9 jaar"> Ja, 9 jaar </option>
          <option value="Ja, 10+ jaar"> Ja, 10+ jaar </option>
          </select><br />
          In welke groep was je ingedeeld?
          <select name="spot" class="styled-select">
          <option value="Nooit mee gedaan"> Nog nooit meegedaan </option>
          <option value="Boot"> Boot </option>
          <option value="Skatepieten"> Skatepieten </option>
          <option value="Fietspieten"> Fietspieten </option>
          </select><br />
          Hoe bent u bij ons terecht gekomen? <br />
          <input type="text" class="input" name="how" onchange="validate_piet();"><br />
          Voor de intocht zoeken we nog pieten die een leuk kunstje kunnen (bv. jongleren) Kun jij zo iets? Zoja wat dan? <br />
          <input type="text" class="input" name="skill" onchange="validate_piet();"><br />
          <textarea class="sign_up" name="extra" placeholder="Opmerkingen of wensen? Vul hier ook in met wie je in de groep wilt zitten. Wij zullen proberen hier rekening mee te houden."></textarea><br />
          <div id="submit" style="display:none;">
          <input type="submit" value="Verstuur het formulier" class="submit"/>
          </div>
        </form>
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