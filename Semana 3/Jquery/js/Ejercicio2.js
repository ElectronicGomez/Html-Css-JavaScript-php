
$(document).ready(function(){
    $("#fecha").val("");
    $("#resultado").hide();

    $("button").click(function(){
        var fecha = $("#fecha").val();
        var edad = obtener_edad(fecha);
        $("#resultado").html("Su edad es: "+edad+" a&ntilde;os. ");
        $("#resultado").css("font-size","24px");
        $("#resultado").css("textAlign","center");

        $("#resultado").slideDown(1000);
    });

    $("#resultado").click(function(){
        $("#resultado").slideUp();
    });
});


function obtener_edad(fecha){
    var res = fecha.split("-");
    /*Obteniendo la fecha ingresada*/
    var year  = res[0];
    var month = res[1];
    var day   = res[2];
    /*Obteniendo la fecha actual*/
    var d = new Date();
    var diahoy = d.getDate();
    var meshoy = d.getMonth()+1;
    var anohoy = d.getFullYear();
    /*Cálculo de la edad*/
    var edad;
    edad = anohoy-year;
    /*Se debe verificar que el mes del cumpleaños no haya pasado*/
    if(meshoy<month)
    {
        edad--;
    }
    else if(meshoy===month)
    {
        if(diahoy<day)
        {
            edad--;
        }
    }
    return edad;
}