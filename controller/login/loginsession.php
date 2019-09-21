<?php
$path = $_SERVER['DOCUMENT_ROOT'].'/gp-printing';
if(!isset($_SESSION['login'])){
	echo "<base href='http://localhost/gp-printing/' /><script>window.location.replace('view/login.php');</script>";
	}
?>