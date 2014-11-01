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
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link href="nova_noticia.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="admin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
		<title>Inserir nova notícia</title>
		
		<!-- Configurações do editor de texto -->
		<!-- Editor utilizado: TinyMCE | Site: http://www.tinymce.com/ | Documentação: http://www.tinymce.com/wiki.php -->
		<script type="text/javascript" src="../javascript/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector:"textarea",
				theme:"modern",
				width:"800",
				height:"300",
				menubar:"edit insert view format table tools", 
				plugins:["autolink charmap code image link media paste preview textcolor wordcount table jbimages"],
				toolbar: "undo redo | copy paste cut | styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | media link image | jbimages",
				relative_urls:false, 
				tools:"inserttable",
				language:"pt_BR"		
			});
		</script>
		<!-- Fim das configurações do editor de texto -->
	</head>
	<body>
		<div id="pagina">
			<div id="header">
				<div id="logo"><a href="home_admin.php"><img height="75px" src="../imagens/gtransp.png"/></a></div>
				<div id="info">
				<?php
					echo "<p>Nome:<b><u>".$_SESSION['nome']."</u></b></p>";
					if (isset($_SESSION['admin']) == true) {
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
							if(isset($_GET['cod'])) {
								$cod = $_GET['cod'];
								echo "<div class='success'><center><h3>Notícia publicada com sucesso! <a href='../noticias/detalhe.php?cod=".$cod."'>Visualizar</a></h3></center></div>";
							} else {
								echo "<div class='fail'><center><h5> Ocorreu um erro! </h5></center></div>";
							}
						} else {
								echo "<div class='fail'><center><h5> Ocorreu um erro! </h5></center></div>";
						}
					}
				?>
				<h1> Publicar uma nova notícia</h1>
				<form method="post" action="inserir_noticia.php">
					<label>
						<span>Título:</span>
						<input class="titulo" type="text" name="titulo" required/>
					</label>
					<label>
						<textarea name="corpo"></textarea>
					</label>
					<label>
						<span>Categorias:</span>
						<input class="categorias" type="text" name="categorias"/><br>
					</label>
					<input class="button" type="submit" value="Publicar"/>
				</form>
			</div>
		</div>
	</body>
</html>