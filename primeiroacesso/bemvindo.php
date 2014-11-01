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
		<title>Parabéns - Bem vindo ao G-Transp! </title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<style type="text/css">
		</style>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<center>
					<a href="#"><img height="300px" src="../imagens/logomarca.png"/></a>
				</center>
			</div>
			<h2> Seja bem vindo ao gerenciador de conteúdo público G-Transp </h2>
			<p> Agora você está pronto para usufruir das funcionalidades dos G-Transp</p>
			<div>
				<a href="../admin">Login</a> | <a href="../admin">Primeira Notícia</a> | <a href="../admin">Editar Páginas</a>
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