$(document).ready(function(){
 
	$("ul.navigation ul").parent().append("<span></span>"); 
	
	$("ul.navigation li span").click(function() { //Al hacer click se ejecuta...
		
		//Con este codigo aplicamos el movimiento de arriva y abajo para el submenu
		$(this).parent().find("ul.navigation ul").slideDown('fast').show(); //Menu desplegable al hacer click
 
		$(this).parent().hover(function() {
		}, function(){	
			$(this).parent().find("ul.navigation ul").slideUp('slow'); //Ocultamos el submenu cuando el raton sale fuera del submenu
		});
 
		}).hover(function() { 
			$(this).addClass("subhover"); //Agregamos la clase subhover
		}, function(){	//Cunado sale el cursor, sacamos la clase
			$(this).removeClass("subhover"); 
	});
 
});