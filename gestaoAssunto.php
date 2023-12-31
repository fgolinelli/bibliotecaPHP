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
$strNomeForm = "formCadastraAssunto";
$strNomeFormE = "formEditaAssunto";
$strNomeFormX = "formExcluiAssunto";

//Instancia CRUD / Formulario
$crud = new CRUD();
$formulario = new Formulario();

//Se houver cadastro de assunto
if( isset($_POST["formCadastraAssunto"]) && $_POST["formCadastraAssunto"] === "true" ){
	
	$VRequest = $_POST;
	$strAssunto = isset($VRequest["txtAssunto"]) ? trim($VRequest["txtAssunto"]) : "" ;
	
	//Carrega Assunto
	$assunto = new Assunto();
	//Valida dados para cadastro
	$respostaAssunto = $assunto->valida($strAssunto);
	
	//Se validado com sucesso
	if ( $respostaAssunto === true ){
		
		//Cadastra Assunto
		$dados = $crud->addAssunto($strAssunto);
		
		//Elimina variável para não exibir mensagem de erro
		unset($strAssunto);
		
		//Recebe mensagem de erro
		$strMsg = "Cadastro realizado.";

	}else{
		//Recebe mensagem de erro
		$strMsg = $respostaAssunto;
	}
}elseif( isset($_POST["formEditaAssunto"]) && $_POST["formEditaAssunto"] === "true" ){
	$strFuncao = "Edita";
	$strNomeBotao = "Editar";
	$strNomeForm = "formEditaAssunto2";
	$strAssunto = $_POST["hidNome"];
	$intId = $_POST["hidId"];
}elseif( isset($_POST["formEditaAssunto2"]) && $_POST["formEditaAssunto2"] === "true" ){

	$dados = $crud->setAssunto($_POST["hidId"],trim($_POST["txtAssunto"]));
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
		$strAssunto = $_POST["txtAssunto"];
		$intId = $_POST["hidId"];
	}

}elseif( isset($_POST["formExcluiAssunto"]) && $_POST["formExcluiAssunto"] === "true" ){
	$strFuncao = "Cadastra";
	$strNomeBotao = "Cadastrar";
	$strAssunto = "";
	$intId = "";
	
	$dados = $crud->delAssunto($_POST["hidId"]);
	
	if($dados === true){
		//Recebe mensagem de erro
		$strMsg = "Excluído com sucesso.";

	}else{
		//Recebe mensagem de erro
		$strMsg = $dados;

	}
}

?>

<!--Formulário de cadastro/alteração de assunto-->
<div class="container text-white">
	<div class="">
		<h3><?=$strFuncao?> Assunto</h3>
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="<?=$strNomeForm?>" id="<?=$strNomeForm?>" value="true">
			<input type="hidden" name="hidId" id="hidId" value="<?=isset($intId) ? $intId : "" ?>">
			<label for="txtAssunto">Descrição:</label>
			<input type="text" class="form-control" name="txtAssunto" id="txtAssunto" value="<?=isset($strAssunto) ? $strAssunto : "" ?>" title="Assunto com 20 caracteres" minlength="3" maxlength="20">
			<div class="my-3">
			<input type="submit" class="w3-button w3-blue" name="sbmLogin" id="sbmLogin" value="<?=$strNomeBotao?>">
			</div>
		</form>
	</div>
	<!--Área para a mensagem-->
	<?=isset($strMsg) ? "<div class='alert alert-warning text-center'>$strMsg</div>" : "" ?>
	
</div>
<?php

//Carrega Assuntos cadastrados e monta listagem com opções para edição e exclusão
$dados = $crud->getAssuntos();

echo "<div class='container'>";
echo '<input class="w3-input w3-border w3-padding" type="text" placeholder="Busca pela descrição ..." id="txtFiltro" onkeyup="filtro()">';

for($i=0;$i<count($dados);$i++ ) {
	echo $i === 0 ? "<table id='Assuntos' class='w3-table-all'><tr><th>Id</th><th>Descrição</th><th class='w3-center'></th><th class='w3-center'></th></tr>" : "" ;
	echo "<tr><td>".$dados[$i]["codAs"] ."</td><td>".$dados[$i]["Descricao"]."</td><td class='w3-center'>".$formulario->formEdita($dados[$i]["codAs"],$dados[$i]["Descricao"],$strNomeFormE)."</td><td class='w3-center'>".$formulario->formExclui($dados[$i]["codAs"],$strNomeFormX)."</td></tr>";
	echo $i === count($dados)-1 ? "</table>" : "" ;
}
echo "</div>";

echo '
<script>
function filtro() {
  var input, filter, table, tr, td, i;
  input = document.getElementById("txtFiltro");
  filter = input.value.toUpperCase();
  table = document.getElementById("Assuntos");
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