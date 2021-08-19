$(document).ready(function(){
	$("#bienvenida").show();
	$("#crear_docente").hide();

	$("#home").click(function(){
		$("#bienvenida").show();
		$("#crear_docente").hide();

	});

	$("#menucreardocente").click(function(){
		$("#bienvenida").hide();
		$("#crear_docente").show(1000);
		
	});

});