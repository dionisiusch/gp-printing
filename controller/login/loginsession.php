<?php
if(!isset($_SESSION['login'])){
	header("location:view/login.php");
		die();
	}

?>