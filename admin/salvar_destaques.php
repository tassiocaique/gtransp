<?php

	session_start();
	
	$link1 = $_POST['link1'];
	$link2 = $_POST['link2'];
	$link3 = $_POST['link3'];
	
	$arquivo = fopen('../config/destaque1.txt', 'w');
	if($arquivo == false)  {
		die('Não foi possível criar o arquivo');
	}
	else {
		if(!fwrite($arquivo, $link1)) die('Não foi possível alterar o nome da prefeitura');
		$sucesso = true;
		fclose($arquivo);
	}
	
	$arquivo = fopen('../config/destaque2.txt', 'w');
	if($arquivo == false)  {
		die('Não foi possível criar o arquivo');
	}
	else {
		if(!fwrite($arquivo, $link2)) die('Não foi possível alterar o email de contato');
		$sucesso = true;
		fclose($arquivo);
	}
	
	$arquivo = fopen('../config/destaque3.txt', 'w');
	if($arquivo == false)  {
		die('Não foi possível criar o arquivo');
	}
	else {
		if(!fwrite($arquivo, $link3)) die('Não foi possível alterar o email de contato');
		$sucesso = true;
		fclose($arquivo);
	}
	
	
	if(is_uploaded_file($_FILES['destaque1']['tmp_name'])) {
			/*-----------------------------------------------------------------------------------------------------*/
			/*                                         Upload da imagem                                            */
			/*-----------------------------------------------------------------------------------------------------*/
			//Pasta onde arquivo vai ser salvo no servidor
			$_UP['pasta'] = "../imagens/";
			
			//Tamanho máximo do arquivo em bytes (2mb)
			$_UP['tamanho'] = 1204 * 1024 * 2 ;
			
			//Extensões permitidas
			$_UP['extensoes'] = array('png','jpg');
			
			$_UP['renomeia'] = true;
			
			//Tipos de erro no upload de arquivos com php
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload e se houve exibe uma mensagem de erro
			if($_FILES['destaque1']['error'] != 0) {
				die("Não foi possível fazer o upload. Erro: <br>" . $_UP['erros'][$_FILES['arquivo']['error']]);
				exit; //para a execução do script
			}
			
			//Faz a verificação da extensão do arquivo
			$extensao = strtolower(end(explode(".", $_FILES['destaque1']['name'])));
			if (array_search($extensao, $_UP['extensoes']) == false) {
			
				$sucesso = false;
			
			} else if($_UP['tamanho'] < $_FILES['destaque1']['size']) { //Verifica o tamanho do arquivo
				
				$sucesso = false;
				
			} else {	
				//Renomeia o arquivo
				$nome_final = 'destaque1.jpg';
				
				/*Move o arquivo para a pasta*/
				if(move_uploaded_file($_FILES['destaque1']['tmp_name'], $_UP['pasta'].$nome_final)) {
					//Upload efetuado com sucesso
					$sucesso = true;
					$caminho = $_UP['pasta'] . $nome_final;					
				} else {
					$sucesso = false;
				}
			}
	}
	
	if(is_uploaded_file($_FILES['destaque2']['tmp_name'])) {
			/*-----------------------------------------------------------------------------------------------------*/
			/*                                         Upload da imagem de destaque1                               */
			/*-----------------------------------------------------------------------------------------------------*/
			//Pasta onde arquivo vai ser salvo no servidor
			$_UP['pasta'] = "../imagens/";
			
			//Tamanho máximo do arquivo em bytes (2mb)
			$_UP['tamanho'] = 1204 * 1024 * 2 ;
			
			//Extensões permitidas
			$_UP['extensoes'] = array('png','jpg');
			
			$_UP['renomeia'] = true;
			
			//Tipos de erro no upload de arquivos com php
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload e se houve exibe uma mensagem de erro
			if($_FILES['destaque2']['error'] != 0) {
				die("Não foi possível fazer o upload. Erro: <br>" . $_UP['erros'][$_FILES['destaque2']['error']]);
				exit; //para a execução do script
			}
			
			//Faz a verificação da extensão do arquivo
			$extensao = strtolower(end(explode(".", $_FILES['destaque2']['name'])));
			if (array_search($extensao, $_UP['extensoes']) == false) {
			
				$sucesso = false;
			
			} else if($_UP['tamanho'] < $_FILES['destaque2']['size']) { //Verifica o tamanho do arquivo
				
				$sucesso = false;
				
			} else {	
				//Renomeia o arquivo
				$nome_final = 'destaque2.jpg';
				
				/*Move o arquivo para a pasta*/
				if(move_uploaded_file($_FILES['destaque2']['tmp_name'], $_UP['pasta'].$nome_final)) {
					//Upload efetuado com sucesso
					echo "Upload efetuado com sucesso!";
					$caminho = $_UP['pasta'] . $nome_final;
					$sucesso = true;
					
				} else {
					$sucesso = false;
				}
			}
	}
	
	if(is_uploaded_file($_FILES['destaque3']['tmp_name'])) {
			/*-----------------------------------------------------------------------------------------------------*/
			/*                                         Upload da imagem de cabeçalho                               */
			/*-----------------------------------------------------------------------------------------------------*/
			//Pasta onde arquivo vai ser salvo no servidor
			$_UP['pasta'] = "../imagens/";
			
			//Tamanho máximo do arquivo em bytes (2mb)
			$_UP['tamanho'] = 1204 * 1024 * 2 ;
			
			//Extensões permitidas
			$_UP['extensoes'] = array('png','jpg');
			
			$_UP['renomeia'] = true;
			
			//Tipos de erro no upload de arquivos com php
			$_UP['erros'][0] = 'Não houve erro';
			$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
			$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
			$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
			$_UP['erros'][4] = 'Não foi feito o upload do arquivo';
			
			//Verifica se houve algum erro com o upload e se houve exibe uma mensagem de erro
			if($_FILES['destaque3']['error'] != 0) {
				die("Não foi possível fazer o upload. Erro: <br>" . $_UP['erros'][$_FILES['destaque3']['error']]);
				exit; //para a execução do script
			}
			
			//Faz a verificação da extensão do arquivo
			$extensao = strtolower(end(explode(".", $_FILES['destaque3']['name'])));
			if (array_search($extensao, $_UP['extensoes']) == false) {
			
				$sucesso = false;
			
			} else if($_UP['tamanho'] < $_FILES['destaque3']['size']) { //Verifica o tamanho do arquivo
				
				$sucesso = false;
				
			} else {	
				//Renomeia o arquivo
				$nome_final = 'destaque3.jpg';
				
				/*Move o arquivo para a pasta*/
				if(move_uploaded_file($_FILES['destaque3']['tmp_name'], $_UP['pasta'].$nome_final)) {
					//Upload efetuado com sucesso
					echo "Upload efetuado com sucesso!";
					$caminho = $_UP['pasta'] . $nome_final;
					$sucesso = true;
					
				} else {
					$sucesso = false;
				}
			}
	}
	
	if($sucesso) {
		header("location:editar_destaques.php?r=1");
	} else {
		header("location:editar_destaques.php?r=0");
	}
?>