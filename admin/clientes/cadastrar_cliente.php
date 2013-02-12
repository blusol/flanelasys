<?php
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
require_once($path_relative . 'verifica.php');
include_once($path_classes . 'fla_clientes.class.php');
include_once($path_classes . 'fla_cores.class.php');
include_once($path_classes . 'fla_mensalidade.class.php');
include_once($path_relative . 'admin/clientes/processa.php');
$objClientes = new fla_clientes();
$objCores = new fla_cores();
$objMensalidade = new fla_mensalidade();

if (isset($_GET) && !empty($_GET['cod_cliente']))
    $cod_cliente = $_GET['cod_cliente'];

if (!empty($_POST)) {
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

    $objClientes->set_num_telefone($_POST["num_telefone"]);

    $objClientes->set_num_celular($_POST["num_celular"]);

    $objClientes->set_des_observacao($_POST["des_observacao"]);

    if ($_POST["tipo_cliente"] == "M") {
        $objClientes->set_tip_mensalidade($_POST["tip_mensalidade"]);
        $objClientes->set_dat_contratacao(gravaData($_POST["dat_contratacao"]));
        $objClientes->set_dia_vencimento($_POST["dia_vencimento"]);
    }

    if (!empty($_POST['ind_ativo']))
        $objClientes->set_ind_ativo(1);
    else
        $objClientes->set_ind_ativo(0);

    if (!empty($_POST["cod_cliente"])) {
        $cod_cliente = $_POST["cod_cliente"];
        $objClientes->set_cod_cliente($_POST["cod_cliente"]);
        $retorno = $objClientes->editaCliente($objClientes);
        if ($retorno)
            $msgRetorno = 'Dados atualizados com sucesso!';
        else
            $msgRetorno = '<span style="color:red;font-weight:bolder;">A placa informada já está sendo utilizada por outro veículo!</span>';
    } else {
        $cod_cliente = $objClientes->insereCliente($objClientes);
        if (is_numeric($cod_cliente)) {
            $msgRetorno = 'Cliente cadastrado com sucesso!';
        } else {
            $msgRetorno = 'O cliente informado já está cadastrado';
        }
    }
}

if (isset($_GET['acao']) && !empty($_GET['acao']) && ($_GET['acao'] == 'excluir')) {
    $cod_cliente = $_GET['cod_cliente'];

    $objClientes->set_cod_cliente($cod_cliente);
    $arrCliente = $objClientes->buscaClientes($objClientes);
    $objClientes->set_des_placa($arrCliente[0]['des_placa']);

    $msgRetorno = $objClientes->removeCliente(); 
}

if (isset($cod_cliente) && !empty($cod_cliente) && is_numeric($cod_cliente)) {
    $objClientes->ResetObject();
    $objClientes->set_cod_cliente($cod_cliente);
    $arrCliente = $objClientes->buscaClientes($objClientes);

    if (is_array($arrCliente)) {
        $arrHistoricoUltimo = $objClientes->consultahistorico($arrCliente[0]["des_placa"], 1);
        $arrHistoricoCompleto = $objClientes->consultahistorico($arrCliente[0]["des_placa"]);

        $select_tipo_doc = "cpf";
        if (strlen($arrCliente[0]["cpf_cnpj_cliente"]) == 14) {
            $select_tipo_doc = "cnpj";
            $arrCliente[0]["cpf_cnpj_cliente"] = mascara_string("##.###.###/####-##", $arrCliente[0]["cpf_cnpj_cliente"]);
            $arrCliente[0]["insc_municipal_cliente"] = mascara_string("###.###.###", $arrCliente[0]["insc_municipal_cliente"]);
            $arrCliente[0]["insc_estadual_cliente"] = mascara_string("###.###.###", $arrCliente[0]["insc_estadual_cliente"]);
        } else {
            $select_tipo_doc = "cpf";
            $arrCliente[0]["cpf_cnpj_cliente"] = mascara_string("###.###.###-##", $arrCliente[0]["cpf_cnpj_cliente"]);
        }
        if (empty($arrCliente[0]['cod_modelo']))
            $arrCliente[0]['cod_modelo'] = 0;

        $carrega_dados_veiculo = "exibeModeloSelect(" . $arrCliente[0]['cod_marca'] . "," . $arrCliente[0]['cod_modelo'] . ");setaModelo(" . $arrCliente[0]['cod_modelo'] . ");";
    } else {
      $arrCliente = array();
      $carrega_dados_veiculo = "";
      unset($cod_cliente);
    }
} else {
    $arrCliente = array();
    $carrega_dados_veiculo = "";
    unset($cod_cliente);
}
$arrCores = $objCores->buscaCores($objCores);
$arrMensalidade = $objMensalidade->buscaMensalidade();
?>
<html>
    <head>
        <title>Cadastro de clientes - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.numeric.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>			
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.core.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/ui.datepicker.js"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery ?>plugins/jquery-ui/ui/i18n/ui.datepicker-pt-BR.js"></script>
        <link type="text/css" href="<?php echo $url_lib_jquery; ?>plugins/jquery-ui/themes/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />
        <script type="text/javascript">
            jQuery(function($){   
                $("#des_placa").mask("aaa-9999");
                $("#cep_cliente").mask("99999-999");
                $("#num_telefone").mask("(99) 9999-9999");
                $("#num_celular").mask("(99) 9999-9999");
                       
                
                $('#excluirCliente').click(function() {
                    var c = confirm("Se excluir o cliente todos os dados relacionados serão excluídos. Continuar?\nProcesso irreversível!");
                    return c;
                });                
                
                $("#dat_contratacao").datepicker(
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
                $("#dat_contratacao").datepicker($.datepicker.regional['pt-BR']);                
                
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
                
                $("#frm").submit(function() {
                    if($("#des_placa").val() == "") {
                        alert('Por favor informe a placa');
                        $("#des_placa").focus();
                        return false;
                    } else {
                        return true;
                    }
                });
                
                
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
                    $().selecionaTipoDocumento("<?php echo $select_tipo_doc; ?>");
                });
                
            });	
				
				
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
    <body onLoad="<?php echo $carrega_dados_veiculo; ?>">
        <div class="content">
