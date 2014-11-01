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
	<title>Editar usuário - Sistema gTransp</title>
	<link href="novo_usuario.css" rel="stylesheet" type="text/css" media="screen" />
	<link href="admin.css" rel="stylesheet" type="text/css" media="screen" />
	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="../javascript/validarcpf.js" ></script>
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
		<form method="post" action="inserir_edicao_usuario.php">
			<?php
					if(isset($_GET['r'])) {
						$resultado = $_GET['r'];
						if ($resultado == "1") {
							echo "<div class='success'><center><h3>Usuário editado com sucesso!</h3></center></div>";
						}else {
							echo "<div class='fail'><center><h3>Ocorreu um erro! Tente novamente.<h3></center></div>";
						}
					}
					
					if(isset($_GET['u'])) {
						$cpf = $_GET['u'];
						/* ========================================== Estabelece a conexão com o banco de dados fazendo uso da classe Conexão =============================================================================================================================*/
		
						//Inclui o arquivo conexao.php para podermos fazer uso do mesmo
						require_once('../config/conexao.php');
						
						//Atribui a instância do banco a uma variável
						$db = Conexao::getInstance();
						//===================================================================================================================================================================================================================================================
						
						//Pega o nome da tabela
						$tabela = Conexao::getTabela('TB_USUARIO');
						
						
						$query = $db->query("SELECT * FROM $tabela WHERE $tabela.ativo=1 AND $tabela.cpf='$cpf'");
						
						
						$usuario = $query->fetch(PDO::FETCH_ASSOC);
					}
			?>
		<h1>Editar um usuário</h1>
			<label>
				<span>CPF (Login): </span>
				<input class="normal" type="text" name="login" value="<?php echo $usuario['cpf']; ?>" id="login" onchange="javascript:validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" readonly="readonly"/>
				<p id="mensagem"></p>
			</label>
			<label>
				<span>Nome: </span>
				<input class="normal" type="text" value="<?php echo $usuario['nome'] ?>" name="nome"/>
			</label>
						
			<label>
				<span>Nível de permissão: </span>
				
				<select name="nivel_permissao" class="normal" required>
					<?php
						if($usuario['nivel_permissao'] == 0) {
							echo "<option value='gerenciador' selected='selected'>Gerenciador</option>";
							echo "<option value='admin'>Administrador</option>";
						} else {
							echo "<option value='gerenciador'>Gerenciador</option>";
							echo "<option value='admin' selected='selected'>Administrador</option>";
						}
					?>
					
				</select>
			</label>
			
			<label>
				<span>Departamento: </span>
				<input class="normal" type="text" value="<?php echo $usuario['departamento']?>" name="departamento"/>
			</label>
			
			<center><input class="button" type="submit" value="Cadastrar" ></center>
			
		</form>
	
	</div>
	</div>
 </body>
</html>