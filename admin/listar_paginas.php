<html>
	<head>
	<?php
		require_once('../config/gerenciadordesessao.php');
		$sessao = new GerenciadorDeSessao();
		$sessao->isAdministrador();
	?>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Lista de Páginas </title>
		<link href="listar_noticias.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
	
		<div id="pagina">
		
			<div id="header">
				<div id="logo"><a href="#"><img src="../imagens/gtransp.png"/></a></div>
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
					<td><a href="editar_pagina.php?id=Apresentacao">Editar</a></td>
				</tr>
				<tr class="linhaimpar">
					<td><a href="">Pontos Turísticos</a></td>
					<td><a href="editar_pagina.php?id=PontosTuristicos">Editar</a></td>
				</tr>
				<tr class="linhapar">
					<td><a href="">Histórico</a></td>
					<td><a href="editar_pagina.php?id=Historico">Editar</a></td>
				</tr>
				<tr class="linhaimpar">
					<td><a href="">Estrutura Organizacional</a></td>
					<td><a href="editar_pagina.php?id=Estrutura">Editar</a></td>
				</tr>
				<tr class="linhapar">
					<td><a href="">Contatos</a></td>
					<td><a href="editar_pagina.php?id=Contatos">Editar</a></td>
				</tr>
				<tr class="linhaimpar">
					<td><a href="">Perguntas mais frequentes dos cidadãos</a></td>
					<td><a href="editar_pagina.php?id=FAQ">Editar</a></td>
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