<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_clientes.class.php');
include_once($path_classes . 'fla_modelos.class.php');

$objClientes = new fla_clientes();
$objModelos = new fla_modelos();

$palavra_chave = "";
$filtro_palavra_chave = "";
$tipo_cliente = "";

if (isset($_POST)) {
    if (!empty($_POST['palavra_chave'])) {
        $palavra_chave = $_POST['palavra_chave'];
    }
    if (!empty($_POST["filtro_palavra_chave"])) {
        $filtro_palavra_chave = $_POST["filtro_palavra_chave"];
    }
    if (!empty($_POST['tipo_cliente'])) {
        $tipo_cliente = $_POST['tipo_cliente'];
    }
    
    if (!empty($palavra_chave)) {
        if ($filtro_palavra_chave == 'Nome')
            $objClientes->set_nom_cliente($palavra_chave);
        elseif ($filtro_palavra_chave == 'Placa')
            $objClientes->set_des_placa ($palavra_chave);
    }
    
    if ($tipo_cliente == "M")
        $objClientes->set_tipo_cliente ("M");
    elseif ($tipo_cliente == "R")
        $objClientes->set_tipo_cliente ("R");
}

$arrClientes = $objClientes->buscaClientes($objClientes);
if ($arrClientes == false)
    $arrClientes = array();
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
                <form method="POST" action="index.php">
                        Palavra chave: <input name="palavra_chave" id="palava_chave" value="<?php echo $palavra_chave;?>" />
                        <select name="filtro_palavra_chave">
                                <option value="Nome">Busca por </option>
                                <option value="Nome" <?php echo $filtro_palavra_chave == 'Nome'? 'selected="selected"' : '';?>>Nome</option>
                                <option value="Placa" <?php echo $filtro_palavra_chave == 'Placa'? 'selected="selected"' : '';?>>Placa</option>
                        </select>
                        Tipo de cliente: 
                        <select name="tipo_cliente">
                            <option value="T"> Todos </option>
                            <option value="M"  <?php echo $tipo_cliente == 'M'? 'selected="selected"' : '';?>> Mensalistas </option>
                            <option value="R"  <?php echo $tipo_cliente == 'R'? 'selected="selected"' : '';?>> Rotativos </option>
                        </select>
                        <input type="submit" value="Buscar" />
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
                    if (count($arrClientes) > 0) {
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
                    } else {
                           echo '<tr>' . chr(10);
                           echo '<td colspan="5" style="font-size:12pt;color:red;"> Desculpe, não foi encontrado nenhum cliente com os filtros utilizados. </td>';
                           echo '</tr>' . chr(10);
                    }
                    ?>
                </table>
            </div>
        </div>
    </body>
</html>	



