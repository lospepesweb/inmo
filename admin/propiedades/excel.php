<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	// $nombre = $_POST['nombre_cliente']."_".$f['calle_num']." ".$f['departamento']." ".$f['provincia'];
	header('Content-type: aplication/vnd.ms-excel; name="excel"');
	header('Content-Disposition: filename=Reporte.xls');
	header('Pragma: no-cache');
	header('Expires: 0');

	echo $_POST['datos'];
} else {
	header('location:../extend/alertas.php?msj=Utiliza el formulario&c=prop&p=in&t=error');
}