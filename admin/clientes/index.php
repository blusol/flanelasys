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
    </head>
    <body>
        <div class="content">
            <?php
            include_once("../../menu.php");
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



