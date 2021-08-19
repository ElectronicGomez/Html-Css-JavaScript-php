/*Tipo de dato primitivo*/
var mensaje = "Hola mundo!"; //mensaje es de tipo String
var pi = 3.1415; //pi es una variable tipo double
var num = -9; //num es una variable de tipo entero
var valor; //valor es de tipo undefined
var variable = null; //variable de tipo null
var k = true; //k es de tipo booleano

/*Objetos */
var sotr={
	pc1:0.15,
	pc2:0.15,
	lb1:0.15,
	lb2:0.15,
	ea: 0.2,
	dd: 0.05,
	tf: 0.15};
num++;
num--;
sotr.tf=0.16;
var notas = new Array();
notas[0]=12;notas[1]=13;notas[2]=15;notas[3]=13;notas[4]=15;notas[5]=17;notas[6]=12;
notas[100]=10;
var aux = notas[45];//var = undefined
//alert("Hola mundo");
var pf = promedio(notas);
console.log("El promedio final es "+pf);
if(pf>12.5 && notas[6]>13)
	console.log("El alumno se merece estar aprobado");
else if(pf>12.5 && notas[6]<=13) //|| O 
	console.log("El alumno no merece aprobar");
else
	console.log("El alumno está desaprobado");

switch(k){
	case 0:
		k=k+1;
		break;
	case 1:
		k=k+2;
		break;
}

var k = 1;	//k es entero
var p = 1.0;//p es flotate y vale 1.0
var cadena = "1";
if(k==cadena){
	console.log("k y p tienen el mismo valor");
}
if(k===cadena){
	console.log("k y p tienen el mismo valor y también son del mismo tipo");
}
if(k!==cadena){
	console.log("k y cadena tiene diferente valor y diferente tipo");
}
function promedio(notas){
	var pf = notas[0]*sotr.pc1+notas[1]*sotr.pc2+notas[2]*sotr.lb1+notas[3]*sotr.lb2+
	notas[4]*sotr.ea+notas[5]*sotr.dd+notas[6]*sotr.tf;
	return pf;
}

var t = 50%4;
var j = 50/4;

for (var i = 0;i<10;i++){
	console.log("i="+i);

}