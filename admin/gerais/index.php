<?php
session_start();
include_once('../../includes/config.php');
include_once('../../includes/funcao.php');
include_once($path_classes . 'fla_descontos.class.php');

$objDescontos = new fla_descontos();
$arrDescontos = $objDescontos->buscaDescontos($objDescontos);

?>
<html>
    <head>
        <title>Configurações Gerais - Administração - Flanela Sys</title>
        <link href="../../images/style.css" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="<?php echo $url_libs . 'cidades-estados/cidades-estados-1.0.js'; ?>"></script>

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
            include_once("../../menu.php");
            ?>
            <div class="data">		
                <h1 style="text-align:center;"> Configurações Gerais </h1>
                <table style="width:100%;" border="1" align="center">
                    <tr>
                        <th colspan="2"> Dados da empresa </th>
                    </tr>
                </table>
                <form name="frmSalvar" id="frmSalvar" action="index.php" method="POST">
                    <table style="width:100%;" border="1" align="center">
                        <tr>
                            <td style="width:30%;"> Nome Fantasia</td>
                            <td> <input type="text" name="nome_fantasia" id="nome_fantasia" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Razão Social </td>
                            <td> <input type="text" name="razao_social" id="razao_social" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> CNPJ </td>
                            <td> <input type="text" name="num_cnpj" id="num_cnpj" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Inscrição Estadual </td>
                            <td> <input type="text" name="num_ie" id="num_ie" /> </td>
                        </tr>                                        
                        <tr>
                            <td style="width:30%;"> Cep </td>
                            <td> <input type="text" name="cep_empresa" id="cep_empresa" /> </td>
                        </tr>                        
                        <tr>
                            <td style="width:30%;"> Endereço </td>
                            <td> <input type="text" name="des_endereco" id="des_endereco" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Bairro </td>
                            <td> <input type="text" name="des_bairro" id="des_bairro" /> </td>
                        </tr>                      
                        <tr>
                            <td style="width:30%;"> Estado </td>
                            <td> <select name="des_estado" id="des_estado"></select> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Cidade </td>
                            <td> <select name="des_cidade" id="des_cidade"></select> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;"> Telefone Fixo </td>
                            <td> <input type="text" name="num_telefone" id="num_telefone" /> </td>
                        </tr>                                        
                        <tr>
                            <td style="width:30%;"> Telefone Celular </td>
                            <td> <input type="text" name="num_celular" id="num_celular" /> </td>
                        </tr>
                        <tr>
                            <td style="width:30%;" colspan="2">
                                <input type="submit" name="btEnviar" id="btEnviar" value="Salvar"/> 
                            </td>
                        </tr>                                        
                    </table>
                </form>
            </div>
        </div>
    </body>
</html>