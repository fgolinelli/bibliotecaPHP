<?php
class Formulario{
	//Propriedades
	
	//Metodos
	function __construct() {
	}
	
	function formEdita($intId,$strNome,$strNomeForm){
		
		$dados = "<form method='post' action='". htmlspecialchars($_SERVER["PHP_SELF"])."' autocomplete='off' enctype='multipart/form-data'>
					<input type='hidden' name='$strNomeForm' id='$strNomeForm' value='true'>
					<input type='hidden' name='hidId' id='hidId' value='$intId'>
					<input type='hidden' name='hidNome' id='hidNome' value='$strNome'>
					<input type='submit' class='w3-button w3-tiny w3-blue' name='sbmEnviar' id='sbmEnviar' value='E'>
				</form>";
		
		return $dados;
	}
	
	function formExclui($intId,$strNomeForm){
		
		$dados = "<form method='post' action='". htmlspecialchars($_SERVER["PHP_SELF"])."' autocomplete='off' enctype='multipart/form-data'>
					<input type='hidden' name='$strNomeForm' id='$strNomeForm' value='true'>
					<input type='hidden' name='hidId' id='hidId' value='$intId'>
					<input type='submit' class='w3-button w3-tiny w3-red' name='sbmEnviar' id='sbmEnviar' value='X'>
				</form>";
		
		return $dados;
	}

	function FormGestaoLivro($strNomeForm,$strNomeBotao,$intId,$strTitulo,$strEditora,$intEdicao,$strAno,$strSelectAutor,$strSelectAssunto){
		$dados = "
				<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."' autocomplete='off' enctype='multipart/form-data'>
					<input type='hidden' name='$strNomeForm' id='$strNomeForm' value='true'>
					<input type='hidden' name='hidId' id='hidId' value='$intId'>
					<div class='container'>
						<div class='row'>
							<div class='col-6'>
								<label for='txtTitulo'>Titulo:</label>
								<input type='text' class='form-control' name='txtTitulo' id='txtTitulo' value='$strTitulo' title='Máximo de 40 caracteres' minlength='3' maxlength='40' required>
							</div>
							<div class='col-6'>
							<label for='txtEditora'>Editora:</label>
							<input type='text' class='form-control' name='txtEditora' id='txtEditora' value='$strEditora' title='Máximo com 40 caracteres' minlength='3' maxlength='40' required>
							</div>
							<div class='col-6'>
							<label for='numEdicao'>Edição:</label>
							<input type='number' class='form-control' name='numEdicao' id='numEdicao' value='$intEdicao' title='Numérico entre 1 e 999' min='1' max='999' required>
							</div>
							<div class='col-6'>
							<label for='txtAno'>Ano de publicação:</label>
							<input type='text' class='form-control' name='txtAno' id='txtAno' value='$strAno' title='Ano de publicação com 4 números' minlength='4' maxlength='4' required>
							</div>
							<div class='col-6'>
							<label for='slcAutor'>Autor:</label>
							<select name='slcAutor' id='slcAutor' class='form-select form-select-lg mb-3' required>
								<option value=''></option>
								$strSelectAutor
							</select>
							</div>
							<div class='col-6'>
							<label for='txtAssunto'>Assunto:</label>
							<select name='slcAssunto' id='slcAssunto' class='form-select form-select-lg mb-3' required>
								<option value=''></option>
								$strSelectAssunto
							</select>
							</div>
							<div class='col-6 my-5'>
								<input type='submit' class='btn btn-primary' name='sbmEnviar' id='sbmEnviar' value='$strNomeBotao'>
							</div>
						</div>
					</div>
				</form>
		";
		
		return $dados;
	}
	
	function FormSelecaoRelatorios($strSelectRel){
		
		return $dados = "
				<form method='post' action='".htmlspecialchars($_SERVER["PHP_SELF"])."' autocomplete='off' enctype='multipart/form-data'>
					<div class='container'>
						<div class='row'>
							<div class='col-12'>
							<label for='slcRel'>Relatórios:</label>
							<select name='slcRel' id='slcRel' class='form-select form-select-lg mb-3' required>
								$strSelectRel
							</select>
							</div>
							<div class='col-6 my-2'>
								<input type='submit' class='btn btn-primary' name='sbmEnviar' id='sbmEnviar' value='Carregar'>
							</div>
						</div>
					</div>
				</form>
		";
	}
}
?>