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
<html>
	<head>
		<?php
			ob_start();
			session_start();
			
			if ((!isset($_SESSION['login']) == true) && (!isset($_SESSION['senha']) == true)) {
					
					unset($_SESSION['login']);
					unset($_SESSION['senha']);
					header('location:index.php');
					
				}
			
		?>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Painel Gerenciador</title>
		<link href="home_admin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="admin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>		
	</head>
		<body>
		<div id="pagina">
			<div id="header">
				<div id="logo"><a href=".."><img height="75px" src="../imagens/gtransp.png"/></a></div>
				<div id="info">
						<?php
							echo "<p>Nome:<b><u>".$_SESSION['nome']."</u></b></p>";
							if (isset($_SESSION['admin'])) {
								echo "<p>Privilégio:<b><u>Administrador</u></b></p>";
							} else {
								echo "<p>Privilégio:<b><u>Gerenciador</u></b></p>";
							}
						?>
						<div id="logout"><a class="logoutbtn" href="logout.php">Logout</a></div>
				</div>
				
			</div>
			<div id="navegacao">
				<nav id="menu">
					<ul>
						<li><a href="../index.php">Visualizar Portal</a></li>
						<li><a href="nova_noticia.php">Nova Notícia</a></li>
						<li><a href="nova_receita.php">Nova Receita</a></li>
						<li><a href="nova_despesa.php">Nova Despesa</a></li>
						<li><a href="novo_upload.php">Arquivos Gerais</a></li>
						<li><a href="mudar_senha.php">Mudar Senha</a></li>
					</ul>
				</nav>
			</div>	
			<div id="wrapper">
				<center><h1>Painel de Controle</h1></center>
				<div id="menu1">
					<p class="divisor">Notícias</p>
					<a href="nova_noticia.php"><img class="options" src="../imagens/inserir_noticias.png"/></a>
					<a href="../noticias"><img class="options" src="../imagens/visualizar_noticia.png"/></a>
					
					<p class="divisor">Receitas</p>
					<a href="nova_receita.php"><img class="options" src="../imagens/inserir_receita.png"/></a>
					<a href="../gtransp/receitas"><img class="options" src="../imagens/visualizar_receita	.png"/></a>
					
					<p class="divisor">Depesas</p>
					<a href="nova_despesa.php"><img class="options" src="../imagens/inserir_despesa.png"/></a>
					<a href="../gtransp/despesas"><img class="options" src="../imagens/visualizar_despesa.png"/></a>
					
					<p class="divisor">Arquivos</p>
					<a href="novo_upload.php"><img class="options" src="../imagens/enviar_arquivo.png"/></a>
					<a href="../arquivos"><img class="options" src="../imagens/visualizar_arquivo.png"/></a>
					
				</div>
			</div>
		
		</div>
		
	</body>
</html>