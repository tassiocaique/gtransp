<?php
	
	session_start();
	
	//Verificação de todos os campos obrigatórios estão preenchidos
	if (isset($_POST['titulo']) && isset($_POST['corpo']) && isset($_POST['cod_controle']) && isset($_POST['cod_noticia']))	{	
		
		//recupera os valores que foram passados no formulário		
		$titulo = $_POST['titulo'];
		$corpo = $_POST['corpo'];
		$cod_controle = $_POST['cod_controle'];
		$cod_noticia = $_POST['cod_noticia'];
		
		//Verifica se o campo não obrigatório categorias foi preenchido
		if (isset($_POST['categorias'])) {//Se sim, recupera o valor
			$categorias = $_POST['categorias'];
		} else {//Se não, atribui a ele um valor padrão
			$categorias = "sem categoria";
		}
		
		//recupera o CPF do usuário da sessão
		$cpf_usuario = $_SESSION['login'];
				
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_NOTICIAS');
		//Comando de inserção do registro na tabela
		$query = $db->query("INSERT INTO $tabela(cpf_usuario, titulo, corpo, categorias, cod_noticia, editado)
		                                  VALUES ('$cpf_usuario', '$titulo', '$corpo', '$categorias', '$cod_noticia', 1)")or die(mysql_error());
		
		$id = $db->lastInsertId('cod_controle');
		
		$query2 = $db->query("UPDATE $tabela SET editado = 1, visivel = 0 WHERE cod_controle='$cod_controle' AND cod_noticia='$cod_noticia'") or die(mysql_error());
		
		
		if ($query && $query2) {
			header("location:editar_noticia.php?r=1&ctl=".$id);
		} else {
			header("location:editar_noticia.php?r=2");
		}
		
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		header("location:editar_noticia.php?r=0");
	}


?>
