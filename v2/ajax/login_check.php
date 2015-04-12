<?php 
  require_once("../includes/config.php");
 echo "hello";
  if($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = mysql_real_escape_string($_POST['account']);
    $pass = mysql_real_escape_string($_POST['password']);
    
    $result = mysql_query("SELECT * FROM account WHERE name = '$name' AND password = '$pass'") or die(mysql_error());
    if(mysql_num_rows($result) > 0) {
      $account_info = mysql_fetch_array($result);
      $admin_lvl = $account_info['admin_lvl'];
      $_SESSION['login'] = $admin_lvl;
      echo $admin_lvl;
      if($admin_lvl == 0) {
        header("Location: ../old/Piet/Indeling_tijden.php");
      } else if($admin_lvl == 1) {
        header("Location: ../old/Foto/");
      } else if($admin_lvl == 2) {
        header("Location: ../old/Admin/");
      } else {
        $_SESSION['error'] = "Admin_lvl is niet toegekend";
        header("Location: ../index.html");
      }
    } else {
    echo "Fout";
        header("Location: ../index.html");
    }
  }
?>