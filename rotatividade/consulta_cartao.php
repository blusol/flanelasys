<?php
	//ini_set('date.timezone', 'America/Sao_Paulo');
	include('../includes/config.php');
	include_once('../includes/funcao.php');
	include_once($path_classes.'fla_conexao.class.php');
	include_once($path_classes.'fla_precos.class.php');
	
	$cod_cartao = $_GET['cod_cartao'];
	
	$objConexao = new fla_conexao();
	$objPrecos  = new fla_precos();
	
	$arrPreco = array();
	
	$SQL = 'select
				rot.cod_rotatividade
				, rot.des_placa
				, rot.hor_entrada
				, rot.hor_saida
				, rot.dat_cadastro
				, rot.val_total
				, rot.des_situacao
				, rot.cod_cartao
				, cli.cod_marca
				, cli.cod_modelo
				, cli.des_cor
				, rot.cod_preco
			from
			   fla_rotatividade rot
			   join fla_clientes cli ON (cli.des_placa = rot.des_placa)
			   join fla_precos pre ON (pre.cod_preco = rot.cod_preco)
			where 
			   rot.cod_cartao = ' . $cod_cartao 
			   . ' AND rot.des_situacao = "P"';
			   
	//echo "<p>$SQL</p>";
	$rsCartao = $objConexao->prepare($SQL);
	$rsCartao->execute();
	
	if ($rsCartao != false) {
		if ($rsCartao->rowCount() > 0) {
			while($cartao = $rsCartao->fetch(PDO::FETCH_ASSOC)){
				$des_placa     = $cartao['des_placa'];
				$hor_entrada   = $cartao['hor_entrada'];
				$dat_entrada   = $cartao['dat_cadastro'];				
				$hora_saida    = date("H:i:s");
				$dat_saida     = date("Y-m-d");
				$cod_marca     = $cartao['cod_marca'];
				$cod_modelo    = $cartao['cod_modelo'];
				$des_cor       = $cartao['des_cor'];
				$des_situacao  = $cartao['des_situacao'];
                                $cod_rotatividade = strToHex(base64_encode($cartao['cod_rotatividade']));

				if ($_GET["cod_preco"] != "") {
					$cod_preco  = $_GET['cod_preco'];
				} else {
					$cod_preco  = $cartao['cod_preco'];
				}
				
				$data1 = $dat_entrada . " " . $hor_entrada;
				$data2 = $dat_saida . " " . $hora_saida;
				$minutos = calculaMinutos($data1,$data2);
				if ($minutos < 1440) {
					$dat_entrada = "";
				} else {
					$dat_entrada = mostraData($dat_entrada);
				}
				$objPrecos->set_cod_preco($cod_preco);
				$arrPreco = $objPrecos->buscaPrecoPagar($objPrecos,$minutos);
                
				echo sprintf('new Array("%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s","%s")',$des_placa,$hor_entrada,$cod_marca,$cod_modelo,$des_cor,$cod_preco,$arrPreco['val_total'],$hora_saida,$arrPreco['tempo_permanencia'],$des_situacao,$arrPreco['des_justificativa'],$dat_entrada,$cod_rotatividade);
			}
		} else {
				echo sprintf('new Array("")');
		}
	}
?>