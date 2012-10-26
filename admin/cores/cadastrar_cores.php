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