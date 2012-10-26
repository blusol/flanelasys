<?php
	include_once('../../includes/config.php');
	include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_descontos.class.php');
	require_once($path_relative.'verifica.php');
	$objDescontos     = new fla_descontos();
	
	if (isset($_GET['cod_desconto'])) {
		$cod_desconto = $_GET["cod_desconto"];
	} else {
		$cod_desconto = 0;
	}

	if (!empty($_POST)) {
		$cod_desconto = $_POST['cod_desconto'];
		$des_desconto = $_POST['des_desconto'];
		$val_desconto = $_POST['val_desconto'];
		if (isset($_POST['ind_ativo'])) {
			$ind_ativo    = $_POST['ind_ativo'];
		} else {
		    $ind_ativo    = 0;
		}
		
		$objDescontos->set_cod_desconto($cod_desconto);
		$objDescontos->set_des_desconto($des_desconto);
		$objDescontos->set_val_desconto($val_desconto);
		
		if (empty($cod_desconto)) {
			$objDescontos->insereDescontos($objDescontos);
			$msgRetorno = 'Desconto cadastrado com sucesso!';
		} else {
			$objDescontos->editaDescontos($objDescontos);
			$msgRetorno = 'Dados atualizados com sucesso!';
		}
?>
	<script language="javascript">
		alert('<?php echo $msgRetorno; ?>');
		window.location = 'index.php';
	</script>
<?php		
		
	}
	
	if ($cod_desconto > 0) {
		$objDescontos->set_cod_desconto($cod_desconto);
		$arrDesconto = $objDescontos->buscaDescontos($objDescontos);
	}

?>
<html>
	<head>
		<title>Cadastro de descontos - Administração - Flanela Sys</title>
		<link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
		<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>

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
				
				jQuery(function($){   
					$("#val_desconto").mask("99.99");
				});									
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
					<table>
						<tr>
							<td width="30%"> Descrição </td>
							<td> <input class="text" type="text" value="<?php echo $arrDesconto[0]['des_desconto']; ?>" id="des_desconto" name="des_desconto"></td>
						</tr>
						
						<tr>
							<td> Valor R$ </td>
							<td> <input class="text" type="text" value="<?php echo str_pad($arrDesconto[0]['val_desconto'], 5, "0", STR_PAD_LEFT);  ?>" id="val_desconto" name="val_desconto"></td>
						</tr>					
						<tr>
						    <td>
						        <input type="hidden" name="cod_desconto" value="<?php echo $cod_desconto; ?>">
						        <input type="submit" value="Salvar">
						    </td>
						</tr>
					</table>
				</form>	
			</div>
		</div>
	</body>
</html>