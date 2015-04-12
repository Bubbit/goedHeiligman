<?php 
  require_once("connection.php");

  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysql_real_escape_string($_POST['name']);
    $pass = mysql_real_escape_string($_POST['pass']);
    
    $result = mysql_query("SELECT * FROM account WHERE name = '$name' AND password = '$pass'") or die(mysql_error());
    if(mysql_num_rows($result) > 0) {
      $account_info = mysql_fetch_array($result);
      $admin_lvl = $account_info['admin_lvl'];
      $_SESSION['login'] = $admin_lvl;
      
      if($admin_lvl == 0) {
        header("Location: ./Piet/Indeling_tijden.php");
      } else if($admin_lvl == 1) {
        header("Location: ./Foto/");
      } else if($admin_lvl == 2) {
        header("Location: ./Admin/");
      } else {
        $_SESSION['error'] = "Admin_lvl is niet toegekend";
        header("Location: ./Login.php");
      }
    } else {
      $_SESSION['error'] = "Ongeldige combinatie".$name.$pass;
      header("Location: ./login.php");
    }
  }
?>