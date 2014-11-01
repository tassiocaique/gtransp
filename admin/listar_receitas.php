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
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<title> Lista de Receitas </title>
		<link href="listar_noticias.css" rel="stylesheet" type="text/css" media="screen" />
		<link href="admin.css" rel="stylesheet" type="text/css" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	
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
					
					$tabela = Conexao::getTabela('TB_USUARIO');
					$consultaautor = $db->query("SELECT * FROM $tabela WHERE cpf = '$conteudo[cpf_usuario]'");
					$fetch = $consultaautor->fetch(PDO::FETCH_ASSOC);
					$autor = $fetch['nome'];
						
					echo "<tr class=".$classe.">";
					echo "<td>".date("d-m-Y", strtotime($conteudo['data_versao']))."</td>";
					echo "<td>".$conteudo['identificacao']."</td>";
					echo "<td>".$autor."</td>";
					echo "<td><a href='editar_receita.php?ctl=".$conteudo['cod_controle']."'><img src='../imagens/edit.png'></a></td>";
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