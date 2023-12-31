<?php
class Menu{
	//Propriedades
	
	
	//Metodos
	function __construct() {

	}
	
	function getMenu(){
?>

		<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
		  <div class="container-fluid">
			<a class="navbar-brand" href="home.php">Home</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="collapsibleNavbar">
			  <ul class="navbar-nav">
				<li class="nav-item btn btn-primary" style="width: 100px;">
				  <a class="nav-link" href="gestaoLivro.php" style="text-decoration: none;">Livro</a>
				</li>  
				<li class="nav-item btn btn-primary" style="width: 100px;">
				  <a class="nav-link" href="gestaoAssunto.php" style="text-decoration: none;">Assunto</a>
				</li>
				<li class="nav-item btn btn-primary" style="width: 100px;">
				  <a class="nav-link" href="gestaoAutor.php" style="text-decoration: none;">Autor</a>
				</li>   
				<li class="nav-item btn btn-primary" style="width: 100px;">
				  <a class="nav-link" href="relatorios.php" style="text-decoration: none;">Relatórios</a>
				</li>  
				<li class="nav-item btn btn-danger" style="width: 100px;">
				  <a class="nav-link" href="logoff.php" style="text-decoration: none;">Sair</a>
				</li>  
			  </ul>
			</div>
		  </div>
		</nav>
		
<?php
	}
}
?>