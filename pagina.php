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
				
				if(isset($_GET['id'])) {
				
				$identificacao = $_GET['id'];
				
				/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
				//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
				require_once('config/conexao.php');
				
				//Atribui a instância do banco a uma variável
				$db = Conexao::getInstance();
				//===================================================================================================================================================================================================================================================
				
				$tabela = Conexao::getTabela('TB_PAGINA');
								
				$query = $db->query("SELECT * FROM `$tabela` WHERE `$tabela`.`visivel` = 1 AND `$tabela`.`identificacao`='$identificacao'");
			
				
				$conteudo = $query->fetch(PDO::FETCH_ASSOC) ;
				
					if ($query->rowCount() === 0) {
						$conteudo['titulo'] = "ERRO!";
						$conteudo['corpo'] = "Essa página ainda não possui nenhum conteúdo";
					}
								
				} else {
					//pagina não encontrada
				}
			
		?>
		
		<?php
			$arquivo = fopen('config/prefeitura.txt', 'r');
			if($arquivo == false)  {
				$titulo = "Portal";
			} else {
				$titulo = fgets($arquivo); 
				fclose($arquivo);
			}
		?>
		
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title><?php echo $conteudo['titulo']?> | <?php echo $titulo?> </title>
		<link href="index.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div id="pagina">
			<div id="header">
				<a href="index.php"><img src="imagens/header.jpg"/></a>
			</div>
			<div id="navegacao">
				<nav>
					<ul class="menu">
						<li><a href="#">Conheça o Município</a>
							<ul>
								<li><a href="pagina.php?id=apresentacao">Apresentação</a></li>
								<li><a href="pagina.php?id=pontosturisticos">Pontos Turísticos</a></li>
								<li><a href="pagina.php?id=historico">Histórico</a></li>
								<li><a href="pagina.php?id=estrutura">Estrutura Organizacional</a></li>
							</ul>
						</li>						
						<li><a href="noticias">Notícias</a></li>
						<li><a href="receitas">Receitas</a></li>
						<li><a href="despesas">Despesas</a></li>
						<li><a href="arquivos">Arquivos</a></li>
						<li><a href="">Licitações</a>
							<ul>
								<li><a href="">Em andamento</a></li>
								<li><a href="">Encerradas</a></li>
							</ul>
						</li>
						<li><a href="pagina.php?id=contatos">Contatos</a></li>
					</ul>
				</nav>
			</div>
			<div id="identificacao">
			</div>
			
			<?php
				echo "<div id='noticia'>
						 <div><h2><center>".$conteudo['titulo']."</center></h2></div>
						 <div id='corpo'>
							".$conteudo['corpo']."
						 </div>
					 </div>";
			?>			
			 
		</div>
		<div id="rodape">
			<center><p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a>. Sua atualização é de responsabilidade da Prefeitura Municipal| <a href="admin/home_admin.php">Login</a></p></center>
		</div>
	</body>
</html>