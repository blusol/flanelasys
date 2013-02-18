<?php
	session_start();
    include_once('../../includes/config.php');
    include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_descontos.class.php');
	
	$objDescontos     = new fla_descontos();
	$arrDescontos = $objDescontos->buscaDescontos($objDescontos);	
	
?>
<html>
	<head>
		<title>Cadastro de descontos - Administração - Flanela Sys</title>
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
				<h1 style="text-align:center;"> Preços </h1>
				<p style="border-bottom:none;"> <a href="editar_desconto.php"> Cadastrar desconto </a> </p>
				<table style="width:100%;" border="1" align="center">
					<tr>
						<th> Preços </th>
						<th> Editar </th>
					</tr>
<?php
				for ($i=0;$i < count($arrDescontos); $i++) {
					echo '<tr>'.chr(10);
					echo '<td>' . $arrDescontos[$i]['des_desconto'] . '</td>'.chr(10);		
					echo sprintf('<td> <a href="editar_desconto.php?cod_desconto=%s">Alterar dados</a> </td>',$arrDescontos[$i]['cod_desconto']).chr(10);
					echo '</tr>'.chr(10);
				}
?>
				</table>
			</div>
		</div>
	</body>
</html>