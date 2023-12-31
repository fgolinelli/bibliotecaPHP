<?php
session_start();
include( "config.php" );

//Carrega cabecalho
$cabecalho = new Cabecalho();
echo $cabecalho->getCabecalho();
//-----Início da área da página

//Dados do formulário
$strFuncao = "Cadastra";
$strNomeBotao = "Cadastrar";
$strNomeForm = "formCadastraAutor";
$strNomeFormE = "formEditaAutor";
$strNomeFormX = "formExcluiAutor";

//Instancia CRUD / Formulario
$crud = new CRUD();
$formulario = new Formulario();

//Se houver cadastro de autor
if( isset($_POST["formCadastraAutor"]) && $_POST["formCadastraAutor"] === "true" ){
	
	$VRequest = $_POST;
	$strAutor = isset($VRequest["txtAutor"]) ? trim($VRequest["txtAutor"]) : "" ;
	
	//Carrega Autor
	$autor = new Autor();
	//Valida dados para cadastro
	$respostaAutor = $autor->valida($strAutor);
	
	//Se validado com sucesso
	if ( $respostaAutor === true ){
		
		//Cadastra Autor
		$dados = $crud->addAutor($strAutor);
		
		//Elimina variável para não exibir mensagem de erro
		unset($strAutor);
		
		//Recebe mensagem de erro
		$strMsg = "Cadastro realizado.";

	}else{
		//Recebe mensagem de erro
		$strMsg = $respostaAutor;
	}
}elseif( isset($_POST["formEditaAutor"]) && $_POST["formEditaAutor"] === "true" ){
	$strFuncao = "Edita";
	$strNomeBotao = "Editar";
	$strNomeForm = "formEditaAutor2";
	$strAutor = $_POST["hidNome"];
	$intId = $_POST["hidId"];
}elseif( isset($_POST["formEditaAutor2"]) && $_POST["formEditaAutor2"] === "true" ){

	$dados = $crud->setAutor($_POST["hidId"],trim($_POST["txtAutor"]));
	if($dados === true){
		//Recebe mensagem de erro
		$strMsg = "Alterado com sucesso.";
		
		$strFuncao = "Cadastra";
		$strNomeBotao = "Cadastrar";
		$strAssunto = "";
		$intId = "";
		
	}else{
		//Recebe mensagem de erro
		$strMsg = $dados;
		
		$strFuncao = "Edita";
		$strNomeBotao = "Editar";
		$strAutor = $_POST["txtAutor"];
		$intId = $_POST["hidId"];
	}

}elseif( isset($_POST["formExcluiAutor"]) && $_POST["formExcluiAutor"] === "true" ){
	$strFuncao = "Cadastra";
	$strNomeBotao = "Cadastrar";
	$strAssunto = "";
	$intId = "";
	
	$dados = $crud->delAutor($_POST["hidId"]);
	
	if($dados === true){
		//Recebe mensagem de erro
		$strMsg = "Excluído com sucesso.";

	}else{
		//Recebe mensagem de erro
		$strMsg = $dados;

	}
}

?>

<!--Formulário de cadastro/alteração de autor-->
<div class="container text-white">
	<div class="">
	<h3><?=$strFuncao?> Autor</h3>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off" enctype="multipart/form-data">
		<input type="hidden" name="<?=$strNomeForm?>" id="<?=$strNomeForm?>" value="true">
		<input type="hidden" name="hidId" id="hidId" value="<?=isset($intId) ? $intId : "" ?>">
		<label for="txtAutor">Nome:</label>
		<input type="text" class="form-control" name="txtAutor" id="txtAutor" value="<?=isset($strAutor) ? $strAutor : "" ?>" title="Autor com 40 caracteres" minlength="3" maxlength="40">
		<div class="my-3">
		<input type="submit" class="w3-button w3-blue" name="sbmLogin" id="sbmLogin" value="<?=$strNomeBotao?>">
		</div>
	</form>
	</div>
	<!--Área para a mensagem-->
	<?=isset($strMsg) ? "<div class='alert alert-warning text-center'>$strMsg</div>" : "" ?>
</div>

<?php

//Carrega Autores cadastrados e monta listagem com opções para edição e exclusão
$dados = $crud->getAutores();

echo "<div class='container'>";
echo '<input class="w3-input w3-border w3-padding" type="text" placeholder="Busca pelo nome ..." id="txtFiltro" onkeyup="filtro()">';

for($i=0;$i<count($dados);$i++ ) {
	echo $i === 0 ? "<table id='Autores' class='w3-table-all'><tr><th>Id</th><th>Nome</th><th class='w3-center'></th><th class='w3-center'></th></tr>" : "" ;
	echo "<tr><td>".$dados[$i]["codAu"] ."</td><td>".$dados[$i]["Nome"]."</td><td class='w3-center'>".$formulario->formEdita($dados[$i]["codAu"],$dados[$i]["Nome"],$strNomeFormE)."</td><td class='w3-center'>".$formulario->formExclui($dados[$i]["codAu"],$strNomeFormX)."</td></tr>";
	echo $i === count($dados)-1 ? "</table>" : "" ;
}
echo "</div>";

echo '
<script>
function filtro() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("txtFiltro");
  filter = input.value.toUpperCase();
  table = document.getElementById("Autores");
  tr = table.getElementsByTagName("tr");
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}
</script>
';


//-----Fim da área da página
//Carrega rodape
$rodape = new Rodape();
echo $rodape->getRodape();
?>