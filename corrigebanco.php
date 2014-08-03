<?php
		
	
		header('Content-Type: text/html; charset=utf-8');
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_NOTICIAS');	
		//Comando de inserção do registro na tabela
		$query = $db->query("ALTER TABLE  $tabela CHANGE  `cod_noticia`  `cod_noticia` VARCHAR( 30 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL") or die(mysql_error());
		$query = $db->query("ALTER TABLE  $tabela CHANGE  `corpo`  `corpo` LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL") or die(mysql_error());
		$tabela = Conexao::getTabela('TB_PAGINA');
		$query = $db->query("ALTER TABLE  $tabela CHANGE  `corpo`  `corpo` LONGTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ") or die(mysql_error());
		
		$tabela = Conexao::getTabela('TB_UPLOAD');
		$query = $db->query("ALTER TABLE  $tabela CHANGE  `detalhamento`  `detalhamento` MEDIUMTEXT CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL") or die(mysql_error());
		
		
		
		
		if($query) {
			echo "Altereções efetuadas com sucesso!";
		} else {
			echo "Ocorreu um erro!";
		}

	
	
?>