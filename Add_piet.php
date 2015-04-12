<?php
	require_once("connection.php"); 

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $f_name = mysql_real_escape_string($_POST['first_name']);
    $l_name = mysql_real_escape_string($_POST['last_name']);
    $d_o_b = mysql_real_escape_string($_POST['date_of_birth']);
    $BSN = mysql_real_escape_string($_POST['BSN']);   
    $email = mysql_real_escape_string($_POST['email']);
    $phone = mysql_real_escape_string($_POST['phone']);
    $extra = mysql_real_escape_string($_POST['extra']);
    $how = mysql_real_escape_string($_POST['how']);
    $skills = mysql_real_escape_string($_POST['skill']);
    $suit = $_POST['own_suit'];
    $size = $_POST['size'];
    $prev = $_POST['prev'];
    if(isset($_POST['spot'])) {
      $spot = $_POST['spot'];
    } else {
      $spot = "0";
    }

    $boot = $_POST['boot'];
    
    $opt_events = array();
    $sql = "SELECT * FROM events";
    $result = mysql_query($sql) or die(mysql_error());
    if(mysql_num_rows($result) > 0) {
      while($event = mysql_fetch_array($result)) {
      echo $event['id'];
        if(isset($_POST[$event['id']])) {
        echo "j";
          $opt_events[] = $event['id'];
        }      
      }
    }

    $dates = implode(",", $opt_events);
    
    $sql = "INSERT INTO pieten (first_name, last_name, BSN, date_of_birth, email, phone, own_suit, size, dates, prev, spot, extra, how, skill, boot) VALUES ('$f_name', '$l_name', '$BSN', '$d_o_b', '$email', '$phone', '$suit', '$size', '$dates', '$prev', '$spot', '$extra', '$how', '$skills', '$boot')";
    $result = mysql_query($sql) or die(mysql_error());
    if($result) {
      header("Location: ./Succes.php");
    } else {
      header("Location: ./Geen_Succes.php");
    }
  }
?>