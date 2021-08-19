function iniciar(){
	document.getElementById("PC1").value="";
	document.getElementById("PC2").value="";
	document.getElementById("LB1").value="";
	document.getElementById("LB2").value="";
	document.getElementById("EA").value="";
	document.getElementById("DD").value="";
	document.getElementById("TF").value="";
	
}

function calcular(){
	var notas = new Array();
	//var notas = [0,0,0,0,0,0,0];
	notas[0]= parseInt(document.getElementById("PC1").value);
	notas[1]= parseInt(document.getElementById("PC2").value);
	notas[2]= parseInt(document.getElementById("LB1").value);
	notas[3]= parseInt(document.getElementById("LB2").value);
	notas[4]= parseInt(document.getElementById("EA").value);
	notas[5]= parseInt(document.getElementById("DD").value);
	notas[6]= parseInt(document.getElementById("TF").value);
	
	/*Verificar que todas las notas estén entre 0 y 20*/
	console.log("Hay un total de "+notas.length+ "notas");
	for(var i = 0;i<notas.length;i++){
		if(notas[i]<0 || notas[i]>20){
			document.getElementById("resul").innerHTML="<b>Las notas deben ser entre 0 y 20</b>";
			document.getElementById("resul").style.textAlign="center";
			document.getElementById("resul").style.background="orange";
			return;
		}
	}
	var pf = notas[0]*0.15+notas[1]*0.15+notas[2]*0.15+notas[3]*0.15+notas[4]*0.2+
		notas[5]*0.05+notas[6]*0.15;
	pf = pf.toFixed(2);
	document.getElementById("resul").innerHTML="<b>Su promedio final es "+pf+"</b>";
	var cont = document.getElementById("res_container");
	if(pf<12.5){
		cont.style.background="red";
	}	
	else{
		cont.style.background="green";
	}
	cont.style.textAlign="center";
}