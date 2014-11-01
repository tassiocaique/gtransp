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
//	session_start();
	ob_start();
	function validaCPF($cpf) {
		if (empty($cpf)){
			return FALSE;
		}
		
		//Elimina máscara
		$cpf = ereg_replace('[^0-9]','', $cpf);
		$cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);
		
		//Verifica se o número de dígitos informados é igual a 11
		if(strlen($cpf) != 11) {
			return FALSE;
		} else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        	return FALSE;
        } else {
        	for($t = 9; $t < 11; $t++) {
        		for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return FALSE;
            }
        	}
			return TRUE;
        }
	}
	
	//Verificação de todos os campos obrigatórios estão preenchidos
	if((isset($_POST['nome']) && isset($_POST['senha']) && isset($_POST['rsenha']) && isset($_POST['login']) && isset($_POST['departamento'])) ) {
		
		//recupera os valores que foram passados no formulário		
		$nome = $_POST['nome'];
		$login = $_POST['login'];
		$login = str_replace(".", "",  $login);
		$login = str_replace("-", "", $login);
		$senha = $_POST['senha'];
		$rsenha = $_POST['rsenha'];
			
		
		if (validaCPF($login) === FALSE) {
			header("location:index.php?r=1");
			break;
		}
		
		if(strcmp($senha, $rsenha) != 0) {
			header("location:index.php?r=2");
			break;	
		}
		
		
		
		$whirlpool = hash('whirlpool', $senha); //criptografa a senha
		
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
		$query = $db->query("INSERT INTO $tabela(nome, cpf, senha, departamento, nivel_permissao) VALUES('$nome', '$login', '$whirlpool', '$dpto', '$perm')") or die(mysql_error());
		
		if($query) {
			header("location:configuracoes.php");	
		} else {
			header("location:index.php?r=0");	
			
		}
		
	} else {
		//Aviso que os campos não foram preenchidos corretamente
		header("location:index.php?r=0");
	}

?>