<html>
	<head>
	<?php
		session_start();
	?>
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Lista de Receitas </title>
		<link href="listar_noticias.css" rel="stylesheet" type="text/css" media="screen" />
	
		<script type="text/javascript">
			function confirmarExclusao(id) {
				if(confirm("Tem certeza que deseja excluir essa receita?")) {
						location.href = "excluir.php?tabela=TB_UPLOAD&&id="+id;
				}
			}
		</script>
	
	</head>
	<body>
	
		<div id="pagina">
		
			<div id="header">
				<div id="logo"><a href="#"><img src="../imagens/gtransp.png"/></a></div>
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
		<div id="table_content">
			<?php
				if(isset($_GET['r'])) {
					$resultado = $_GET['r'];
					if($resultado == "1") {
						echo "<div class='success'><h3>Notícia excluída com sucesso!</h3></div>";
					} else {
						echo "<div class='fail'><h3>Ocorreu um erro!</h3></div>";
					} 
				}
			?>
			<h1>Lista de Receitas</h1>
			<table>
				<th>Data</th>
				<th>Identificação</th>
				<th>Quem publicou</th>
				<th>Editar</th>
				<th>Excluir</th>
			<?php
				
				/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
				//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
				require_once('../config/conexao.php');
				
				//Atribui a instância do banco a uma variável
				$db = Conexao::getInstance();
				//===================================================================================================================================================================================================================================================
				
				//Pega o nome da tabela
				$tabela = Conexao::getTabela('TB_UPLOAD');
				
				$query = $db->query("SELECT * FROM $tabela WHERE $tabela.visivel=1 AND $tabela.genero='Receitas'");
				
				$i = 0;
				
				while ($conteudo = $query->fetch(PDO::FETCH_ASSOC)) {
				
					if ($i%2 == 0) {
						$classe = "linhapar";
					} else {
						$classe = "linhaimpar";
					}
					
					$consultaautor = $db->query("SELECT * FROM usuario WHERE cpf = '$conteudo[cpf_usuario]'");
					$fetch = $consultaautor->fetch(PDO::FETCH_ASSOC);
					$autor = $fetch['nome'];
						
					echo "<tr class=".$classe.">";
					echo "<td>".date("d-m-Y", strtotime($conteudo['data_versao']))."</td>";
					echo "<td>".$conteudo['identificacao']."</td>";
					echo "<td>".$autor."</td>";
					echo "<td><a href='editar_noticia.php?ctl=".$conteudo['cod_controle']."'><img src='../imagens/edit.png'></a></td>";
					echo "<td><input class='btn' type='image' src='../imagens/delete.png' value='Excluir' onClick='confirmarExclusao(".$conteudo['cod_controle'].")'/></td>";
					echo "</tr>";
						   
					$i++;
				}
				
				echo "</table>";
			?>
		
		</div>
		</div>	
		</div>
		<div id="rodape">
				<center><p>Desenvolvido por <a href="">PRO-SPB</a> | <a href="../admin">Login</a></p></center>
		</div>
		
	</body>
</html>