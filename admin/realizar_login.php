<!--

Copyright 2014 - Aplicativaria - Gestão e Desenvolvimento de Soluções Móveis <www.aplicativaria.com>, 
Programa de Formação de Agentes para Sustentabilidade do Software Público Brasileiro (PRO-SPB) <spb.univasf.edu.br> - Universidade Federal do Vale do São Francisco.
Desenvolvedores: Tássio Caique Dias Freire <tassiok2@gmail.com>, João Paulo dos Santos Nascimento Castro <joaopaulosncastro@gmail.com>.

Este arquivo é parte do programa G-Transp - Gerenciador de Conteúdo Público, ou simplesmente G-Transp.
O G-Transp é um software livre; você pode redistribuí-lo e/ou modificá-lo dentro dos termos da Licença Pública Geral 
GNU como publicada pela Fundação do Software Livre (FSF); na versão 2 da Licença.
Este programa é distribuído na esperança que possa ser  útil, mas SEM NENHUMA GARANTIA; sem uma garantia implícita de 
ADEQUAÇÃO a qualquer  MERCADO ou APLICAÇÃO EM PARTICULAR. Veja a Licença Pública Geral GNU/GPL em português para maiores
 detalhes.
Você deve ter recebido uma cópia da Licença Pública Geral GNU, sob o título "LICENCA.txt", junto com este programa, 
se não, acesse o Portal do Software Público Brasileiro no endereço www.softwarepublico.gov.br ou escreva para a Fundação do Software Livre(FSF) Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301, USA

-->
<?php
	
	ob_start();
	session_start();
	
	//Verificação de todos os campos obrigatórios estão preenchidos
	if(isset($_POST['usuario']) && isset($_POST['senha'])) {
		
		//recupera os valores que foram passados no formulário		
		$login = $_POST['usuario'];
		$senha = $_POST['senha'];
		
		
		//Criptografa a senha recebida pelo usuário
		$whirlpool = hash('whirlpool', $senha);
			
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		
		$tabela = Conexao::getTabela('TB_USUARIO');
			
		//Faz uma busca na tabela usando os valores de login e senha inseridos
		$query = $db->query("SELECT * FROM $tabela WHERE `cpf` = '$login' AND BINARY `senha` = '{$whirlpool}'");
		//Verifica se a busca retornou algum resultado
		if (( $query->rowCount() ) > 0) {///Sim, retornou
			
			//Guarda os valores da busca em um array
			$conteudo = $query->fetch(PDO::FETCH_ASSOC);
			
			//Define os parâmetros da sessão
			$_SESSION['login'] = $login;
			$_SESSION['senha'] = $senha;
			$_SESSION['nome']  = $conteudo['nome'];
			$_SESSION['depto'] = $conteudo['departamento'];		
			
			$tabela = Conexao::getTabela('TB_CONTROLE_ACESSO');	
			//Insere na tabela controle_acesso o usuário e o horário que o mesmo efetuou um login
			$query2 = $db->query("INSERT INTO $tabela(cpf_usuario) VALUES('$login')") or die(mysql_error());
			
			//Verifica se a inserção na tabela controle_acesso ocorreu corretamente
			if ($query2) { //Inserção ocorreu corretamente
				//Verifica se o usuário é administrador
				if ($conteudo['nivel_permissao'] == '1') {//Se for, redireciona para a home_admin e define o parâmetro da sessão para admin
					header('location:home_admin.php');
					$_SESSION['admin'] = true;
				} else { //Se não, redireciona para o painel de gerenciador
					header('location:home.php');
				}			
			}
		} else {//Não foi encontrado nenhum registro na tabela com os valores de login e senha inseridos
			//Deleta os valores das sessões e envia uma informação de erro para index, para que este exiba o erro ao usuário
			unset($_SESSION['login']);
			unset($_SESSION['senha']);
			header('location:index.php?erro=1');
		}
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		header('location:index.php?erro=1');
	}
	
?>