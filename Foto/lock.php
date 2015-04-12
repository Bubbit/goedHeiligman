<?php
$user_check=$_SESSION['login'];

if($user_check != 1) {
	header("Location: ../");
}
?>
