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
			require_once('../config/gerenciadordesessao.php');
			$sessao = new GerenciadorDeSessao();
			$sessao->isAdministrador();
		?>
		
		<?php
			$arquivo = fopen('../config/prefeitura.txt', 'r');
			if($arquivo == false)  {
				die('Não foi possível criar o arquivo');
			} else {
				$prefeitura = fgets($arquivo); 
				fclose($arquivo);
			}
			
			$arquivo = fopen('../config/contato.txt', 'r');
			if($arquivo == false)  {
				die('Não foi possível criar o arquivo');
			} else {
				$contato = fgets($arquivo); 
				fclose($arquivo);
			}
		?>
	
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Configurações </title>
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
							echo "<div class='success'><center><h3>Alterações salvas com sucesso!</h3></center></div>";
						}else {
							echo "<div class='fail'><center><h3>Ocorreu um erro! Tente novamente.<h3></center></div>";
						}
					}
			?>
			<h1>Configurações</h1>
			<form method="post" action="salvar_configuracoes.php" enctype="multipart/form-data">
				<h3>Alterar Nome da Prefeitura</h3>
				<label>
					<span>Nome da Prefeitura: </span>
					<input type="text" name="nome_prefeitura" value="<?php echo $prefeitura?>" required/>
				</label>
				<h3>Alterar Email de contato</h3>
				<label>
					<span>Email de contato: </span>
					<input type="email" name="email_contato" value="<?php echo $contato?>" required/>
				</label>
				<h3>Modificar imagem de cabeçalho</h3>
				<span>Imagem atual (dimensões recomendadas: 800x150 px, formato .jpg):</span>
				<img src="../imagens/header.jpg" />
				<span>Escolha o arquivo que deseja publicar (Tamanho Máx 2mb):</span><br>
				<input class="arquivo" type="file" name="arquivo"/>
				<input class="button" type="submit" value="Enviar"/>
			</form>
		</div>
	</div>

</body>
</html>