<?php
class Impressao{
	//Propriedades
	
	//Metodos
	function __construct() {

	}
	
	function getBotao($Descricao){
		//Para o botão funcionar, o que será impresso precisa estar envolvido na div abaixo
		//<div id='print' class='conteudo'>
		//</div>
		//$dados = "<input type='button' onclick='cont();' value='$Descricao'>";
		$dados = "<button type='button' class='btn btn-secondary' onclick='cont();'>$Descricao</button>";
		$dados .= "
			<script>
			function cont(){
			   var conteudo = document.getElementById('print').innerHTML;
			   tela_impressao = window.open('about:blank');
			   tela_impressao.document.write(conteudo);
			   tela_impressao.window.print();
			   tela_impressao.window.close();
			}
			</script>
		";
		return $dados;
	}
}
?>