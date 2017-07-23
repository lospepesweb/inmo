/*===================================================================
=            mostrar el sidenav con el boton hamburguesa            =
===================================================================*/

$('.button-collapse').sideNav();

/*=====  End of mostrar el sidenav con el boton hamburguesa  ======*/

/*================================================================================
=            convertir a mayusculas el value de un input al perder el foco            =
================================================================================*/

function may(obj, id) {
	obj = obj.toUpperCase();
	document.getElementById(id).value = obj;

};

/*=====  End of convertir a mayusculas el value de un input al perder el foco  ======*/


// $('#buscar').keyup(function(event){
// 	var contenido = new RegExp($(this).val(), 'i');
// 	$('tr').hide();
// 	$('tr').filter(function(){
// 		return contenido.test($(this).text());
// 	}).show();
// });


/*==================================================================
=            comprar contraseñas en el alta de usuarios            =
==================================================================*/

// $('#pass2').change(function(event){
// 	if($('#pass1').val() == $('#pass2').val()){
// 		swal('Bien hecho...','Las contraseñas coninciden','success');
// 	} else {
// 		swal('Ups...','Las contraseñas no coninciden','error');
// 	}
// });

/*=====  End of comprar contraseñas en el alta de usuarios  ======*/


