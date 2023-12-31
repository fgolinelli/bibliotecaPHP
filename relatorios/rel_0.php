<?php
session_start();
include( "../../config.php" );
//-----Início da área da página

$strTitulo = isset($_GET["titulo"]) ? $_GET["titulo"] : "" ;


//-----Fim da área da página
//Carrega rodape
$rodape = new Rodape();
echo $rodape->getRodape();
?>