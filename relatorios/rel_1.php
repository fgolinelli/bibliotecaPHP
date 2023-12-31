<?php
ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);
session_start();
include( $_SESSION["CaminhoExterno"]."/config.php" );

//-----Início da área da página

//Recebe título do relatório
$strTitulo = isset($_GET["titulo"]) ? $_GET["titulo"] : "" ;


echo "<html lang='pt-br'>";
echo "<head>";
echo "<title>Bootstrap Example</title>";
echo "<meta charset='utf-8'>";
echo "<meta name='viewport' content='width=device-width, initial-scale=1'>";
echo "<link rel='stylesheet' href='https://www.w3schools.com/w3css/4/w3.css'>";
echo "<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>";
echo "<link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css' rel='stylesheet'>";
echo "<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js'></script>";
echo "</head>";
echo "<body>";

//Carrega Impressao
$impressao = new Impressao();
$strBtnImpressao = $impressao->getBotao("<i class='fa fa-print'></i>");

//Carrega CRUD
$crud = new CRUD();
$dados = $crud->getLivros();

echo "	<div class='d-flex justify-content-between bg-dark text-white mb-3'>";
echo "		<div class='p-1'>$strTitulo</div>";
echo "		<div class='p-1'>$strBtnImpressao</div>";
echo "	</div>";

echo "<div id='print' class='conteudo'>";
echo "<table class='w3-table-all'><tr><th>ID</th><th>Título</th><th>Autor(a)</th><th>Assunto</th></tr>";
	for($i=0;$i<count($dados);$i++){
		echo "<tr><td>".$dados[$i]["codl"]."</td><td>".$dados[$i]["Titulo"]."</td><td>".$dados[$i]["Autor"]."</td><td>".$dados[$i]["Assunto"]."</td></tr>";
	}
echo "</table>";
echo "</div>";

//-----Fim da área da página
//Carrega rodape
$rodape = new Rodape();
echo $rodape->getRodape();
?>




