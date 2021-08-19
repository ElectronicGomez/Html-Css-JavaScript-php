var notas = {pc1:0,
             pc2:0,
             lb1:0,
             lb2:0,
             ea :0,
             dd :0,
             tf1:0,
             pf :0};

$(document).ready(function(){
     $("#pc1").val("");
     $("#pc2").val("");
     $("#lb1").val("");
     $("#lb2").val("");
     $("#ea").val("");
     $("#dd").val("");
     $("#tf1").val("");
     $("#resul").innerHTML="Aqu&iacute; aparecer&aacute; su promedio final.";
     $("#enviar").click(function(){
            notas.pc1 = $("#pc1").val();
            notas.pc2 = $("#pc2").val();
            notas.lb1 = $("#lb1").val();
            notas.lb2 = $("#lb2").val();
            notas.ea  = $("#ea").val();
            notas.dd  = $("#dd").val();
            notas.tf1 = $("#tf1").val();

            for(var i in notas){
                //console.log(i+"=>"+notas[i]);
                if(notas[i]<0 || notas[i]>20){
                    $("#resul").html("<b>Las notas deben estar entre 0 y 20</b>");
                    $("#resul").css("textAlign","center");
                    $("#resul").css("background","orange");
                              
                    return;        
                }
            }
            notas.pf= 0.15*notas.pc1+0.15*notas.pc2+0.15*notas.lb1+0.15*notas.lb2+
                      0.2*notas.ea+0.05*notas.dd+0.15*notas.tf1;
            notas.pf = notas.pf.toFixed(2);
            console.log(notas.pf);
            $("#resul").html("Su promedio final es: "+notas.pf);
            if(notas.pf<12.5)
            {
                $("#res_container").css("background","red");
            }
            else
            {
                $("res_container").css("background","yellow");
            }
            document.getElementById("resul").style.textAlign="center";


     });

     $("#limpiar").click(function(){
            limpiar();
     });

});

function limpiar(){
    $("#pc1").val("");
    $("#pc2").val("");
    $("#lb1").val("");
    $("#lb2").val("");
    $("#ea").val("");
    $("#dd").val("");
    $("#tf1").val("");
    $("#resul").html("Aqu&iacute; aparecer&aacute; su promedio final.");
    $("#res_container").css("background","yellow");
    console.log("Limpiando");

}