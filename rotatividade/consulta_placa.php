<?php
	include('../includes/config.php');
	include_once('../includes/funcao.php');
	include_once($path_classes.'fla_conexao.class.php');
	$des_placa = strtolower($_GET['des_placa']);
	$objConexao = new fla_conexao();
	
	$SQL = 'SELECT 
				des_placa
				, cod_modelo
				, cod_marca
				, des_cor
			FROM
				fla_clientes
			WHERE
				LOWER(des_placa) = "' . $des_placa . '"';
	
	$rsPlaca = $objConexao->prepare($SQL);
	$rsPlaca->execute();
	if ($rsPlaca != false) {
		if ($rsPlaca->rowCount() > 0) {
			while($placa = $rsPlaca->fetch(PDO::FETCH_ASSOC)){
				$cod_marca  = $placa['cod_marca'];
				$cod_modelo = $placa['cod_modelo'];			
				$des_cor    = $placa['des_cor'];
				echo sprintf('new Array("%s","%s","%s")',$cod_marca,$cod_modelo,$des_cor);
			}
		}
	}

?>