<?php
$user_check=$_SESSION['login'];

if($user_check != 2) {
	header("Location: ../");
}
?>
