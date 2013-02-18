<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
		require_once($path_relative.'verifica.php');
	include_once($path_classes.'fla_marcas.class.php');
	
	$objMarcas = new fla_marcas;

	$arrMarcas = $objMarcas->buscaMarcas($objMarcas);	
	
?>
<html>
	<head>
		<title>Cadastro de cores - Administração - Flanela Sys</title>
		<link href="../../images/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>
	</head>
	<body>
		<div class="content">
<?php
			include_once("../../cabecalho.php");
?>
			<div class="data">		
				<h1 style="text-align:center;"> Marcas </h1>
				<a href="cadastrar_marca.php">Cadastrar uma nova marca </a> <br/><br/>
				<table style="width:100%;" border="1" align="center">
					<tr>
						<th> Descrição </th>
						<th> Editar </th>
					</tr>
<?php
				for ($i=0;$i < count($arrMarcas); $i++) {
					echo '<tr>'.chr(10);
					echo '<td>' . $arrMarcas[$i]['des_marca'] . '</td>'.chr(10);		
					echo sprintf('<td> <a href="editar_marca.php?cod_marca=%s">Alterar dados</a> </td>',$arrMarcas[$i]['cod_marca']).chr(10);
					echo '</tr>'.chr(10);
				}
?>
				</table>
			</div>
		</div>
	</body>
</html>	
