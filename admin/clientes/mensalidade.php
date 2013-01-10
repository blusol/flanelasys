<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_clientes.class.php');
include_once($path_classes . 'fla_mensalidade.class.php');
include_once($path_classes . 'fla_mensalidade_usuario.class.php');
include_once($path_relative . 'rotatividade/nfeblu.php');

$objClientes = new fla_clientes();
$objMensalidade = new fla_mensalidade();
$objMensalidadeUsuario = new fla_mensalidade_usuario();

if (isset($_GET) && !empty($_GET['cod_cliente'])) 
    $cod_cliente = $_GET['cod_cliente'];

if (isset($_POST) && !empty($_POST['envia'])) {
    $valor_pago = str_replace(",",".",$_POST['valor_pago']);
    $periodo_inicial = gravaData($_POST['periodo_inicial']);
    $periodo_final = gravaData($_POST['periodo_final']);
    $data_pagamento = gravaData($_POST['data_pagamento']);
    $cod_cliente = $_POST['cod_cliente'];
    $cod_mensalidade = $_POST['cod_mensalidade'];
    
    $objMensalidadeUsuario->set_valor_pago($valor_pago);
    $objMensalidadeUsuario->set_periodo_inicial($periodo_inicial);
    $objMensalidadeUsuario->set_periodo_final($periodo_final);
    $objMensalidadeUsuario->set_data_pagamento($data_pagamento);
    $objMensalidadeUsuario->set_cod_cliente($cod_cliente);
    $objMensalidadeUsuario->set_cod_mensalidade($cod_mensalidade);
    $cod_pagamento = $objMensalidadeUsuario->cadastraPagamento();
    
    $msgRetorno = "Pagamento registrado com sucesso";
    $msgRetorno .= '<br> Deseja imprimir RPS? <a href="'.$url.'admin/clientes/mensalidade.php?imprimir='.  base64_encode(strToHex('imprimeRPS')).'&cod_pagamento='.$cod_pagamento.'">Sim</a>';
    $objMensalidadeUsuario->ResetObject();
}

if (isset($_POST) && !empty($_POST['ImprimirComprovante'])) {
	$cod_mensalidade_usuario = $_POST['cod_mensalidade_usuario'];
	$objMensalidadeUsuario->set_cod_mensalidade_usuario($cod_mensalidade_usuario);
	$objMensalidadeUsuario->geraComprovante();
}

if (isset($_GET) && !empty($_GET['imprimir'])) {
    $cod_pagamento = $_GET['cod_pagamento'];
    $cod_cliente = $_POST['cod_cliente'];
	
    geraRPS($cod_pagamento,2,$cod_cliente);
    Header("Location:" . $url . "admin/clientes/index.php");
}

$objClientes->set_cod_cliente($cod_cliente);
$arrCliente = $objClientes->buscaClientes($objClientes);

$arrMensalidade = $objMensalidade->buscaMensalidade($arrCliente[0]['tip_mensalidade']);
$cod_cliente = $arrCliente[0]['cod_cliente'];

$objMensalidadeUsuario->set_cod_cliente($cod_cliente);
$arrMensalidadeUsuario = $objMensalidadeUsuario->buscaPagamentos();
?>
<html>
    <head>
        <title>Histórico - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.numeric.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>			
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.core.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/i18n/ui.datepicker-pt-BR.js"></script>
        <link type="text/css" href="<?php echo $url_lib_jquery; ?>plugins/jquery-ui/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />		
        <script type="text/javascript">
            jQuery(function($){
                
                $("#periodo_inicial").datepicker(
                {
                    showOn: 'button', 
                    buttonImage: '<?php echo $url_images ?>ico_calendario.gif',
                    buttonImageOnly: true,
                    buttonText: 'Calendário',
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true
                });
                $("#periodo_inicial").datepicker($.datepicker.regional['pt-BR']);

                $("#periodo_final").datepicker(
                {
                    showOn: 'button', 
                    buttonImage: '<?php echo $url_images ?>ico_calendario.gif',
                    buttonImageOnly: true,
                    buttonText: 'Calendário',
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true
                });
                $("#periodo_final").datepicker($.datepicker.regional['pt-BR']);                
                
                $("#data_pagamento").datepicker(
                {
                    showOn: 'button', 
                    buttonImage: '<?php echo $url_images ?>ico_calendario.gif',
                    buttonImageOnly: true,
                    buttonText: 'Calendário',
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true
                });
                $("#data_pagamento").datepicker($.datepicker.regional['pt-BR']);                                
            });
          </script>
    </head>
    <body>
        <div class="content">
