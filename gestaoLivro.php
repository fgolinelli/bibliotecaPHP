<?php
session_start();
include( "config.php" );

//Carrega cabecalho
$cabecalho = new Cabecalho();
echo $cabecalho->getCabecalho();
//-----Início da área da página

//Receber dados do form
if( count($_POST) > 0 ){
	if( $_POST["sbmEnviar"] === "Cadastrar" ){
		
		//Preparar dados
		$VDados = array(
			"Titulo"=>$_POST["txtTitulo"],
			"Editora"=>$_POST["txtEditora"],
			"Edicao"=>$_POST["numEdicao"],
			"AnoPublicacao"=>$_POST["txtAno"],
			"codAu"=>$_POST["slcAutor"],
			"codAs"=>$_POST["slcAssunto"]
		);

		//Carregar CRUD
		$crud = new CRUD();
		//Cadasrar livro
		if( $crud->addLivro($VDados) === true ){
			$strMsg = "Cadastro realizado.";
		}
		
	}
	if( $_POST["sbmEnviar"] === "E" ){
		
		$intId = $_POST["hidId"];
		
		//Carregar CRUD
		$crud = new CRUD();
		//Busca dados do livro
		$VDados = $crud->getLivro($intId);

		//Dados para carregar o formulário principal para EDIÇÃO
		$strNomeForm = "formEditaLivro";
		$strNomeBotao = "Editar";
		$intId = $VDados[0]["codl"];
		$strTitulo = $VDados[0]["Titulo"];
		$strEditora = $VDados[0]["Editora"];
		$intEdicao = $VDados[0]["Edicao"];
		$strAno = $VDados[0]["AnoPublicacao"];
		$intCodAutor = $VDados[0]["Autor_codAu"];
		$intCodAssunto = $VDados[0]["Assunto_codAs"];
	}
	if( $_POST["sbmEnviar"] === "Editar" ){
		
		//print_r($_POST);
		
		//Preparar dados
		$VDados = array(
			"codl"=>$_POST["hidId"],
			"Titulo"=>$_POST["txtTitulo"],
			"Editora"=>$_POST["txtEditora"],
			"Edicao"=>$_POST["numEdicao"],
			"AnoPublicacao"=>$_POST["txtAno"],
			"codAu"=>$_POST["slcAutor"],
			"codAs"=>$_POST["slcAssunto"]
		);

		//Carregar CRUD
		$crud = new CRUD();
		//Cadasrar livro
		if( $crud->setLivro($VDados) === true ){
			$strMsg = "Cadastro realizado.";
		}

	}
	if( $_POST["sbmEnviar"] === "X" ){
		//Carregar CRUD
		$crud = new CRUD();
		//Cadasrar livro
		if( $crud->delLivro($_POST["hidId"]) === true ){
			$strMsg = "Exclusão realizada.";
		}
	}
}

//Carrega CRUD
$crud = new CRUD();

//Dados para carregar o formulário principal
$strNomeForm = isset($strNomeForm) ? $strNomeForm : "formCadastraLivro";
$strNomeBotao = isset($strNomeBotao) ? $strNomeBotao : "Cadastrar";
$intId = isset($intId) ? $intId : "";
$strTitulo = isset($strTitulo) ? $strTitulo : "";
$strEditora = isset($strEditora) ? $strEditora : "";
$intEdicao = isset($intEdicao) ? $intEdicao : "";
$strAno = isset($strAno) ? $strAno : "";
$intCodAutor = isset($intCodAutor) ? $intCodAutor : "";
$intCodAssunto = isset($intCodAssunto) ? $intCodAssunto : "";
		
//Titulo do formulário que poderá ser alterado conforme necessidade
$strFuncao = "Cadastra";

//Dados dos formulários para edição e exclusão
$strNomeFormE = "formEditaLivro";
$strNomeFormX = "formExcluiLivro";

//Carrega Formulário principal
$formulario = new Formulario();
echo "<div class='text-white'>";
echo $formulario->FormGestaoLivro($strNomeForm,$strNomeBotao,$intId,$strTitulo,$strEditora,$intEdicao,$strAno,FMontaSelectAutor($intCodAutor),FMontaSelectAssunto($intCodAssunto));
echo "</div>";

//Área para a mensagem
echo isset($strMsg) ? "<div class='alert alert-warning text-center'>$strMsg</div>" : "" ;

//Carrega Assuntos cadastrados e monta listagem com opções para edição e exclusão
$dados = $crud->getLivros();

echo "<div class='container'>";

echo '<input class="w3-input w3-border w3-padding" type="text" placeholder="Busca pelo título ..." id="txtFiltro" onkeyup="filtro()">';

for($i=0;$i<count($dados);$i++ ) {
	echo $i === 0 ? "<table id='Assuntos' class='w3-table-all'><tr><th>Id</th><th>Título</th><th>Editora</th><th>Edição</th><th>Ano</th><th class='w3-center'></th><th class='w3-center'></th></tr>" : "" ;
	echo "<tr><td>".$dados[$i]["codl"] ."</td><td>".$dados[$i]["Titulo"]."</td><td>".$dados[$i]["Editora"]."</td><td>".$dados[$i]["Edicao"]."</td><td>".$dados[$i]["AnoPublicacao"]."</td><td class='w3-center'>".$formulario->formEdita($dados[$i]["codl"],$dados[$i]["Titulo"],$strNomeFormE)."</td><td class='w3-center'>".$formulario->formExclui($dados[$i]["codl"],$strNomeFormX)."</td></tr>";
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





//Para formulário principal
function FMontaSelectAutor($intCodAutor = null){
	
	$crud = new CRUD();
	$VAutores = $crud->getAutores();
	
	$dados = "";
	
	for($i=0;$i<count($VAutores);$i++){
		$selecionado = $intCodAutor === $VAutores[$i]["codAu"] ? "selected" : "" ;
		$dados .= "<option value='".$VAutores[$i]["codAu"]."' $selecionado>".$VAutores[$i]["Nome"]."</option>";
	}
	return $dados;
}

//Para formulário principal
function FMontaSelectAssunto($intCodAssunto = null){
	
	$crud = new CRUD();
	$VAssuntos = $crud->getAssuntos();
	
	$dados = "";
	
	for($i=0;$i<count($VAssuntos);$i++){
		$selecionado = $intCodAssunto === $VAssuntos[$i]["codAs"] ? "selected" : "" ;
		$dados .= "<option value='".$VAssuntos[$i]["codAs"]."' $selecionado>".$VAssuntos[$i]["Descricao"]."</option>";
	}
	return $dados;
}
?>