<?php
	include_once('../includes/config.php');
	include_once('../includes/funcao.php');
    require_once($path_relative."verifica.php");    
	include_once($path_classes.'fla_conexao.class.php');	
	include_once($path_classes.'fla_precos.class.php');
	
	$objConexao = new fla_conexao();
	$objPrecos  = new fla_precos();
	$arrPrecos = $objPrecos->buscaPrecos($objPrecos);
	
	$dat_inicio = date("Y-m-d"); 
	$dat_final  = date("Y-m-d"); 
	$tip_cobranca = "";
	$exibe_estacionados = "";
	
	if (isset($_POST['_submit'])) {
		$dat_inicio = gravaData($_POST['dat_inicio']);
		$dat_final  = gravaData($_POST['dat_final']);
		
		$periodo =  sprintf('%s à %s',mostraData($dat_inicio),mostraData($dat_final));
		
		if (isset($_POST['exibe_estacionados']) && $_POST["exibe_estacionados"] == 1) {
			$where_exibe_estacionados = " and (rot.des_situacao = 'L' or rot.des_situacao = 'P') ";
			$exibe_estacionados = "checked";
		} else {
			$where_exibe_estacionados = " and (rot.des_situacao = 'L') ";
			$exibe_estacionados = "";
		}
		
		if (!empty($_POST['tip_cobranca'])) {
			$tip_cobranca = $_POST['tip_cobranca'];
			$where_tip_cobranca = " and pre.cod_preco = " . $tip_cobranca;
		} else {
			$where_cod_preco = "";
		}
		$SQL = sprintf('select
				rot.cod_rotatividade
				, rot.des_placa
				, rot.hor_entrada
				, rot.hor_saida
				, rot.dat_cadastro
				, rot.val_total
				, rot.des_situacao
				, rot.cod_cartao
				, rot.des_justificativa				
				, mar.des_marca
				, mode.des_modelo
				, pre.val_minimo
				, pre.val_hora
				, pre.val_fracao
				, pre.des_preco
				, pre.cod_preco
				, pre.tem_tolerancia
				, rot.tem_permanencia
				, rot.val_desconto
				, rot.val_cobrado
			from
			   fla_rotatividade rot
			   join fla_clientes cli ON (cli.des_placa = rot.des_placa)
			   join fla_marcas mar ON (cli.cod_marca = mar.cod_marca)
			   join fla_modelos mode ON (cli.cod_modelo = mode.cod_modelo)
			   join fla_precos pre ON (pre.cod_preco = rot.cod_preco)
						where dat_cadastro between "%s" and "%s" %s %s ORDER BY dat_cadastro, hor_entrada, hor_saida ',$dat_inicio,$dat_final,$where_tip_cobranca,$where_exibe_estacionados);

		$rsFechamentoCaixa = $objConexao->prepare($SQL);
		$rsFechamentoCaixa->execute();		
	}
?>
<html>
	<head>
		<title>Cadastro de clientes - Administração - Flanela Sys</title>
		<link href="<?php echo $url_images; ?>style.css" rel="stylesheet" type="text/css" />
		<link type="text/css" href="<?php echo $url_lib_jquery; ?>plugins/jquery-ui/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />		
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.core.js"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.datepicker.js"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/i18n/ui.datepicker-pt-BR.js"></script>		
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
				<script type="text/javascript">
				$(function() {
					$("#dat_inicio").datepicker(
					{
						showOn: 'button', 
						buttonImage: '<?php echo $url_images ?>ico_calendario.gif',
						buttonImageOnly: true,
						buttonText: 'Calendário',
						changeMonth: true,
						changeYear: true,
						showButtonPanel: true
					}		
				);
					$("#dat_inicio").datepicker($.datepicker.regional['pt-BR']);

					$("#dat_final").datepicker(
					{
						showOn: 'button', 
						buttonImage: '<?php echo $url_images ?>ico_calendario.gif',
						buttonImageOnly: true,
						buttonText: 'Calendário',
						changeMonth: true,
						changeYear: true,
						showButtonPanel: true
					}		
				);
					$("#dat_final").datepicker($.datepicker.regional['pt-BR']);						
			});
				</script>				
	</head>
	<body>
		<div class="content">
<?php
			include_once("../menu.php");
?>
	
			<div class="data">		
				<h1 style="text-align:center;"> Gera RPS - Recibo Provisório de Serviço </h1>
				<form method="POST" name="form_fechamento" action="">
					<p> <strong> Filtros </strong> </p>
					Data Inicial <input type="text" value="<?php echo mostraData($dat_inicio);?>" name="dat_inicio" id="dat_inicio">
					Data Final <input type="text" value="<?php echo mostraData($dat_final);?>" name="dat_final" id="dat_final">				
					<input type="submit" name="_submit" value="Gerar RPS">
				</form>					
			</div>	
			
<?php
					if (isset($rsFechamentoCaixa) && ($rsFechamentoCaixa->rowCount() > 0)) {
?>
				<table id="fechamento_caixa">
					<tr>
						<td colspan="14"> <strong> Periodo </strong> <?php echo $periodo; ?> </td>
					</tr>
					<tr>
						<th> &nbsp; </th>
						<th> Data </th>
						<th> Placa </th>
						<th> Marca </th>
						<th> Modelo </th>
						<th> Entrada </th>
						<th> Saida </th>
						<th> Tipo de cobrança </th>						
						<th> Tempo de permanência </th>
						<th> Valor Total </th>
						<th> Desconto </th>
						<th> Valor Pago </th>
						<th> Justificativa </th>						
<?php
						echo $exibe_estacionados != "" ? '<th> Situação </th>' : "&nbsp;";
?>						
					</tr>
<?php					
						$total_pago = 0;
						$carros_estacionados = 0;
						$aux = 1;
						while($movimento = $rsFechamentoCaixa->fetch(PDO::FETCH_ASSOC)){
							$situacao = $movimento['des_situacao'] == "L" ? "Liberado" : "No patio";
							echo '<tr>'.chr(10);
							echo sprintf('<td>%s</td>',$aux).chr(10);
							echo sprintf('<td>%s</td>',mostraData($movimento['dat_cadastro'])).chr(10);
							echo sprintf('<td>%s</td>',$movimento['des_placa']).chr(10);
							echo sprintf('<td>%s</td>',$movimento['des_marca']).chr(10);
							echo sprintf('<td>%s</td>',$movimento['des_modelo']).chr(10);
							echo sprintf('<td>%s</td>',$movimento['hor_entrada']).chr(10);
							echo sprintf('<td>%s</td>',$movimento['hor_saida']).chr(10);
							echo sprintf('<td>%s</td>',$movimento['des_preco']).chr(10);
							echo sprintf('<td>%s</td>',$movimento['tem_permanencia']).chr(10);
							echo sprintf('<td>%s</td>',str_replace(".",",",$movimento['val_total'])).chr(10);
							echo sprintf('<td>%s</td>',str_replace(".",",",$movimento['val_desconto'])).chr(10);
							echo sprintf('<td>%s</td>',str_replace(".",",",$movimento['val_cobrado'])).chr(10);
							echo sprintf('<td>%s</td>',$movimento['des_justificativa']).chr(10);						
							echo $exibe_estacionados != "" ? '<td> ' . $situacao . ' </td>' : "&nbsp;";
							echo '</tr>'.chr(10);
							$total_pago = $total_pago + $movimento['val_cobrado'];
							$carros_estacionados++;
							$aux++;
						}
?>
					<tr>
						<td colspan="7"> <strong> Carros estacionados: </strong> <?php echo $carros_estacionados; ?> </td>
						<td colspan="7"> <strong> Total: R$ </strong> <?php echo sprintf("%01.2f",$total_pago); ?> </td>
					</tr>
<?php						
					}
?>					
				</table>
		</div>
	</body>
</html>	