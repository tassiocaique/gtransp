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
<?php session_start(); ?>
<?php ob_start(); ?>
<?php
	if (isset($_SESSION['login']) == true) {
		header("location:home_admin.php");
	}
?>
<html>
	<head>
			
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href="index.css" rel="stylesheet" type="text/css" media="screen" />
		<title>Login- Sistema gTransp</title>

	</head>
	
	<body>
		<div id="header">
			<center><div id="logo"><img height="75px" src="../imagens/gtransp.png"/></div></center>
		</div>
		<div id="logoprefeitura"><img src="../imagens/header.jpg"/></div>
		<div id="wrapper">		
			<form method="post" action="realizar_login.php">
				<label>
					<span>Login (CPF):</span>
					<input name="usuario" type="text" required>
				</label>
				
				<label>
					<span>Senha:</span>
					<input name ="senha" type="password" required>
				</label>
				
				<?php
					
					if (isset($_GET['erro'])) {
						$erro = $_GET['erro'];					
						if ($erro == 1) {
							echo "<p style='font-size:10px;color:#f00'>Usuário ou senha inválidos!</p>";
						}
					}
					
				?>
				
				<input type="submit" class="button" value="Fazer login">
			</form>
		</div>
	</body>
</html>