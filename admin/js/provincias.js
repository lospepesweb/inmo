$('#provincia').change(function(){
	$.post('ajax_deptos.php',{
		provincia:$('#provincia').val(),
		beforeSend: function(){
			$('.res_provincia').html("Espere un momento por favor...");
		}
	}, function(respuesta){
		$('.res_provincia').html(respuesta);
	});
});