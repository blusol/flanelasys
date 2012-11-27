<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_clientes.class.php');

$objClientes = new fla_clientes();

if (isset($_GET) && !empty($_GET['cod_cliente'])) 
    $cod_cliente = $_GET['cod_cliente'];
else
    Header("index.php");

$objClientes->set_cod_cliente($cod_cliente);
$arrCliente = $objClientes->buscaClientes($objClientes);
$arrHistoricoCompleto = $objClientes->consultahistorico($arrCliente[0]["des_placa"]);

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
    </head>
    <body>
        <div class="content">
<?php
include_once("../../cabecalho.php");
?>
            <div class="data">
                <?php 
                    if (!empty($arrCliente[0]['nom_cliente']))
                        echo sprintf('<h1> Cadastro do cliente: %s </h1>',$arrCliente[0]['nom_cliente']);
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
                <table>
                    <tr>
                        <td>Data</td>
                        <td>Entrada</td>
                        <td>Saída</td>
                    </tr>
                        <?php
                            for ($i = 0; $i < count($arrHistoricoCompleto); $i++) {
                                echo '<tr>'.chr(10);
                                echo sprintf("<td>%s</td>",  mostraData($arrHistoricoCompleto[$i]['dat_cadastro'])).chr(10);
                                echo sprintf("<td>%s</td>",  $arrHistoricoCompleto[$i]['hor_entrada']).chr(10);
                                echo sprintf("<td>%s</td>",  $arrHistoricoCompleto[$i]['hor_saida']).chr(10);
                                echo '</tr>'.chr(10);
                            }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>