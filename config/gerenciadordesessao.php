<?php

/*
* Essa classe tem como intuito fazer a verificação do nível de autenticação de um usuário bem como se ele está autencidado ou não.
*/

class GerenciadorDeSessao {
	
	function __construct() {
		session_start();
	}
	
	public function isGerenciador() {
		if ((!isset($_SESSION['login']) == true) && (!isset($_SESSION['senha']) == true)) {	
					unset($_SESSION['login']);
					unset($_SESSION['senha']);
					header('location:index.php');
					return false;

		} else {
			return true;
		}
	}
	
	public function isAdministrador() {
		if ($this->isGerenciador() && isset($_SESSION['admin'])) {
			return true;
		} else if($this->isGerenciador()){
			header('location:home.php');
		} else {
			unset($_SESSION['login']);
			unset($_SESSION['senha']);
			header('location:index.php');
			return false;
		}
		
	}
	
}
?>