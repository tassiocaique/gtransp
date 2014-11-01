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
	
	//Verifica se os campos obrigatórios foram preenchidos
	if(isset($_POST['identificacao']) && isset($_POST['detalhamento']) && isset($_POST['genero']) && isset($_POST['cod_upload']) && isset($_POST['cod_controle']) && isset($_POST['caminho'])) {
	
				
				/*                     Inserção do registro do upload no banco de dados                    */
				
				$identificacao = $_POST['identificacao'];
				$detalhamento = $_POST['detalhamento'];
				$genero = $_POST['genero'];
				$cpf_usuario = $_SESSION['login'];						
				$cod_upload = $_POST['cod_upload'];
				$cod_controle = $_POST['cod_controle'];
				$caminho = $_POST['caminho'];
				
				/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
				
				//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
				require_once('../config/conexao.php');
				
				//Atribui a instância do banco a uma variável
				$db = Conexao::getInstance();
				//===================================================================================================================================================================================================================================================
				
				$tabela = Conexao::getTabela('TB_UPLOAD');
				
				$query = $db->query("INSERT INTO $tabela(cpf_usuario, cod_upload, identificacao, detalhamento, genero, caminho, editado) 
												  VALUES('$cpf_usuario', '$cod_upload', '$identificacao', '$detalhamento', '$genero', '$caminho', 1)");
				
				$cod = $db->lastInsertId('cod_controle');
				
				$query2 = $db->query("UPDATE $tabela SET editado = 1, visivel = 0 WHERE cod_controle='$cod_controle' AND cod_upload='$cod_upload'")or die(mysql_error());
				
				if($query && $query2) {
					if(strcasecmp($genero, "Despesas") == 0) {
						header("location:editar_despesa.php?r=1&ctl=".$cod);
					} else if (strcasecmp($genero, "Receitas") == 0) {
						header("location:editar_receita.php?r=1&ctl=".$cod);
					} else {
						header("location:editar_arquivo.php?r=1&ctl=".$cod);
					}
				}
				
	
	} else {
		echo "Ocorreu um erro não listado!";
	}
	

?>