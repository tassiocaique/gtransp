<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Ouvidoria </title>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div id="pagina">
			<div id="header">
				<a href=".."><img src="../imagens/header.jpg"/></a>
			</div>
			<div id="navegacao">
				<nav>
					<ul class="menu">
						<li><a href="#">Conheça o Município</a>
							<ul>
								<li><a href="../pagina.php?id=apresentacao">Apresentação</a></li>
								<li><a href="../pagina.php?id=pontosturisticos">Pontos Turísticos</a></li>
								<li><a href="../pagina.php?id=historico">Histórico</a></li>
								<li><a href="../pagina.php?id=estrutura">Estrutura Organizacional</a></li>
							</ul>
						</li>						
						<li><a href="../noticias">Notícias</a></li>
						<li><a href="../receitas">Receitas</a></li>
						<li><a href="../despesas">Despesas</a></li>
						<li><a href="../arquivos">Arquivos</a></li>
						<li><a href="">Licitações</a>
							<ul>
								<li><a href="">Em andamento</a></li>
								<li><a href="">Encerradas</a></li>
							</ul>
						</li>
						<li><a href="../pagina.php?id=contatos">Contatos</a></li>
					</ul>
				</nav>
			</div>
			<div id="identificacao">
				<img src="../imagens/ouvidoriaheader.png"/>
			</div>
			<center><h4>Entre em contato com nossa ouvidoria para obter quaisquer informação adicional</h4></center>
			<div id="formulario">
				<?php
						if(isset($_GET['r'])){
						
							$resultado = $_GET['r'];
							if($resultado == "1") {
								echo "<div class='success'><h3>Obrigado por entrar em contato.</h3></div>";
							} else {
								echo "<div class='fail'><h3>Ocorreu um erro! Tente novamente.</h3></div>";
							}
						
						}
				?>
				<form method="post" action="enviar_email.php">
					<label>
						<span><b>Nome:*</b></span>
						<input type="text" name="nome" placeholder="Seu nome" required/>
					</label>
					<label>
						<span><b>Email:*</b></span>
						<input type="email" name="email" placeholder="Seu email" required/>
					</label>
					<label>
						<span><b>Assunto:*</b></span>
						<input type="text" name="assunto" placeholder="O assunto que deseja tratar" required/>
					</label>
					<label>
						<span><b>Conteúdo:*</b></span>
						<textarea name="conteudo"></textarea>
					</label>
					<center><input class="button" type="submit" value="Enviar"/></center>
				</form>
			</div>
		</div>
		<div id="footer">
			<center><p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a>. Sua atualização é de responsabilidade da Prefeitura Municipal| <a href="../admin">Login</a></p></center>
		</div>
	</body>
</html>