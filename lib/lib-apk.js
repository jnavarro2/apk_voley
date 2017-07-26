var control = 0;

function mostrarNav(){
	$("nav").animate({left: "0%"}, 500);
	$("#menuNav").animate({left: "0%"}, 500);
	$("#blackCap").fadeIn(500);
	control++;
};

function ocultarNav(){
	$("nav").animate({left: "-100%"}, 500);
	$("#menuNav").animate({left: "-100%"}, 500);
	$("#blackCap").fadeOut(500);
	control--;
};

function mostrarPlayers(){
	$("#playerTeam").animate({left: "-100%"}, 500);
	$("#playerPlayers").animate({left: "0%"}, 500);
	$("#player").animate({left: "+100%"}, 500);
	
	$("#addPlayer").css("display", "block");
}
function mostrarTeams(){
	$("#playerTeam").animate({left: "0%"}, 500);
	$("#addPlayer").css("display", "none");
	$("#playerPlayers").animate({left: "+100%"}, 500);
}
function mostrarPlayer(){
	$("#playerPlayers").animate({left: "-100%"}, 500);
	$("#addPlayer").css("display", "none");
	$("#player").animate({left: "0%"}, 500);
}

function assistPlayers(){
	$("#assistTeam").animate({left: "-100%"}, 500);
	$("#assistPlayers").animate({left: "0%"}, 500);
}
function assistTeams(){
	$("#assistTeam").animate({left: "0%"}, 500);
	$("#assistPlayers").animate({left: "+100%"}, 500);
}


$(document).ready(function(){
	$("#content").load("dashboard.html");
	
	$("#menuOption").click(function(){
		if(control == 0)
			mostrarNav();
	});
	
	$("#whiteCap").click(function(){
		if(control ==1)
			ocultarNav();
	});
	
	$("#menuTitle").click(function(){
		$("#content").load("dashboard.html");
		$("footer").css("display","block");
	});

	$("#list li").click(function(){
		var id = $(this).attr("class");
		var dir = id+".html";		
		//alert(dir);
		$("#content").load(dir);
		if(id == "player2" || id == "assist"){
			$("footer").css("display","none");
		}else{
			$("footer").css("display","block");
		}
	});
	
	$("#content").on('click','.link', function(){
		var id = $(this).attr("alt");
		var dir = id+".html";
		//alert(dir);
		$("#content").load(dir);
		if(id == "player2" || id == "assist"){
			$("footer").css("display","none");
		}else{
			$("footer").css("display","block");
		}
	});
	
	//JUGADORES 
	$("#content").on('click','#playerTeam article', function(){
		//alert("next");
		mostrarPlayers();
	});
	
	$("#content").on('click','#playerPlayers .infoNameTeam', function(){
		//alert("back");
		mostrarTeams();
	});
	
	$("#content").on('click','#playerPlayers .listPlayer', function(){
		//alert("back");
		mostrarPlayer();
	});
	
	$("#content").on('click','#player .back', function(){
		//alert("back");
		mostrarPlayers();
	});
	
	$("#content").on('click','#addTeam', function(){
		alert("Equipo añadido!!!");
	});
	//ASISTENCIA
	$("#content").on('click','#assistTeam article', function(){
		//alert("next");
		assistPlayers();
	});
	
	$("#content").on('click','#assistPlayers .infoNameTeam', function(){
		//alert("back");
		assistTeams();
	});
		
});