<?php
	session_start();
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
    require_once($path_relative.'verifica.php');
	include_once($path_classes.'fla_modelos.class.php');
	include_once($path_classes.'fla_marcas.class.php');
	include_once($path_classes.'fla_clientes.class.php');
	
	$objClientes = new fla_clientes();
	$objModelos  = new fla_modelos();
	$objMarcas   = new fla_marcas();
	if (isset($_POST['_submit'])) {
		$cod_marca  = $_POST['cod_marca'];
		$objModelos->set_cod_marca($cod_marca);
		$arrModelos = $objModelos->buscaModelos($objModelos);		
		$arrMarca = $objMarcas->buscaMarcas($objMarcas);
	} else if (isset($_POST['_submit2'])) {
		$arrModelosAtivo = array();
     	$arrModelosAtivo = $_POST['ind_disponivel'];
		$objModelos->editaAtivos($arrModelosAtivo,$_POST['cod_marca2']);
		
		$arrModelosPopular = array();
		$arrModelosPopular = $_POST['ind_popular'];		
		$objModelos->editaPopulares($arrModelosPopular);

		$arrModelosExcluir = array();
		$arrModelosExcluir = $_POST['ind_excluir'];		
		$objModelos->excluirModelos($arrModelosExcluir);

		$cod_marca  = $_POST['cod_marca2'];		
		$objMarcas->set_cod_marca($cod_marca);
		$objModelos->set_cod_marca($cod_marca);		
		$arrModelos = $objModelos->buscaModelos($objModelos);		
		$objMarcas->set_cod_marca("");
		$arrMarca = $objMarcas->buscaMarcas($objMarcas);				
		
	} else {
		$arrMarca = $objMarcas->buscaMarcas($objMarcas);
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
				<p style="border-bottom:none;">  <a href="cadastrar_modelo.php"> Cadastrar novo veiculo </a></p>
				<form method="POST" action="">
					<table>
						<tr>
							<td colspan="4"> 
								 Marca:
								 <select name="cod_marca" id="cod_marca">
									<option value=""></option>
<?php
									foreach ($arrMarca as $marca) {
										if ($cod_marca == $marca['cod_marca']) {
											echo sprintf('<option selected="selected" value="%s">%s</option>',$marca['cod_marca'],$marca['des_marca']).chr(10);
										} else {
											echo sprintf('<option value="%s">%s</option>',$marca['cod_marca'],$marca['des_marca']).chr(10);
										}
									}									
?>								 
								 </select>
								 <input type="submit" name="_submit" id="_submit" value="Buscar">
							</td>
							</form>							

						</tr>
						<form method="POST">
						<tr>
							<td> 
                                Ativo 
                                <p style="font-size:small;font-weight:bolder;">
                                    <input type="checkbox" name="selecionar_ativos" id="selecionar_ativos">
                                    Todos
                                </p>
                            </td>
							<td> 
                                Popular 
                                <p style="font-size:small;font-weight:bolder;">
                                    <input type="checkbox" name="selecionar_popular" id="selecionar_popular">
                                    Todos
                                </p>                                
                            </td>
							<td> 
								Descrição 
								<p>&nbsp;</p>
							</td>
							<td> 
								Excluir 
								<p style="font-size:small;font-weight:bolder;">
                                    <input type="checkbox" name="selecionar_excluir" id="selecionar_excluir">
                                    Todos
                                </p>
							</td>
<?php
								for ($i=0; $i < count($arrModelos); $i++) {
									if ($arrModelos[$i]['ind_disponivel'] == '1') {
										$checked_disponivel = "checked";
									} else {
										$checked_disponivel = "";
									}
									
									if ($arrModelos[$i]['ind_popular'] == '1') {
										$checked_popular = "checked";
									} else {
										$checked_popular = "";
									}
									
									$objClientes->set_cod_modelo($arrModelos[$i]['cod_modelo']);
									$pode_excluir = $objClientes->buscaClientes($objClientes);
									echo '<tr>'.chr(10);
									echo sprintf('<td><input type="checkbox" value="%s" name="ind_disponivel[]" %s id="ind_disponivel"></td>',$arrModelos[$i]['cod_modelo'],$checked_disponivel).chr(10);
									echo sprintf('<td><input type="checkbox" value="%s" name="ind_popular[]" %s id="ind_popular"></td>',$arrModelos[$i]['cod_modelo'],$checked_popular).chr(10);
									echo sprintf('<td><a href="editar_modelo.php?cod_modelo=%s">%s</a></td>',$arrModelos[$i]['cod_modelo'],$arrModelos[$i]['des_modelo']).chr(10);
									if (!$pode_excluir)
										echo sprintf('<td><input type="checkbox" value="%s" name="ind_excluir[]" id="ind_excluir"></td>',$arrModelos[$i]['cod_modelo']).chr(10);									
									else 	
										echo '<td style="font-size:small;"> Em uso por clientes </td>';
										
									echo '</tr>'.chr(10);
									$objClientes->ResetObject();
								}
?>							
						<tr>
							<td>
								<input type="hidden" name="cod_marca2" value="<?php echo $cod_marca; ?>">
								<input type="submit" name="_submit2" id="_submit2" value="Salvar">
							</td>			
						</tr>
						<tr>
							<td>
								<a href="listar_modelo.php"> Voltar </a>
							</td>
						</tr>
						</form>
					</table>

			</div>
		</div>
	</body>
</html>
					