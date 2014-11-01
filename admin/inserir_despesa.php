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
	if (isset($_POST['data']) && isset($_POST['fase']) && isset($_POST['documento']) && isset($_POST['especie']) && isset($_POST['orgaosuperior']) 
		&& isset($_POST['entidadevinculada']) && isset($_POST['unidadegestora']) && isset($_POST['elementodedespesa']) 
		&& isset($_POST['favorecido']) && isset($_POST['valor'])) {
		
		//recupera os valores que foram passados no formulário		
		$data = $_POST['data'];
		$fase = $_POST['fase'];
		$documento = $_POST['documento'];
		$espécie = $_POST['especie'];
		$orgaosuperior = $_POST['orgaosuperior'];
		$entidadevinculada = $_POST['entidadevinculada'];
		$unidadegestora = $_POST['unidadegestora'];
		$elementodedespesa = $_POST['elementodedespesa'];
		$favorecido = $_POST['favorecido'];
		$valor = $_POST['valor'];
		
		//recupera o CPF do usuário da sessão
		$cpf_usuario = $_SESSION['login'];
		
		/* Define o código da despesa com o prefixo DES+horário, esse valor será usado como um
		identificador para referenciar uma edição */
		
		//Seleciona a timezone
		date_default_timezone_set('America/Bahia');
		//Pega a hora do sistema pra concatenar com o prefixo identificador
		$date = date('Ymdhis');
		//Pega o tempo em milisegundos
		$microtime = microtime(true)*10000;
				
		$cod_despesa = "DES".$date.$microtime;		
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_DESPESA');
		//Comando de inserção do registro na tabela
		$query = $db->query("INSERT INTO $tabela (data_versao, cpf_usuario, cod_despesa, fase, documento, especie, orgao, entidade_vinculada, unidade_gestora, elemento_de_despesa, favorecido, valor)
		                                 VALUES ('$data', '$cpf_usuario', '$cod_despesa', '$fase', '$documento', '$espécie', '$orgaosuperior', '$entidadevinculada', '$unidadegestora', '$elementodedespesa', '$favorecido', $valor)")or die(mysql_error());
		
		//Mostra uma caixa de diálogo e redireciona o usuário para o painel de controle
		echo "<script type='text/javascript'>
				window.alert('Dados inseridos com sucesso!')
				window.location.href='../admin/home.php';
			  </script>";
		
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		echo "<script type='text/javascript'>
				window.alert('Algum campo obrigatório não foi inserido. Reinsira os dados e tente novamente')
				window.location.href='/formulariodespesas.php';
			  </script>";
	}


?>