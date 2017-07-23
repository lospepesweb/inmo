<?php 
include '../conexion/conexion.php';
if(!isset($_SESSION['nick'])){
	header('location: ../');
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" href="../css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="../css/sweetalert2.css">
	<style>
		body {
			text-transform: uppercase;
		}
	</style>
	<title>Título</title>

</head>
	<body>
		<main>
			<?php 
			if ($_SESSION['nivel'] == 'Admin') {
				include 'menu_admin.php';
			} elseif ($_SESSION['nivel'] == 'Asesor') {
				include 'menu_asesor.php';
			}
