<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_webshop_connection = "localhost";
$database_webshop_connection = "admin_sinterklaas";
$username_webshop_connection = "michael";
$password_webshop_connection = "guppie";
$webshop_connection = mysql_connect($hostname_webshop_connection, $username_webshop_connection, $password_webshop_connection) or trigger_error(mysql_error(),E_USER_ERROR);

mysql_select_db($database_webshop_connection, $webshop_connection);

session_start();
?>
