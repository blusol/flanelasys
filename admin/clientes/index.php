<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_clientes.class.php');
include_once($path_classes . 'fla_modelos.class.php');

$objClientes = new fla_clientes();
$objModelos = new fla_modelos();
$arrClientes = $objClientes->buscaClientes($objClientes);
?>
<html>
    <head>
        <title>Cadastro de clientes - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>		
    </head>
    <body>
        <div class="content">
            <?php
            include_once("../../cabecalho.php");
            ?>
            <div class="data">		
                <h1 style="text-align:center;"> Clientes </h1>
                <form>
                        Palavra chave: <input name="palavra_chave" id="palava_chave" />
                        <select>
                                <option value="">Busca por </option>
                                <option value="Nome">Nome</option>
                                <option value="Placa">Placa</option>
                        </select>
                </form>
                <table style="width:100%;" border="1" align="center">
                    <tr>
                        <th> Nome </th>
                        <th> Placa </th>
                        <th> Modelo </th>
                        <th> Tipo de cliente </th>
                        <th> Editar </th>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($arrClientes); $i++) {
                        echo '<tr>' . chr(10);
                        if ($arrClientes[$i]['nom_cliente'] == "") {
                            echo '<td> Não informado </td>' . chr(10);
                        } else {
                            echo '<td>' . $arrClientes[$i]['nom_cliente'] . '</td>' . chr(10);
                        }
                        echo '<td>' . $arrClientes[$i]['des_placa'] . '</td>' . chr(10);
                        $objModelos->set_cod_modelo($arrClientes[$i]['cod_modelo']);
                        $arrModelos = $objModelos->buscaModelos($objModelos);
                        $tipo_cliente = $arrClientes[$i]['tipo_cliente'] == "M" ? "Mensalista" : "Rotativo";
                        echo '<td>' . $arrModelos[0]['des_modelo'] . '</td>' . chr(10);
                        echo '<td>' . $tipo_cliente . '</td>' . chr(10);
                        echo sprintf('<td> <a href="cadastrar_cliente.php?cod_cliente=%s">Alterar dados</a> </td>', $arrClientes[$i]['cod_cliente']) . chr(10);
                        echo '</tr>' . chr(10);
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>	



