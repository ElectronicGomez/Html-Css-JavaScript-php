$(document).ready(function(){
    $("#numero").val("");
    $("#respuesta").hide();
    $("#texto_respuesta").css("textAlign","center");
    $("#texto_respuesta").css("font-size","24px");
    $("#respuesta").css("margin-left","auto");
    $("#respuesta").css("margin-right","auto");

    $("#decimal").click(function(){
        console.log("Calculando decimal");
        $("#respuesta").slideUp(1000); 
        calculardec();
        $("#respuesta").show(2000);       
    });
    $("#hexadecimal").click(function(){
        $("#respuesta").slideUp(1000);
        console.log("Calculando hexadecimal");
        setTimeout(() => {  calcularhex(); }, 2000);
        console.log("Terminando el cálculo luego de 2 segundos");
        $("#respuesta").show(2000);
    });
});




function calculardec(){
    var numbin=$("#numero").val();
    /*Primero se debe averiguar si el número es binario*/
    numbin = numbin.toString();
    var tam = numbin.length;
    var dec=0;
   
    for(var i = 0;i<tam;i++)
    {
        if(numbin[i]!=='0' && numbin[i]!=='1')
        {
            $("#texto_respuesta").html("El n&uacute;mero no es binario");
            return;
            
        }
        else{
            dec+=(numbin[i]*Math.pow(2,(tam-1)-i));
        }
    }
    $("#texto_respuesta").html("El n&uacute;mero decimal es: "+dec);
    
}

function calcularhex(){
    var numbin=$("#numero").val();
    /*Primero se debe averiguar si el número es binario*/
    numbin = numbin.toString();
    var tam = numbin.length;
    var dec=0;
   
    for(var i = 0;i<tam;i++)
    {
        if(numbin[i]!=='0' && numbin[i]!=='1')
        {
            $("#texto_respuesta").html("El n&uacute;mero no es binario");
            return;
            
        }
        else{
            dec+=(numbin[i]*Math.pow(2,(tam-1)-i));
        }
    }
    dec = dec.toString(16);
    $("#texto_respuesta").html("El n&uacute;mero decimal es: 0x"+dec.toUpperCase());
   
}