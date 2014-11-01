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

	if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['assunto']) && isset($_POST['conteudo'])) {
		
		$nome = $_POST['nome'];
		$de = $_POST['email'];
		$assunto = $_POST['assunto'];
		$conteudo = $_POST['conteudo'];
		
		
		$arquivo = fopen('../config/contato.txt', 'r');
		if($arquivo == false)  {
			die('Não foi possível criar o arquivo');
		} else {
			$remetente = fgets($arquivo); 
			fclose($arquivo);
		}
		
		
		$headers =  "Content-Type:text/html; charset=UTF-8\n";
		$headers .= "From: <".$remetente.">"; //Vai ser mostrado que o email partiu deste email e seguido do nome
		$headers .= "X-Sender:  <".$remetente.">\n"; //email do servidor que enviou
		$headers .= "X-Mailer: PHP  v".phpversion()."\n";
		$headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
		$headers .= "Return-Path:  <".$remetente.">\n"; //caso seja respondida
		$headers .= "MIME-Version: 1.0\n";
		
		
		$send = mail($remetente, $assunto, $conteudo, $headers, "-f$remetente");
		
		var_dump($send);
		
		if($send) {
			header("location:index.php?r=1");
		} else {
			header("location:index.php?r=0");
		}
		
	} else {
		header("location:index.php?r=0");
	}

?>