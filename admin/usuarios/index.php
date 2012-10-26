<?php
	include_once('../../includes/config.php');
    include_once('../../includes/funcao.php');
    require_once($path_relative.'verifica.php');
    
	include_once($path_classes.'fla_usuarios.class.php');

	$objUsuarios     = new fla_usuarios();
	$arrUsuarios     = $objUsuarios->buscaUsuarios($objUsuarios);
?>
<html>
	<head>
		<title>Cadastro de usuarios- Administração - Flanela Sys</title>
		<link href="../../images/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>		
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
	</head>
	<body>
		<div class="content">
<?php
			include_once("../../cabecalho.php");
?>
			<div class="data">		
				<h1 style="text-align:center;"> Usuários </h1>
				<table style="width:100%;" border="1" align="center">
					<tr>
						<th> Nome </th>
						<th> Editar </th>
						<th> Excluir </th>
					</tr>
<?php
				for ($i=0;$i < count($arrUsuarios); $i++) {
					echo '<tr>'.chr(10);
					echo '<td>' . $arrUsuarios[$i]['nom_usuario'] . '</td>'.chr(10);		
					echo sprintf('<td> <a href="cadastrar_usuario.php?cod_usuario=%s">Alterar dados</a> </td>',$arrUsuarios[$i]['cod_usuario']).chr(10);
					echo sprintf('<td> <a onClick="return confirmar();" href="excluir_usuario.php?cod_usuario=%s">Excluir dados</a> </td>',$arrUsuarios[$i]['cod_usuario']).chr(10);
					echo '</tr>'.chr(10);
				}
?>
				<tr>
					<td colspan="3"> <a style="text-decoration:none;" href="cadastrar_usuario.php"><img style="border:none;" src="<?php echo $url_images.'add.png';?>"> Cadastrar usuário </a> </td>
				</table>
			</div>
		</div>
	</body>
</html>	



