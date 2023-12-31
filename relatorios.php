<?php
session_start();
include( "config.php" );

//Carrega cabecalho
$cabecalho = new Cabecalho();
echo $cabecalho->getCabecalho();
//-----Início da área da página


//Relatórios
$VRelatorio = array(
	0=>"",
	1=>"Listagem dos Livros",
	2=>"Listagem dos Livros por Ano",
	3=>"Listagem dos Livros por Editora"
);
$intRel = 0;

//Carrega Form de seleção de relatórios
$rel = new Formulario();
echo "<div class='container text-white'>";
echo $rel->FormSelecaoRelatorios(FMontaSelectRelatorios($VRelatorio,isset($_POST["slcRel"])?$_POST["slcRel"]:0 ));
echo "</div>";

if(isset($_POST["slcRel"])){

	$intRel = $_POST["slcRel"];

	echo "<div class='container text-white'>";
	FMontaRelatorio($intRel,$VRelatorio[$intRel]);
	echo "</div>";
}


//-----Fim da área da página
//Carrega rodape
$rodape = new Rodape();
echo $rodape->getRodape();





function FMontaSelectRelatorios($VRelatorio,$intNumRelat){
	
	$dados="";
	
	foreach($VRelatorio AS $i => $descricao){
		$dados .= $intNumRelat == $i ? "<option value='$i' selected >$descricao</option>"  : "<option value='$i'>$descricao</option>" ;
	}
	
	return $dados;
}

function FMontaRelatorio($intRel,$strTituloRelatorio){
?>
	<iframe src="relatorios/rel_<?=$intRel?>.php?titulo=<?=$strTituloRelatorio?>" title="W3Schools Free Online Web Tutorials" width="100%" height="500px" style="border:1px solid black;"></iframe>
<?php
}
?>