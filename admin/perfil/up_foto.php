<?php 
include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$nick = $_SESSION['nick'];
	$foto = $_SESSION['foto'];

	$extension = "";//formato del archivo de imagen
	$ruta = 'fotos_perfil';//ruta donde se guarda la imagen del usuario
	$archivo = $_FILES['foto']['tmp_name'];
	$nombreArchivo = $_FILES['foto']['name'];
	$info = pathinfo($nombreArchivo);
	if($archivo != ''){
		$extension = $info['extension'];
		if($extension == "png" || $extension == "PNG" || $extension == "jpg" || $extension == "JPG"){
			unlink('../usuarios/'.$foto);
			$rand = rand(000,999);
			move_uploaded_file($archivo, '../usuarios/fotos_perfil/'.$nick.$rand.'.'.$extension);
			$ruta = $ruta."/".$nick.$rand.'.'.$extension;
			$up = $con->query("UPDATE usuarios SET foto = '$ruta' WHERE nick='$nick' ");
			if ($up) {
				$_SESSION['foto'] = $ruta;
				header('location:../extend/alertas.php?msj=La foto de perfil fue actualizada&c=pe&p=in&t=success');
			} else {
				header('location:../extend/alertas.php?msj=La foto de perfil no pudo ser actualizada&c=pe&p=in&t=error');
			}
		} else {
			header('location: ../extend/alertas.php?msj=El formato de la imagen debe ser png o jpg&c=us&p=in&t=error');
			exit;
		}
	} else {
		header('location:../extend/alertas.php?msj=No se encontró ninguna foto para actualizar&c=pe&p=in&t=error');
	}	

$con->close();

} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=pe&p=in&t=error');
}