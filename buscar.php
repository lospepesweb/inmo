<?php include 'admin/conexion/conexion_web.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $id_provincia = htmlentities($_POST['provincia']);
  $departamento = htmlentities($_POST['departamento']);
  $operacion = htmlentities($_POST['operacion']);
  $tipo_inmueble = htmlentities($_POST['tipo_inmueble']);
  $desde = htmlentities($_POST['precio_desde']);
  $hasta = htmlentities($_POST['precio_hasta']);
  //convertir id de provincia (value del select) a nombre
  $sel_prov = $con->prepare("SELECT provincia FROM provincias WHERE idprovincia = ?");
  $sel_prov->bind_param('i', $id_provincia);
  $sel_prov->execute();
  $res_prov = $sel_prov->get_result();
  if ($f_prov = $res_prov->fetch_assoc()) {
    $provincia = $f_prov['provincia'];
  }

  $sel_marcado = $con->prepare("SELECT foto_principal, precio, departamento, provincia, barrio, propiedad FROM inventario WHERE provincia = ? AND departamento = ? AND operacion = ? AND tipo_inmueble = ? AND precio BETWEEN ? AND ?");
  $sel_marcado->bind_param('ssssdd', $provincia ,$departamento, $operacion, $tipo_inmueble, $desde, $hasta);
  $sel_marcado->execute();
  $res_marcado = $sel_marcado->get_result();

} else {
  header('location:index.php');
  exit;
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="is-edge">
  <link rel="stylesheet" href="admin/css/estilos.css">
	<link rel="stylesheet" href="admin/css/materialize.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>Sitio Web</title>
</head>
<body class="blue-grey lighten-4">
<nav class="blue lighten-1">
  <a href="index.php" class="brand-logo center">LOGO</a>
</nav>

<div class="slider">
  <ul class="slides">
    <?php  
      $sel = $con->prepare("SELECT * FROM slider");
      $sel->execute();
      $res = $sel->get_result();
      while($f = $res->fetch_assoc()){
    ?>
    <li>
        <img src="admin/inicio/<?php echo $f['ruta']?>"> <!-- random image -->
        <div class="caption center-align">
          <h3>Empresa</h3>
          <h5 class="light grey-text text-lighten-3">Slogan</h5>
        </div>
    </li>
    <?php 
      }
      $sel->close();
    ?> 
  </ul>
</div>

<h1><center>Inmuebles Encontrados</center></h1>

<div class="row">
  <?php 
  
  while ($f_marcado = $res_marcado->fetch_assoc()){
  ?>
  <div class="col s12 m6 l3">
    <div class="card">
      <div class="card-image">
        <img src="admin/propiedades/<?php echo $f_marcado['foto_principal'] ?>">
          <span class="card-title"><?php echo '$ '. number_format($f_marcado['precio'], 2,",",".") ?></span>
      </div>
      <div class="card-content">
        <p><?php echo $f_marcado['barrio'].', '.$f_marcado['provincia'].' '.$f_marcado['departamento']?></p>
      </div>
      <div class="card-action">
        <a href="ver_mas.php?id=<?php echo $f_marcado['propiedad'] ?>">Ver mas...</a>
      </div>
    </div>
  </div>
  <?php }
  $sel_marcado->close();
  ?>

</div>

<script src="admin/js/jquery-3.2.1.min.js"></script>
<script src="admin/js/materialize.min.js"></script>
<script>
	$('.slider').slider();
</script>
</body>
</html>