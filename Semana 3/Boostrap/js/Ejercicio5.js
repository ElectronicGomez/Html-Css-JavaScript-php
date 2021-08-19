var lunes = 0;
$(document).ready(function(){
    $("#bloque3").hide();
    $("#bloque2").hide();
    $("#bloque1").show();

    $("#clave").click(function(){
        $("#bloque3").hide();
	    $("#bloque2").show();
    	$("#bloque1").hide();

    });

    $("#disponibilidad").click(function(){
    	$("#bloque3").show();
	    $("#bloque2").hide();
    	$("#bloque1").hide();

    });

    $("#L78").click(function(){

    	if(lunes==3)
    		lunes=0;
    	switch(lunes)
    	{
    		case 1:
    			$("#L78").html("San Miguel");
    			break;
    		case 2:
    			$("#L78").html("Monterrico");
    			break;
    		case 0:
    			$("#L78").html("Ocupado");
    			break;
    	}
    	console.log(lunes);
    	lunes++;
    	
    });

});