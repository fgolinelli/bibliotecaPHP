<?php
class Autor{
	//Propriedades
	
	//Metodos
	function __construct() {

	}
	
	function valida($strAutor){
		if( strlen($strAutor) < 3 ){
			return "Mínimo de três caracteres.";
		}
		if( strlen($strAutor) > 40 ){
			return "Máximo de 40 caracteres.";
		}
		return true;
	}
}
?>