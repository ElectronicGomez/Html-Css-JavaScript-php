function iniciar(){
	document.getElementById("respuesta").style.display="none";
}

function calculardec(){
	/*Supongamos que se ingresa 1101*/
	var numerobin = document.getElementById("numero").value;
	/*Primero tenemos que averiguar si el número es binario:
	que solo contenga 1s o 0s*/
	numerobin = numerobin.toString();
	var tam = numerobin.length;
	var dec = 0;//1101
	for(var i = 0; i<tam; i++){
		if(numerobin[i]!=='0' && numerobin[i]!=='1'){
			document.getElementById("respuesta").style.display="table";
			document.getElementById("respuesta").innerHTML="El n&uacute;mero no es binario";
			return;
		}else{
			dec+=(numerobin[i]*Math.pow(2,(tam-1)-i));
		}
	}
	document.getElementById("respuesta").innerHTML="El n&uacute;mero decimal es: "+dec;
	document.getElementById("respuesta").style.display="table";
	
}

function calcularhex(){
	/*Supongamos que se ingresa 1101*/
	var numerobin = document.getElementById("numero").value;
	/*Primero tenemos que averiguar si el número es binario:
	que solo contenga 1s o 0s*/
	numerobin = numerobin.toString();
	var tam = numerobin.length;
	var dec = 0;//1101
	for(var i = 0; i<tam; i++){
		if(numerobin[i]!=='0' && numerobin[i]!=='1'){
			document.getElementById("respuesta").style.display="table";
			document.getElementById("respuesta").innerHTML="El n&uacute;mero no es binario";
			return;
		}else{
			dec+=(numerobin[i]*Math.pow(2,(tam-1)-i));
		}
	}
	dec = dec.toString(16);
	document.getElementById("respuesta").innerHTML="El n&uacute;mero hexdecimal es: 0x"
	+dec.toUpperCase();
	document.getElementById("respuesta").style.display="table";
	

}

function calcular(base){
	/*Supongamos que se ingresa 1101*/
	var numerobin = document.getElementById("numero").value;
	/*Primero tenemos que averiguar si el número es binario:
	que solo contenga 1s o 0s*/
	numerobin = numerobin.toString();
	var tam = numerobin.length;
	var dec = 0;//1101
	for(var i = 0; i<tam; i++){
		if(numerobin[i]!=='0' && numerobin[i]!=='1'){
			document.getElementById("respuesta").style.display="table";
			document.getElementById("respuesta").innerHTML="El n&uacute;mero no es binario";
			return;
		}else{
			dec+=(numerobin[i]*Math.pow(2,(tam-1)-i));
		}
	}
	if(base === 10)
	{
		document.getElementById("respuesta").innerHTML="El n&uacute;mero decimal es: "+dec;
		document.getElementById("respuesta").style.display="table";
	}
	else if(base === 16){
		dec = dec.toString(16);
		document.getElementById("respuesta").innerHTML="El n&uacute;mero hexdecimal es: 0x"
		+dec.toUpperCase();
		document.getElementById("respuesta").style.display="table";
	}
}