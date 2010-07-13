<?php
	session_start();
	include_once('../../includes/config.php');
    include_once('../../includes/funcao.php');
	include_once($path_classes.'fla_cores.class.php');
	
	$objCores     = new fla_cores();
	$arrCores = $objCores->buscaCores($objCores);
?>
<html>
	<head>
		<title>Cadastro de cores - Administra��o - Flanela Sys</title>
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
			include_once("../../menu.php");
?>
			<div class="data">		
				<h1 style="text-align:center;"> Cores </h1>
				<a href="cadastrar_cores.php">Cadastrar nova cor</a> <br/><br/>
				<table style="width:100%;" border="1" align="center">
					<tr>
						<th> Descri��o </th>
						<th> Editar </th>
					</tr>
<?php
				for ($i=0;$i < count($arrCores); $i++) {
					echo '<tr>'.chr(10);
					echo '<td>' . $arrCores[$i]['des_cor'] . '</td>'.chr(10);		
					echo sprintf('<td> <a href="cadastrar_cores.php?cod_cor=%s">Alterar dados</a> </td>',$arrCores[$i]['cod_cor']).chr(10);
					echo '</tr>'.chr(10);
				}
?>
				</table>
			</div>
		</div>
	</body>
</html>