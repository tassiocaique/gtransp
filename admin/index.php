<html>
	<head>
			
		<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
		<link href="index.css" rel="stylesheet" type="text/css" media="screen" />
		<title>Login- Sistema gTransp</title>
	</head>
	
	<body>
		<div id="header">
			<center><div id="logo"><img src="../imagens/gtransp.png"/></div></center>
		</div>
		<div id="logoprefeitura"><img src="../imagens/header.jpg"/></div>
		<div id="wrapper">		
			<form method="post" action="realizar_login.php">
				<label>
					<span>Login (CPF):</span>
					<input name="usuario" type="text" required>
				</label>
				
				<label>
					<span>Senha:</span>
					<input name ="senha" type="password" required>
				</label>
				
				<?php
					
					if (isset($_GET['erro'])) {
						$erro = $_GET['erro'];					
						if ($erro == 1) {
							echo "<p style='font-size:10px;color:#f00'>Usuário ou senha inválidos!</p>";
						}
					}
					
				?>
				
				<input type="submit" class="button" value="Fazer login">
			</form>
		</div>
	</body>
</html>