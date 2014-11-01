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
	
	if(isset($_GET['tabela']) && isset($_GET['id'])) {
		
		$tab = $_GET['tabela'];
		$id = $_GET['id'];
		
		$login = $_SESSION['login'];
		
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
				
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
				
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
				
		$tabela = Conexao::getTabela($tab);
			
		
		if(strcasecmp($tab, 'TB_NOTICIAS') == 0) {
			
			$atualizar  = $db->query("UPDATE $tabela SET visivel = 0 WHERE cod_controle = $id");
			$selecionar = $db->query("SELECT * FROM `$tabela` WHERE `cod_controle` = '$id' ");
			$resultado  = $selecionar->fetch(PDO::FETCH_ASSOC);
			$novo = $db->query("INSERT INTO $tabela(cpf_usuario, titulo, corpo, visivel, excluido, cod_noticia, categorias) 
								VALUES('$login', '$resultado[titulo]', '$resultado[corpo]', 0, 1, '$resultado[cod_noticia]', '$resultado[categorias]')") or die(mysql_errono());
			
			
			if($novo) {
				header("location:listar_noticias.php?r=1");
			} else {
				header("location:listar_noticias.php?r=0");
			}
			
			
		} else if(strcasecmp($tab, 'TB_USUARIO') == 0) {
			
			$atualizar  = $db->query("UPDATE $tabela SET ativo = 0 WHERE cpf = $id");
			
			if($atualizar) {
				header("location:listar_usuarios.php?r=1");
			} else {
				header("location:listar_usuarios.php?r=0");
			}
			
		} else if(strcasecmp($tab, 'TB_UPLOAD') == 0) {
			
			echo "entrou";
			
			echo "<br>";
			
			$atualizar  = $db->query("UPDATE $tabela SET visivel = 0 WHERE cod_controle = $id");
			$selecionar = $db->query("SELECT * FROM `$tabela` WHERE `cod_controle` = '$id' ");
			$resultado  = $selecionar->fetch(PDO::FETCH_ASSOC);
			$novo = $db->query("INSERT INTO $tabela(cpf_usuario, identificacao, detalhamento, genero, caminho, visivel, excluido, cod_upload) 
								VALUES('$login', '$resultado[identificacao]', '$resultado[detalhamento]', '$resultado[genero]', '$resultado[caminho]', 0, 1, '$resultado[cod_upload]')");
			
			$genero = $resultado['genero'];
			
			if($novo) {
				
				if(strcasecmp($genero, "despesas") == 0) header("location:listar_despesas.php?r=1");
				else if(strcasecmp($genero, "receitas") == 0) header("location:listar_receitas.php?r=1");
				else header("location:listar_arquivos.php?r=1");
			} else {
				if(strcasecmp($genero, "despesas") == 0) header("location:listar_despesas.php?r=0");
				else if(strcasecmp($genero, "receitas") == 0) header("location:listar_receitas.php?r=0");
				else header("location:listar_arquivos.php?r=0");
			}
			
		}
	
	}
	
?>