<?php
  	if (isset($_GET['cod_marca'])) {
		$cod_marca = $_GET['cod_marca'];
		$SQL = "DELETE FROM hdk_marca WHERE cod_marca = " . $cod_marca;
		// Executa a query
      header('Location:listar_marca.php');
	} else {
		header('Location:listar_marca.php');
	}
?>