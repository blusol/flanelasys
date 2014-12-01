<?php
include_once('../includes/config.php');
include_once('../includes/funcao.php');
require_once($path_relative . "verifica.php");
include_once($path_classes . 'fla_mensalidade.class.php');

$objMensalidade = new fla_mensalidade();

$dat_inicio = date("Y-m-01");
$dat_final = date("Y-m-d");

if (isset($_POST['_submit'])) {
    $dat_inicio = gravaData($_POST['dat_inicio']);
    $dat_final = gravaData($_POST['dat_final']);
    if (!empty($_POST['situacao']))
        $situacao = $_POST['situacao'];

    $arrRelatorioMensalistas = $objMensalidade->relatorioMensalistas($dat_inicio, $dat_final,$situacao);
}
?>
<html>
    <head>
        <title>Mensalistas - Relatórios - Flanela Sys</title>
        <link href="<?php echo $url_images; ?>style.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="<?php echo $url_lib_jquery; ?>plugins/jquery-ui/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />		
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.core.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/i18n/ui.datepicker-pt-BR.js"></script>		
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>		
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
            include_once("../cabecalho.php");
            ?>

            <div class="data">		
                <h1 style="text-align:center;"> Mensalistas </h1>
                <form method="POST" name="form_fechamento" action="">
                    <strong> Filtros: </strong><br/>
                    Data Inicial <input type="text" value="<?php echo mostraData($dat_inicio); ?>" name="dat_inicio" id="dat_inicio">
                    Data Final <input type="text" value="<?php echo mostraData($dat_final); ?>" name="dat_final" id="dat_final">				
                    Situação: <select name="situacao">
                        <option value="T">Todos</option>
                        <option value="Q">Somente quitados</option>
                        <option value="A">Somente em aberto</option>
                    </select>
                    <input type="submit" name="_submit" value="Gerar relatório">
                </form>					
            </div>	

            <?php
            if (is_array($arrRelatorioMensalistas)) {
                ?>
                <table id="fechamento_caixa">
                    <tr>
                        <td colspan="14"> <strong> Periodo </strong> <?php echo $periodo; ?> </td>
                    </tr>
                    <tr>
                        <th> &nbsp; </th>
                        <th> Cliente </th>
                        <th> Mensalidade </th>
                        <th> Valor </th>
                        <th> Vencimento (dia) </th>
                        <th> Situação </th>
                    </tr>
                    <?php
                    $aux = 0;
					$total_quitados_qtd = 0;
					$total_quitados_valor = 0;
					$total_abertos_qtd = 0;
					$total_abertos_valor = 0;
                    for ($aux = 0;$aux < count($arrRelatorioMensalistas);$aux++) {
						if ($arrRelatorioMensalistas[$aux]['situacao'] == "Q") {
							$situacao_mensalidade = "Quitado";
							$style_css = "green";
							$total_quitados_qtd++;
							$total_quitados_valor += $arrRelatorioMensalistas[$aux]['val_mensalidade'];
						} else {
							$situacao_mensalidade = "Em aberto";
							$style_css = "red";
							$total_abertos_qtd++;
							$total_abertos_valor += $arrRelatorioMensalistas[$aux]['val_mensalidade'];
						}

                        echo '<tr>' . chr(10);
                        echo sprintf('<td>%s</td>', $aux+1) . chr(10);
                        echo sprintf('<td>%s</td>', $arrRelatorioMensalistas[$aux]['nom_cliente']) . chr(10);
                        echo sprintf('<td>%s</td>', $arrRelatorioMensalistas[$aux]['des_mensalidade']) . chr(10);
                        echo sprintf('<td>R$ %s</td>', str_replace('.',',',$arrRelatorioMensalistas[$aux]['val_mensalidade'])) . chr(10);
                        echo sprintf('<td>%s</td>', $arrRelatorioMensalistas[$aux]['dia_vencimento']) . chr(10);
                        echo sprintf('<td style="color:%s;font-weight:bolder;">%s</td>', $style_css, $situacao_mensalidade) . chr(10);
                        echo '</tr>' . chr(10);
                    }
                    ?>
                    <tr>
                        <td colspan="7"> <strong> Total de registros: </strong> <?php echo $aux; ?> </td>
                    </tr>
					<?php if ($situacao == 'T' || $situacao == 'Q') { ?>
                    <tr>
                        <td colspan="5"> <strong> Quantidade quitados: </strong> <?php echo $total_quitados_qtd; ?> </td>
                        <td colspan="1"> <strong> Valor R$: </strong> <?php echo number_format($total_quitados_valor,2,',','.'); ?> </td>
                    </tr>
					<?php } ?>
					<?php if ($situacao == 'T' || $situacao == 'A') { ?>
                    <tr>
                        <td colspan="5"> <strong> Quantidade em aberto: </strong> <?php echo $total_abertos_qtd; ?> </td>
                        <td colspan="1"> <strong> Valor R$: </strong> <?php echo number_format($total_abertos_valor,2,',','.'); ?> </td>
                    </tr>						
					<?php } ?>
                    <?php
                }
                ?>					
            </table>
        </div>
    </body>
</html>	