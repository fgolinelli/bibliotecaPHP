<?php
//Base de dados MySQL
/*
create table Livro (
  codl int auto_increment not null primary key,
  Titulo varchar(40),
  Editora varchar(40),
  Edicao int,
  AnoPublicacao varchar(4)
);

create table Autor (
  codAu int auto_increment not null primary key,
  Nome varchar(40)
);

create table Assunto (
  codAs int auto_increment not null primary key,
  Descricao varchar(20)
);

create table Livro_Autor (
  Livro_codl int,
  Autor_codAu int,
  foreign key (Livro_codl ) references Livro(codl),
  foreign key (Autor_codAu) references Autor(codAu)
);

create table Livro_Assunto (
  Livro_codl int,
  Assunto_codAs int,
  foreign key (Livro_codl ) references Livro(codl),
  foreign key (Assunto_codAs) references Assunto(codAs)
);
*/

//Dados de acesso
$strDB = "NomeBD";
$strDBUsuario = "UsuBD";
$strDBPass = "Pas";

//Dados da empresa
$_SESSION["nomeEmpresa"] = "Livraria Geek";

//Dados do sistema
$_SESSION["nomeSistema"] = "Gestão de Livros";

//Tempo de sessão
$_SESSION["tempoLimiteSessao"] = 30;

//Caminhos
$_SESSION["CaminhoExterno"] = dirname(dirname(__FILE__))."/Biblioteca";

//Classes
include( $_SESSION["CaminhoExterno"]."/components/Cabecalho.php" );
include( $_SESSION["CaminhoExterno"]."/components/Rodape.php" );
include( $_SESSION["CaminhoExterno"]."/components/Menu.php" );
include( $_SESSION["CaminhoExterno"]."/components/CRUD.php" );
include( $_SESSION["CaminhoExterno"]."/components/Autor.php" );
include( $_SESSION["CaminhoExterno"]."/components/Formulario.php" );
include( $_SESSION["CaminhoExterno"]."/components/Assunto.php" );
include( $_SESSION["CaminhoExterno"]."/components/Livro.php" );
include( $_SESSION["CaminhoExterno"]."/components/Impressao.php" );
?>