<?php
	session_start();
    include_once('../../includes/config.php');
    include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_precos.class.php');
	
	$objPrecos     = new fla_precos();
	$arrPrecos = $objPrecos->buscaPrecos($objPrecos);	
?>
<html>
	<head>
		<title>Cadastro de clientes - Administra��o - Flanela Sys</title>
		<link href="../../images/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>		
		<script type="text/javascript">
				function setaModelo(modelo) {
					document.getElementById("codigo_modelo").value = modelo;
				}				
                </script>		
	</head>
	<body>
		<div class="content">
<?php
			include_once("../../cabecalho.php");
?>
			<div class="data">		
				<h1 style="text-align:center;"> Pre�os </h1>
				<p style="border-bottom:none;"> <a href="editar_preco.php"> Cadastrar novo pre�o </a> </p>
				<table style="width:100%;" border="1" align="center">
					<tr>
						<th> Pre�os </th>
						<th> Editar </th>
					</tr>
<?php
				for ($i=0;$i < count($arrPrecos); $i++) {
					echo '<tr>'.chr(10);
					echo '<td>' . $arrPrecos[$i]['des_preco'] . '</td>'.chr(10);		
					echo sprintf('<td> <a href="editar_preco.php?cod_preco=%s">Alterar dados</a> </td>',$arrPrecos[$i]['cod_preco']).chr(10);
					echo '</tr>'.chr(10);
				}
?>
				</table>
			</div>
		</div>
	</body>
</html>