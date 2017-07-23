<?php 
include '../conexion/conexion.php';
include '../extend/permisos.php';

$nick = $con->real_escape_string($_POST['nick']);

$sel = $con->query("SELECT id FROM usuarios WHERE nick = '$nick'");
$row = mysqli_num_rows($sel);

if($row != 0) {
	echo "<label style='color:red;'>El nombre de usuario ya existe</label>";
} else {
	echo "<label style='color:green;'>El nombre de usuario está disponible</label>";
}

$con->close();