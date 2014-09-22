<?php
		
		header('Content-Type: text/html; charset=utf-8');
		
		$login = "admin";
		$whirlpool = hash('whirlpool', "admin"); //criptografa a senha
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_USUARIO');	
		//Comando de inserção do registro na tabela
		$query = $db->query("INSERT INTO $tabela(nome, cpf, senha, departamento, nivel_permissao) VALUES('Administrador', '$login', '$whirlpool', 'Administrador', '1')") or die(mysql_error());
		
		if($query) {
			echo "Usuário inserido com sucesso! Você já pode acessar <a href='admin'> painel de adminitração</a> do GTransp";
		} else {
			echo "Ocorreu um erro!";
		}


?>