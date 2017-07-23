<?php 
if($_SESSION['nivel'] != 'Admin') {
	header("location: bloqueo.php");
}