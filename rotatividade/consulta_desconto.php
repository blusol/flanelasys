<?php
	include('../includes/config.php');
	include_once('../includes/funcao.php');
	include_once($path_classes.'fla_conexao.class.php');
	
	$cod_desconto = $_GET['cod_desconto'];
	$val_cobrado  = $_GET['val_total'];
	$objConexao   = new fla_conexao();
	
	$SQL = 'select
				des_desconto
				, val_desconto
			from
				fla_descontos
			where
				cod_desconto = ' . $cod_desconto;
	
	$rsDesconto = $objConexao->prepare($SQL);
	$rsDesconto->execute();
	if ($rsDesconto != false) {
		if ($rsDesconto->rowCount() > 0) {
			while($desconto = $rsDesconto->fetch(PDO::FETCH_ASSOC)){
				$des_desconto = $desconto['des_desconto'];
				$val_desconto = $desconto['val_desconto'];
				$val_cobrado = ($val_cobrado - $val_desconto);
				
				if ($val_cobrado < 0) {
					$val_cobrado = 0;
					$valor_negativo = "yes";
				} else {
					$valor_negativo = "no";
				}
				
				$val_cobrado = number_format($val_cobrado, 2, ',', ' ');				
				echo sprintf('new Array("%s","%s","%s","%s")',$des_desconto,$val_desconto,$val_cobrado,$valor_negativo);
			}
		}
	}		
?>