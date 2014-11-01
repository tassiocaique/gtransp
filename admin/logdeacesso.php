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
	<title>Log de acessos</title>
	<style type="text/css">
		body {background-color:#FFFFFF}
		tr {
			background:#F0F0EE;
		}
		td, th {
			padding:5px;
		}
		th {
			background:#232323;
			color:#FFFFFF;
		}
	</style>
</head>
	<body> 
		<p><h3>Relatório de Acessos G-Transp - <?php echo date("Y-m-d h:m:s")?></h3></p>
		<table>
			<th>Usuário</th>
			<th>Data/Hora de Acesso</th>
		
		<?php
			require_once('../config/conexao.php');
			$db = Conexao::getInstance();
			$tabela = Conexao::getTabela('TB_CONTROLE_ACESSO');			
			$query = $db->query("SELECT * FROM $tabela ORDER BY 1 DESC");
			while ($conteudo = $query->fetch(PDO::FETCH_ASSOC)) {
				echo "<tr>";
				echo "<td>".$conteudo['cpf_usuario']."</td>";
				echo "<td>".$conteudo['data_acesso']."</td>";
			}
					
		?>
		</table>
		<br/>
		<br/>
		<a href="home_admin.php"> Voltar ao Painel de Controle</a>
	</body>
</html>