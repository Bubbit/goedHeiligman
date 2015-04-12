<?php
$user_check=$_SESSION['login'];

if($user_check != 0) {
	header("Location: ../");
}
?>
