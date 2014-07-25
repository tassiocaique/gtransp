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
			<center><p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a>. Sua atualização é de responsabilidade da Prefeitura Municipal| <a href="../admin">Login</a></p></center>
		</div>
	</body>
</html>