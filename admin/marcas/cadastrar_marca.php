<?php
	session_start();
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_marcas.class.php');

	$objMarcas  = new fla_marcas();
	
	$des_marca  = "";
	$cod_marca = "";
	$ind_disponivel = 0;
	$ind_popular	= 0;	
	
	if ($_POST) {
		$cod_marca  = $_POST['cod_marca'];
		$des_marca = $_POST['des_marca'];
		
		$ind_disponivel = 0;
		if (isset($_POST['ind_disponivel'])) {
			$ind_disponivel = $_POST['ind_disponivel'];
		}
		
		$ind_popular = 0;
		if (isset($_POST['ind_popular'])) {
			$ind_popular = $_POST['ind_popular'];
		}		
		
		$objMarcas->set_cod_marca($cod_marca);		
		$objMarcas->set_des_marca($des_marca);
		$objMarcas->set_ind_disponivel($ind_disponivel);
		$objMarcas->set_ind_popular($ind_popular);
		$objMarcas->cadastraMarcas($objMarcas);
		
		$objMarcas->set_cod_marca($cod_marca);
		$arrMarcas = $objMarcas->buscaMarcas($objMarcas);		
		
		$msgRetorno = "Dados atualizados com sucesso";
	}		
	
?>
<html>
	<head>
		<title>Cadastro de marcas - Administração - Flanela Sys</title>
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
				<h1> Módulo de marcas </h1>				
				<div class="success"> <?php echo $msgRetorno; ?> </div>
				<form method="POST" action="">
					<table>
						<tr>
							<td> Descrição: <input type="text" name="des_marca" value="<?php echo $des_marca; ?>"></td>
						</tr>
						<tr>						
<?php
							if ($arrMarcas[0]['ind_disponivel'] == '1') {
								$checked_disponivel = "checked";
							} else {
								$checked_disponivel = "";
							}
							
							if ($arrMarcas[0]['ind_popular'] == '1') {
								$checked_popular = "checked";
							} else {
								$checked_popular = "";
							}									
							
							echo sprintf('<tr><td>Disponivel: <input type="checkbox" value="%s" name="ind_disponivel" %s id="ind_disponivel"></td></tr>',1,$checked_disponivel).chr(10);
							echo sprintf('<tr><td>Marca popular: <input type="checkbox" value="%s" name="ind_popular" %s id="ind_popular"></td></tr>',1,$checked_popular).chr(10);							
?>						
						</tr>
						<tr>
							<td>
							    <input type="hidden" name="cod_marca" value="<?php echo $cod_marca; ?>">
								<input type="submit" name="_submit" id="_submit" value="Salvar">
							</td>
						</tr>
						<tr>
							<td>
								<a href="listar_marca.php"> Voltar </a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>
					