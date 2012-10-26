<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_modelos.class.php');
	include_once($path_classes.'fla_marcas.class.php');
	
	$objModelos = new fla_modelos();
	$objMarcas  = new fla_marcas();
	
	if ($_POST) {
		$arrModelosAtivo = array();
		$arrModelosAtivo = $_POST['ind_disponivel'];
		$objModelos->editaAtivos($arrModelosAtivo, $_POST['cod_marca']);
		
		$arrModelosPopular = array();
		$arrModelosPopular = $_POST['ind_popular'];		
		$objModelos->editaPopulares($arrModelosPopular);
		
		$des_modelo = $_POST['des_modelo'];
		$cod_marca  = $_POST['cod_marca'];
		$cod_modelo = $_POST['cod_modelo'];
		
		
		$arrDesModelo = $_POST['des_modelo'];
		$objModelos->set_des_modelo($arrDesModelo);
		$objModelos->set_cod_marca($cod_marca);		
		$objModelos->editaModelos($objModelos);
	}		
	
	if ($_GET) {
		$cod_marca = $_GET["cod_marca"];
		$objModelos->set_cod_marca($cod_marca);
		$arrModelos = $objModelos->buscaModelos($objModelos);
		
		$arrMarcas = $objMarcas->buscaMarcas($objMarcas);
	}	
	
?>
<html>
	<head>
		<title>Cadastro de cores - Administração - Flanela Sys</title>
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
			<div class="data">
				<h1> Módulo de veiculos </h1>				
				<div class="success"> <?php echo $msgRetorno; ?> </div>
				<form method="POST" action="">
					<table>
						<tr>
							<td colspan="4"> 
								 Marca:
								 <select name="cod_marca" id="cod_marca">
<?php
									foreach ($arrMarcas as $marca) {
										if ($arrModelos[0]['cod_marca'] == $marca['cod_marca']) {
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
							<td> Ativo </td>
							<td> Popular </td>
							<td> Descrição </td>
							<td> Alterar nome </td>
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
									echo '<tr>'.chr(10);
									echo sprintf('<td><input type="checkbox" value="%s" name="ind_disponivel[]" %s id="ind_disponivel"></td>',$arrModelos[$i]['cod_modelo'],$checked_disponivel).chr(10);
									echo sprintf('<td><input type="checkbox" value="%s" name="ind_popular[]" %s id="ind_popular"></td>',$arrModelos[$i]['cod_modelo'],$checked_popular).chr(10);
									echo '<td>' . $arrModelos[$i]['des_modelo'].'</td>'.chr(10);
									echo sprintf('<td> <input type="text" name="des_modelo_exibicao[]" id="des_modelo_exibicao[]" value="%s"></td>', $arrModelos[$i]['des_modelo']).chr(10);																									
									echo sprintf('<td> <input type="hidden" name="des_modelo[]" id="des_modelo[]" value="%s:%s"></td>',$arrModelos[$i]['cod_modelo'],$arrModelos[$i]['des_modelo']).chr(10);
									echo '</tr>'.chr(10);
								}
?>							
						</tr>
						<tr>
							<td>
								<input type="submit" name="_submit" id="_submit" value="Salvar">
							</td>
						</tr>
						<tr>
							<td>
								<a href="index.php"> Voltar </a>
							</td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>
					