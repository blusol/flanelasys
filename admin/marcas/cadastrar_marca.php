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
					