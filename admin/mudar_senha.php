<html>
 <head>
	<?php
			
			session_start();
			
			if ((!isset($_SESSION['login']) == true) && (!isset($_SESSION['senha']) == true) 
				&& (!isset($_SESSION['admin']) == true)) {
					
					unset($_SESSION['login']);
					unset($_SESSION['senha']);
					unset($_SESSION['admin']);
					header('location:index.php');
					
				}
			
	?>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Inserir novo usuário - Sistema gTransp</title>
	<link href="novo_usuario.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="../javascript/validarcpf.js" ></script>
	<script type="text/javascript">
		function comparaSenhas(senha1, senha2) {
			if (senha1 != senha2) {
				alert('As senhas não coincidem!');
			}
		}
	</script>
 </head>
 <body>
	
	<div id="pagina">
	<div id="header">
		<div id="logo"><a href=""><img src="../imagens/gtransp.png"/></a></div>
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
		<form method="post" action="inserir_mudar_senha.php">
			<?php
					if(isset($_GET['r'])) {
						$resultado = $_GET['r'];
						if ($resultado == "1") {
							echo "<div class='success'><center><h3>Senha modificada com sucesso!</h3></center></div>";
						} else if ($resultado == "2") {
							echo "<div class='fail'><center><h3>As senhas não coincidem! <h3></center></div>";
						}
						else {
							echo "<div class='fail'><center><h3>Ocorreu um erro! Tente novamente.<h3></center></div>";
						}
					}
			?>
		<h1>Mudar senha</h1>
			<label>
				<span>CPF (Login): </span>
				<input class="normal" type="text"  value='<?php echo $_SESSION['login']?>' readonly='readonly' name="login" id="login" onchange="javascript:validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14"/>
				<p id="mensagem"></p>
			</label>
			
			<label>
				<span>Antiga Senha: </span>
				<input class="normal" type="password" name="asenha" id="asenha"/>
			</label>
			
			<label>
				<span>Nova Senha: </span>
				<input class="normal" type="password" name="senha" id="senha"/>
			</label>
			
			
			<label>
				<span>Redigite a Nova Senha: </span>
				<input class="normal" type="password" name="rsenha" onblur="javascript:comparaSenhas(this.value, document.getElementById('senha').value);"/>
			</label>
			
			<center><input class="button" type="submit" value="Mudar senha" ></center>
			
		</form>
	
	</div>
	</div>
 </body>
</html>