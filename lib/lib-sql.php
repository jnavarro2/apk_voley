<?php
	/*
		Nombre: lib_sql.php
		Libreria de consultas sql.	
		Fecha: 30/06/2015
		Versión: 1.0
		Autor: Javier Navarro del Valle
	*/
	
//BASE DE DATOS
function create_DB($conexion){
	$sql = 'CREATE DATABASE IF NOT EXISTS cvrafaelaltamira';
	$consulta = mysqli_query($conexion, $sql) or die ("Error: ".mysqli_error($conexion));
	
	include("../head.html");
	$button = '<a href="lib-bbdd.php?create_TB=true"><button>Crear Tablas de Datos</button></a>';
	$span = '<span style="float: left; padding-left: 10px; width: 75%;">Se ha creado la Base de Datos.<br />¿Desea crear las Tablas?: <br /><br /></span>';
	$alert = '<div class="msg"><img style="float: left;" src="../img/check.png">'.$span.'<div class="clear">'.$button.'</div>';
	echo '<div class="alert" style="background: rgba(64, 147, 1, 0.6);">'.$alert.'</div>';
	include("../foot.html");
	//header("Refresh:1; url=../login.php");
}
	
//TABLAS
function create_TB($conexion){
	$sql = 'CREATE TABLE usuarios(user VARCHAR(20) PRIMARY KEY,pass VARCHAR(20) NOT NULL, email VARCHAR(150) NOT NULL, tlf VARCHAR(10) NOT NULL, name VARCHAR(50),surname VARCHAR(250), privilegios VARCHAR(20), img VARCHAR(20));';
	$sql2 = 'INSERT INTO usuarios VALUES ("administrador","admin","cvrafaelaltamira@gmail.com",665562187,"Rafael","Altamira","administrador","admin.png");';
	
	$consulta = mysqli_query($conexion,$sql) or die ("Error: ".mysqli_error($conexion));
	$consulta2 = mysqli_query($conexion,$sql2) or die ("Error: ".mysqli_error($conexion));
	
	include("../head.html");
	$button = '<a href="../index.html"><button>Volver al Login</button></a>';
	$span = '<span style="float: left; padding-left: 10px; width: 75%;">Se ha creado las Tablas de Datos.<br />¿Desea volver al Login?: <br /><br /></span>';
	$alert = '<div class="msg"><img style="float: left;" src="../img/check.png">'.$span.'<div class="clear">'.$button.'</div>';
	echo '<div class="alert" style="background: rgba(64, 147, 1, 0.6);">'.$alert.'</div>';
	include("../foot.html");
}

//CONSULTAS SQL 
function num_TB($conexion){
	$sql = 'SHOW TABLES';
	$count_TB = mysqli_query($conexion, $sql);
	@$num_TB = mysqli_num_rows($count_TB);
	
	return $num_TB;
}

function select_all($tb){
	$sql = 'SELECT * FROM '.$tb;
	return $sql;
}

function select_from_id($tb,$id){
	$sql = 'SELECT * FROM '.$tb.' WHERE user="'.$id.'"';
	return $sql;
}
function consulta($sql, $conexion){
	$consulta = mysqli_query($conexion, $sql) or die ("Fallo en la consulta: ".mysqli_error($conexion));
	return $consulta;
}
?>