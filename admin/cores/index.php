<?php
	session_start();
	include_once('../../includes/config.php');
    include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_cores.class.php');
	
	$objCores     = new fla_cores();
	$arrCores = $objCores->buscaCores($objCores);
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
				<h1 style="text-align:center;"> Cores </h1>
				<a href="cadastrar_cores.php">Cadastrar nova cor</a> <br/><br/>
				<table style="width:100%;" border="1" align="center">
					<tr>
						<th> Descrição </th>
						<th> Editar </th>
					</tr>
<?php
				for ($i=0;$i < count($arrCores); $i++) {
					echo '<tr>'.chr(10);
					echo '<td>' . $arrCores[$i]['des_cor'] . '</td>'.chr(10);		
					echo sprintf('<td> <a href="cadastrar_cores.php?cod_cor=%s">Alterar dados</a> </td>',$arrCores[$i]['cod_cor']).chr(10);
					echo '</tr>'.chr(10);
				}
?>
				</table>
			</div>
		</div>
	</body>
</html>