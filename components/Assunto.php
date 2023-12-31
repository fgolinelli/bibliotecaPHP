<?php
class Assunto{
	//Propriedades
	
	//Metodos
	function __construct() {

	}
	
	function valida($strDescricao){
		if( strlen($strDescricao) < 3 ){
			return "Mínimo de três caracteres.";
		}
		if( strlen($strDescricao) > 20 ){
			return "Máximo de 40 caracteres.";
		}
		return true;
	}
}
?>