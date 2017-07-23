<?php include '../conexion/conexion.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

$id = htmlentities($_POST['id']);
$foto = htmlentities($_POST['anterior']);
$ruta = $_FILES['foto']['tmp_name'];
$imagen = $_FILES['foto']['name'];

$ancho = 500;
$alto = 400;
$info = pathinfo($imagen);
$tamano = getimagesize($ruta);
$width = $tamano[0];
$hight = $tamano[1];

if ($info['extension'] == 'jpg' || $info['extension'] == 'JPG') {
	$imagenVieja = imagecreatefromjpeg($ruta);
	$imagenNueva = imagecreatetruecolor($ancho, $alto);
	imagecopyresampled($imagenNueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $hight);
	$rand = rand(000,999);
	$copia="fotos/principal-".$rand.$id.'.jpg';
	imagejpeg($imagenNueva, $copia);
} elseif ($info['extension'] == 'png' || $info['extension'] == 'PNG') {
	$imagenVieja = imagecreatefrompng($ruta);
	$imagenNueva = imagecreatetruecolor($ancho, $alto);
	imagecopyresampled($imagenNueva, $imagenVieja, 0, 0, 0, 0, $ancho, $alto, $width, $hight);
	$rand = rand(000,999);
	$copia = "fotos/principal-".$rand.$id.'.png';
	imagepng($imagenNueva, $copia);
} else {
	header('location:../extend/alertas.php?msj=El formato de la imagen debe ser jpg o png&c=prop&p=img&t=error&id='.$id.'');
	exit;
}

$up = $con->prepare("UPDATE inventario SET foto_principal = ? WHERE propiedad = ? ");
$up->bind_param('ss', $copia, $id);
if ($up->execute()) {
	if ($foto != 'fotos/foto_principal.png') {
		unlink($foto);
	}
	header('location:../extend/alertas.php?msj=Foto principal actualizada&c=prop&p=img&t=success&id='.$id.'');
} else {
	header('location:../extend/alertas.php?msj=La foto principal no pudo ser actualizada&c=prop&p=img&t=success&id='.$id.'');

}

$up->close();
$con->close();
} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=prop&p=img&t=error&id='.$id.'');
}