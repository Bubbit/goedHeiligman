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
            Aanvraag voor optreden
          </div>
          <div>
            <p>Heeft u een vraag; wilt u een optreden of huisbezoek boeken, vragen of opmerkingen over de website of zijn er andere zaken die u met ons wilt bespreken?<p>
			<p>Vul dan onderstaan formulier in en wij proberen zo spoedig mogelijk contact met u op te nemen.<p>
          </div>
          <br />
          <form action="request.php" method="post" onsubmit="validate_aanvraag();" id="request">
          <input type="text" name="email" onchange="validate_aanvraag();" placeholder="E-mailadres" class="input"/><br /> 
          <textarea name="extra" placeholder="Tekst voor sinterklaas" class="sign_up"></textarea>
          <div id="submit" style="display:none;">
            <input type="submit" value="Vraag aan" class= "submit"/>
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