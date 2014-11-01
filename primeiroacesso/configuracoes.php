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
<?php 
		/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
		//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
		require_once('../config/conexao.php');
		
		//Atribui a instância do banco a uma variável
		$db = Conexao::getInstance();
		//===================================================================================================================================================================================================================================================
		
		//Pega o nome da tabela
		$tabela = Conexao::getTabela('TB_USUARIO');	
		//Comando de inserção do registro na tabela
		$query = $db->query("SELECT * FROM $tabela");
		if ($query->rowCount() > 0) {
			header("location:../admin/index.php");
		}
?>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title> Bem vindo ao G-Transp - Primeiro Acesso  - Configurações Iniciais</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<style type="text/css">
		</style>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<center>
					<a href="#"><img height="200px" src="../imagens/logomarca.png"/></a>
				</center>
			</div>
			<h2> Estamos quase lá! </h2>
			<p> Você deve definir as configurações básicas iniciais do gerenciador. Se você preferir, pode <a href="bemvindo.php">fazer isto depois</a></p>
			<div>
				
				<?php
					if (isset($_GET['r'])) {
						if ($_GET['r'] == 0) {
							echo "<div>
								 	<b style='color:#f00'>Ocorreu um erro! Tente novamente.</b>
								 </div>";
						}
					}
				?>
				
				<form role="form" id="form" method="post" action="../admin/salvar_configuracoes.php" enctype="multipart/form-data">
					<h4>Alterar nome da prefeitura</h4>
					<div class="form-group">
						<label for="usuário">Nome da prefeitura: </label>
						<input type="text" name="nome_prefeitura" placeholder="Prefeitura Municipal de PRO-SPB" class="form-control" required/>
					</div>
					<h4>Alterar email de contato: </h4>
					<div class="form-group">
						<label for="usuário">Email de contato: </label>
						<input type="text" name="email_contato" placeholder="contato@aplicativaria.com" class="form-control"  required/>
					</div>
					<h4>Modificar imagem do cabeçalho: </h4>
					<span>Imagem exemplo: (dimensões recomendadas: 800x150 px, formato .jpg):</span>
					<img style="padding:15px;" src="../imagens/header.jpg" />
					<br><span>Escolha o arquivo que deseja publicar (Tamanho Máx 2mb):</span><br>
					<div class="form-group">
						<input name="arquivo" type="file"/>
					</div>				
					<button type="submit" class="btn btn-default">Salvar configurações</button>
				</form>
			</div>
		</div>
		<div class="panel-footer">
			<center>
				<p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a> | Essa página de primeiro acesso é uma cortesia da <a href="">Aplicativaria</a></p>
				<a href="http://www.aplicativaria.com/"><img height="30" src="../imagens/icone_aplicativaria.png"/ onMouseOver="this.src='../imagens/icone_aplicativaria_hover.png'" onMouseOut="this.src='../imagens/icone_aplicativaria.png'"></a>
			</center>
		</div>
	</body>
</html>