<?php 
include '../conexion/conexion.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="ie-edge">
	<link rel="stylesheet" href="../css/sweetalert2.css">
	<title>Título</title>
</head>
<body>
<?php 
$mensaje = htmlentities($_GET['msj']);
$c = htmlentities($_GET['c']);
$p = htmlentities($_GET['p']);
$t = htmlentities($_GET['t']);

switch ($c) {
	case 'us':
		$carpeta = '../usuarios/';
		break;
	case 'home';
		$carpeta = '../inicio/';
		break;
	case 'salir';
		$carpeta = '../';
		break;
	case 'pe':
		$carpeta = '../perfil/';
		break;
	case 'cli':
		$carpeta = '../clientes/';
		break;
	case 'prop':
		$carpeta = '../propiedades/';
		break;
}

switch ($p) {
	case 'in':
		$pagina = 'index.php';
		break;
	case 'home':
		$pagina = 'index.php';
		break;
	case 'salir':
		$pagina = '';
		break;	
	case 'perfil':
		$pagina = 'perfil.php';
		break;
	case 'img':
		$pagina = 'imagenes.php';
		break;
	case 'can':
		$pagina = 'cancelados.php';
		break;
	case 'sl':
		$pagina = 'slider.php';
		break;
}

if (isset($_GET['id'])) {
	$id = htmlentities($_GET['id']);
	$dir = $carpeta.$pagina.'?id='.$id;
} else {
	$dir = $carpeta.$pagina;
}

if($t == "error"){
	$titulo = "Ups...";
} else {
	$titulo = "Buen trabajo!";
}

?>



<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/sweetalert2.js"></script>
<script>
swal({
	title: '<?php echo $titulo?>',
	text: "<?php echo $mensaje?>",
	type: '<?php echo $t?>',
	confirmButtonColor: '#3085d6',
	confirmButtonText: 'Ok'
}).then(function () {
	location.href='<?php echo $dir ?>';
})	

//redireccionar si se hace click fuera de la alerta o tecla esc
$(document).click(function(){
	location.href='<?php echo $dir ?>';
});

$(document).keypres(function(e){
	if(e.which == 27) {
		location.href='<?php echo $dir ?>';

	}
});

</script>


</body>
</html>