<?php
	session_start();
	
	if (isset($_POST['titulo']) && isset($_POST['corpo']))	{	
		
		//recupera os valores que foram passados no formulário		
		$titulo = $_POST['titulo'];
		$corpo = $_POST['corpo'];
		
		$cod_controle = $_POST['cod_controle'];
		$identificacao = $_POST['identificacao'];
		$cpf_usuario = $_SESSION['login'];
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_PAGINA');
		//Comando de inserção do registro na tabela
		$query = $db->query("INSERT INTO $tabela(cpf_usuario, titulo, corpo, identificacao)
		                                  VALUES ('$cpf_usuario', '$titulo', '$corpo', '$identificacao')")or die(mysql_error());
										  
		$query2 = $db->query("UPDATE $tabela SET visivel = 0 WHERE cod_controle='$cod_controle'");
		
		if ($query && $query2) {
			header("location:editar_pagina.php?r=1&id=".$identificacao);
		} else {
			header("location:editar_pagina.php?r=0&id=".$identificacao);
		}
		
	} else {
		echo "Algum campo não foi preenchido";
	}
?>