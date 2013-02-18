<?php
	session_start();
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_cores.class.php');
	include_once($path_classes.'fla_conexao.class.php');	
	
	$objCores        = new fla_cores();
	$objConexao      = new fla_conexao();

	if ($_GET) {
		$cod_cor = $_GET["cod_cor"];
		$objCores->set_cod_cor($cod_cor);
		$arrCores = $objCores->buscaCores($cod_cor);
	} else if ($_POST) {
		if ($_POST['cod_cor'] != 0) {
			$cod_cor = $_POST['cod_cor'];
		} else {
			$cod_cor = 0;
		}
		$des_cor = ucwords(strtolower($_POST['des_cor']));
		$objCores->set_cod_cor($cod_cor);
		$objCores->set_des_cor($des_cor);
		
		if ($cod_cor == 0) {
			// Verifica se a cor já está cadastrado
			$SQL = "SELECT
						cod_cor
					FROM
						fla_cores
					WHERE
						upper(des_cor) = '" . strtoupper($objCores->get_des_cor())."'";
			$cor = $objConexao->prepare($SQL);
			$cor->Execute();
			// Se a consulta retornar vazia, é porque a cor não está cadastrada anda
			if ($cor->rowCount() == 0) {
				$objCores->insereCores($objCores);
				$msgRetorno = 'Nova cor cadastrada com sucesso!';
			} else {
				// Senão exibe uma mensagem para o usuário
				$msgRetorno = 'Esta cor já está cadastrada!';
				$cod_cor = 0;
			}
		} else {
			$objCores->editaCores($objCores);
			$msgRetorno = 'Dados atualizados com sucesso!';
		}		
		$arrCores = $objCores->buscaCores($cod_cor);
	}
?>
<html>
	<head>
		<title>Cadastro de cores - Administração - Flanela Sys</title>
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
				<h1> Módulo de cores </h1>				
				<div class="success"> <?php echo $msgRetorno; ?> </div>
				<form method="POST" action="cadastrar_cores.php">
					<table>
						<tr>
							<td> Descrição </td>
							<td> <input type="text" value="<?php echo $arrCores[0]['des_cor']; ?>" id="des_cor" name="des_cor"></td>
						</tr>
						<tr>
							<td>
								<input type="hidden" name="cod_cor" id="cod_cor" value="<?php echo $arrCores[0]['cod_cor']; ?>">					
								<input type="submit" name="_submit" value="Cadastrar">
							</td>
						</tr>
					</table>
				</form>	
			</div>
		</div>
	</body>
</html>