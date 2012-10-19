<?php
include_once('../includes/config.php');
include_once('../includes/funcao.php');
require_once($path_relative . "verifica.php");
include_once($path_classes . 'fla_conexao.class.php');
include_once($path_classes . 'fla_nfes.class.php');
include_once($path_relative.'rotatividade/nfeblu.php');

$objConexao = new fla_conexao();
$objNFE = new fla_nfes();
$dat_inicio = date("Y-m-d");
$dat_final = date("Y-m-d");

if (isset($_POST['_submit'])) {
    $dat_inicio = gravaData($_POST['dat_inicio']);
    $dat_final = gravaData($_POST['dat_final']);
    $exibir = $_POST['exibir'];
    $periodo = sprintf('%s à %s', mostraData($dat_inicio), mostraData($dat_final));

    if ($exibir == "enviados")
        $objNFE->set_ind_enviado(1);
    elseif ($exibir == "naoenviados")
        $objNFE->set_ind_enviado(0);

    $arrNFES = $objNFE->buscaNFE($objNFE);
}

if (isset($_POST['gerarlote'])) {
    $arrRPS = $_POST['envia_prefeitura'];
    if (is_array($arrRPS)) {
        geraLoteRPS($arrRPS);
    }
}
?>
<html>
    <head>
        <title>Lotes RPS - Flanela Sys</title>
        <link href="<?php echo $url_images; ?>style.css" rel="stylesheet" type="text/css" />
        <link type="text/css" href="<?php echo $url_lib_jquery; ?>plugins/jquery-ui/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />		
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.core.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/i18n/ui.datepicker-pt-BR.js"></script>		
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
            include_once("../menu.php");
            ?>

            <div class="data">		
                <h1 style="text-align:center;"> Gera RPS - Recibo Provisório de Serviço </h1>
                <form method="POST" name="form_fechamento" action="">
                    <p> <strong> Filtros </strong> </p>
                    Data Inicial <input type="text" value="<?php echo mostraData($dat_inicio); ?>" name="dat_inicio" id="dat_inicio">
                    Data Final <input type="text" value="<?php echo mostraData($dat_final); ?>" name="dat_final" id="dat_final">				
                    Exibir 
                    <select name="exibir" id="exibir">
                        <option value="naoenviados">Não enviados</option>
                        <option value="enviados">Somente enviados</option>
                        <option value="todos">Todos</option>
                    </select>
                    <input type="submit" name="_submit" value="Buscar">
                </form>					
            </div>	

            <?php
            if (isset($arrNFES) && (is_array($arrNFES))) {
                ?>
            <form method="POST" name="form_fecharlote" action="">
                <table id="fechamento_caixa">

                    <tr>
                        <td colspan="14"> <strong> Periodo </strong> <?php echo $periodo; ?> </td>
                    </tr>
                    <tr>
                        <th> &nbsp; </th>
                        <th> Número RPS </th>
                        <th> Rotatividade </th>
                        <th> Data criação </th>                                                
                        <th> Enviado a prefeitura </th>
                        <th> Data envio </th>
                    </tr>
                    <?php
                    for ($i = 0; $i < count($arrNFES); $i++) {
                        $ind_enviado = $arrNFES[$i]['ind_enviado'] == 1 ? 'Sim' : 'Não';
                        echo '<tr>' . chr(10);
                        echo sprintf('<td><input type="checkbox" name="envia_prefeitura[]" value="%s" /></td>', $arrNFES[$i]['cod_nfe']) . chr(10);
                        echo sprintf('<td>%s</td>', $arrNFES[$i]['cod_nfe']) . chr(10);
                        echo sprintf('<td>%s</td>', $arrNFES[$i]['cod_rotatividade']) . chr(10);
                        echo sprintf('<td>%s</td>', mostraData($arrNFES[$i]['dat_criacao'])) . chr(10);
                        echo sprintf('<td>%s</td>', $ind_enviado) . chr(10);
                        echo sprintf('<td>%s</td>', mostraData($arrNFES[$i]['dat_envio'])) . chr(10);
                        echo '</tr>' . chr(10);
                    }
                    ?>
                    <tr>
                        <td colspan="5">
                                <input type="submit" name="gerarlote" value="Gerar Lote" />
                            </form>    
                        </td>
                    </tr>
                    <?php
                }
                ?>					
            </table>

        </div>
    </body>
</html>	