<?php
include_once("../../cabecalho.php");
?>
            <div class="data">
            <?php
            if (!empty($arrCliente[0]['nom_cliente']))
                echo sprintf('<h1> Cadastro do cliente: %s </h1>', $arrCliente[0]['nom_cliente']);
            else
                echo '<h1> Cadastro de cliente </h1>';
            ?>
                <p style="border:none;"> 
                    <a href="index.php">Lista de clientes</a> | 

<?php
if (!empty($cod_cliente)) {
    echo '<a href="cadastrar_cliente.php">Cadastrar novo</a> | ';
    echo sprintf('<a href="cadastrar_cliente.php?cod_cliente=%s">Dados Gerais</a> | ', $cod_cliente);
    echo sprintf('<a href="historico.php?cod_cliente=%s">Histórico</a> | ', $cod_cliente);

	if ((!empty($arrCliente[0]['tipo_cliente']) && $arrCliente[0]['tipo_cliente'] == 'M')) {
		echo sprintf('<a href="mensalidade.php?cod_cliente=%s">Mensalidades</a> |', $cod_cliente);
	}	
	echo sprintf('<a id="excluirCliente" href="cadastrar_cliente.php?cod_cliente=%s&acao=excluir">Excluir</a> ', $cod_cliente);	
} else {
    echo '<a href="cadastrar_cliente.php">Cadastrar novo</a> |';
}
?>
                </p>
                <div class="success"> <?php echo $msgRetorno; ?> </div>
                <form method="POST" action="cadastrar_cliente.php" id="frm">
                    <table>
                        <tr>
                            <td> Nome </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['nom_cliente']; ?>" id="nom_cliente" name="nom_cliente"></td>
                        </tr>
                        <tr>
                            <td> Identificação </td>
                            <td>
                                <select name="select_tipo_doc" id="select_tipo_doc">
                                    <option value="cpf" <?php echo $select_tipo_doc == 'cpf' ? 'selected="selected"' : ''; ?>>CPF</option>
                                    <option value="cnpj" <?php echo $select_tipo_doc == 'cnpj' ? 'selected="selected"' : ''; ?>>CNPJ</option>                                    
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label id="cpfcnpj"><span>CPF:</span></label>
                            </td>
                            <td>
                                <input type="text" value="<?php echo $arrCliente[0]['cpf_cnpj_cliente']; ?>" id="cpf_cnpj_cliente" name="cpf_cnpj_cliente">
                            </td>
                        </tr>
                        <tr class="tr_cnpj">
                            <td> Inscrição Municipal </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['insc_municipal_cliente']; ?>" id="insc_municipal_cliente" name="insc_municipal_cliente"></td>
                        </tr>
                        <tr class="tr_cnpj">
                            <td> Inscrição Estadual </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['insc_estadual_cliente']; ?>" id="insc_estadual_cliente" name="insc_estadual_cliente"></td>
                        </tr>
                        <tr>
                            <td> E-mail </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['email_cliente']; ?>" id="email_cliente" name="email_cliente"></td>
                        </tr>
                        <tr>
                            <td> Cep </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['cep_cliente']; ?>" id="cep_cliente" name="cep_cliente" onblur="getEndereco(this.value,'<?php echo $url; ?>')"></td>
                        </tr>
                        <tr>
                            <td> Endereço </td>
                            <td>
                                <select name="tip_rua_cliente" id="tip_rua_cliente">
