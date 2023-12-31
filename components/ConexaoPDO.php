<?php
class ConexaoPDO{
	//Propriedades
	private $strNomeBD;
	private $strNomeUsuario;
	private $strPass;
	
	//Metodos
	function __construct() {
		$this->strNomeBD = "u553825348_CadastroLivros";
		$this->strNomeUsuario = "u553825348_CadastroLivros";
		$this->strPass = "G3:rWaY4";
	}
	
	function conecta(){
		try {
			$conexao = new PDO('mysql:host=localhost;dbname=' . $this->strNomeBD . ';charset=utf8', $this->strNomeUsuario, $this->strPass);
			return $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $exception) {
			//Se houver problema na conexão, exibe a mensagem
			exit('Falha na conexão com o BD!');
		}
	}
}
?>