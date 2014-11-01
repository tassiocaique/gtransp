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
	if (isset($_POST['titulo']) && isset($_POST['corpo']))	{	
		
		//recupera os valores que foram passados no formulário		
		$titulo = $_POST['titulo'];
		$corpo = $_POST['corpo'];
		
		//Verifica se o campo não obrigatório categorias foi preenchido
		if (isset($_POST['categorias'])) {//Se sim, recupera o valor
			$categorias = $_POST['categorias'];
		} else {//Se não, atribui a ele um valor padrão
			$categorias = "sem categoria";
		}
		
		//recupera o CPF do usuário da sessão
		$cpf_usuario = $_SESSION['login'];
		
		/* Define o código da despesa com o prefixo NOT+horário, esse valor será usado como um
		identificador para referenciar uma edição*/
		
		//Seleciona a timezone
		date_default_timezone_set('America/Bahia');
		//Pega a hora do sistema pra concatenar com o prefixo identificador
		$date = date('Ymdhis');
		//Pega o tempo em milisegundos
		$microtime = microtime(true)*10000;
				
		$cod_noticia = "NOT".$date.$microtime;
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_NOTICIAS');
		//Comando de inserção do registro na tabela
		$query = $db->query("INSERT INTO $tabela(cpf_usuario, titulo, corpo, categorias, cod_noticia)
		                                  VALUES ('$cpf_usuario', '$titulo', '$corpo', '$categorias', '$cod_noticia')")or die(mysql_error());
										  
		//Mostra uma caixa de diálogo e redireciona o usuário para o painel de controle
		if ($query) {
			header("location:nova_noticia.php?r=1&cod=".$db->lastInsertId('cod_controle'));
		} else {
			header("location:nova_noticia.php?r=2");
		}
		
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		header("location:nova_noticia.php?r=0");
	}


?>
