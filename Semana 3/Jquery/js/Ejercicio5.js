var hora="0"+7, min=59,seg=59;
var id;

$(document).ready(function(){
    hora = "0"+2;
    min = 59;
    seg = 59;
    $("#iniciar").click(function(){
        id=setInterval("cronometro()",500);

    });
    
    $("#parar").click(function(){
        detener();
    });

});

function cronometro()
{
    seg--;
    if(seg<0)
    {
        seg=59;min--;
        if(min<10)  min="0"+min;
    }
    if(min<0)
    {
        min=0;hora--;
        if(hora<10) hora="0"+hora;
    }
    if(hora==0 && min===0 && seg===0)
    {
        clearInterval(id);
    }
        
    if(seg<10)  seg="0"+seg;
    $("#cronometro").html(hora+":"+min+":"+seg);
            
}

function detener(){
    if(id!=undefined)
        clearInterval(id);
}