<?php
include_once("../../cabecalho.php");
?>
            <div class="data">
                <?php 
                    if (!empty($arrCliente[0]['nom_cliente']))
                        echo sprintf('<h1> Histórico de mensalidades de: %s </h1>',$arrCliente[0]['nom_cliente']);
                    else
                        echo '<h1> Cadastro de cliente </h1>';
                ?>
                <p style="border:none;"> 
                    <a href="index.php">Lista de clientes</a> | 
                    
                    <?php
                        if (!empty($cod_cliente)) {
                            echo '<a href="cadastrar_cliente.php">Novo Cadastro</a> | ';
                            echo sprintf('<a href="cadastrar_cliente.php?cod_cliente=%s">Dados Gerais</a> | ',$cod_cliente);
                            echo sprintf('<a href="historico.php?cod_cliente=%s">Histórico</a> | ',$cod_cliente);
                        } else {
                            echo '<a href="cadastrar_cliente.php">Cadastrar novo</a> |';
                        }
                        if (!empty($cod_cliente) && (!empty($arrCliente[0]['tipo_cliente']) && $arrCliente[0]['tipo_cliente'] =='M')) {
                            echo sprintf('<a href="mensalidade.php?cod_cliente=%s">Mensalidades</a> |',$cod_cliente);
                        }
                    ?>
                </p>
                <div class="success"> <?php echo $msgRetorno; ?> </div>
                <form action="mensalidade.php" method="POST">
                    <table>
                        <tr>
                            <td colspan="2">Tipo de mensalidade: <?php echo $arrMensalidade[0]['des_mensalidade'];?> </td>
                        </tr>
                        <tr>
                            <td> Valor da mensalidade: </td>
                            <td> <?php echo number_format($arrMensalidade[0]['val_mensalidade'],2,",",".");?> </td>
                        </tr>
                        <tr>
                            <td> Valor pago: </td>
                            <td> <input type="text" name="valor_pago" id="valor_pago" value="<?php echo number_format($arrMensalidade[0]['val_mensalidade'],2,",",".");?>" /> </td>
                        </tr>                        
                        <tr id="trJustificativa" style="display: none;">
                            <td> Justificativa: </td>
                            <td> <input type="text" name="des_justificativa" id="des_justificativa" value="" /> </td>
                        </tr>                        
                        <tr>
                            <td> Período Inicial: </td>
                            <td><input type="text" name="periodo_inicial" id="periodo_inicial" value="<?php echo date("d/m/Y");?>" /> </td>
                        </tr>
                        <tr>
                            <td> Período Final: </td>
                            <td><input type="text" name="periodo_final" id="periodo_final" value="<?php echo date("d/m/Y",strtotime("+30 days"));?>" /></td>
                        <tr>
                            <td> Data do pagamento </td>
                            <td> <input type="text" name="data_pagamento" id="data_pagamento" value="<?php echo date("d/m/Y");?>" /> </td>
                        </tr>
                        <tr>
                            <td> 
                                <input type="hidden" id="cod_cliente" name="cod_cliente" value="<?php echo $cod_cliente;?>" />
                                <input type="hidden" id="cod_mensalidade" name="cod_mensalidade" value="<?php echo $arrMensalidade[0]['cod_mensalidade'];?>" />
                                <input type="submit" name="envia" value="Cadastrar" /> 
                            </td>
                            <td>
                        </tr>
                    </table>
                </form>
                <table>
                    <tr>
                        <td colspan="2">Histórico de pagamentos </td>
                    </tr>                    
                    <tr>
                        <td>Data de pagamento</td>
                        <td>Valor</td>
                        <td>Período</td>
                        <td>Comprovante</td>
                    </tr>
                        <?php
                            for ($i = 0; $i < count($arrMensalidadeUsuario); $i++) {
                                echo '<tr>'.chr(10);
                                echo sprintf("<td>%s</td>",  mostraData($arrMensalidadeUsuario[$i]['data_pagamento'])).chr(10);
                                echo sprintf("<td>R$ %s</td>", number_format($arrMensalidadeUsuario[$i]['valor_pago'],2,",",".")).chr(10);
                                echo sprintf("<td>%s á %s</td>", mostraData($arrMensalidadeUsuario[$i]['periodo_inicial']),mostraData($arrMensalidadeUsuario[$i]['periodo_final'])).chr(10);
								echo sprintf("<td><form action=\"mensalidade.php\" method=\"POST\"><input type=\"hidden\" id=\"cod_cliente\" name=\"cod_cliente\" value=\"%s\" /><input type='submit' name='ImprimirComprovante' value='Imprimir'/><input type='hidden' name='cod_mensalidade_usuario' value='%s'></form></td>",$cod_cliente, $arrMensalidadeUsuario[$i]['cod_mensalidade_usuario']).chr(10);
                                echo '</tr>'.chr(10);
                            }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>