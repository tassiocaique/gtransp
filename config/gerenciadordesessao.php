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

/*
* Essa classe tem como intuito fazer a verificação do nível de autenticação de um usuário bem como se ele está autencidado ou não.
*/

class GerenciadorDeSessao {
	
	function __construct() {
		session_start();
	}
	
	public function isGerenciador() {
		if ((!isset($_SESSION['login']) == true) && (!isset($_SESSION['senha']) == true)) {	
					unset($_SESSION['login']);
					unset($_SESSION['senha']);
					header('location:index.php');
					return false;

		} else {
			return true;
		}
	}
	
	public function isAdministrador() {
		if ($this->isGerenciador() && isset($_SESSION['admin'])) {
			return true;
		} else if($this->isGerenciador()){
			header('location:home.php');
		} else {
			unset($_SESSION['login']);
			unset($_SESSION['senha']);
			header('location:index.php');
			return false;
		}
		
	}
	
}
?>