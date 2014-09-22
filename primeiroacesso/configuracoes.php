<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title> Bem vindo ao G-Transp - Primeiro Acesso  - Configurações Iniciais</title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<style type="text/css">
		</style>
	</head>
	<body>
		<div class="container">
			<div class="page-header">
				<center>
					<a href="#"><img height="200px" src="../imagens/logomarca.png"/></a>
				</center>
			</div>
			<h2> Seja bem vindo ao gerenciador de conteúdo público G-Transp </h2>
			<p> Este é seu primeiro acesso. É necessário configurar um usuário e uma senha para que você possa ter acesso as funcionalidades do G-Transp</p>
			<div>
				<form role="form" id="form" method="post" action="../admin/salvar_configuracoes.php" enctype="multipart/form-data">
					<h4>Alterar nome da prefeitura</h4>
					<div class="form-group">
						<label for="usuário">Nome da prefeitura: </label>
						<input type="text" name="nome_prefeitura" placeholder="Prefeitura Municipal de PRO-SPB" class="form-control" />
					</div>
					<h4>Alterar email de contato: </h4>
					<div class="form-group">
						<label for="usuário">Email de contato: </label>
						<input type="text" name="email_contato" placeholder="contato@aplicativaria.com" class="form-control"  />
					</div>
					<h4>Modificar imagem do cabeçalho: </h4>
					<span>Imagem exemplo: (dimensões recomendadas: 800x150 px, formato .jpg):</span>
					<img style="padding:15px;" src="../imagens/header.jpg" />
					<br><span>Escolha o arquivo que deseja publicar (Tamanho Máx 2mb):</span><br>
					<div class="form-group">
						<input name="arquivo" type="file"/>
					</div>				
					<button type="submit" class="btn btn-default">Salvar configurações</button>
				</form>
			</div>
		</div>
		<div class="panel-footer">
			<center>
				<p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a> | Essa página de primeiro acesso é uma cortesia da <a href="">Aplicativaria</a></p>
				<a href="http://www.aplicativaria.com/"><img height="30" src="../imagens/icone_aplicativaria.png"/ onMouseOver="this.src='../imagens/icone_aplicativaria_hover.png'" onMouseOut="this.src='../imagens/icone_aplicativaria.png'"></a>
			</center>
		</div>
	</body>
</html>