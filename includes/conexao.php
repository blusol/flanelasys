<?php         
		// Passando o caminho do arquivo config.php
		 // include_once('../includes/config.php');
		// Carregando o arquivo de inicializa��o da base de dados do sistema 
		 // include_once($path_libraries.'adodb.inc.php');
		 
		 // Vari�vel global para ser acess�vel de qualquer parte do sistema 
		 // global $conexao;
		 
		 // Definindo o tipo de conex�o
		 // $dbdriver = "mysql";
		 
		 // Definindo os dados de acesso ao banco de dados
		 // Servidor
		 $server = "localhost";
		 // Usu�rio
		 $user = "root";
		 // Senha
		 $password = "";
		 $database = "flanelasys";
		 
		 try {
			$conexao = new PDO("mysql:host=$server;$dbname=mysql",$user,$password);
			//echo 'conectado no banco';
		 } catch (PDOException $e) {
			echo $e->getMessage();
		}
		 
		 // // Criando uma nova conex�o
         // $conexao = ADONewConnection($dbdriver); # eg 'mysql' or 'postgres'

		 // // Setando a biblioteca para n�o exibir erros		 
         // $conexao->debug = false;

		 // // Conectando com a base de dados
         // $conexao->Connect($server, $user, $password, $database);
		 
		
?>