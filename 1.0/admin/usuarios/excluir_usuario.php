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
	
	if (!empty($cod_usuario)) {
		$objUsuarios->set_cod_usuario($cod_usuario);
		$objUsuarios->excluiUsuarios($objUsuarios);
?>
		<script language="javascript">
			alert('Usuário excluido com sucesso.');
			window.location = 'index.php';
		</script>	
<?php
	}
?>