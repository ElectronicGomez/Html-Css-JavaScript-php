function iniciar(){
		document.getElementById("fecha").value="";
		document.getElementById("resultado").style.display="none";
}

function calcular(){
	var fecha = document.getElementById("fecha").value;
	console.log(fecha);
	var edad = obtener_edad(fecha);
	document.getElementById("resultado").style.display="table";
	document.getElementById("resul").innerHTML="Su edad es: "+edad+
							" a&ntilde;os";

	/*document.getElementById("resul").style.textAlign="center";*/
	/*document.getElementById("resul").style.fontSize="22px";*/
}

function obtener_edad(fecha){
	var age = fecha.split('-');
	var anio = age[0];
	var mes  = age[1];
	var dia  = age[2];
	/*Obtener la fecha actual*/
	var f = new Date();
	var diahoy = f.getDate();
	var meshoy = f.getMonth()+1;
	var aniohoy = f.getFullYear();
	/*Calculando la edad*/
	var edad = aniohoy-anio;
	if(meshoy<mes){
		edad--;
	}
	else if(meshoy==mes)
	{
		if(diahoy<dia)
			edad--;
	}

	return edad;
}