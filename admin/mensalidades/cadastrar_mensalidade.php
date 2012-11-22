<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_mensalidade.class.php');

$objMensalidade = new fla_mensalidade();

if (isset($_POST)) {
    $objMensalidade->set_des_mensalidade($_POST["des_mensalidade"]);
    $objMensalidade->set_val_mensalidade($_POST["val_mensalidade"]);
    if (isset($_POST['ind_ativo']))
        $objMensalidade->set_ind_ativo(1);
    else
        $objMensalidade->set_ind_ativo(0);
    
    $objMensalidade->set_dat_criacao(date("Y-m-d H:i"));
    
    $objMensalidade->cadastraMensalidade($objMensalidade);
}

?>
<html>
    <head>
        <title>Cadastro de mensalidades - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.numeric.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>
    </head>
    <body>
            <div class="content">
<?php
include_once("../../cabecalho.php");
?>
    <div class="data">
        <h1> Cadastro de mensalidades </h1>	
            <p style="border:none;"> <a href="index.php">Voltar a lista de mensalidades</a></p>
            <div class="success"> <?php echo $msgRetorno; ?> </div>
            <form method="POST" action="cadastrar_mensalidade.php" id="frm">
                    <table>
                        <tr>
                            <td> Descrição </td>
                            <td> <input type="text" value="<?php echo $arrMensalidade[0]['des_mensalidade']; ?>" id="des_mensalidade" name="des_mensalidade"></td>
                        </tr>
                        <tr>
                            <td> Valor </td>
                            <td> <input type="text" value="<?php echo $arrMensalidade[0]['val_mensalidade']; ?>" id="val_mensalidade" name="val_mensalidade"></td>
                        </tr>
                        <tr>
                            <td> Ativo </td>
                            <td> <input type="checkbox" name="ind_ativo" id="ind_ativo" value="1" <?php echo $arrMensalidade[0]['ind_ativo'] == 1 ? 'checked' : '';?>  /></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="cod_mensalidade" id="cod_mensalidade" value="<?php echo $cod_mensalidade; ?>">
                                <input type="submit" name="_submit" value="Cadastrar">
                            </td>
                        </tr>                        
                    </table>
            </form>
    </div>
    </body>
</html>