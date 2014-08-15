<html>
<head>
	<title>Log de acessos</title>
	<style type="text/css">
		body {background-color:#000;font-family:Courier;color:green}
	</style>
</head>
	<body> 
		<p><h3>Log de Acessos gTransp - <?php echo date("Y-m-d h:m:s")?></h3></p>
		<p>------------------------------------------------------------------</p>
		<?php
			require_once('config/conexao.php');
			$db = Conexao::getInstance();
			$tabela = Conexao::getTabela('TB_CONTROLE_ACESSO');			
			$query = $db->query("SELECT * FROM $tabela ORDER BY 1 DESC");
			$conteudo = $query->fetchAll(PDO::FETCH_ASSOC);
			echo "<p>".nl2br(json_encode($conteudo, JSON_PRETTY_PRINT))."</p>";		
		?>
		<p>------------------------------------------------------------------</p>
	</body>
</html>