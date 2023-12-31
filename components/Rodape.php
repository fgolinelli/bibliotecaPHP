<?php
class Rodape{
	//Propriedades
	
	
	//Metodos
	function __construct() {
		//Guardar o fim do carregamento da página para estatísticas no rodapé
		$dthFimPagina = new DateTime;
	}
	
	function getRodape(){
?>
		</body>
		</html>
<?php
	}
}
?>