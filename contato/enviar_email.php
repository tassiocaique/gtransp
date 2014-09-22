<?php

	if(isset($_POST['nome']) && isset($_POST['email']) && isset($_POST['assunto']) && isset($_POST['conteudo'])) {
		
		$nome = $_POST['nome'];
		$de = $_POST['email'];
		$assunto = $_POST['assunto'];
		$conteudo = $_POST['conteudo'];
		
		
		$arquivo = fopen('../config/contato.txt', 'r');
		if($arquivo == false)  {
			die('Não foi possível criar o arquivo');
		} else {
			$remetente = fgets($arquivo); 
			fclose($arquivo);
		}
		
		
		$headers =  "Content-Type:text/html; charset=UTF-8\n";
		$headers .= "From: <".$remetente.">"; //Vai ser mostrado que o email partiu deste email e seguido do nome
		$headers .= "X-Sender:  <".$remetente.">\n"; //email do servidor que enviou
		$headers .= "X-Mailer: PHP  v".phpversion()."\n";
		$headers .= "X-IP:  ".$_SERVER['REMOTE_ADDR']."\n";
		$headers .= "Return-Path:  <".$remetente.">\n"; //caso seja respondida
		$headers .= "MIME-Version: 1.0\n";
		
		
		$send = mail($remetente, $assunto, $conteudo, $headers, "-f$remetente");
		
		var_dump($send);
		
		if($send) {
			header("location:index.php?r=1");
		} else {
			header("location:index.php?r=0");
		}
		
	} else {
		header("location:index.php?r=0");
	}

?>