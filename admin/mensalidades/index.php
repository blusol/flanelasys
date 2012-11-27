<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_mensalidade.class.php');

$objMensalidade = new fla_mensalidade();

$arrMensalidade = $objMensalidade->buscaMensalidade();
if (!is_array($arrMensalidade))
    $arrMensalidade = array();
?>
<html>
    <head>
        <title>Mensalidades - Administração - Flanela Sys</title>
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
                <h1 style="text-align:center;"> Mensalidades </h1>
                <form method="POST" action="index.php">
                        Palavra chave: <input name="palavra_chave" id="palava_chave" value="<?php echo $palavra_chave;?>" />
                        <input type="submit" value="Buscar" />
                </form>
                <table style="width:100%;" border="1" align="center">
                    <tr>
                        <td><a href="cadastrar_mensalidade.php">Cadastrar Mensalidade</a></td>
                    </tr>
                    <tr>
                        <th> Descrição </th>
                        <th> Valor </th>
                        <th> Editar </th>
                    </tr>
                    <?php
                    if (count($arrMensalidade) > 0) {
                        for ($i = 0; $i < count($arrMensalidade); $i++) {
                            echo '<tr>' . chr(10);
                            echo '<td>' . $arrMensalidade[$i]['des_mensalidade'] . '</td>' . chr(10);
                            echo '<td> R$' . number_format($arrMensalidade[$i]['val_mensalidade'],2,",",".") . '</td>' . chr(10);
                            echo sprintf('<td> <a href="cadastrar_mensalidade.php?cod_mensalidade=%s">Alterar dados</a> </td>', $arrMensalidade[$i]['cod_mensalidade']) . chr(10);
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