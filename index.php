<?php include 'admin/conexion/conexion_web.php'; ?>
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

<h1><center>Inmuebles Destacados</center></h1>

<div class="row">
  <?php 
  $sel_marcado = $con->prepare("SELECT foto_principal, precio, departamento, provincia, barrio, propiedad FROM inventario WHERE marcado = 'SI'");
  $sel_marcado->execute();
  $res_marcado = $sel_marcado->get_result();
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

  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Buscar inmuebles</span>
          <form action="buscar.php" method="post">
            <div class="row">
              <div class="col s6">
                <select id="provincia" name="provincia" required>
                  <option disabled selected>ELIGE UNA PROVINCIA</option>
                  <?php $sel_prov = $con->prepare("SELECT * FROM provincias ");
                        $sel_prov->execute();
                        $res_prov = $sel_prov->get_result(); 
                  while ($f_prov = $res_prov->fetch_assoc()) { ?>
                    <option value="<?php echo $f_prov['idprovincia'] ?>"><?php echo $f_prov['provincia'] ?></option>
                  <?php } 
                        $sel_prov->close();
                  ?>
                </select>
              </div>
              <div class="col s6">
                <div class="res_provincia"></div>
              </div>
            </div>

            <div class="row">
              <div class="col s6">
                <select name="operacion" required  >
                  <option value="" disabled selected  >ELIGE LA OPERACION</option>
                  <option value="VENTA">VENTA</option>
                  <option value="ALQUILER">ALQUILER</option>
                  <option value="TRASPASO">TRASPASO</option>
                  <option value="OCUPADO">OCUPADO</option>
                </select>
              </div>
              <div class="col s6">
                <select name="tipo_inmueble" required >
                  <option value="" disabled selected  >ELIGE EL TIPO DE INMUEBLE</option>
                  <option value="CASA">CASA</option>
                  <option value="TERRENO">TERRENO</option>
                  <option value="LOCAL">LOCAL</option>
                  <option value="DEPARTAMENTO">DEPARTAMENTO</option>
                </select>
              </div>
            </div>

            <div class="row">
              <div class="col s6">
                <div class="input-field">
                  <input type="number" name="precio_desde" id="precio_desde">
                  <label for="precio_desde" required>Desde:</label>
                </div>
              </div>
              <div class="col s6">
                <div class="input-field">
                  <input type="number" name="precio_hasta" id="precio_hasta">
                  <label for="precio_hasta" required>Hasta:</label>
                </div>
              </div>
            </div>
            <button type="submit" class="btn">Buscar inmuebles</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Contacto</span>
          <div class="row">
            <div class="col s6"> <!-- ubicacion de la inmobiliaria directamente de google maps -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2405.569257786702!2d-68.57519898235904!3d-31.496995256929765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzHCsDI5JzQ3LjIiUyA2OMKwMzQnMjQuNCJX!5e0!3m2!1ses-419!2sar!4v1500850800917" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen class="z-depth-1"></iframe>
            </div>
            <div class="col s6">
              <div class="input-field">
                   <input type="text" name="nombre" pattern="[A-Za-z/s ]+"  title=""  id="nombre" required >
                   <label for="nombre">Nombre:</label>
                 </div>
                 <div class="input-field">
                   <input type="text" name="asunto"   title=""  id="asunto"  >
                   <label for="asunto">Asunto:</label>
                 </div>
                 <div class="input-field">
                   <input type="email" name="correo"   title=""  id="correo" required  >
                   <label for="correo">Correo:</label>
                 </div>
                 <div class="input-field">
                   <textarea name="mensaje" rows="8" cols="80" id="mensaje" onblur="may(this.value, this.id)" class="materialize-textarea"></textarea>
                   <label for="">Mensaje:</label>
                 </div>
                 <button type="button" class="btn" id="enviar">Enviar</button>
                 <div class="resultado"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<footer class="page-footer blue white-text center">
   Hola soy anto, acá en piiiilee  
</footer>

<script src="admin/js/jquery-3.2.1.min.js"></script>
<script src="admin/js/materialize.min.js"></script>
<script>
	$('.slider').slider();
  $('select').material_select();
  $('#provincia').change(function(){
    $.post('admin/propiedades/ajax_deptos.php',{
      provincia:$('#provincia').val(),
      beforeSend: function(){
        $('.res_provincia').html("Espere un momento por favor...");
      }
    }, function(respuesta){
      $('.res_provincia').html(respuesta);
    });
  });

  //envio del "formualrio" (que no es un form) por ajax
  $('#enviar').click(function(){
      $.post('email.php',{
        nombre:$('#nombre').val(),
        asunto:$('#asunto').val(),
        correo:$('#correo').val(),
        mensaje:$('#mensaje').val(),
        id_propiedad:$('#id_propiedad').val(),
        beforeSend: function(){
          $('.resultado').html("Espere un momento por favor...");
        }
      }, function(respuesta){
            $('.resultado').html(respuesta);
         });
    });
</script>
</body>
</html>