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
		<link href="../images/style.css" rel="stylesheet" type="text/css" />                                                                                   

                <style type="text/css">
                /* menu styles */
                #jsddm
                {	margin: 0;
                        padding: 0}

                        #jsddm li
                        {	float: left;
                                list-style: none;
                                font: 12px Tahoma, Arial}

                        #jsddm li a
                        {	display: block;
                                background: #324143;
                                padding: 5px 12px;
                                text-decoration: none;
                                border-right: 1px solid white;
                                width: 100px;
                                color: #EAFFED;
                                white-space: nowrap}

                        #jsddm li a:hover
                        {	background: #24313C}

                                #jsddm li ul
                                {	margin: 0;
                                        padding: 0;
                                        position: absolute;
                                        visibility: hidden;
                                        border-top: 1px solid white}

                                        #jsddm li ul li
                                        {	float: none;
                                                display: inline}

                                        #jsddm li ul li a
                                        {	width: auto;
                                                background: #A9C251;
                                                color: #24313C}

                                        #jsddm li ul li a:hover
                                        {	background: #8EA344}
                </style>
                <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
				<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>
                <script type="text/javascript">
                var timeout         = 500;
                var closetimer		= 0;
                var ddmenuitem      = 0;

                function jsddm_open()
                {	jsddm_canceltimer();
                        jsddm_close();
                        ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

                function jsddm_close()
                {	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

                function jsddm_timer()
                {	closetimer = window.setTimeout(jsddm_close, timeout);}

                function jsddm_canceltimer()
                {	if(closetimer)
                        {	window.clearTimeout(closetimer);
                                closetimer = null;}}

                $(document).ready(function()
                {	$('#jsddm > li').bind('mouseover', jsddm_open);
                        $('#jsddm > li').bind('mouseout',  jsddm_timer);});

                document.onclick = jsddm_close;
				
				
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