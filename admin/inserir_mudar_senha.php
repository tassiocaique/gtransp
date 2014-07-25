<?php
	
	//Verificação de todos os campos obrigatórios estão preenchidos
	if(isset($_POST['senha']) && isset($_POST['rsenha']) && isset($_POST['login']) && isset($_POST['asenha'])) {
		
		//recupera os valores que foram passados no formulário	
		$login = $_POST['login'];
		$login = str_replace(".", "",  $login);
		$login = str_replace("-", "", $login);
		$senha = $_POST['senha'];
		$rsenha = $_POST['rsenha'];
		$asenha = $_POST['senha'];
		$asenha = hash('whirlpool', $asenha);
		
		if(strcmp($senha, $rsenha) != 0) {
			header("location:mudar_senha.php?r=2");
		}
		
		$whirlpool = hash('whirlpool', $senha); //criptografa a senha
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_USUARIO');	
		//Comando de inserção do registro na tabela
		$query = $db->query("UPDATE $tabela SET `$tabela`.`senha`='$whirlpool' WHERE `$tabela`.`senha`='$asenha' AND `$tabela`.`cpf`='$login'") or die(mysql_error());
		
		if($query) {
			header("location:mudar_senha.php?r=1");
		} else {
			header("location:mudar_senha.php?r=0");
		}
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		header("location:mudar_senha.php?r=0");
	}

?>