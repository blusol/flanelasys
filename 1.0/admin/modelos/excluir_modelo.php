<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
	require_once($path_relative.'verifica.php');
  	if (isset($_GET['cod_modelo'])) {
		$cod_modelo = $_GET['cod_modelo'];
		$SQL = "DELETE FROM hdk_modelo WHERE cod_modelo = " . $cod_modelo;
		// Executa a query
      header('Location:listar_marca.php');
	} else {
		header('Location:listar_marca.php');
	}
?>