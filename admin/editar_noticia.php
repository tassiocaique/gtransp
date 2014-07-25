<html>
	<head>
	
		<?php
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
			
			//Pega o nome da tabela
			$tabela = Conexao::getTabela('TB_NOTICIAS');
			
			$cod_controle = $_GET['ctl'];
			
			$query = $db->query("SELECT * FROM $tabela WHERE cod_controle = '$cod_controle'");
			
			$conteudo = $query->fetch(PDO::FETCH_ASSOC);
			
			
		?>
		
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<link href="nova_noticia.css" rel="stylesheet" type="text/css" media="screen" />
		<title>Editar notícia</title>
		
		<!-- Configurações do editor de texto -->
		<!-- Editor utilizado: TinyMCE | Site: http://www.tinymce.com/ | Documentação: http://www.tinymce.com/wiki.php -->
		<script type="text/javascript" src="../javascript/tinymce/tinymce.min.js"></script>
		<script type="text/javascript">
			tinymce.init({
				selector:"textarea",
				theme:"modern",
				width:"800",
				height:"300",
				menubar:"edit insert view format table tools", 
				plugins:["autolink charmap code image link media paste preview textcolor wordcount table jbimages"],
				toolbar: "undo redo | copy paste cut | styleselect | bold italic | alignleft aligncenter alignright alignjustify | forecolor backcolor | media link image | jbimages",
				tools:"inserttable",
				language:"pt_BR"		
			});
		</script>
		<!-- Fim das configurações do editor de texto -->
	</head>
	<body>
	
		
	
		<div id="pagina">
			<div id="header">
				<div id="logo"><a href=""><img src="../imagens/gtransp.png"/></a></div>
			</div>
			<div id="navegacao">
				<nav id="menu">
					<ul>
						<li><a href="#">Painel</a></li>
						<li><a href="#">Nova Notícia</a></li>
						<li><a href="receitas">Nova Receita</a></li>
						<li><a href="despesas">Nova Despesa</a></li>
						<li><a href="#">Lançar Arquivo</a></li>
					</ul>
				</nav>
			</div>
			<div id="formulario">
			<?php
					if(isset($_GET['r'])) {
						$resultado = $_GET['r'];
						if ($resultado == "1") {
							if(isset($_GET['ctl'])) {
								$cod = $_GET['ctl'];
								echo "<div class='success'><center><h3>Notícia publicada com sucesso! <a href='../noticias/detalhe.php?cod=".$cod."'>Visualizar</a></h3></center></div>";
							} else {
							echo "<div class='fail'><center><h3> Ocorreu um erro! </h3></center></div>";
							} 
						}
						else {
							echo "<div class='fail'><center><h3> Ocorreu um erro! </h3></center></div>";
						}
					}
			?>
				<h1> Editar notícia</h1>
				<form method="post" action="inserir_edicao_noticia.php">
					<label>
						<span>Título:</span>
						<input class="titulo" type="text" name="titulo" value="<?php print $conteudo['titulo'] ?>" required/>
					</label>
					<label>
						<textarea name="corpo"><?php echo $conteudo['corpo']?></textarea>
					</label>
					<label>
						<span>Categorias:</span>
						<input class="categorias" type="text" name="categorias" value="<?php print $conteudo['categorias'] ?>"/>
					</label>
					<div class="info">
					<label>
						<span>Informações da notícia:</span>
						Código de controle: <input readonly="readonly" name="cod_controle" value="<?php print $conteudo['cod_controle'] ?>"/>
						Código da Notícia: <input readonly="readonly" name="cod_noticia" value="<?php print $conteudo['cod_noticia'] ?>"/>
					</label>
					</div>
					<input class="button" type="submit" value="Publicar"/>
				</form>
			</div>
		</div>
	</body>
</html>