<?php
session_start();
include( "config.php" );

//Carrega cabecalho
$cabecalho = new Cabecalho();
echo $cabecalho->getCabecalho();
//-----Início da área da página



//Carrega conexão
$crud = new CRUD();
$quantidadeAutores = $crud->quantidadeAutores() ;
$quantidadeAssuntos = $crud->quantidadeAssuntos() ;

echo "<div class='container text-white'>";
echo "<h4>Olá ".$_SESSION["UsuarioNome"].", seja bem-vindo!</h4>" ;
echo "<br>";
echo "<h5>Estatísticas</h5>";
echo "$quantidadeAutores autor(es) cadastrado(s).";
echo "<br>$quantidadeAssuntos assunto(s) cadastrado(s).";
echo "</div>";

//-----Fim da área da página
//Carrega rodape
$rodape = new Rodape();
echo $rodape->getRodape();
?>
