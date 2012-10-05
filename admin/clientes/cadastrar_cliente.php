<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_clientes.class.php');
include_once($path_classes . 'fla_cores.class.php');
include_once($path_relative . 'admin/clientes/processa.php');
$objClientes = new fla_clientes();
$objCores = new fla_cores();

if ( (isset($_GET)) && (!empty($_GET['cod_cliente'])) || isset($_POST))
    $cod_cliente = $_GET["cod_cliente"];
else
    Header("Location:".$url);

if (!empty($_POST)) {
    
    if (is_array($_POST)) {
        $cod_cliente = $_POST["cod_cliente"];
        $objClientes->set_cod_cliente($_POST["cod_cliente"]);

        $objClientes->set_nom_cliente($_POST["nom_cliente"]);

        $objClientes->set_des_cor($_POST["des_cor"]);

        $objClientes->set_des_placa($_POST["des_placa"]);

        $objClientes->set_cod_modelo($_POST["codigo_modelo"]);

        $objClientes->set_cod_marca($_POST["codigo_marca"]);

        $objClientes->set_cpf_cnpj_cliente($_POST["cpf_cnpj_cliente"]);

        $objClientes->set_insc_municipal_cliente($_POST["insc_municipal_cliente"]);

        $objClientes->set_insc_estadual_cliente($_POST["insc_estadual_cliente"]);

        $objClientes->set_email_cliente($_POST["email_cliente"]);

        $objClientes->set_cep_cliente($_POST["cep_cliente"]);

        $objClientes->set_tip_rua_cliente($_POST["tip_rua_cliente"]);

        $objClientes->set_des_end_cliente($_POST["des_end_cliente"]);

        $objClientes->set_num_end_cliente($_POST["num_end_cliente"]);

        $objClientes->set_com_end_cliente($_POST["com_end_cliente"]);

        $objClientes->set_bairro_end_cliente($_POST["bairro_end_cliente"]);

        $objClientes->set_estado_cliente($_POST["estado_cliente"]);

        $objClientes->set_cidade_cliente($_POST["cidade_cliente"]);

        $objClientes->set_tipo_cliente($_POST["tipo_cliente"]);
    }

    $objClientes->editaCliente($objClientes);

    $msgRetorno = 'Dados atualizados com sucesso!';
}

$objClientes->ResetObject();
$objClientes->set_cod_cliente($cod_cliente);
if (is_array($objClientes->buscaClientes($objClientes))) {
    $arrCliente = $objClientes->buscaClientes($objClientes);
    $arrHistoricoUltimo = $objClientes->consultahistorico($arrCliente[0]["des_placa"],1);
    $arrHistoricoCompleto = $objClientes->consultahistorico($arrCliente[0]["des_placa"]);
} else {
    Header("Location:".$url);
}

$arrCores = $objCores->buscaCores($objCores);
$select_tipo_doc = "cpf";
if (strlen($arrCliente[0]["cpf_cnpj_cliente"]) == 14) {
    $select_tipo_doc = "cnpj";
    $arrCliente[0]["cpf_cnpj_cliente"] = mascara_string("##.###.###/####-##",$arrCliente[0]["cpf_cnpj_cliente"]);
    $arrCliente[0]["insc_municipal_cliente"] = mascara_string("###.###.###",$arrCliente[0]["insc_municipal_cliente"]);
    $arrCliente[0]["insc_estadual_cliente"] = mascara_string("###.###.###",$arrCliente[0]["insc_estadual_cliente"]);
} else {
    $select_tipo_doc = "cpf";
    $arrCliente[0]["cpf_cnpj_cliente"] = mascara_string("###.###.###-##",$arrCliente[0]["cpf_cnpj_cliente"]);
}
    
