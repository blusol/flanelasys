<?php

include('../includes/config.php');
include_once('../includes/funcao.php');
include_once($path_classes . 'fla_conexao.class.php');
$objConexao = new fla_conexao();

if (isset($_GET)) {
    if (!empty($_GET['des_placa']))
        buscaPlaca($_GET['des_placa']);
    else
        buscaPlacas($_GET['term']);
}

function buscaPlaca($des_placa) {
    $des_placa = strtolower($des_placa);
    global $objConexao;
    $SQL = 'SELECT 
                                    des_placa
                                    , cod_modelo
                                    , cod_marca
                                    , des_cor
                                    , tipo_cliente
                            FROM
                                    fla_clientes
                            WHERE
                                    LOWER(des_placa) = "' . $des_placa . '"';

    $rsPlaca = $objConexao->prepare($SQL);
    $rsPlaca->execute();
    if ($rsPlaca != false) {
        if ($rsPlaca->rowCount() > 0) {
            while ($placa = $rsPlaca->fetch(PDO::FETCH_ASSOC)) {
                if ($placa['tipo_cliente'] == 'R') {
                    $cod_marca = $placa['cod_marca'];
                    $cod_modelo = $placa['cod_modelo'];
                    $des_cor = $placa['des_cor'];
                    echo sprintf('new Array("%s","%s","%s")', $cod_marca, $cod_modelo, $des_cor);
                } else {
                    echo sprintf('new Array("","","MENSALISTA","%s")',utf8_encode("Este veiculo é mensalista!"));
                }
            }
        }
    }
}

function buscaPlacas($des_placa) {
    $des_placa = strtolower($des_placa);
    global $objConexao;
    $arrPlacas = array();
    $SQL = 'SELECT 
            des_placa
    FROM
            fla_clientes
    WHERE
            LOWER(des_placa) LIKE "%' . $des_placa . '%"';
    $rsPlaca = $objConexao->prepare($SQL);
    $rsPlaca->execute();
    while ($placa = $rsPlaca->fetch(PDO::FETCH_ASSOC)) {
        $row_placa['value'] = $placa['des_placa'];
        array_push($arrPlacas,$row_placa);
    }
    echo json_encode($arrPlacas);
}

?>