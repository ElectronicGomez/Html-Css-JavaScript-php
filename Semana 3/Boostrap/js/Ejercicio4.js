/*Objetos en Javascript*/
var brasil = {"nombre":"Brasil","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var colombia = {"nombre":"Colombia","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var peru = {"nombre":"Per&uacute;","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var venezuela = {"nombre":"Venezuela","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var ecuador = {"nombre":"Ecuador","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var qatar = {"nombre":"Qatar","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0}
var pais =  {"nombre":"hola mundo","PJ":0,"PG":0,"PE":0,"PP":0,"GF":0,"GC":0,"DIF":0,"PTS":0};
var score = {"pais1":0,
             "pais2":0};

$(document).ready(function(){
    for(var i = 0;i<54;i++)
    {
        if(i%9===0) continue;
        $("td").eq(i).html("0");    
    }

    $("#simula").click(function(){
        simular();
    });
});



function simular(){
    
    
    /*Borrando los goles y puntos*/
    
    brasil.PJ=0;brasil.GF=0;brasil.GC=0;brasil.PG=0;brasil.PE=0;brasil.PP=0;brasil.DIF=0;brasil.PTS=0;
    colombia.PJ=0;colombia.GF=0;colombia.GC=0;colombia.PG=0;colombia.PE=0;colombia.PP=0;colombia.DIF=0;colombia.PTS=0;
    peru.PJ=0;peru.GF=0;peru.GC=0;peru.PG=0;peru.PE=0;peru.PP=0;peru.DIF=0;peru.PTS=0;
    venezuela.PJ=0;venezuela.GF=0;venezuela.GC=0;venezuela.PG=0;venezuela.PE=0;venezuela.PP=0;venezuela.DIF=0;venezuela.PTS=0;
    ecuador.PJ=0;ecuador.GF=0;ecuador.GC=0;ecuador.PG=0;ecuador.PE=0;ecuador.PP=0;ecuador.DIF=0;ecuador.PTS=0;
    qatar.PJ=0;qatar.GF=0;qatar.GC=0;qatar.PG=0;qatar.PE=0;qatar.PP=0;qatar.DIF=0;qatar.PTS=0;
    
    /*Asignando goles a favor y en contra*/
    /*Fecha 1:*/
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    brasil.GF+=score.pais1;brasil.GC+=score.pais2;//Brasil-Venezuela
    venezuela.GF+=score.pais2;brasil.GC+=score.pais1;//Venezuela-Brasil
    if(score.pais1>score.pais2)//Brasil-Venezuela
    {
        brasil.PG+=1;brasil.PTS+=3;venezuela.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        brasil.PE+=1;brasil.PTS+=1;venezuela.PE+=1;venezuela.PTS+=1;
    }
    else{
        venezuela.PG+=1;venezuela.PTS+=3;brasil.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    colombia.GF+=score.pais1;colombia.GC+=score.pais2;//Colombia-Ecuador
    ecuador.GF+=score.pais2;ecuador.GC+=score.pais1;//Ecuador-Colombia
    if(score.pais1>score.pais2)//Brasil-Venezuela
    {
        colombia.PG+=1;colombia.PTS+=3;ecuador.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        colombia.PE+=1;colombia.PTS+=1;ecuador.PE+=1;ecuador.PTS+=1;
    }
    else{
        ecuador.PG+=1;ecuador.PTS+=3;colombia.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    peru.GF+=score.pais1;peru.GC+=score.pais2;//Perú-Qatar
    qatar.GF+=score.pais2;qatar.GC+=score.pais1;//Qatar-Perú
    if(score.pais1>score.pais2)//Brasil-Venezuela
    {
        peru.PG+=1;peru.PTS+=3;qatar.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        peru.PE+=1;peru.PTS+=1;qatar.PE+=1;qatar.PTS+=1;
    }
    else{
        qatar.PG+=1;qatar.PTS+=3;peru.PP+=1;
    }
    /*Fecha 2:*/
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    brasil.GF+=score.pais1;brasil.GC+=score.pais2;//Brasil-Peru
    peru.GF+=score.pais2;peru.GC+=score.pais1;//Perú-Brasil
    if(score.pais1>score.pais2)
    {
        brasil.PG+=1;brasil.PTS+=3;peru.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        brasil.PE+=1;brasil.PTS+=1;peru.PE+=1;peru.PTS+=1;
    }
    else{
        peru.PG+=1;peru.PTS+=3;brasil.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    colombia.GF+=score.pais1;colombia.GC+=score.pais2;//Colombia-Venezuela
    venezuela.GF+=score.pais2;venezuela.GC+=score.pais1;//Venezuela-Colombia
    if(score.pais1>score.pais2)
    {
        colombia.PG+=1;colombia.PTS+=3;venezuela.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        colombia.PE+=1;colombia.PTS+=1;venezuela.PE+=1;venezuela.PTS+=1;
    }
    else{
        venezuela.PG+=1;venezuela.PTS+=3;colombia.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    ecuador.GF+=score.pais1;ecuador.GC+=score.pais2;//Ecuador-Qatar
    qatar.GF+=score.pais2;qatar.GC+=score.pais1;//Qatar-Ecuador
    if(score.pais1>score.pais2)
    {
        ecuador.PG+=1;ecuador.PTS+=3;qatar.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        ecuador.PE+=1;ecuador.PTS+=1;qatar.PE+=1;qatar.PTS+=1;
    }
    else{
        qatar.PG+=1;qatar.PTS+=3;ecuador.PP+=1;
    }
    /*Fecha 3:*/
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    brasil.GF+=score.pais1;brasil.GC+=score.pais2; //Brasil -Qatar  
    qatar.GF+=score.pais2;qatar.GC+=score.pais1;  //Qatar-Brasil
    if(score.pais1>score.pais2)
    {
        brasil.PG+=1;brasil.PTS+=3;qatar.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        brasil.PE+=1;brasil.PTS+=1;qatar.PE+=1;qatar.PTS+=1;
    }
    else{
        qatar.PG+=1;qatar.PTS+=3;brasil.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    colombia.GF+=score.pais1;colombia.GC+=score.pais2;//Colombia-Perú 
    peru.GF+=score.pais2;peru.GC+=score.pais1;//Perú -Colombia
    if(score.pais1>score.pais2)
    {
        colombia.PG+=1;colombia.PTS+=3;peru.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        colombia.PE+=1;colombia.PTS+=1;peru.PE+=1;peru.PTS+=1;
    }
    else{
        peru.PG+=1;peru.PTS+=3;colombia.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    venezuela.GF+=score.pais1;venezuela.GC+=score.pais2;  //Venezuela-Ecuador  (Fecha 3)
    ecuador.GF+=score.pais2;ecuador.GC+=score.pais1;//Ecuador-Venezuela
    if(score.pais1>score.pais2)
    {
        venezuela.PG+=1;venezuela.PTS+=3;ecuador.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        ecuador.PE+=1;ecuador.PTS+=1;venezuela.PE+=1;venezuela.PTS+=1;
    }
    else{
        ecuador.PG+=1;ecuador.PTS+=3;venezuela.PP+=1;
    }

    /*Fecha 4:*/
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    brasil.GF+=score.pais1;brasil.GC+=score.pais2;//Brasil-Colombia
    colombia.GF+=score.pais2;colombia.GC+=score.pais1;//Colombia-Brasil
    if(score.pais1>score.pais2)
    {
        brasil.PG+=1;brasil.PTS+=3;colombia.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        brasil.PE+=1;brasil.PTS+=1;colombia.PE+=1;colombia.PTS+=1;
    }
    else{
        colombia.PG+=1;colombia.PTS+=3;brasil.PP+=1;
    }    
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    peru.GF+=score.pais1;peru.GC+=score.pais2;//Perú -Ecuador
    ecuador.GF+=score.pais2;ecuador.GC+=score.pais1;//Ecuador-Perú
    if(score.pais1>score.pais2)
    {
        peru.PG+=1;peru.PTS+=3;ecuador.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        ecuador.PE+=1;ecuador.PTS+=1;peru.PE+=1;peru.PTS+=1;
    }
    else{
        ecuador.PG+=1;ecuador.PTS+=3;peru.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    venezuela.GF+=score.pais1;venezuela.GC+=score.pais2;//Venezuela-Qatar
    qatar.GF+=score.pais2;qatar.GC+=score.pais1;//Qatar-Venezuela
    if(score.pais1>score.pais2)
    {
        venezuela.PG+=1;venezuela.PTS+=3;qatar.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        venezuela.PE+=1;venezuela.PTS+=1;qatar.PE+=1;qatar.PTS+=1;
    }
    else{
        qatar.PG+=1;qatar.PTS+=3;venezuela.PP+=1;
    }
    /*Fecha 5:*/
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    brasil.GF+=score.pais1;brasil.GC+=score.pais2;//Brasil-Ecuador
    ecuador.GF+=score.pais2;ecuador.GC+=score.pais1;//Ecuador-Brasil
    if(score.pais1>score.pais2)
    {
        brasil.PG+=1;brasil.PTS+=3;ecuador.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        ecuador.PE+=1;ecuador.PTS+=1;brasil.PE+=1;brasil.PTS+=1;
    }
    else{
        ecuador.PG+=1;ecuador.PTS+=3;brasil.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    colombia.GF+=score.pais1;colombia.GC+=score.pais2;//Colombia-Qatar
    qatar.GF+=score.pais2;qatar.GC+=score.pais1;//Qatar-Colombia
    if(score.pais1>score.pais2)
    {
        colombia.PG+=1;colombia.PTS+=3;qatar.PP+=1;
    }
    else if(score.pais1==score.pais2)
    {
        colombia.PE+=1;colombia.PTS+=1;qatar.PE+=1;qatar.PTS+=1;
    }
    else{
        qatar.PG+=1;qatar.PTS+=3;colombia.PP+=1;
    }
    score.pais1=Math.floor(Math.random()*8);score.pais2=Math.floor(Math.random()*8);
    peru.GF+=score.pais1;peru.GC+=score.pais2;//Peru-Venezuela
    venezuela.GF+=score.pais2;venezuela.GC+=score.pais1;//Venezuela-Peru
    if(score.pais1>score.pais2)
    {
        peru.PG+=1;peru.PTS+=3;venezuela.PP+=1;
    }
    else if(score.pais1==score.pais1)
    {
        peru.PE+=1;peru.PTS+=1;venezuela.PE+=1;venezuela.PTS+=1;
    }
    else{
        venezuela.PG+=1;venezuela.PTS+=3;peru.PP+=1;
    }
    
    /*Partidos jugados*/
    brasil.PJ=5;colombia.PJ=5;peru.PJ=5;venezuela.PJ=5;ecuador.PJ=5;qatar.PJ=5;
    /*Calculando la diferencia de goles*/
    brasil.DIF=brasil.GF-brasil.GC;
    colombia.DIF=colombia.GF-colombia.GC;
    peru.DIF=peru.GF-peru.GC;
    venezuela.DIF=venezuela.GF-venezuela.GC;
    ecuador.DIF = ecuador.GF-ecuador.GC;
    qatar.DIF = qatar.GF-qatar.GC;
    /*Ordenando los equipos por PTS y diferencia de goles*/
    var equipos=[brasil,colombia,peru,venezuela,ecuador,qatar];
    equipos.sort(function (a, b) {
        if (a.PTS > b.PTS) {
            return -1;
        }
        if (a.PTS < b.PTS) {
            return 1;
        }
        if(a.DIF>b.DIF)
            return -1;
        if(a.DIF<b.DIF)
            return 1;
          // a must be equal to b
        return 0;
    });  

    console.log(equipos);
    
    /*Ordenar paises en función a los puntos*/
    console.log(equipos.length);
    /*Mostrar resultados*/
    ind=0;
    for(var i = 0;i<equipos.length;i++){
        pais = equipos[i];
        $("td").eq(ind).html(pais.nombre);
        $("td").eq(ind+1).html(pais.PJ.toString());
        $("td").eq(ind+2).html(pais.PG.toString());
        $("td").eq(ind+3).html(pais.PE.toString());
        $("td").eq(ind+4).html(pais.PP.toString());
        $("td").eq(ind+5).html(pais.GF.toString());
        $("td").eq(ind+6).html(pais.GC.toString());
        $("td").eq(ind+7).html(pais.DIF.toString());
        $("td").eq(ind+8).html(pais.PTS.toString());
        
        /*Marcamos en verde solo a los Tags que clasificaron (primeros 4)*/
        if(i<4){
            for(var k = ind;k<ind+9;k++){
                $("td").eq(k).css("background","green");
                $("td").eq(k).css("font-size","24px");
            }  
        }
        ind+=9;        
        
    }

     
     
}

