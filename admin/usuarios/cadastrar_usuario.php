<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_usuarios.class.php');
	require_once($path_relative.'verifica.php');
	$objUsuarios     = new fla_usuarios();
	
	if (isset($_GET)) {
		$cod_usuario = $_GET["cod_usuario"];
	} else {
		$cod_usuario = 0;
	}

	if (!empty($_POST)) {
		$cod_usuario = $_POST['cod_usuario'];
		$nom_usuario = $_POST['nom_usuario'];
		$des_login   = $_POST['des_login'];
		$des_senha   = $_POST['des_senha'];
		$cod_tipo    = $_POST['cod_tipo'];
		if (isset($_POST['ind_ativo'])) {
			$ind_ativo    = $_POST['ind_ativo'];
		} else {
		    $ind_ativo    = 0;
		}
		
		$objUsuarios->set_cod_usuario($cod_usuario);
		$objUsuarios->set_nom_usuario($nom_usuario);
		$objUsuarios->set_des_login($des_login);
		$objUsuarios->set_des_senha($des_senha);
		$objUsuarios->set_cod_tipo($cod_tipo);
		$objUsuarios->set_ind_ativo($ind_ativo);
		
		if (empty($cod_usuario)) {
			$objUsuarios->insereUsuarios($objUsuarios);
			$msgRetorno = 'Usuário cadastrado com sucesso!';
		} else {
			$objUsuarios->editaUsuario($objUsuarios);
			$msgRetorno = 'Dados atualizados com sucesso!';
		}
	}
	
	if ($cod_usuario > 0) {
		$objUsuarios->set_cod_usuario($cod_usuario);
		$arrUsuario = $objUsuarios->buscaUsuarios($objUsuarios);
	}

?>
<html>
	<head>
		<title>Cadastro de usuarios - Administração - Flanela Sys</title>
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
			<form method="POST" action="">
			<div class="data">
				<h1> Módulo de rotatividade </h1>				
				<div class="success"> <?php echo $msgRetorno; ?> </div>
					<table>
						<tr>
							<td width="30%"> Nome </td>
							<td> <input class="text" type="text" value="<?php echo $arrUsuario[0]['nom_usuario']; ?>" id="nom_usuario" name="nom_usuario"></td>
						</tr>
						
						<tr>
							<td> Login </td>
							<td> <input class="text" type="text" value="<?php echo $arrUsuario[0]['des_login']; ?>" id="des_login" name="des_login"></td>
						</tr>					
						
						<tr>
							<td> Senha </td>
							<td> <input class="text" type="text" value="<?php echo $arrUsuario[0]['des_senha']; ?>" id="des_senha" name="des_senha"></td>						
						</tr>

						<tr>
							<td> Tipo </td>
                            <td> 
                                <input type="radio" name="cod_tipo" value="2" <?php echo $arrUsuario[0]['cod_tipo'] == 2 ? 'checked' : '';?>> Administrador
                                <input type="radio" name="cod_tipo" value="1" <?php echo $arrUsuario[0]['cod_tipo'] == 1 ? 'checked' : '';?>> Funcionário
                            </td >					
						</tr>
						
						<tr>
							<td> Ativo </td>
                            <td> <input type="checkbox" name="ind_ativo" value="1" <?php echo $arrUsuario[0]['ind_ativo'] == 1 ? 'checked' : '';?>> 				
                        </tr>

						<tr>
						    <td>
						        <input type="hidden" name="cod_usuario" value="<?php echo $cod_usuario; ?>">
						        <input type="submit" value="Salvar">
						    </td>
						</tr>
					</table>
				</form>	
			</div>
		</div>
	</body>
</html>