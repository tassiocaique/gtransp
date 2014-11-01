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
	//Verificação de todos os campos obrigatórios estão preenchidos
	if(isset($_POST['nome']) && isset($_POST['login']) && isset($_POST['departamento'])) {
		
		//recupera os valores que foram passados no formulário		
		$nome = $_POST['nome'];
		$login = $_POST['login'];
		$login = str_replace(".", "",  $login);
		$login = str_replace("-", "", $login);
		
		if(strcmp($senha, $rsenha) != 0) {
			header("location:novo_usuario.php?r=2");
		}
		
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
		$query = $db->query("UPDATE `$tabela` SET `$tabela`.`nome`='$nome', `$tabela`.`departamento`='$dpto', `$tabela`.`nivel_permissao`='$perm' WHERE `$tabela`.`cpf`='$login' ") or die(mysql_error());
		
		if($query) {
			header("location:editar_usuario.php?r=1&u=".$login);
		} else {
			header("location:editar_usuario.php?r=0&u=".$login);
		}
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		header("location:editar_usuario.php?r=0&u=".$login);
	}

?>