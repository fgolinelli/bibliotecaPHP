<?php
class Cabecalho{
	//Propriedades
	
	
	//Metodos
	function __construct() {
		//Definir Time Zone
		date_default_timezone_set('America/Sao_Paulo');
		
		//Guardar o início do carregamento da página para estatísticas no rodapé
		$dthInicioPagina = new DateTime;
	}
	
	function getCabecalho(){
		ini_set('display_errors',1);
		ini_set('display_startup_erros',1);

		error_reporting(E_ALL);

		//foreach ($_SERVER as $parm => $value){
		//	echo "$parm = '$value'<br>";
		//}
		?>

		<!DOCTYPE html>
		<html lang="pt-br">
		<head>
			<title><?=$_SESSION["nomeEmpresa"]?> / <?=$_SESSION["nomeSistema"]?></title>
			<meta http-equiv="Content-Language" content="pt-br">
			<!--Refresh logo após completar o ciclo de tempo da sessão, em segundos -->
			<meta http-equiv="refresh" content="<?= $_SESSION["tempoLimiteSessao"]*60.5?>">
				<meta http-equiv="cache-control" content="max-age=0" />
				<meta http-equiv='cache-control' content='no-cache'>
				<meta http-equiv='expires' content='0'>
				<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
				<meta http-equiv='pragma' content='no-cache'>
			<meta charset="UTF-8">
				
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="shortcut icon" href="<?=$_SESSION["CaminhoExterno"]?>/images/img-empresa-nav.png" >
			<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
			<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-2021.css">
			<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-vivid.css">
			<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
			<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
			<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
			<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
			<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

		</head>

		<body class="container-fluid bg-secondary p-2">
<?php

		if ( isset($_SESSION["Logado"]) && $_SESSION["Logado"] === true ){
			
			//Carrega Cabecalho logo e informações da empresa
?>
			<div class="p-3 bg-black text-white align-middle">
				<div class="row">
					<div class="col-sm-6">
						<img src="images/LivrariaOnLine.png" style="width:100px;height:100px;">
					</div>
					<div class="col-sm-6 text-end">
						<span class=" w3-xlarge"><?=$_SESSION["nomeEmpresa"]?> / <?=$_SESSION["nomeSistema"]?></span>
						<br>
						<span class="text-small">Autenticado como <?=$_SESSION["UsuarioNome"]?></span>
					</div>
				</div>
			</div>
<?php
			
			//Carrega menu
			$menu = new Menu();
			echo $menu->getMenu();
		}
	}
}
?>