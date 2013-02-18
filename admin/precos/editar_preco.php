<?php
session_start();
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
include_once($path_classes . 'fla_precos.class.php');

$objPreco = new fla_precos();

if (!empty($_GET['cod_preco'])) {
    $cod_preco = $_GET['cod_preco'];
    $objPreco->set_cod_preco($cod_preco);
    $arrPrecos = $objPreco->buscaPrecos($objPreco);
} elseif ($_POST['_submit']) {
    $cod_preco = $_POST['cod_preco'];
    $des_preco = $_POST['des_preco'];
    $tip_cobranca = $_POST['tip_cobranca'];
    $val_minimo = $_POST['val_minimo'];
    $val_hora = $_POST['val_hora'];
    $val_fracao = $_POST['val_fracao'];
    $val_diaria = $_POST['val_diaria'];
    $tem_tolerancia = $_POST['tem_tolerancia'];
    $tem_diaria = $_POST['tem_diaria'];
    $tem_minimo = $_POST['tem_minimo'];
    $objPreco->set_cod_preco($cod_preco);
    $objPreco->set_des_preco($des_preco);
    $objPreco->set_tip_cobranca($tip_cobranca);
    $objPreco->set_val_minimo($val_minimo);
    $objPreco->set_val_hora($val_hora);
    $objPreco->set_val_diaria($val_diaria);
    $objPreco->set_val_fracao($val_fracao);
    $objPreco->set_tem_tolerancia($tem_tolerancia);
    $objPreco->set_tem_diaria($tem_diaria);
    $objPreco->set_tem_minimo($tem_minimo);

    if ($_POST['cod_preco'] != "") {
        $objPreco->editaPrecos($objPreco);
        $msgRetorno = 'Dados atualizados com sucesso';
    } else {
        $objPreco->inserePrecos($objPreco);
        $msgRetorno = 'Novo preço cadastrado com sucesso';
    }
    $arrPrecos = $objPreco->buscaPrecos($objPreco);
}
?>
<html>
    <head>
        <title>Cadastro de clientes - Administração - Flanela Sys</title>
		<link href="../../images/style.css" rel="stylesheet" type="text/css" />
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>
		<script type="text/javascript" src="<?php echo $url_includes.'script.js';?>"></script>		
        <script type="text/javascript">
            function setaModelo(modelo) {
                document.getElementById("codigo_modelo").value = modelo;
            }

            jQuery(function($){   
                $("#val_minimo").mask("99.99");
                $("#val_hora").mask("99.99");
                $("#val_fracao").mask("99.99");
                $("#val_diaria").mask("99.99");
            });					
        </script>		
    </head>
    <body>
        <div class="content">
            <?php
            include_once("../../cabecalho.php");
            ?>
            <div class="data">
                <h1> Módulo de preços </h1>

                <div class="success"> <?php echo $msgRetorno; ?> </div>
                <form method="POST" action="editar_preco.php">
                    <table>
                        <tr>
                            <td> Descrição </td>
                            <td> <input type="text" name="des_preco" id="des_preco" value="<?php echo $arrPrecos[0]['des_preco']; ?>">  </td>
                        </tr>

                        <tr>
                            <td> Tipo de cobrança </td>
                            <td> <select id="tip_cobranca" name="tip_cobranca">
                                    <option value="H" <?php echo $arrPrecos[0]['tip_cobranca'] == "H" ? "selected" : ""; ?>> Por hora </option>
                                    <option value="F" <?php echo $arrPrecos[0]['tip_cobranca'] == "F" ? "selected" : ""; ?>> Preço fixo </option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td> Preço inicial ou fixo </td>
                            <td> <input type="text" name="val_minimo" id="val_minimo" value="<?php echo str_pad($arrPrecos[0]['val_minimo'], 5, "0", STR_PAD_LEFT); ?>"> </td>
                        </tr>

                        <tr>
                            <td> Preço na 1ª hora </td>
                            <td> <input type="text" name="val_hora" id="val_hora" value="<?php echo str_pad($arrPrecos[0]['val_hora'], 5, "0", STR_PAD_LEFT); ?>"> </td>
                        </tr>

                        <tr>
                            <td> Preço fracionado </td>
                            <td> <input type="text" name="val_fracao" id="val_fracao" value="<?php echo str_pad($arrPrecos[0]['val_fracao'], 5, "0", STR_PAD_LEFT); ?>"> </td>
                        </tr>

                        <tr>
                            <td> Preço diária </td>
                            <td> <input type="text" name="val_diaria" id="val_diaria" value="<?php echo str_pad($arrPrecos[0]['val_diaria'], 5, "0", STR_PAD_LEFT); ?>"> </td>
                        </tr>						

                        <tr>
                            <td> 
                                Tempo de tolerância <span class="ajuda">(Em minutos)</span>
                            </td>
                            <td> <input type="text" name="tem_tolerancia" id="tem_tolerancia" value="<?php echo $arrPrecos[0]['tem_tolerancia']; ?>"> </td>
                        </tr>

                        <tr>
                            <td> Tempo de diária (em horas) </td>
                            <td> <input type="text" name="tem_diaria" id="tem_tolerancia" value="<?php echo $arrPrecos[0]['tem_diaria']; ?>"> </td>
                        </tr>

                        <tr>
                            <td> Tempo minimo (em minutos) </td>
                            <td> <input type="text" name="tem_minimo" id="tem_minimo" value="<?php echo $arrPrecos[0]['tem_minimo']; ?>"> </td>
                        </tr>						

                        <tr>
                            <td>
                                <input type="hidden" id="cod_preco" name="cod_preco" value="<?php echo $arrPrecos[0]['cod_preco']; ?>">
                                <input type="submit" name="_submit" value="Cadastrar">
                            </td>
                        </tr>
                    </table>	
                </form>
            </div>
        </div>
    </body>
</html>				