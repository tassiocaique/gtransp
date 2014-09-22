<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="content-type" content="text/html; charset=utf-8">
		<title> Bem vindo ao G-Transp - Primeiro Acesso  </title>
		<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="../javascript/validarcpf.js" ></script>
		<script type="text/javascript">
			function comparaSenhas(senha1, senha2) {
				if (senha1 != senha2) {
					alert('As senhas não coincidem!');
				}
			}
		</script>
		<script type="text/javascript" src="//cdn.jsdelivr.net/jquery/1.11.1/jquery.min.js"></script>
		<link rel="stylesheet" href="//cdn.jsdelivr.net/fontawesome/4.1.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/css/bootstrapValidator.min.css"/>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.1/js/bootstrapValidator.min.js"></script>
		
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
			<form method="post" id="registrationForm" action="../admin/inserir_usuario.php?intro=true" >
				<div class="form-group">
					<label>Nome: </label>
					<input class="form-control" type="text" name="nome" id="nome"/>
				</div>
				<div class="form-group">
					<label>CPF: </label>
					<input class="form-control" type="text" name="login" id="login" onchange="javascript:validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);"  maxlength="14" required/>
				</div>
				<div class="form-group">
					<label>Departamento: </label>
					<input class="form-control" type="text" name="departamento" id="departamento" required/>
				</div>				
				<div class="form-group">
					<label>Senha: </label>
					<input type="password" name="senha" id="senha" class="form-control" required/>
				</div>
				<div class="form-group">
					<label>Redigite sua senha: </label>
					<input class="form-control" type="password" id="rsenha" name="rsenha" onblur="javascript:comparaSenhas(this.value, document.getElementById('senha').value);" required/>
				</div>
				<button type="submit" class="btn btn-default">Inserir primeiro usuário</button>
			</form>

		</div>
		<div class="panel-footer">
			<center>
				<p>Portal desenvolvido como atividade do <a href="">PRO-SPB/UNIVASF</a> | Essa página de primeiro acesso é uma cortesia da <a href="">Aplicativaria</a></p>
				<a href="http://www.aplicativaria.com/"><img height="30" src="../imagens/icone_aplicativaria.png"/ onMouseOver="this.src='../imagens/icone_aplicativaria_hover.png'" onMouseOut="this.src='../imagens/icone_aplicativaria.png'"></a>
			</center>
		</div>			
		<script>
		$(document).ready(function() {
		    $('#registrationForm').bootstrapValidator({
		        feedbackIcons: {
		            valid: 'glyphicon glyphicon-ok',
		            invalid: 'glyphicon glyphicon-remove',
		            validating: 'glyphicon glyphicon-refresh'
		        },
		        fields: {
		            nome: {
		                message: 'Nome de usuário inválido',
		                validators: {
		                    notEmpty: {
		                        message: 'Este campo não pode ficar vazio'
		                    },
		                }
		            },
		            login: {
		                validators: {
		                    notEmpty: {
		                        message: 'The email address is required and cannot be empty'
		                    },
		                    
		                }
		            },
		            password: {
		                validators: {
		                    notEmpty: {
		                        message: 'The password is required and cannot be empty'
		                    },
		                    different: {
		                        field: 'username',
		                        message: 'The password cannot be the same as username'
		                    },
		                    stringLength: {
		                        min: 8,
		                        message: 'The password must have at least 8 characters'
		                    }
		                }
		            },
		            birthday: {
		                validators: {
		                    notEmpty: {
		                        message: 'The date of birth is required'
		                    },
		                    date: {
		                        format: 'YYYY/MM/DD',
		                        message: 'The date of birth is not valid'
		                    }
		                }
		            },
		            gender: {
		                validators: {
		                    notEmpty: {
		                        message: 'The gender is required'
		                    }
		                }
		            }
		        }
		    });
	});
	</script>
	</body>
</html>