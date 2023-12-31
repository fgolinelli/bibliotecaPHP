<?php
session_start();

if($_POST && $_POST["formAutentica"] === "true" ){
	$VRequest = $_POST;
	$strUsuario = $VRequest["txtUsuario"];
	$strSenha = $VRequest["pasUsuario"];
	
	if($strUsuario === "Fernando" && $strSenha === "123456"){
		$_SESSION["Logado"] = true;
		$_SESSION["UsuarioNome"] = $strUsuario;
		header("location: home.php");
	}else{
		
		header("location: index.php?Erro=1");
	}
}
?>