<?php
class Livro{
	//Propriedades
	
	//Metodos
	function __construct() {

	}
	
	function valida($VDados){

		if( strlen($VDados["txtTitulo"]) < 3 || strlen($VDados["txtTitulo"]) > 40 ){
			return "Mínimo de três e máximo de 40 caracteres.";
		}
		
		if( strlen($VDados["txtEditora"]) < 3 || strlen($VDados["txtEditora"]) > 40 ){
			return "Mínimo de três e máximo de 40 caracteres.";
		}
		
		if( !is_numeric($VDados["numEdicao"]) ){
			return "Apenas valor numérico.";
		}
		
		if( strlen($VDados["txtAno"]) <> 4 || !is_numeric($VDados["txtAno"])){
			return "Apenas valor numérico.";
		}
		
		return true;
	}
}
?>