<?php
foreach ($arrTiposRuas as $value) {
    if ($arrCliente[0]['tip_rua_cliente'] == $value || (empty($arrCliente[0]["tip_rua_cliente"]) && $value == "Rua"))
        echo sprintf('<option selected="selected" value="%s">%1$s</option>', $value) . chr(10);
    else
        echo sprintf('<option value="%s">%1$s</option>', $value) . chr(10);
}
?>	
                                    <option value="">Outros</option>
                                </select>&nbsp;
                                <input type="text" value="<?php echo $arrCliente[0]['des_end_cliente']; ?>" id="des_end_cliente" name="des_end_cliente">&nbsp;
                                <input type="text" value="<?php echo $arrCliente[0]['num_end_cliente']; ?>" id="num_end_cliente" name="num_end_cliente">
                            </td>
                        </tr>
                        <tr>
                            <td> Complemento </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['com_end_cliente']; ?>" id="com_end_cliente" name="com_end_cliente"></td>
                        </tr>
                        <tr>
                            <td> Bairro </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['bairro_end_cliente']; ?>" id="bairro_end_cliente" name="bairro_end_cliente"></td>
                        </tr>
                        <tr>
                            <td> Estado </td>
                            <td> 
                                <select id="estado_cliente" name="estado_cliente">
<?php
foreach ($arrEstadosSiglas as $value) {
    if ($arrCliente[0]['estado_cliente'] == $value)
        echo sprintf('<option selected="selected" value="%s">%1$s</option>', $value) . chr(10);
    else
        echo sprintf('<option value="%s">%1$s</option>', $value) . chr(10);
}
?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> Cidade </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['cidade_cliente']; ?>" id="cidade_cliente" name="cidade_cliente"></td>
                        </tr>
                        <tr>
                            <td> Telefone Fixo </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['num_telefone']; ?>" id="num_telefone" name="num_telefone"></td>
                        </tr>                        
                        <tr>
                            <td> Telefone Celular </td>
                            <td> <input type="text" value="<?php echo $arrCliente[0]['num_celular']; ?>" id="num_celular" name="num_celular"></td>
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
        echo sprintf('<option selected value="%s">%s</option>', $arrCores[$i]['cod_cor'], $arrCores[$i]['des_cor']) . chr(10);
    } else {
        echo sprintf('<option value="%s">%s</option>', $arrCores[$i]['cod_cor'], $arrCores[$i]['des_cor']) . chr(10);
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
                                    <option <?php echo $arrCliente[0]['tipo_cliente'] == "R" ? 'selected="selected"' : ''; ?> value="R">Rotativo</option>
                                    <option <?php echo $arrCliente[0]['tipo_cliente'] == "M" ? 'selected="selected"' : ''; ?> value="M">Mensalista</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td> Plano de mensalidade </td>
                            <td>
                                <select name="tip_mensalidade" id="tip_mensalidade">
                                    <option value=""></option>
<?php
for ($i = 0; $i < count($arrMensalidade); $i++) {
    if ($arrMensalidade[$i]['cod_mensalidade'] == $arrCliente[0]['tip_mensalidade'])
        echo sprintf("<option value='%s' selected='selected'>%s - Valor R$ %s</option>", $arrMensalidade[$i]['cod_mensalidade'], $arrMensalidade[$i]['des_mensalidade'], $arrMensalidade[$i]['val_mensalidade']) . chr(10);
    else
        echo sprintf("<option value='%s'>%s - R$ %s</option>", $arrMensalidade[$i]['cod_mensalidade'], $arrMensalidade[$i]['des_mensalidade'], $arrMensalidade[$i]['val_mensalidade']) . chr(10);
}
?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> Inicio contratação </td>
                            <td><input type="text" name="dat_contratacao" id="dat_contratacao" value="<?php echo $arrCliente[0]['dat_contratacao'] != '' ? mostraData($arrCliente[0]['dat_contratacao']) : date("d/m/Y"); ?>" /></td>
                        </tr>
                        <tr>
                            <td>Dia de vencimento</td>
                            <td>
                                <select name="dia_vencimento" id="dia_vencimento">
<?php
for ($i = 1; $i <= 31; $i++) {
    if ($i == $arrCliente[0]['dia_vencimento'])
        echo sprintf('<option value="%s" selected="selected">%1$s</option>', str_pad($i, 2, 0, STR_PAD_LEFT)) . chr(10);
    else
        echo sprintf('<option value="%s">%1$s</option>', str_pad($i, 2, 0, STR_PAD_LEFT)) . chr(10);
}
?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td> Observações </td>
                            <td> <textarea name="des_observacao"><?php echo $arrCliente[0]["des_observacao"]; ?></textarea></td>
                        </tr>
                        <tr>
                            <td> Ativo </td>
                            <td> <input type="checkbox" name="ind_ativo" id="ind_ativo" value="1" <?php echo $arrCliente[0]['ind_ativo'] == 1 ? 'checked' : ''; ?>  /></td>
                        </tr>                        
                        <tr>
                            <td> Ultima vez que estacionou </td>
                            <td> <?php echo mostraData($arrHistoricoUltimo[0]["dat_cadastro"]); ?></td>
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
            </div>
        </div>
    </body>
</html>