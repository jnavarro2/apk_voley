/*
	Nombre: lib-bbdd.js
	Libreria que realiza la gestion de la base de datos.	
	Fecha: 01/11/2016
	Versión: 1.0
	Autor: Javier Navarro del Valle
*/

var checkDB = false;

//COMPROBAR SI EXISTE CONEXION CON LA BASE DE DATOS
function checkDataBase(){
	$.ajax({
		type: "POST",
		url: "http://192.168.1.57/apk-voley/lib/lib-bbdd.php",
		data: "database=cvrafaelaltamira",
		dataType: "html",
		error: function(){
			alert("No se puede conectar con la base de datos");
		},
		success: function(data){                                                      
			$("body").append(data);
		}
		
  });
}

//COMPROBAR USUARIO Y CONTRASEÑA
function checkUser(user,pass){
	var parametros = {
		"user" : user,
		"pass" : pass
	};
	
	$.ajax({
		data:  parametros,
		url:   'http://192.168.1.57/apk-voley/lib/lib-bbdd.php',
		type:  'POST',
		beforeSend: function () {
			//$("#resultado").html("Procesando, espere por favor...");
		},
		success:  function (response) {
			
			if(response == "true"){
				var url = "main.html"; 
				$("#login").css("display","none");
				$("#main").fadeIn(500);
				userLogin(user);
				sesionActive = true;
				localStorage.setItem("Usuario", user);
			}
			else{
				var msg = '<div id="errLogin" class="alert"><div class="msg"><img style="float: left;" src="img/alert.png">Usuario o Contrase&ntildea son <br> Incorrectos.<div class="clear"></div></div>';
				$("body").append(msg);
				setTimeout(function() {
					$("#errLogin").fadeOut(500);
					setTimeout(function() {
						$("#errLogin").remove();
					},1000);
				},4000);
				console.log(parametros);
			}
		}
	});
	
}

//CARGAMOS LA INFORMACION DEL LOGIN
function userLogin(user){
	
	var parametro = {
		"login" : user
	};
	console.log(parametro);
	$.ajax({
		data:  parametro,
		url:   'http://192.168.1.57/apk-voley/lib/lib-bbdd.php',
		type:  'POST',
		beforeSend: function () {
			//$("#resultado").html("Procesando, espere por favor...");
		},
		success:  function (response) {
			$("#log").empty();
			$("#log").append(response);
			console.log(response);
		}
	});
}

$(document).ready(function(){
	
	if(checkDB == false){
		checkDataBase();
		checkDB = true;
	}
	
	$(".logout").click(function(){
		userLogout();
	});
});