<?php 
	session_start();
	unset($_SESSION['bike_admin']);

	header('location: ./');
?>