?>
<html>
    <head>
        <title>Cadastro de clientes - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />

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
        <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.numeric.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>				
        <script type="text/javascript">
            var timeout         = 500;
            var closetimer		= 0;
            var ddmenuitem      = 0;

            jQuery(function($){   
                $("#des_placa").mask("aaa-9999");
                $("#cep_cliente").mask("99999-999");
                
                $.fn.selecionaTipoDocumento = function(tipo_documento) {
                    if (tipo_documento == "cnpj") {
                        $("#cpfcnpj").text('CNPJ:');
                        $("#cpf_cnpj_cliente").unmask().mask("99.999.999/9999-99");
                        $(".tr_cnpj").show();                        
                    } else {
                        $("#cpfcnpj").text('CPF:');
                        $("#cpf_cnpj_cliente").unmask().mask("999.999.999-99");
                        $(".tr_cnpj").hide();                        
                    }
                }
                
                $("#select_tipo_doc").change(function() {
                    var opcao = ($(this).val());
                    if(opcao=="cnpj"){
                            $("#cpfcnpj").text('CNPJ:');
                            $("#cpf_cnpj_cliente").unmask().mask("99.999.999/9999-99");
                            $(".tr_cnpj").show();
                            //$("#insc_estadual_cliente").show();
                            //
                    } else {
                            $("#cpfcnpj").text('CPF:');
                            $("#cpf_cnpj_cliente").unmask().mask("999.999.999-99");
                            $(".tr_cnpj").hide();
                            //$("#insc_estadual_cliente").hide();
                            //$("#ie").hide();
                    }
                });
                $(window).load(function() {
                    //$(".tr_cnpj").hide();
                    $("#nom_cliente").focus();
                    $("#nom_cliente").select();
                    $().selecionaTipoDocumento("<?php echo $select_tipo_doc;?>");
                });
                
            });	
            
            function jsddm_open()
            {	jsddm_canceltimer();
                jsddm_close();
                ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

            function jsddm_close()
            {	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

            function jsddm_timer()
            {	closetimer = window.setTimeout(jsddm_close, timeout);}

            function jsddm_canceltimer()
            {	if(closetimer)
                {	window.clearTimeout(closetimer);
                    closetimer = null;}}

            $(document).ready(function()
            {	$('#jsddm > li').bind('mouseover', jsddm_open);
                $('#jsddm > li').bind('mouseout',  jsddm_timer);});

            document.onclick = jsddm_close;
				
				
            function setaModelo(modelo) {
                document.getElementById("codigo_modelo").value = modelo;
            }   
            
            function setaMarca(marca) {
                document.getElementById("codigo_marca").value = marca;
            }             
            
            $(function() {
                $("input.numeric").numeric();
            });
        </script>		
    </head>
    <body onLoad="exibeModeloSelect(<?php echo $arrCliente[0]['cod_marca']; ?>,<?php echo $arrCliente[0]['cod_modelo']; ?>);setaModelo(<?php echo $arrCliente[0]['cod_modelo']; ?>)">
        <div class="content">
<?php
include_once("../../menu.php");
?>
            <div class="data">
                <h1> Cadastro de clientes </h1>	
                <p style="border:none;"> <a href="index.php">Voltar a lista de clientes</a></p>
                <div class="success"> <?php echo $msgRetorno; ?> </div>
                <form method="POST" action="cadastrar_cliente.php">
                    <table>
                        <tr>
                            <td> Nome </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['nom_cliente']; ?>" id="nom_cliente" name="nom_cliente"></td>
                        </tr>
                        <tr>
                            <td> Identificação </td>
                            <td>
                                <select name="select_tipo_doc" id="select_tipo_doc">
                                    <option value="cpf" <?php echo $select_tipo_doc == 'cpf' ? 'selected="selected"' : '';?>>CPF</option>
                                    <option value="cnpj" <?php echo $select_tipo_doc == 'cnpj' ? 'selected="selected"' : '';?>>CNPJ</option>                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label id="cpfcnpj"><span>CPF:</span></label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $arrCliente[0]['cpf_cnpj_cliente'];?>" id="cpf_cnpj_cliente" name="cpf_cnpj_cliente">
                            </td>
                        </tr>
                        <tr class="tr_cnpj">
                            <td> Inscrição Municipal </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['insc_municipal_cliente'];?>" id="insc_municipal_cliente" name="insc_municipal_cliente"></td>
                        </tr>
                        <tr class="tr_cnpj">
                            <td> Inscrição Estadual </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['insc_estadual_cliente'];?>" id="insc_estadual_cliente" name="insc_estadual_cliente"></td>
                        </tr>
                        <tr>
                            <td> E-mail </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['email_cliente'];?>" id="email_cliente" name="email_cliente"></td>
                        </tr>
                        <tr>
                            <td> Cep </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['cep_cliente'];?>" id="cep_cliente" name="cep_cliente" onblur="getEndereco(this.value)"></td>
                        </tr>
                        <tr>
                            <td> Endereço </td>
                            <td>
                                <select name="tip_rua_cliente" id="tip_rua_cliente">
                                <?php
                                    foreach($arrTiposRuas as $value) {
                                        if ($arrCliente[0]['tip_rua_cliente'] == $value)
                                            echo sprintf('<option selected="selected" value="%s">%1$s</option>',$value).chr(10);
                                        else
                                            echo sprintf('<option value="%s">%1$s</option>',$value).chr(10);
                                    }
                                ?>	
					<option value="">Outros</option>
                                </select>&nbsp;
                                <input type="text" value="<?php echo $arrCliente[0]['des_end_cliente'];?>" id="des_end_cliente" name="des_end_cliente">&nbsp;
                                <input type="text" value="<?php echo $arrCliente[0]['num_end_cliente'];?>" id="num_end_cliente" name="num_end_cliente">
                            </td>
                        </tr>
                        <tr>
                            <td> Complemento </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['com_end_cliente'];?>" id="com_end_cliente" name="com_end_cliente"></td>
                        </tr>
                        <tr>
                            <td> Bairro </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['bairro_end_cliente'];?>" id="bairro_end_cliente" name="bairro_end_cliente"></td>
                        </tr>
                        <tr>
                            <td> Estado </td>
                            <td> 
                                <select id="estado_cliente" name="estado_cliente">
                                <?php
                                    foreach($arrEstadosSiglas as $value) {
                                        if ($arrCliente[0]['estado_cliente'] == $value)
                                            echo sprintf('<option selected="selected" value="%s">%1$s</option>',$value).chr(10);
                                        else
                                            echo sprintf('<option value="%s">%1$s</option>',$value).chr(10);
                                    }
                                ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> Cidade </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['cidade_cliente'];?>" id="cidade_cliente" name="cidade_cliente"></td>
                        </tr>
                        <tr>
                            <td> Placa </td>
                            <td> <input style="text-transform: uppercase;" type="text" value="<?php echo $arrCliente[0]['des_placa']; ?>" id="des_placa" name="des_placa"></td>
                        </tr>					

                        <tr>
                            <td> Marca </td>
                            <td>
                                <select name="cod_marca" onchange="exibeModeloSelect(this.value);setaMarca(this.value);" onBlur="setaMarca(this.value);" id="cod_marca">
                                    <option value="">Selecione</option>						
                                    <?php
                                    $marca = get_marcas();
                                    $ind_popular = true;
                                    for ($i = 0; $i < count($marca); $i++) {
                                        if ($arrCliente[0]['cod_marca'] == $marca[$i]['id_marca']) {
                                            echo sprintf('<option selected value="%s">%s</option>', $marca[$i]['id_marca'], $marca[$i]['ds_marca']);
                                        } else {
                                            echo sprintf('<option value="%s">%s</option>', $marca[$i]['id_marca'], $marca[$i]['ds_marca']);
                                        }
                                    }
                                    ?>
                                </select>
                            </td>						
                        </tr>

                        <tr>
                            <td> Modelo </td>
                            <td>
                                <select name="cod_modelo" onChange="setaModelo(this.value);" onBlur="setaModelo(this.value);" id="cod_modelo">
                                    <option value="0">Selecione</option>
                                </select>
                            </td>						
                        </tr>

                        <tr>
                            <td> Cor </td>
                            <td>
                                <select name="des_cor" id="des_cor">
                                    <option value="0">Selecione</option>
<?php
for ($i = 0; $i < count($arrCores); $i++) {
    if ($arrCores[$i]['cod_cor'] == $arrCliente[0]['des_cor']) {
        echo sprintf('<option selected value="%s">%s</option>', $arrCores[$i]['cod_cor'], $arrCores[$i]['des_cor']).chr(10);
    } else {
        echo sprintf('<option value="%s">%s</option>', $arrCores[$i]['cod_cor'], $arrCores[$i]['des_cor']).chr(10);
    }
}
?>
                                </select>

                            </td>						
                        </tr>
                        <tr>
                            <td> Tipo de cliente </td>
                            <td>
                                <select name="tipo_cliente" id="tipo_cliente">
                                    <option <?php echo $arrCliente[0]['tipo_cliente'] == "R" ? 'selected="selected"' : '';?> value="R">Rotativo</option>
                                    <option <?php echo $arrCliente[0]['tipo_cliente'] == "M" ? 'selected="selected"' : '';?> value="M">Mensalista</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td> Ultima vez que estacionou </td>
                            <td> <?php echo mostraData($arrHistoricoUltimo[0]["dat_cadastro"]);?></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="hidden" name="cod_cliente" id="cod_cliente" value="<?php echo $cod_cliente; ?>">					
                                <input type="hidden" name="codigo_marca" id="codigo_marca" value="<?php echo $arrCliente[0]['cod_marca']; ?>">					
                                <input type="hidden" name="codigo_modelo" id="codigo_modelo" value="<?php echo $arrCliente[0]['cod_modelo']; ?>">
                                <input type="submit" name="_submit" value="Cadastrar">
                            </td>
                        </tr>
                    </table>
                </form>	
                <h1> Histórico </h1>
                <table>
                    <tr>
                        <td>Data</td>
                        <td>Entrada</td>
                        <td>Saída</td>
                    </tr>
                    <tr>
                        <?php
                            for ($i = 0; $i < count($arrHistoricoCompleto); $i++) {
                                echo sprintf("<td>%s</td>",  mostraData($arrHistoricoCompleto[$i]['dat_cadastro'])).chr(10);
                                echo sprintf("<td>%s</td>",  $arrHistoricoCompleto[$i]['hor_entrada']).chr(10);
                                echo sprintf("<td>%s</td>",  $arrHistoricoCompleto[$i]['hor_saida']).chr(10);
                            }
                        ?>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>