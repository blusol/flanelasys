<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
    require_once($path_relative.'verifica.php');
	include_once($path_classes.'fla_modelos.class.php');
	include_once($path_classes.'fla_marcas.class.php');
	
	$objModelos  = new fla_modelos();
	$objMarcas   = new fla_marcas();
	
	$des_modelo = "";
	$des_marca  = "";
	$cod_modelo = "";
	$ind_disponivel = 0;
	$ind_popular	= 0;
	
	if ($_POST) {
		$des_modelo = $_POST['des_modelo'];
		$cod_marca  = $_POST['cod_marca'];
		$cod_modelo = $_POST['cod_modelo'];
		
		$ind_disponivel = 0;
		if (isset($_POST['ind_disponivel'])) {
			$ind_disponivel = $_POST['ind_disponivel'];
		}
		
		$ind_popular = 0;
		if (isset($_POST['ind_popular'])) {
			$ind_popular = $_POST['ind_popular'];
		}		
		
		$objModelos->set_des_modelo($des_modelo);
		$objModelos->set_cod_marca($cod_marca);		
		$objModelos->set_cod_modelo($cod_modelo);
		$objModelos->set_ind_disponivel($ind_disponivel);
		$objModelos->set_ind_popular($ind_popular);
		$objModelos->cadastraModelos($objModelos);
		
		$msgRetorno = 'Veiculo cadastrado com sucesso';
	}		
	
	$arrMarcas = $objMarcas->buscaMarcas($objMarcas);		
	
	if ($ind_disponivel == '1') {
		$checked_disponivel = "checked";
	} else {
		$checked_disponivel = "";
	}

	if ($ind_popular == '1') {
		$checked_popular = "checked";
	} else {
		$checked_popular = "";
	}									
?>
<html>
	<head>
		<title>Cadastro de cores - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>		
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
				<h1> Módulo de veiculos </h1>				
				<div class="success"> <?php echo $msgRetorno; ?> </div>
				<form method="POST" action="">
					<table>
						<tr>
							<td> Descrição: <input type="text" name="des_modelo" value="<?php echo $des_modelo; ?>"></td>
						</tr>
						<tr>
							<td colspan="4"> 
								 Marca:
								 <select name="cod_marca" id="cod_marca">
									<option value=""></option>
<?php
									foreach ($arrMarcas as $marca) {
											if ($cod_marca == $marca['cod_marca']) {
												echo sprintf('<option selected="selected" value="%s">%s</option>',$marca['cod_marca'],$marca['des_marca']).chr(10);
											} else {
												echo sprintf('<option value="%s">%s</option>',$marca['cod_marca'],$marca['des_marca']).chr(10);
											}
									}									
?>								 
								 </select>
							</td>
						</tr>
						<tr>
							<td>
								Disponivel: <input type="checkbox" <?php echo $checked_disponivel; ?> value="1" name="ind_disponivel" id="ind_disponivel">
							</td>
						</tr>						
						<tr>						
						
						<tr>
							<td>
								Carro popular: <input type="checkbox" <?php echo $checked_popular; ?> value="1" name="ind_popular" id="ind_popular">
							</td>
						</tr>			
						</tr>
						<tr>
							<td>
								<input type="submit" name="_submit" id="_submit" value="Salvar">
							</td>
						</tr>
						<tr>
							<td>
								<a href="listar_modelo.php"> Voltar </a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>
					