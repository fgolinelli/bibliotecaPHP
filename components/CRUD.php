<?php
class CRUD{
	//Propriedades
	private $strNomeBD;
	private $strNomeUsuario;
	private $strPass;
	private $conexao;
	
	//Metodos
	function __construct() {
		$this->strNomeBD = "u553825348_CadastroLivros";
		$this->strNomeUsuario = "u553825348_CadastroLivros";
		$this->strPass = "G3:rWaY4";
		$this->conecta();
	}
	
	function conecta(){
		try {
			$this->conexao = new PDO('mysql:host=localhost;dbname=' . $this->strNomeBD . ';charset=utf8', $this->strNomeUsuario, $this->strPass);
			$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			//Se houver problema na conexão, exibe a mensagem
			exit('Falha na conexão com o BD!<br>'.$e->getMessage().'');
		}
	}
	
	function getAutor($intId){
		
		try {
			
			$stmt = $this->conexao->prepare('SELECT * FROM Autor WHERE codAu = :id ;');
			$stmt->execute(array(':id' => $intId));
			$dados = $stmt->fetchAll();
			
			return $dados;
		
		} catch(PDOException $e) {
			exit('Falha ao buscar autor!<br>'.$e->getMessage().'');
		}
	}
	
	function getAutores(){
		
		try {
		
			$stmt = $this->conexao->prepare('SELECT * FROM Autor;');
			$stmt->execute();
			$dados = $stmt->fetchAll();
			
			return $dados;
			
		} catch(PDOException $e) {
			exit('Falha ao buscar autores!<br>'.$e->getMessage().'');
		}
	}
	
	function addAutor($strNomeAutor){
		
		try {
		
			$stmt = $this->conexao->prepare("INSERT INTO Autor (Nome) VALUES (:NomeAutor);");
			$stmt->execute(array(':NomeAutor' => $strNomeAutor));
			
			return true;
		
		} catch(PDOException $e) {
			exit('Falha ao adicionar autor!<br>'.$e->getMessage().'');
		}
	}
	
	function setAutor($intId,$strNome){
		
		try {
		
			$stmt = $this->conexao->prepare('UPDATE Autor SET Nome = :nome WHERE codAu = :id ;');
			$stmt->execute(array(':nome' => $strNome,':id' => $intId));
					
			return true;
			
		} catch(PDOException $e) {
			exit('Falha para alterar autor!<br>'.$e->getMessage().'');
		}
	}
	
	function delAutor($intId){
		
		try {
		
			$stmt = $this->conexao->prepare('DELETE FROM Autor WHERE codAu = :id ;');
			$stmt->execute(array(':id' => $intId));
					
			return true;
			
		} catch(PDOException $e) {
			exit('Falha ao deletar autor!<br>'.$e->getMessage().'');
		}
	}
	
	function quantidadeAutores(){
		
		try {
		
			$stmt = $this->conexao->prepare('SELECT count(CodAu) As quantidade FROM Autor;');
			$stmt->execute();
			$dados = $stmt->fetchAll();
			
			return $dados[0]["quantidade"];
			
		} catch(PDOException $e) {
			exit('Falha ao buscar a quantidade de autores!<br>'.$e->getMessage().'');
		}
	}
	
	function getAssunto($intId){
		
		try {
			
			$stmt = $this->conexao->prepare('SELECT * FROM Assunto WHERE codAs = :id ;');
			$stmt->execute(array(':id' => $intId));
			$dados = $stmt->fetchAll();
			
			return $dados;
		
		} catch(PDOException $e) {
			exit('Falha ao buscar assunto!<br>'.$e->getMessage().'');
		}
	}
	
	function getAssuntos(){
		
		try {
		
			$stmt = $this->conexao->prepare('SELECT * FROM Assunto;');
			$stmt->execute();
			$dados = $stmt->fetchAll();
			
			return $dados;
			
		} catch(PDOException $e) {
			exit('Falha ao buscar assuntos!<br>'.$e->getMessage().'');
		}
	}
	
	function addAssunto($strDescricao){
		
		try {
		
			$stmt = $this->conexao->prepare("INSERT INTO Assunto (Descricao) VALUES (:Descricao);");
			$stmt->execute(array(':Descricao' => $strDescricao));
			
			return true;
		
		} catch(PDOException $e) {
			return ('Falha ao adicionar assunto!<br>'.$e->getMessage().'');
		}
	}
	
	function setAssunto($intId,$strDescricao){
		
		try {
		
			$stmt = $this->conexao->prepare('UPDATE Assunto SET Descricao = :Descricao WHERE codAs = :id ;');
			$stmt->execute(array(':Descricao' => $strDescricao,':id' => $intId));
					
			return true;
			
		} catch(PDOException $e) {
			return ('Falha para alterar assunto!<br>'.$e->getMessage().'');
		}
	}
	
	function delAssunto($intId){
		
		try {
		
			$stmt = $this->conexao->prepare('DELETE FROM Assunto WHERE codAs = :id ;');
			$stmt->execute(array(':id' => $intId));
					
			return true;
			
		} catch(PDOException $e) {
			return('Falha ao deletar assunto!<br>'.$e->getMessage().'');
		}
	}
	
