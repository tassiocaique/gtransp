<html>
	<head>
	
		<?php
			
			$arquivo = fopen('config/prefeitura.txt', 'r');
			if($arquivo == false)  {
				$titulo = "Portal";
			} else {
				$titulo = fgets($arquivo); 
				fclose($arquivo);
			}
			
			$arquivo = fopen('config/destaque1.txt', 'r');
			if($arquivo == false)  {
				$link1 = "";
			} else {
				$link1 = fgets($arquivo); 
				fclose($arquivo);
			}
			
			$arquivo = fopen('config/destaque2.txt', 'r');
			if($arquivo == false)  {
				$link2 = "";
			} else {
				$link2 = fgets($arquivo); 
				fclose($arquivo);
			}
			
			$arquivo = fopen('config/destaque3.txt', 'r');
			if($arquivo == false)  {
				$link3 = "";
			} else {
				$link3 = fgets($arquivo); 
				fclose($arquivo);
			}
		?>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title><?php echo $titulo;?></title>
		<link href="index.css" rel="stylesheet" type="text/css" media="screen" />
		<!-- Configurações do slide -->
		<!-- Arquivos necessário para a execução do slide -->
		<script src="javascript/jquery-1.8.2.min.js" type="text/javascript"></script>
		<script src="javascript/jquery.cycle.all.js" type="text/javascript"></script>
		<!-- e aqui damos vida ao rotator -->
		<script type="text/javascript">
			$( document ).ready( function(){
				$( "#container ul" ).cycle({ 
					fx: "scrollHorz"
				 });
				$("#nextbtn").click(function(){
					$("#container ul").cycle('next');
				});
				$("#prevbtn").click(function(){
					$("#container ul").cycle('prev');
				});
			} );
		</script>
		
	</head>
	
	<body>
		<div id="pagina">
			<div id="header">
				<a href="#"><img src="imagens/header.jpg"/></a>
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
						<li><a href="licitacoes">Licitações</a>
							<ul>
								<li><a href="licitacoes/?t=licitacao_em_andamento">Em andamento</a></li>
								<li><a href="licitacoes/?t=licitacao_encerrada">Encerradas</a></li>
							</ul>
						</li>
						<li><a href="pagina.php?id=contatos">Contatos</a></li>
					</ul>
				</nav>
			</div>
			<div id="container">		 
				<ul>
					<li id="box-1"><a href="<?php echo $link1; ?>"><img src="imagens/destaque1.jpg"/></a></li>
					<li id="box-2"><a href="<?php echo $link2; ?>"><img src="imagens/destaque2.jpg"/></a></li>
					<li id="box-3"><a href="<?php echo $link2; ?>"><img src="imagens/destaque3.jpg"/></a></li>
				</ul>
			</div>
			<div id="pager"></div>
			<div id="slidenav">
					<div id="nextbtn"></div>
					<div id="prevbtn"></div>
			</div>
			<div id="feedcontainer">
				<div id="feed">
					<center><h3><b>Últimas:</b></h3></center>
					
					<?php
					
						/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
						//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
						require_once('config/conexao.php');
						
						//Atribui a instância do banco a uma variável
						$db = Conexao::getInstance();
						//===================================================================================================================================================================================================================================================
						
						//Pega o nome da tabela
						$tabela = Conexao::getTabela('TB_NOTICIAS');
						
						$query = $db->query("SELECT * FROM $tabela WHERE `$tabela`.`visivel` = 1 ORDER BY `$tabela`.`data_versao` DESC");
						
						$i = 0;
						while ( ($conteudo = $query->fetch(PDO::FETCH_ASSOC)) && ($i != 4)) {
							$i++;
							echo "<p><strong><div class='noticiatxt'>Notícia: </div></strong><a href='noticias/detalhe.php?cod=".$conteudo['cod_controle']."'>".$conteudo['titulo']."</a></p>";
						}
					?>
				</div>
			</div>
			<div id="banner">
				<center>
					<table>
						<tr>
							<td><a href="noticias"><img src="imagens/noticias.png"/></a></td>
							<td><a href="receitas"><img src="imagens/receitas.png"/></a></td>
							<td><a href="despesas"><img src="imagens/despesas.png"/></a></td>
							<td><a href="arquivos"><img src="imagens/arquivos.png"/></a></td>
						</tr>
					</table>
					<a class="banner" href="contato"><img src="imagens/ouvidoria.png"/></a>
					<a class="banner" href="pagina.php?id=faq"><img src="imagens/faq.png"/></a>
				</center>
			</div>			
		</div>
		<div id="rodape">
				<center><p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a>. Sua atualização é de responsabilidade da Prefeitura Municipal| <a href="admin">Login</a></p></center>
		</div>
	</body>
</html>