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
		
		<?php
		
			/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
				//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
				require_once('../config/conexao.php');
				
				//Atribui a instância do banco a uma variável
				$db = Conexao::getInstance();
				//===================================================================================================================================================================================================================================================
				
				$cod_controle = $_GET['ctl'];
				
				//Pega o nome da tabela
				$tabela = Conexao::getTabela('TB_UPLOAD');
				
				$query = $db->query("SELECT * FROM $tabela WHERE $tabela.visivel=1 AND $tabela.genero='Despesas' AND cod_controle='$cod_controle'");
				
				$conteudo = $query->fetch(PDO::FETCH_ASSOC)
		
		?>
	
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Upload de arquivo </title>
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
							echo "<div class='success'><center><h3>Informações sobre o arquivo atualizadas com sucesso!</h3></center></div>";
						} else {
							echo "<div class='fail'><center><h5> Ocorreu um erro! Verifique se a extensão do arquivo é suportada (Extensões suportadas: 'pdf', 'doc', 'odt', 'docx', 'ods', 'xls', 'xlsx', 'png', 'jpg') e/ou se seu arquivo possui um tamanho máximo de 2mb</h5></center></div>";
						}
					}
			?>
			<h1>Upload de Arquivo de Despesa</h1>
			<h6>Se você deseja enviar um arquivo que não é referente a nenhuma <u>DESPESA</u>, por favor, retorne ao <a href="home_admin.php">Painel de Controle</a> e envie-o na seção correta. </h6>
			<form method="post" action="inserir_edicao.php" enctype="multipart/form-data">
				<label>
					<span>Identificação do documento: </span><br>
					<input class="identificacao" type="text" name="identificacao" value="<?php echo $conteudo['identificacao']?>" required/>
				</label>
				<label>
					<span>Detalhamento: </span><br>
					<textarea class="detalhamento" name="detalhamento"><?php echo $conteudo['detalhamento']?></textarea>
				</label>
				<label>
					<span>Gênero: </span>
					<input class="genero" type="text" readonly="readonly" name="genero" value="Despesas"/>
				
				</label>
								
				<label>
					<p class="aviso"> Não é possível modificar o arquivo enviado! O arquivo enviado foi: <a href="<?php echo $conteudo['caminho']?>"><?php echo $conteudo['identificacao']?></a>
					<br>Se deseja reenviar um arquivo, faça um novo upload e exclua esse. </p>
					<div class='info'>
						<span>Informações da despesa:</span>
						Caminho: <input type="text" readonly="readonly" name="caminho" value="<?php echo $conteudo['caminho']?>"/>
						Código de upload: <input type="text" readonly="readonly" name="cod_upload" value="<?php echo $conteudo['cod_upload']?>"/>
						Código de controle: <input type="text" readonly="readonly" name="cod_controle" value="<?php echo $conteudo['cod_controle']?>"/>
					</div>
				</label>
				<input class="button" type="submit" value="Enviar"/>				
			</form>
		</div>
	</div>

</body>
</html>