<html>
	<head>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title>Notícias</title>
		<link href="style.css" rel="stylesheet" type="text/css" media="screen" />
	</head>
	<body>
		<div id="pagina">
			<div id="header">
				<a href=".."><img src="../imagens/header.jpg"/></a>
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
						<li><a href="#">Notícias</a></li>
						<li><a href="../receitas">Receitas</a></li>
						<li><a href="../despesas">Despesas</a></li>
						<li><a href="../arquivos">Arquivos</a></li>
						<li><a href="#">Licitações</a>
							<ul>
								<li><a href="../licitacoes/?t=licitacao_em_andamento">Em andamento</a></li>
								<li><a href="../licitacoes/?t=licitacao_encerrada">Encerradas</a></li>
							</ul>
						</li>
						<li><a href="../pagina.php?id=contatos">Contatos</a></li>
					</ul>
				</nav>
			</div>
			<div id="identificacao">
				<div id="containerbusca">
					<form method="get" action="index.php">
						<input class="caixapesquisa" type="text" name="pesquisa" placeholder="Digite aqui o termo que deseja pesquisar" required/>
						<input class="botaopesquisa" type="submit" value=" "/>
					</form>
				</div>
			</div>
			
			<?php
			
				/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
				//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
				require_once('../config/conexao.php');
				
				//Atribui a instância do banco a uma variável
				$db = Conexao::getInstance();
				//===================================================================================================================================================================================================================================================
				
				
				$tabela = Conexao::getTabela('TB_NOTICIAS');
				
				if(isset($_GET['pesquisa'])) {
					$busca = $_GET['pesquisa'];
					$query = $db->query("SELECT * FROM `$tabela` WHERE (`$tabela`.`visivel` = 1) AND ((`$tabela`.`titulo` LIKE '%".$busca."%') OR ('%".$busca."%'))  ORDER BY `$tabela`.`data_versao` DESC");
				} else {
					$query = $db->query("SELECT * FROM `$tabela` WHERE `$tabela`.`visivel` = 1 ORDER BY `$tabela`.`data_versao` DESC");
				}
			
				if ($query->rowCount() > 0) {
				
					if (isset($busca)) {
						echo "<center><i>Exibindo resultados para: <b>".$busca."</b> . ".$query->rowCount()." resultado(s) encontrado(s)<br><br></i></center>";
					}
				
					while ( $conteudo = $query->fetch(PDO::FETCH_ASSOC) ) {
						
						
						$tabela = Conexao::getTabela('TB_USUARIO');
											
						$consultaautor = $db->query("SELECT * FROM $tabela WHERE cpf = '$conteudo[cpf_usuario]'");
						$fetch = $consultaautor->fetch(PDO::FETCH_ASSOC);
						$autor = $fetch['nome'];
					
						echo "  <div id='noticia'>
								<div id='titulo'>
									<a class='titulo' href='detalhe.php?cod=".$conteudo['cod_controle']."'>".$conteudo['titulo']." </a>
								</div>
								<div id='corpo'>
									".$conteudo['corpo']."
								</div>
								<div id='rodape'>
									<strong>Categorias: </strong>".$conteudo['categorias']."<br>
									<strong>Postado por: </strong><u>".$autor."</u>
									em ".date("d/m/Y", strtotime($conteudo['data_versao']))."
									às ".date("h:m", strtotime($conteudo['data_versao']))."
								</div>
								<div id='divisor'>
								</div>
							</div>";
						
					}
				
				}  else {
					echo "<center>Nenhum resultado encontrado";
					if (isset($_GET['pesquisa'])) echo " para <b>". $busca ."</b>";
					echo "</center>";
					
				}
			
			?>
		</div>
		<div id="footer">
			<center><p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a>. Sua atualização é de responsabilidade da Prefeitura Municipal| <a href="../admin">Login</a></p></center>
		</div>
	</body>
</html>