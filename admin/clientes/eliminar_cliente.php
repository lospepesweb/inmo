<?php 

include '../conexion/conexion.php';

$id = htmlentities($_GET['id']);

$del = $con->prepare("DELETE FROM clientes WHERE id = ? ");
$del->bind_param('i', $id);

if($del->execute()){
	header('location:../extend/alertas.php?msj=Cliente eliminado&c=cli&p=in&t=success');
} else {
	header('location:../extend/alertas.php?msj=No se pudo eliminar el cliente&c=cli&p=in&t=error');
}

$del->close();
$con->close();
