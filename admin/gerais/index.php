<?php
session_start();
include_once('../../includes/config.php');
include_once($path_relative.'includes/funcao.php');
include_once($path_classes.'fla_conexao.class.php');
include_once($path_classes.'fla_empresas.class.php');

$objEmpresas = new fla_empresas();
$objConexao = new fla_conexao();

if (isset($_POST) && ($_POST['btEnviar'] == 'Salvar')) {
   // imprimeCodigo($objEmpresas, 'Empresas');
    $objEmpresas->set_cod_empresa($_POST["cod_empresa"]);
    $objEmpresas->set_nom_fantasia($_POST["nom_fantasia"]);
    $objEmpresas->set_raz_social($_POST["raz_social"]);
    $_POST['num_cnpj'] = str_replace(array(".","/","-"," "),array(""), $_POST['num_cnpj']);
    $objEmpresas->set_num_cnpj($_POST['num_cnpj']);
    $objEmpresas->set_num_insc_municipal($_POST["num_insc_municipal"]);
    $objEmpresas->set_num_ie($_POST["num_ie"]);
    
    $_POST['cep_empresa'] = str_replace("-", "", $_POST['cep_empresa']);
    $objEmpresas->set_cep_empresa($_POST["cep_empresa"]);
    $objEmpresas->set_des_endereco($_POST["des_endereco"]);
    $objEmpresas->set_des_bairro($_POST["des_bairro"]);
    $objEmpresas->set_des_estado($_POST["des_estado"]);
    $objEmpresas->set_des_cidade($_POST["des_cidade"]);
    
    $_POST['num_telefone'] = str_replace(array("-","(",")"," "),array("","","",""), $_POST['num_telefone']);
    $objEmpresas->set_num_telefone($_POST["num_telefone"]);
    $_POST['num_celular'] = str_replace(array("-","(",")"," "),array("","","",""), $_POST['num_celular']);
    $objEmpresas->set_num_celular($_POST["num_celular"]);
    $objEmpresas->set_tip_empresa($_POST["tip_empresa"]);
    $objEmpresas->set_ind_disponivel($_POST["ind_disponivel"]); 
    
    if (isset($_POST['cod_empresa']) && !empty($_POST['cod_empresa'])) {
        $objEmpresas->set_cod_empresa($_POST['cod_empresa']);
        $edita = $objEmpresas->editaEmpresa($objEmpresas);
        if ($edita == true) {
            echo 'Alterado com sucesso';
        }        
    } else {
        $cadastro = $objEmpresas->insereEmpresa($objEmpresas);
        if ($cadastro == true) {
            echo 'Cadastrado com sucesso';
        }
    }
    $objEmpresas->ResetObject($objEmpresas);    
    $arrEmpresas = $objEmpresas->buscaEmpresas($objEmpresas);
} else {
    $arrEmpresas = $objEmpresas->buscaEmpresas($objEmpresas);
}
?>
<html>
    <head>
        <title>Configurações Gerais - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo $url_libs . 'cidades-estados/cidades-estados-1.0.js'; ?>"></script>
        <script src="<?php echo $url_lib_jquery; ?>jquery.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.maskedinput.js';?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery.'jquery.validate.js';?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery.'util.validate.js';?>"></script>
        <script type="text/javascript">
            var timeout         = 500;
            var closetimer		= 0;
            var ddmenuitem      = 0;

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
                
            $(function() 
            {
                new dgCidadesEstados({
                    estado: $('#des_estado').get(0),
                    cidade: $('#des_cidade').get(0)
                });
            });
            
            jQuery(function($){   
                    $("#num_cnpj").mask("99.999.999/9999-99");
                    $("#num_ie").mask("999.999.999.999");
                    $("#num_telefone").mask("(99) 9999-9999");
                    $("#num_celular").mask("(99) 9999-9999");
                    $("#cep_empresa").mask("99999-999");
                    
                    
            });

            $(function() {
                $("#frmSalvar").validate({
                // debug:true, //retira essa linha, para o form voltar a funcionar
                    rules: {
                        "num_cnpj" : {
                            cnpj: 'both' //valida tanto Formatação como os Digitos
                        }
                    }
                });
            });
        </script>		
    </head>
    <body>
        <div class="content">
            <?php
            include_once("../../cabecalho.php");
            ?>
            <div class="data">		
                <h1 style="text-align:center;"> Configurações Gerais </h1>
                <table style="width:100%;" border="1" align="center">
                    <tr>
                        <th colspan="2"> Dados da empresa </th>
                    </tr>
                </table>
                <div class="formCadastraEmpresa">
                <form name="frmSalvar" id="frmSalvar" action="index.php" method="POST">
                    <table style="width:100%;" border="1" align="center">
                        <tr>
                            <td style="width:30%;"> Nome Fantasia</td>
                            <td> <input type="text" name="nom_fantasia" value="<?php echo $arrEmpresas[0]['nom_fantasia'];?>" id="nom_fantasia" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Razão Social </td>
                            <td> <input type="text" name="raz_social" value="<?php echo $arrEmpresas[0]['raz_social'];?>" id="raz_social" style="width:100%;" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> CNPJ </td>
                            <td> <input type="text" name="num_cnpj" value="<?php echo $arrEmpresas[0]['num_cnpj'];?>" id="num_cnpj" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Inscrição Municipal </td>
                            <td> <input type="text" name="num_insc_municipal" value="<?php echo $arrEmpresas[0]['num_insc_municipal'];?>" id="num_insc_municipal" /> </td>
                        </tr>                                                                
                        <tr>
                            <td style="width:30%;"> Inscrição Estadual </td>
                            <td> <input type="text" name="num_ie" value="<?php echo $arrEmpresas[0]['num_ie'];?>" id="num_ie" /> </td>
                        </tr>                                        
                        <tr>
                            <td style="width:30%;"> Cep </td>
                            <td> <input type="text" name="cep_empresa" value="<?php echo $arrEmpresas[0]['cep_empresa'];?>" id="cep_empresa" /> </td>
                        </tr>                        
                        <tr>
                            <td style="width:30%;"> Endereço </td>
                            <td> <input type="text" name="des_endereco" value="<?php echo $arrEmpresas[0]['des_endereco'];?>" id="des_endereco" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Bairro </td>
                            <td> <input type="text" name="des_bairro" value="<?php echo $arrEmpresas[0]['des_bairro'];?>" id="des_bairro" /> </td>
                        </tr>                      
                        <tr>
                            <td style="width:30%;"> Estado </td>
                            <td> <select name="des_estado" id="des_estado" value="<?php echo $arrEmpresas[0]['des_estado'];?>"></select> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Cidade </td>
                            <td> <select name="des_cidade" id="des_cidade" value="<?php echo $arrEmpresas[0]['des_cidade'];?>"></select> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Telefone Fixo </td>
                            <td> <input type="text" name="num_telefone" value="<?php echo $arrEmpresas[0]['num_telefone'];?>" id="num_telefone" /> </td>
                        </tr>                                        
                        <tr>
                            <td style="width:30%;"> Telefone Celular </td>
                            <td> <input type="text" name="num_celular" value="<?php echo $arrEmpresas[0]['num_celular'];?>" id="num_celular" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Tipo de empresa </td>
                            <td>
                                <select id="tip_empresa" name="tip_empresa">
                                    <option value="M" <?php echo $arrEmpresas[0]['tip_empresa'] == 'M' ? 'selected="selected"':'';?>>Matriz</option>
                                    <option value="F" <?php echo $arrEmpresas[0]['tip_empresa'] == 'F' ? 'selected="selected"':'';?>>Filial</option>
                                </select>
                            </td>
                        </tr>                        
                        <tr>
                            <td style="width:30%;" colspan="2">
                                <input type="hidden" name="cod_empresa" id="cod_empresa" value="<?php echo $arrEmpresas[0]['cod_empresa'];?>" />
                                <input type="submit" name="btEnviar" id="btEnviar" value="Salvar"/> 
                            </td>
                        </tr>                                        
                    </table>
                </form>
                </div>
            </div>
        </div>
    </body>
</html>