<?php
	session_start();
    include_once('../../includes/config.php');
    include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_precos.class.php');
	
	$objPrecos     = new fla_precos();
	$arrPrecos = $objPrecos->buscaPrecos($objPrecos);	
?>
<html>
	<head>
		<title>Cadastro de clientes - Administração - Flanela Sys</title>
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
				<h1 style="text-align:center;"> Preços </h1>
				<p style="border-bottom:none;"> <a href="editar_preco.php"> Cadastrar novo preço </a> </p>
				<table style="width:100%;" border="1" align="center">
					<tr>
						<th> Preços </th>
						<th> Editar </th>
					</tr>
<?php
				for ($i=0;$i < count($arrPrecos); $i++) {
					echo '<tr>'.chr(10);
					echo '<td>' . $arrPrecos[$i]['des_preco'] . '</td>'.chr(10);		
					echo sprintf('<td> <a href="editar_preco.php?cod_preco=%s">Alterar dados</a> </td>',$arrPrecos[$i]['cod_preco']).chr(10);
					echo '</tr>'.chr(10);
				}
?>
				</table>
			</div>
		</div>
	</body>
</html>