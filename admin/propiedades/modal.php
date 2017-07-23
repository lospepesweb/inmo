<?php
include '../conexion/conexion.php';
$id = $con->real_escape_string(htmlentities($_GET['id']));
$sel = $con->prepare("SELECT * FROM inventario WHERE propiedad = ? ");
$sel->bind_param('s', $id);
$sel->execute();
$res = $sel->get_result();
if ($f = $res->fetch_assoc()) {
}
 ?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <link rel="stylesheet" href="../css/materialize.min.css">
   <title>modal</title>
 </head>
 <body>
<h5 align="right"><b><?php echo "$". number_format($f['precio'], 2,",","."); ?></b></h5>
 <table class="striped" width="100%" >
   <tr>
     <td colspan="4" class="center" ><b>Datos generales</b></td>
   </tr>
   <tr>
     <td>Cliente</td>
     <td><?php echo $f['nombre_cliente'] ?></td>
     <td>Num.</td>
     <td><?php echo $f['consecutivo'] ?></td>
   </tr>
   <tr>
     <td>Calle y numero</td>
     <td><?php echo $f['calle_num']?></td>
     <td>Barrio</td>
     <td><?php echo $f['barrio'] ?></td>
   </tr>
   <tr>
     <td>Numero int.</td>
     <td><?php echo $f['numero_int']?></td>
     <td>Provincia</td>
     <td><?php echo $f['provincia'] ?></td>
   </tr>
   <tr>
     <td>Departamento</td>
     <td><?php echo $f['departamento']?></td>
     <td colspan="2"></td>
   </tr>
   <tr>
     <td colspan="4" class="center" ><b>Características</b></td>
   </tr>
   <tr>
     <td>M2 Terreno.</td>
     <td><?php echo $f['m2t']?></td>
     <td>M2 Construcción</td>
     <td><?php echo $f['m2c'] ?></td>
   </tr>
   <tr>
     <td>Baños</td>
     <td><?php echo $f['banos']?></td>
     <td>Plantas</td>
     <td><?php echo $f['plantas'] ?></td>
   </tr>
   <tr>
     <td>Dormitorios</td>
     <td><?php echo $f['dormitorios']?></td>
     <td>Cocheras</td>
     <td><?php echo $f['cocheras'] ?></td>
   </tr>
   <tr>
     <td>Características</td>
     <td><?php echo $f['caracteristicas']?></td>
     <td>Observaciones</td>
     <td><?php echo $f['observaciones'] ?></td>
   </tr>
   <tr>
     <td colspan="4" class="center" ><b>Datos de venta</b></td>
   </tr>
   <tr>
     <td>Forma de pago</td>
     <td><?php echo $f['forma_pago']?></td>
     <td>Asesor</td>
     <td><?php echo $f['asesor'] ?></td>
   </tr>
   <tr>
     <td>Tipo de inmueble</td>
     <td><?php echo $f['tipo_inmueble']?></td>
     <td>Fecha de registro</td>
     <td><?php echo date('d-m-Y', strtotime($f['fecha_registro'])) ?></td>
   </tr>
   <tr>
     <td>Comentario web</td>
     <td><?php echo $f['comentario_web']?></td>
     <td>Operación</td>
     <td><?php echo $f['operacion'] ?></td>
   </tr>

 </table>
 </body>
 </html>