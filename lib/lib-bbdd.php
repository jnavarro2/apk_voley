<?php
	/*
		Nombre: lib-bbdd.php
		Libreria que realiza la gestion de la base de datos.	
		Fecha: 14/02/2017
		Versión: 1.0
		Autor: Javier Navarro del Valle
	*/
	
	include('lib-sql.php');
	
	//CONFIGURACION BASE DE DATOS
	$server = "localhost"; /* Nuestro server mysql */
	$dbuser = "root"; /* Nuestro user mysql */
	$dbpass = ""; /* Nuestro password mysql */
	$database = "cvrafaelaltamira"; /* Nuestra base de datos */
	
	//ESTABLECER LA CONEXION
	$conexion = mysqli_connect($server,$dbuser,$dbpass) or die ("No se puede conectar con el servidor");		
	
	//COMPROBACION DE LA BASE DE DATOS
	if(isset($_POST['database'])) { 
		$database = $_POST['database'];
		
		//VARIABLES GLOBALES
		global $conexion;
		
		//SELECCIONAR BASE DE DATOS
		$db = mysqli_select_db($conexion, $database);
		
		if(!$db){
			$button = '<a href="lib/lib-bbdd.php?create_DB=true"><button>Crear Base de Datos</button></a>';
			$span = '<span style="float: left; padding-left: 10px; width: 75%;">Error: La Base de Datos no existe.<br />¿Desea crearla?: <br /><br /></span>';
			$alert = '<div class="msg"><img style="float: left;" src="img/alert.png">'.$span.'<div class="clear">'.$button.'</div>';
			echo '<div class="alert">'.$alert.'</div>';
		}
	}
	
	//COMPROBACION DEL USUARIO Y LA CONTRASEÑA
	if(isset($_POST['user']) && $_POST['pass']) { 
		
		$user = $_POST['user'];
		$pass = $_POST['pass'];
				
		//TABLA A CONSULTAR
		global $usuario;
		global $server; 
		global $dbuser;
		global $dbpass; 
		global $database;
		$usuario = $user;
		$tb = 'usuarios';
		$conexion = mysqli_connect($server,$dbuser,$dbpass,$database) or die ("No se puede conectar con el servidor");
		
		//CONSULTAS
		$sql = select_all($tb);
		$consulta = consulta($sql, $conexion);
		
		//VARIABLES
		//Login
		$arr_user = array();
		$arr_pass = array();
		
		$total_l = 0;
		
		while($fila = mysqli_fetch_array($consulta)){
			$arr_user[$total_l] = $fila["user"];
			$arr_pass[$total_l] = $fila["pass"];	
			$total_l++;
		}
		
		if($user != null || $pass != null){ 
			for($x=0;$x<$total_l;$x++){
				if($user == $arr_user[$x] && $pass == $arr_pass[$x]){
					session_start();
					$_SESSION["user"]=$arr_user[$x];
					echo "true";
				}
			}
		}
		
	}
	
	//EXTRACCION DATOS DEL LOGIN
	if(isset($_POST['login'])) { 
		$user = $_POST['login'];
		
		//TABLA A CONSULTAR
		global $server; 
		global $dbuser;
		global $dbpass; 
		global $database;
		$tb = 'usuarios';
		$conexion = mysqli_connect($server,$dbuser,$dbpass,$database) or die ("No se puede conectar con el servidor");
		$sql = select_from_id($tb,$user);
		$consulta = mysqli_query($conexion, $sql);
				
		$fila = mysqli_fetch_row($consulta);
		
		//echo $sql;
		
		$userIMG = '<img id="user" src="img/user/'.$fila[7].'" />';	
		$userNAME = '<div class="clear"></div>
		<div id="userName" class="span">'.$fila[4].' '.$fila[5].'</div>';
		$userEMAIL = '<div class="clear"></div>
		<div id="userEmail" class="span">'.$fila[2].'</div>';
				
		echo $userIMG.$userNAME.$userEMAIL;
			
	}
	
	if(isset($_GET['create_DB'])) {
		create_DB($conexion);
	}
	
	if(isset($_GET['create_TB'])) {
		$conexion = mysqli_connect($server,$dbuser,$dbpass,$database) or die ("No se puede conectar con el servidor");
		create_TB($conexion);
	}
?>