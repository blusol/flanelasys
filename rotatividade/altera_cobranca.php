<?php
	ini_set('date.timezone', 'America/Sao_Paulo');
	include('../includes/config.php');
	include_once('../includes/funcao.php');
	include_once($path_classes.'fla_conexao.class.php');
	include_once($path_classes.'fla_precos.class.php');
	
	$cod_cartao = $_GET['cod_cartao'];
	
	$objConexao = new fla_conexao();
	$objPrecos  = new fla_precos();
	
	$arrPreco = array();
	
?>