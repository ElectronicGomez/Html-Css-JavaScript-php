/*Objetos para manejar las estadísticas de cada país*/
var brasil = {"nombre":"Brasil","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var colombia = {"nombre":"Colombia","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var peru = {"nombre":"Peru","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var venezuela={"nombre":"Venezuela","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var ecuador={"nombre":"Ecuador","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var qatar={"nombre":"Qatar","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var pais={"nombre":"Xcosa","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
/*JSON = JavaScript Object Notation*/
var score={
		"pais1":0,
		"pais2":0};

function iniciar(){
	console.log("Hola mundo");
	for(var i = 0;i<54;i++)
	{
		if(i%9===0) {
			continue;
		}

		document.getElementsByTagName("td")[i].innerHTML="0";
	}
}

/*Evento para detectar el click del botón simular*/
document.getElementById("simula").addEventListener("click",simular);

function simular(){
	/*Resetar los goles, puntos, partidos jugados de cada país*/
	brasil.PJ=0;brasil.PG=0;brasil.PE=0;brasil.PP=0;brasil.GF=0;brasil.GC=0;brasil.DIF=0;brasil.PTS=0;
	colombia.PJ=0;colombia.PG=0;colombia.PE=0;colombia.PP=0;colombia.GF=0;colombia.GC=0;colombia.DIF=0;colombia.PTS=0;
	peru.PJ=0;peru.PG=0;peru.PE=0;peru.PP=0;peru.GF=0;peru.GC=0;peru.DIF=0;peru.PTS=0;
	ecuador.PJ=0;ecuador.PG=0;ecuador.PE=0;ecuador.PP=0;ecuador.GF=0;ecuador.GC=0;ecuador.DIF=0;ecuador.PTS=0;
	venezuela.PJ=0;venezuela.PG=0;venezuela.PE=0;venezuela.PP=0;venezuela.GF=0;venezuela.GC=0;venezuela.DIF=0;venezuela.PTS=0;
	qatar.PJ=0;qatar.PG=0;qatar.PE=0;qatar.PP=0;qatar.GF=0;qatar.GC=0;qatar.DIF=0;qatar.PTS=0;

	/*Vamos a jugar la fecha 1 de la Copa América*/
	/*Brasil-Venezuela*/
	score.pais1=Math.floor(Math.random()*9);score.pais2=Math.floor(Math.random()*9);
	brasil.GF+=score.pais1;brasil.GC=score.pais2;
	venezuela.GF+=score.pais2;venezuela.GC=score.pais1;
	if(score.pais1>score.pais2){
		brasil.PG+=1; brasil.PTS+=3;venezuela.PP+=1;
	}
	else if(score.pais1==score.pais2){
		brasil.PE+=1;venezuela.PE+=1;brasil.PTS+=1;venezuela.PTS+=1;
	}
	else{
		venezuela.PG+=1;venezuela.PTS+=3;brasil.PP+=1;
	}
	/*Colombia-Ecuador*/
	score.pais1=Math.floor(Math.random()*9);score.pais2=Math.floor(Math.random()*9);
	colombia.GF+=score.pais1;colombia.GC=score.pais2;
	ecuador.GF+=score.pais2;ecuador.GC=score.pais1;
	if(score.pais1>score.pais2){
		colombia.PG+=1; colombia.PTS+=3;ecuador.PP+=1;
	}
	else if(score.pais1==score.pais2){
		colombia.PE+=1;ecuador.PE+=1;colombia.PTS+=1;ecuador.PTS+=1;
	}
	else{
		ecuador.PG+=1;ecuador.PTS+=3;colombia.PP+=1;
	}
	/*Perú-Qatar*/
	score.pais1=Math.floor(Math.random()*9);score.pais2=Math.floor(Math.random()*9);
	peru.GF+=score.pais1;peru.GC=score.pais2;
	qatar.GF+=score.pais2;qatar.GC=score.pais1;
	if(score.pais1>score.pais2){
		peru.PG+=1; peru.PTS+=3;qatar.PP+=1;
	}
	else if(score.pais1==score.pais2){
		peru.PE+=1;venezuela.PE+=1;peru.PTS+=1;qatar.PTS+=1;
	}
	else{
		qatar.PG+=1;qatar.PTS+=3;peru.PP+=1;
	}
	/*Partidos Jugados*/
	brasil.PJ=1;colombia.PJ=1;peru.PJ=1;venezuela.PJ=1;ecuador.PJ=1;qatar.PJ=1;
	/*Calculamos la diferencia*/
	brasil.DIF=brasil.GF-brasil.GC;
	colombia.DIF=colombia.GF-colombia.GC;
	peru.DIF=peru.GF-peru.GC;
	venezuela.DIF=venezuela.GF-venezuela.GC;
	ecuador.DIF=ecuador.GF-ecuador.GC;
	qatar.DIF=qatar.GF-qatar.GC;
	
	/*Ordenar los equipos por PTS y luego por DIF*/
	//var numeros=[9,-9,12,13,103,-90,10];
	//numeros.sort();
	//numeros=[-90,-9,9,10,12,13,103];
	var equipos=[brasil,colombia,peru,venezuela,ecuador,qatar];
	equipos.sort(function(a,b){
		if(a.PTS>b.PTS){
			return -1;
		}
		if(a.PTS<b.PTS){
			return 1;
		}
		if(a.DIF>b.DIF){
			return -1;
		}
		if(a.DIF<b.DIF){
			return 1;
		}
	});

	console.log(equipos);

	ind = 0;
	for(var i = 0;i<equipos.length;i++){
		pais = equipos[i];
		document.getElementsByTagName("td")[ind].innerHTML=pais.nombre;
		document.getElementsByTagName("td")[ind+1].innerHTML=pais.PJ;
		document.getElementsByTagName("td")[ind+2].innerHTML=pais.PG;
		document.getElementsByTagName("td")[ind+3].innerHTML=pais.PE;
		document.getElementsByTagName("td")[ind+4].innerHTML=pais.PP;
		document.getElementsByTagName("td")[ind+5].innerHTML=pais.GF;
		document.getElementsByTagName("td")[ind+6].innerHTML=pais.GC;
		document.getElementsByTagName("td")[ind+7].innerHTML=pais.DIF;
		document.getElementsByTagName("td")[ind+8].innerHTML=pais.PTS;
		/*Solo los primeros 4 equipos van a clasificar*/
		if(i<4){
			for(var k = ind;k<ind+9;k++){
				document.getElementsByTagName("td")[k].style.background="green";
			}
		}

		ind+=9;			
	}

}