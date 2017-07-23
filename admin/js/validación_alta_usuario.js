/*============================================================================
=            validar que el usuario NO exista en alta de usuarios            =
============================================================================*/

$('#nick').change(function(){
	$.post('ajax_validacion_nick.php',{
		nick:$('#nick').val(),
		beforeSend: function(){
			$('.validacion').html("Espere un momento por favor...");
		}
	}, function(respuesta){
		$('.validacion').html(respuesta);
	});
});

/*=====  End of validar que el usuario NO exista en alta de usuarios  ======*/



/*=============================================================
=            validar que las contraseñas coincidan            =
=============================================================*/
$('#btn_guardar').hide();
$('#pass2').change(function(event){
	if($('#pass1').val() == $('#pass2').val()){
		swal('Bien hecho...','Las contraseñas coinciden','success');
		$('#btn_guardar').show();
	} else {
		$('#pass2').focus();
		swal('Ups...','Las contraseñas no coinciden','error');
		$('#btn_guardar').hide();
	}
});

/*=====  End of validar que las contraseñas coincidan  ======*/

/*=====================================================================
=            desactivar tecla enter para enviar formulario            =
=====================================================================*/

$('.form').keypress(function(e){
	if(e.which == 13){
		return false;
	}
});

/*=====  End of desactivar tecla enter para enviar formulario  ======*/