<html>
	
	<head>
		
		<?php
			require_once('../config/gerenciadordesessao.php');
			$sessao = new GerenciadorDeSessao();
			$sessao->isAdministrador();
		?>
		
		<?php
			$arquivo = fopen('../config/destaque1.txt', 'r');
			if($arquivo == false)  {
				die('Não foi possível criar o arquivo');
			} else {
				$link1 = fgets($arquivo); 
				fclose($arquivo);
			}
			
			$arquivo = fopen('../config/destaque2.txt', 'r');
			if($arquivo == false)  {
				die('Não foi possível criar o arquivo');
			} else {
				$link2 = fgets($arquivo); 
				fclose($arquivo);
			}
			
			$arquivo = fopen('../config/destaque3.txt', 'r');
			if($arquivo == false)  {
				die('Não foi possível criar o arquivo');
			} else {
				$link3 = fgets($arquivo); 
				fclose($arquivo);
			}
		?>
	
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Configurar Destaques</title>
		<link href="nova_noticia.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="editar_destaques.css" rel="stylesheet" type="text/css" media="screen" />
	</head>

<body>
	
	
	<div id="pagina">
		<div id="header">
			<div id="logo"><a href=""><img src="../imagens/gtransp.png"/></a></div>
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
			
			<?php
					if(isset($_GET['r'])) {
						$resultado = $_GET['r'];
						if ($resultado == "1") {
							echo "<div class='success'><center><h3>Informações atualizadas com sucesso!</h3></center></div>";
						} else {
							echo "<div class='fail'><center><h5> Ocorreu um erro! Verifique se a imagem(ns) que você adicinou estão no formato .jpg e/ou tem tamanho maior que 2mb </h5></center></div>";
						}
					
					}
				?>
			
			<h1>Configurar Destaques</h1>
			<form method="post" action="salvar_destaques.php" enctype="multipart/form-data">
				<h3>Alterar Desatques</h3>
				<label>
					<span class="head">Destaque 1 (dimensões recomendadas: 800x250 px, formato .jpg):</span>
					<div class="imagem"><img src="../imagens/destaque1.jpg" /></div>
					<span>Link da notícia: </span>
					<input type="url" name="link1" value="<?php echo $link1?>"/><br>
					<span>Escolha o arquivo que deseja publicar (Tamanho Máx 2mb):</span><br>
					<input class="arquivo" type="file" name="destaque1" value="<?php echo $link1?>"/>
				</label>
				<div id="divisor"></div>
				<label>
					<span class="head">Destaque 2 (dimensões recomendadas: 800x250 px, formato .jpg):</span>
					<div class="imagem"><img src="../imagens/destaque2.jpg" /></div>
					<span>Link da notícia: </span>
					<input type="url" name="link2" value="<?php echo $link2?>"/><br>
					<span>Escolha o arquivo que deseja publicar (Tamanho Máx 2mb):</span><br>
					<input class="arquivo" type="file" name="destaque2"/>
				</label>
				<div id="divisor"></div>
				<label>
					<span class="head">Destaque 3 (dimensões recomendadas: 800x250 px, formato .jpg):</span>
					<div class="imagem"><img src="../imagens/destaque3.jpg" /></div>
					<span>Link da notícia: </span>
					<input type="url" name="link3" value="<?php echo $link3?>"/><br>
					<span>Escolha o arquivo que deseja publicar (Tamanho Máx 2mb):</span><br>
					<input class="arquivo" type="file" name="destaque3"/>
				</label>
				
				
				<input class="button" type="submit" value="Salvar alterações"/>
			</form>
		</div>
	</div>

</body>
</html>