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
	if(isset($_POST['identificacao']) && isset($_POST['detalhamento']) && isset($_POST['genero'])) {
	
		//Pasta onde arquivo vai ser salvo no servidor
		$_UP['pasta'] = "../uploads/";
		
		//Tamanho máximo do arquivo em bytes (2mb)
		$_UP['tamanho'] = 1204 * 1024 * 2 ;
		
		//Extensões permitidas
		$_UP['extensoes'] = array("pdf", 'doc', 'odt', 'docx', 'ods', 'xls', 'xlsx',  'png', 'jpg', 'csv');
		
		$_UP['renomeia'] = true;
		
		//Tipos de erro no upload de arquivos com php
		$_UP['erros'][0] = 'Não houve erro';
		$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
		$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
		$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
		$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
		
		//Verifica se houve algum erro com o upload e se houve exibe uma mensagem de erro
		if($_FILES['arquivo']['error'] != 0) {
			die("Não foi possível fazer o upload. Erro: <br>" . $_UP['erros'][$_FILES['arquivo']['error']]);
			exit; //para a execução do script
		}
		
		//Faz a verificação da extensão do arquivo
		$extensao = strtolower(end(explode(".", $_FILES['arquivo']['name'])));
		if ((array_search($extensao, $_UP['extensoes'])) === false) {
			//echo "Por favor, envie apenas arquivos com a seguintes extensões: 'pdf', 'doc', 'odt', 'docx', 'ods', 'xls', 'xlsx', 'png', 'jpg'";
			$sucesso = false;
		} else if($_UP['tamanho'] < $_FILES['arquivo']['size']) { //Verifica o tamanho do arquivo
			
			$sucesso = false;
			
		} else {	
			//Renomeia o arquivo
			if($_UP['renomeia'] == true) {
				//Usa a criptografia md5 e concatena com o horário
				//Indenfica a extensão do arquivo para ser concatenada string criptografada
				$tipo = strrchr($_FILES['arquivo']['name'],".");
				$nome_final = md5($_FILES['arquivo']['name'] . date('dmYHis')).$tipo;
			} else {
				//Mantém o nome do arquivo
				$nome_final = $_FILES['arquivo']['name'];
			}
			
			/*Move o arquivo para a pasta*/
			if(move_uploaded_file($_FILES['arquivo']['tmp_name'], $_UP['pasta'].$nome_final)) {
				//Upload efetuado com sucesso
				echo "Upload efetuado com sucesso!";
				$caminho = $_UP['pasta'] . $nome_final;
				$sucesso = true;
				
				/*                     Inserção do registro do upload no banco de dados                    */
				/* Define o código do upload com o prefixo UP+data+tempo(mili), esse valor será usado como um
				identificador para referenciar uma edição */
				
				$identificacao = $_POST['identificacao'];
				$detalhamento = $_POST['detalhamento'];
				$genero = $_POST['genero'];
				if(strcmp($genero, "outro") == 0) {
					$genero = $_POST['outro'];
				}
				$cpf_usuario = $_SESSION['login'];
			
				//Seleciona a timezone
				date_default_timezone_set('America/Bahia');
				//Pega a hora do sistema pra concatenar com o prefixo identificador
				$date = date('Ymdhis');
				//Pega o tempo em milisegundos
				$microtime = microtime(true)*10000;
						
				$cod_upload = "UP".$date.$microtime;		
				
				/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
				
				//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
				require_once('../config/conexao.php');
				
				//Atribui a instância do banco a uma variável
				$db = Conexao::getInstance();
				//===================================================================================================================================================================================================================================================
				
				$tabela = Conexao::getTabela('TB_UPLOAD');
				
				$query = $db->query("INSERT INTO $tabela(cpf_usuario, cod_upload, identificacao, detalhamento, genero, caminho) 
												  VALUES('$cpf_usuario', '$cod_upload', '$identificacao', '$detalhamento', '$genero', '$caminho')");
												  
				
				if($query) {
					$sucesso = true;
				} else {
					$sucesso = false;
				}
				
				
			} else {
				$sucesso = false;
			}
		}
	
	} else {
		$sucesso = false;
	}
	
	if ($sucesso) {
		if(strcmp($genero, "Despesas") == 0) {
			header("location:nova_despesa.php?r=1");
		} else if(strcmp($genero, "Receitas") == 0) {
			header("location:nova_receita.php?r=1");
		} else {
			header("location:novo_upload.php?r=1");
		}
	} else {
		if(strcmp($genero, "Despesas") == 0) {
			header("location:nova_despesa.php?r=0");
		} else if(strcmp($genero, "Receitas") == 0) {
			header("location:nova_receita.php?r=0");
		} else {
			header("location:novo_upload.php?r=0");
		}
	}
	

?>