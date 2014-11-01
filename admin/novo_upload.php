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
		<title> Upload de arquivo </title>
		<link href="nova_despesa.css" rel="stylesheet" type="text/css" media="screen" />
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
							echo "<div class='fail'><center><h5> Ocorreu um erro! Verifique se a extensão do arquivo é suportada (Extensões suportadas: 'pdf', 'doc', 'odt', 'docx', 'ods', 'xls', 'xlsx', 'png', 'jpg', 'csv') e/ou se seu arquivo possui um tamanho máximo de 2mb</h5></center></div>";
						}
					}
			?>
			<h1>Upload de Arquivos Gerais</h1>
			<h6>Se você deseja enviar um arquivo que já possui uma seção destinada, por favor, direcione-se até ela. Seções disponíveis: <a href="nova_despesa.php">DESPESAS</a>, <a href="nova_receita.php">RECEITAS</a> </h6>
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
					<span>Gênero: </span><br>
					<select name="genero" class="normal" required>
						<option value="licitacao_em_andamento">Licitação em andamento</option>
						<option value="licitacao_encerrada">Licitação encerrada</option>
						<option value="outro">Outro:</option>
					</select>
					<br>Em caso de "Outro", descreva:<input type="text" name="outro"/>
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