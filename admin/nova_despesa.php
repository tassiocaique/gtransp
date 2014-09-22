<html>
	
	<head>
		
		<?php
			session_start();
			
			if ((!isset($_SESSION['login']) == true) && (!isset($_SESSION['senha']) == true)) {
					
					unset($_SESSION['login']);
					unset($_SESSION['senha']);
					header('location:index.php');

				}
			
		?>
	
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Nova despesa </title>
		<link href="editar_despesa.css" rel="stylesheet" type="text/css" media="screen" />
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
		
			<?php
					if(isset($_GET['r'])) {
						$resultado = $_GET['r'];
						if ($resultado == "1") {
							echo "<div class='success'><center><h3>Arquivo publicado com sucesso!</h3></center></div>";
						} else {
							echo "<div class='fail'><center><h5> Ocorreu um erro! Verifique se a extensão do arquivo é suportada (Extensões suportadas: 'pdf', 'doc', 'odt', 'docx', 'ods', 'xls', 'xlsx', 'png', 'jpg') e/ou se seu arquivo possui um tamanho máximo de 2mb</h5></center></div>";
						}
					}
			?>
			
			<h1>Upload de Arquivo de Despesa</h1>
			<h6>Se você deseja enviar um arquivo que não é referente a nenhuma <u>DESPESA</u>, por favor, retorne ao <a href="home_admin.php">Painel de Controle</a> e envie-o na seção correta. </h6>
			<form method="post" action="inserir_arquivo.php" enctype="multipart/form-data">
				<label>
					<span>Identificação do documento: </span><br>
					<input class="identificacao" type="text" name="identificacao" placeholder="Ex.: Prestação de contas da construção da obra no bairro X" required/>
				</label>
				<label>
					<span>Detalhamento: </span><br>
					<textarea class="detalhamento" name="detalhamento"></textarea>
				</label>
				<label>
					<span>Gênero: </span>
					<input class="genero" type="text" readonly="readonly" name="genero" value="Despesas"/>
				</label>
				<label>
					<span>Escolha o arquivo que deseja publicar (Tamanho Máx 2mb):</span><br>
					<input class="arquivo" type="file" name="arquivo" required/>
				</label>
				<input class="button" type="submit" value="Enviar"/>				
			</form>
		</div>
	</div>

</body>
</html>