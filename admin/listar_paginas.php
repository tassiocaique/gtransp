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
		require_once('../config/gerenciadordesessao.php');
		$sessao = new GerenciadorDeSessao();
		$sessao->isAdministrador();
	?>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Lista de Páginas </title>
		<link href="listar_noticias.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="admin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	</head>
	<body>
	
		<div id="pagina">
		
			<div id="header">
				<div id="logo"><a href="home_admin.php"><img height="75px" src="../imagens/gtransp.png"/></a></div>
				<div id="info">
						<?php
							echo "<p>Nome:<b><u>".$_SESSION['nome']."</u></b></p>";
							if ($_SESSION['admin'] == true) {
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
						<li><a href="home_admin.php">Painel</a></li>
						<li><a href="nova_noticia.php">Nova Notícia</a></li>
						<li><a href="nova_receita.php">Nova Receita</a></li>
						<li><a href="nova_despesa.php">Nova Despesa</a></li>
						<li><a href="novo_upload.php">Arquivos Gerais</a></li>
					</ul>
				</nav>
			</div>
		
		<div id="formulario">		
		<div id="table_content">
			<h1>Lista de Páginas</h1>
			<table>
				<th>Página</th>
				<th>Editar</th>
				<tr class="linhapar">
					<td><a href="">Apresentação</a></td>
					<td><a href="editar_pagina.php?id=Apresentacao"><img src="../imagens/edit.png" title="Editar"/></a></td>
				</tr>
				<tr class="linhaimpar">
					<td><a href="">Pontos Turísticos</a></td>
					<td><a href="editar_pagina.php?id=PontosTuristicos"><img src="../imagens/edit.png" title="Editar"/></a></td>
				</tr>
				<tr class="linhapar">
					<td><a href="">Histórico</a></td>
					<td><a href="editar_pagina.php?id=Historico"><img src="../imagens/edit.png" title="Editar"/></a></td>
				</tr>
				<tr class="linhaimpar">
					<td><a href="">Estrutura Organizacional</a></td>
					<td><a href="editar_pagina.php?id=Estrutura"><img src="../imagens/edit.png" title="Editar"/></a></td>
				</tr>
				<tr class="linhapar">
					<td><a href="">Contatos</a></td>
					<td><a href="editar_pagina.php?id=Contatos"><img src="../imagens/edit.png" title="Editar"/></a></td>
				</tr>
				<tr class="linhaimpar">
					<td><a href="">Perguntas mais frequentes dos cidadãos</a></td>
					<td><a href="editar_pagina.php?id=FAQ"><img src="../imagens/edit.png" title="Editar"/></a></td>
				</tr>
			</table>
		</div>
		</div>	
		</div>
		<div id="rodape">
				<center><p>Desenvolvido por <a href="">PRO-SPB</a> | <a href="../admin">Login</a></p></center>
		</div>
		
	</body>
</html>