	function quantidadeAssuntos(){
		
		try {
		
			$stmt = $this->conexao->prepare('SELECT count(CodAs) As quantidade FROM Assunto;');
			$stmt->execute();
			$dados = $stmt->fetchAll();
			
			return $dados[0]["quantidade"];
			
		} catch(PDOException $e) {
			exit('Falha ao buscar a quantidade de assuntos!<br>'.$e->getMessage().'');
		}
	}
	
	function getLivro($intId){
		
		try {
			
			$stmt = $this->conexao->prepare('
				SELECT t1.* , t2.Autor_codAu, t3.Assunto_codAs 
				FROM Livro AS t1
				INNER JOIN Livro_Autor AS t2 ON t2.Livro_codl = t1.codl 
				INNER JOIN Livro_Assunto AS t3 ON t3.Livro_codl = t1.codl
				WHERE t1.codl = :id 
				;');
			$stmt->execute(array(':id' => $intId));
			$dados = $stmt->fetchAll();
			
			return $dados;
		
		} catch(PDOException $e) {
			exit('Falha ao buscar assunto!<br>'.$e->getMessage().'');
		}
	}
	
	function getLivros(){
		
		try {
		
			$stmt = $this->conexao->prepare('SELECT t1.*, t3.Nome AS Autor, t5.Descricao AS Assunto
										FROM Livro AS t1
										INNER JOIN Livro_Autor AS t2 ON t2.Livro_Codl = t1.codl 
										INNER JOIN Autor AS t3 ON t3.codAu = t2.Autor_codAu
										INNER JOIN Livro_Assunto AS t4 ON t4.Livro_Codl = t1.codl 
										INNER JOIN Assunto AS t5 ON t5.codAs = t4.Assunto_codAs
										;');
			$stmt->execute();
			$dados = $stmt->fetchAll();
			
			return $dados;
			
		} catch(PDOException $e) {
			exit('Falha ao buscar assuntos!<br>'.$e->getMessage().'');
		}
	}
	
	
	function addLivro($VDados){
		
		try {
		
			$this->conexao->beginTransaction();
		
				$stmt = $this->conexao->prepare("INSERT INTO Livro (Titulo, Editora, Edicao, AnoPublicacao) VALUES (:Titulo, :Editora, :Edicao, :AnoPublicacao);");
				
				$stmt->execute(array(':Titulo' => $VDados["Titulo"],':Editora' => $VDados["Editora"],':Edicao' => $VDados["Edicao"],':AnoPublicacao' => $VDados["AnoPublicacao"]));

				$intIdLivro = $this->conexao->lastInsertId();
				
				$stmt = $this->conexao->prepare("INSERT INTO Livro_Autor (Livro_codl, Autor_codAu) VALUES (:CodLivro, :CodAutor);");
				
				$stmt->execute(array(':CodLivro' => $intIdLivro,':CodAutor' => $VDados["codAu"]));
				
				$stmt = $this->conexao->prepare("INSERT INTO Livro_Assunto (Livro_codl, Assunto_codAs) VALUES (:CodLivro, :CodAssunto);");
				
				$stmt->execute(array(':CodLivro' => $intIdLivro,':CodAssunto' => $VDados["codAs"]));
			
			$this->conexao->commit();

			return true;
		
		} catch(PDOException $e) {
			
			$stmt->rollback();
			
			exit('Falha ao adicionar livro!<br>'.$e->getMessage().'');
		}
	}
	
	function delLivro($intId){
		
		try {
		
			$this->conexao->beginTransaction();
			
				$stmt = $this->conexao->prepare('DELETE FROM Livro_Assunto WHERE Livro_codl = :id ;');
				
				$stmt->execute(array(':id' => $intId));
				
				$stmt = $this->conexao->prepare('DELETE FROM Livro_Autor WHERE Livro_codl = :id ;');
								
				$stmt->execute(array(':id' => $intId));
				
				$stmt = $this->conexao->prepare('DELETE FROM Livro WHERE codl = :id ;');
				
				$stmt->execute(array(':id' => $intId));
			
			$this->conexao->commit();

			return true;
		
		} catch(PDOException $e) {
			
			$stmt->rollback();
			
			exit('Falha ao adicionar livro!<br>'.$e->getMessage().'');
		}
	}
	
	
	function setLivro($VDados){
		
		try {
		
			$this->conexao->beginTransaction();
	
				$stmt = $this->conexao->prepare("UPDATE Livro AS t1 
													INNER JOIN Livro_Autor AS t2 ON t2.Livro_codl = t1.codl
													INNER JOIN Livro_Assunto AS t3 ON t3.Livro_codl = t1.codl
													SET t1.Titulo = :Titulo, 
														t1.Editora = :Editora, 
														t1.Edicao = :Edicao, 
														t1.AnoPublicacao = :AnoPublicacao,
														t2.Autor_codAu = :codAu,
														t3.Assunto_codAs = :codAs
													WHERE t1.codl = :codl
													;");
				
				$stmt->execute(array(':Titulo' => $VDados["Titulo"],':Editora' => $VDados["Editora"],':Edicao' => $VDados["Edicao"],':AnoPublicacao' => $VDados["AnoPublicacao"],':codAu' => $VDados["codAu"],':codAs' => $VDados["codAs"],':codl' => $VDados["codl"]));
			
			$this->conexao->commit();

			return true;
		
		} catch(PDOException $e) {
			
			$stmt->rollback();
			
			exit('Falha ao alterar livro!<br>'.$e->getMessage().'');
		}
	}
}
?>