<?php 
include '../conexion/conexion.php';
$provincia = htmlentities($_POST['provincia']);
?>

<select id="departamento" name="departamento" required>
    <option disabled selected>ELIGE UN DEPARTAMENTO</option>
	    <?php $sel_depto = $con->prepare("SELECT * FROM departamentos WHERE idprovincia = ? ");
	          $sel_depto->bind_param('i', $provincia);
	          $sel_depto->execute();
	          $res_depto = $sel_depto->get_result(); 
	    while ($f_depto = $res_depto->fetch_assoc()) { ?>
    <option value="<?php echo $f_depto['departamento'] ?>"><?php echo $f_depto['departamento'] ?></option>
	    <?php } 
	          $sel_depto->close();
	          // $con->close();
	    ?>
</select>
<!-- se debe ininializar el select pq está en otra página -->
<script>
	$('select').material_select();
</script>