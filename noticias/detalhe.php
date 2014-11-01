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
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Notícias</title>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div id="pagina">
			<div id="header">
				<a href="../index.php"><img src="../imagens/header.jpg"/></a>
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
				<img src="../imagens/noticiasheader.png"/>
				<div id="containerbusca">
					
				</div>
			</div>
			
			<?php				
				if(isset($_GET['cod'])) { 
				
					/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
					//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
					require_once('../config/conexao.php');
					
					//Atribui a instância do banco a uma variável
					$db = Conexao::getInstance();
					//===================================================================================================================================================================================================================================================
					
					//Pega o nome da tabela
					$tabela = Conexao::getTabela('TB_NOTICIAS');
					
					$cod = $_GET['cod'];
					
					$query = $db->query("SELECT * FROM `$tabela` WHERE `$tabela`.`cod_controle` = '$cod'");
				
					while ( $conteudo = $query->fetch(PDO::FETCH_ASSOC) ) {
						
						$tabela = Conexao::getTabela('TB_USUARIO');
						
						$consultaautor = $db->query("SELECT * FROM $tabela WHERE cpf = '$conteudo[cpf_usuario]'");
						$autor = $consultaautor->fetch(PDO::FETCH_ASSOC);
					
					echo "  <div id='noticia'>
								<div id='titulo'>
									<a class='titulo' href='detalhe.php?cod=".$conteudo['cod_controle']."'>".$conteudo['titulo']." </a>
								</div>
								<div id='corpo'>
									".$conteudo['corpo']."
								</div>
								<div id='rodape'>
									<strong>Categorias: </strong>".$conteudo['categorias']."<br>
									<strong>Postado por: </strong><u>".$autor['nome']."</u>
									em ".date("d/m/Y", strtotime($conteudo['data_versao']))."
									às ".date("h:m", strtotime($conteudo['data_versao']))."
								</div>
								<div id='divisor'>
								</div>
							</div>";
					}
						
				} else {
					//redireciona
				}
			
			
			?>
		</div>
		<div id="footer">
			<center><p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a>. Sua atualização é de responsabilidade da Prefeitura Municipal| <a href="../admin">Login</a></p></center>
		</div>
	</body>
</html>