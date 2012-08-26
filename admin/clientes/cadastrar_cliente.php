<?php
	include_once('../../includes/config.php');
    include_once('../../includes/funcao.php');
    require_once($path_relative.'verifica.php');
	include_once($path_classes.'fla_clientes.class.php');
	include_once($path_classes.'fla_cores.class.php');
	include_once($path_relative.'admin/clientes/processa.php');
	$objClientes     = new fla_clientes();
	$objCores        = new fla_cores();
	
	if (isset($_GET)) {
		$cod_cliente = $_GET["cod_cliente"];
	}

	if (!empty($_POST)) {
		$cod_cliente = $_POST['cod_cliente'];
		$nom_cliente = $_POST['nom_cliente'];
		$des_placa   = $_POST['des_placa'];
		$cod_marca   = $_POST['cod_marca'];
		$cod_modelo  = $_POST['codigo_modelo'];
		$des_cor     = $_POST['des_cor'];
		
		$objClientes->set_cod_cliente($cod_cliente);
		$objClientes->set_nom_cliente($nom_cliente);
		$objClientes->set_des_placa($des_placa);
		$objClientes->set_cod_marca($cod_marca);
		$objClientes->set_cod_modelo($cod_modelo);
		$objClientes->set_des_cor($des_cor);
		
		$objClientes->editaCliente($objClientes);
		
		$msgRetorno = 'Dados atualizados com sucesso!';
	}
	
	$objClientes->set_cod_cliente($cod_cliente);
	$arrCliente = $objClientes->buscaClientes($objClientes);

	$arrCores = $objCores->buscaCores($objCores);
		
	
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
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>				
                <script type="text/javascript">
                var timeout         = 500;
                var closetimer		= 0;
                var ddmenuitem      = 0;

				jQuery(function($){   
					$("#des_placa").mask("aaa-9999");
				});						
				
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
	<body onLoad="exibeModeloSelect(<?php echo $arrCliente[0]['cod_marca']; ?>,<?php echo $arrCliente[0]['cod_modelo']; ?>);setaModelo(<?php echo $arrCliente[0]['cod_modelo'];?>)">
		<div class="content">
<?php
			include_once("../../menu.php");
?>
			<div class="data">
				<h1> Módulo de rotatividade </h1>				
				<div class="success"> <?php echo $msgRetorno; ?> </div>
				<form method="POST" action="cadastrar_cliente.php">
					<table>
						<tr>
							<td> Nome </td>
							<td> <input type="text" value="<?php echo $arrCliente[0]['nom_cliente']; ?>" id="nom_cliente" name="nom_cliente"></td>
						</tr>
						
						<tr>
							<td> Placa </td>
							<td> <input style="text-transform: uppercase;" type="text" value="<?php echo $arrCliente[0]['des_placa']; ?>" id="des_placa" name="des_placa"></td>
						</tr>					
						
						<tr>
							<td> Marca </td>
							<td>
								<select name="cod_marca" onchange="exibeModeloSelect(this.value);" id="cod_marca">
									<option value="">Selecione</option>						
<?php 
								$marca = get_marcas();
								$ind_popular = true;
								for ($i=0;$i < count($marca);$i++) {								
									if ($arrCliente[0]['cod_marca'] == $marca[$i]['id_marca']) {
										echo sprintf('<option selected value="%s">%s</option>',$marca[$i]['id_marca'],$marca[$i]['ds_marca']);
									} else {
										echo sprintf('<option value="%s">%s</option>',$marca[$i]['id_marca'],$marca[$i]['ds_marca']);
									}
								}
?>	
							</td>						
						</tr>

						<tr>
							<td> Modelo </td>
							<td>
								<select name="cod_modelo" onChange="setaModelo(this.value);" onBlur="setaModelo(this.value);" id="cod_modelo">
								   <option value="0">Selecione</option>
								</select>
							</td>						
						</tr>
						
						<tr>
							<td> Cor </td>
							<td>
                                            <select name="des_cor" id="des_cor">
                                                <option value="0">Selecione</option>
<?php 
											for ($i=0;$i < count($arrCores);$i++) {
												if ($arrCores[$i]['cod_cor'] == $arrCliente[0]['cod_cor']) {
													echo sprintf('<option selected value="%s">%s</option>',$arrCores[$i]['cod_cor'],$arrCores[$i]['des_cor']);
												} else {
													echo sprintf('<option value="%s">%s</option>',$arrCores[$i]['cod_cor'],$arrCores[$i]['des_cor']);
												}
											} 
?>
                                            </select>

							</td>						
						</tr>
                                                <tr>
                                                    <td> Tipo de cliente </td>
                                                    <td>
                                                        <select name="tipo_cliente" id="tipo_cliente">
                                                            <option value="R">Rotativo</option>
                                                            <option value="M">Mensalista</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                
                                                <tr>
                                                    <td> Ultima vez que estacionou </td>
                                                    <td> 00/00/0000 </td>
                                                </tr>
						<tr>
							<td>
								<input type="hidden" name="cod_cliente" id="cod_cliente" value="<?php echo $cod_cliente; ?>">					
								<input type="hidden" name="cod_marca" id="cod_marca" value="<?php echo $arrCliente[0]['cod_marca']; ?>">					
								<input type="hidden" name="codigo_modelo" id="codigo_modelo" value="<?php echo $arrCliente[0]['cod_modelo']; ?>">					
								<input type="submit" name="_submit" value="Cadastrar">
							</td>
						</tr>
					</table>
				</form>	
                                <h1> Histórico </h1>
                                <table>
                                    <tr>
                                        <td>Data</td>
                                        <td>Entrada</td>
                                        <td>Saída</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo date("d/m/Y");?></td>
                                        <td><?php echo date("h:i");?></td>
                                        <td><?php echo date("h:i");?></td>
                                    </tr>                                    
                                </table>
			</div>
		</div>
	</body>
</html>