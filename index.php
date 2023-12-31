<?php
session_start();
include( "config.php" );

//Carrega cabecalho
$cabecalho = new Cabecalho();
echo $cabecalho->getCabecalho();
?>
<div class="container">
	<div class="p-5 bg-primary text-white text-center">
		<div class="row">
			<h1><?=$_SESSION["nomeEmpresa"]?></h1>
		</div>
		<div class="row">
			<h3>Login para <?=$_SESSION["nomeSistema"]?></h3>
		</div>
	</div>
	<div class="m-5">
		<form method="post" action="autentica.php" autocomplete="off" enctype="multipart/form-data">
			<input type="hidden" name="formAutentica" id="formAutentica" value="true">
			<label for="txtUsuario" class="form-label">Usuario:</label>
			<input type="text" class="form-control" name="txtUsuario" id="txtUsuario" value="" title="Usuário do sistema" minlength="3" maxlength="10">
			<label for="pasUsuario" class="form-label">Senha:</label>
			<input type="password" class="form-control" name="pasUsuario" id="pasUsuario" value="" title="Senha do sistema" minlength="3" maxlength="20">
			<div class="mt-md-5">
				<input type="submit" class="btn btn-primary" name="sbmLogin" id="btnLogin" value="Autenticar">
			</div>
		</form>
	</div>
	<div class="alert alert-warning text-center">
<?php
		echo $_GET && $_GET["Erro"] === "1" ? "Usuário e/ou senha errado(s).<br>Usuário: <b>Fernando</b><br>senha <b>123456</b>" : "" ;
		echo $_GET && $_GET["Erro"] === "2" ? "Logoff realizado." : "" ;
		echo $_GET && $_GET["Erro"] === "3" ? "É necessário autenticação.<br>Usuário: <b>Fernando</b><br>senha <b>123456</b>" : "" ;
?>
	</div>
</div>

<?php
//Carrega rodape
$rodape = new Rodape();
echo $rodape->getRodape();
?>
