	</main>
<script src="../js/jquery-3.2.1.min.js"></script>
<script src="../js/materialize.min.js"></script>
<script src="../js/sweetalert2.js"></script>
<script src="../js/custom.js"></script>
<script> 
/*========================================================
=            iniciar los selects del proyecto            =
========================================================*/

$('select').material_select();

/*=====  End of iniciar los selects del proyecto  ======*/

/*===============================================
=            inicializar data picker            =
===============================================*/

$('.datepicker').pickadate({
	format: 'yyyy-m-d',
    selectMonths: true, // Creates a dropdown to control month
    selectYears: 15, // Creates a dropdown of 15 years to control year,
    monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
  	weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'],
    today: 'Hoy',
    clear: 'Borrar fecha',
    close: 'Ok',
    closeOnSelect: false // Close upon selecting a date,
  });

/*=====  End of inicializar data picker  ======*/





$('#buscar').keyup(function(event){
	var contenido = new RegExp($(this).val(), 'i');
	$('tr').hide();
	$('tr').filter(function(){
		return contenido.test($(this).text());
	}).show();
	$('.cabecera').attr('style','');
});

</script>