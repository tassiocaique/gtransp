<?php
	
	//Verificação de todos os campos obrigatórios estão preenchidos
	if(isset($_POST['nome']) && isset($_POST['senha']) && isset($_POST['rsenha']) && isset($_POST['login']) && isset($_POST['departamento'])) {
		
		//recupera os valores que foram passados no formulário		
		$nome = $_POST['nome'];
		$login = $_POST['login'];
		$login = str_replace(".", "",  $login);
		$login = str_replace("-", "", $login);
		$senha = $_POST['senha'];
		$rsenha = $_POST['rsenha'];
		
		if(strcmp($senha, $rsenha) != 0) {
			header("location:novo_usuario.php?r=2");
		}
		
		$whirlpool = hash('whirlpool', $senha); //criptografa a senha
		$permissao = $_POST['nivel_permissao'];
		$dpto = $_POST['departamento'];
		
		//Verifica se o usuário foi definido como administrador
		if (strcmp($permissao, "admin") == 0) { //Se sim, define o valor do campo como 1
			$perm = '1';
		} else { //Se não, define o valor do campo como 0
			$perm = '0';
		}
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_USUARIO');	
		//Comando de inserção do registro na tabela
		$query = $db->query("INSERT INTO $tabela(nome, cpf, senha, departamento, nivel_permissao) VALUES('$nome', '$login', '$whirlpool', '$dpto', '$perm')") or die(mysql_error());
		
		if($query) {
			header("location:novo_usuario.php?r=1");
		} else {
			header("location:novo_usuario.php?r=0");
		}
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		header("location:novo_usuario.php?r=0");
	}

?>