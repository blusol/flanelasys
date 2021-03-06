<?php
session_start();
include_once('../includes/config.php');
include_once('../includes/funcao.php');
require_once($path_relative . "verifica.php");
include_once($path_classes . 'fla_precos.class.php');
include_once($path_classes . 'fla_descontos.class.php');
include_once($path_classes . 'fla_rotatividade.class.php');
include_once($path_classes . 'fla_clientes.class.php');
include_once($path_classes . 'fla_mensalidade.class.php');
include_once('nfeblu.php');
include_once('processa.php');

$msgRetorno = "";

$mktime = mktime(date("H"), date("i"), date("s"), date("m"), date("d"), date("Y"));
$mktime = substr($mktime, 6, 4);
$arrPrecos = array();
$objPrecos = new fla_precos();
$objPrecos->set_ind_disponivel(1);
$arrPrecos = $objPrecos->buscaPrecos($objPrecos);

$arrDescontos = array();
$objDescontos = new fla_descontos();
$objDescontos->set_ind_disponivel(1);
$arrDescontos = $objDescontos->buscaDescontos($objDescontos);

$objRotatividade = new fla_rotatividade();

$objMensalidade = new fla_mensalidade();

$objClientes = new fla_clientes();
$objPlacas = new fla_clientes();

if (isset($_POST['cod_cartao'])) {
    if (!empty($_POST['cod_cartao']))
        $cod_cartao = $_POST['cod_cartao'];
    else
        $cod_cartao = $objRotatividade->geraProximaNumeroCartao();
    
    $des_placa = $_POST['des_placa'];
    $hor_entrada = date("H:i:s");
    $dat_saida = gravaData(date("d/m/Y"));
    $dat_cadastro = gravaData($_POST['dat_cadastro']);
    $cod_preco = $_POST['cod_preco'];
    $des_situacao = $_POST['des_situacao'];
    $cod_marca = $_POST['cod_marca'];
    $cod_modelo = $_POST['codigo_modelo'];
    $des_cor = $_POST['des_cor'];
    $hor_saida = $_POST['hor_saida'];
    $tem_permanencia = $_POST['tem_permanencia'];
    $cod_desconto = $_POST['cod_desconto'];
    $val_total = $_POST['val_total'];
    $val_cobrado = $_POST['val_cobrado'];
    $des_justificativa = $_POST['des_justificativa'];
    $cod_rotatividade = $_POST["cod_rotatividade"];

    if (empty($des_placa)) {
        $des_placa = "XXX-" . $mktime;
    }

    if (empty($cod_modelo)) {
        $cod_modelo = 0;
    }

    if (empty($cod_desconto)) {
        $cod_desconto = 0;
    }

    $objRotatividade->set_des_placa($des_placa);
    $objRotatividade->set_cod_preco($cod_preco);
    $objRotatividade->set_des_situacao("P");

    if (empty($val_total)) {
        $objClientes->set_des_placa($des_placa);
        $objClientes->set_tipo_cliente('M');
        $arrClientes = $objClientes->buscaClientes($objClientes);        
        
        if (is_array($arrClientes)) {
            $msgRetorno = 'Este ve�culo � mensalista!';
        } else {
            $objClientes->ResetObject();
            $objClientes->set_des_placa($des_placa);
            $objClientes->set_cod_marca($cod_marca);
            $objClientes->set_des_cor($des_cor);
            $objClientes->set_cod_modelo($cod_modelo);
            $objClientes->insereCliente($objClientes);

            $verifica = $objRotatividade->buscaCarro($objRotatividade,"P");
            $objRotatividade->set_cod_cartao($cod_cartao);
            if ($verifica == false) {
                $objRotatividade->set_hor_entrada($hor_entrada);
                $objRotatividade->set_dat_cadastro($dat_cadastro);            
                $cod_rotatividade = $objRotatividade->insereRotatividade($objRotatividade);
                $msgRetorno = 'Entrada de veiculo feito com sucesso';
                $verificaImprimir = true;
            } else {
                $msgRetorno = 'Este veiculo j� se encontra estacionado';
            }
        }
    } else {
        $objRotatividade->set_cod_cartao($cod_cartao);
        $objRotatividade->set_hor_entrada($hor_entrada);
        $objRotatividade->set_dat_cadastro($dat_cadastro);        
        $objRotatividade->set_cod_rotatividade($cod_rotatividade);
        $objRotatividade->set_hor_saida($hor_saida);
        $objRotatividade->set_dat_saida($dat_saida);
        $objRotatividade->set_cod_desconto($cod_desconto);
        $objRotatividade->set_val_total(str_replace(",", ".", $val_total));
        $objRotatividade->set_val_cobrado(str_replace(",", ".", $val_cobrado));
        $objRotatividade->set_des_justificativa($des_justificativa);
        $objRotatividade->set_tem_permanencia($tem_permanencia);
        $objRotatividade->removeRotatividade($objRotatividade);
        
        $objClientes->set_des_placa($des_placa);
        $arrCliente = $objClientes->buscaClientes($objClientes);
        $cod_cliente = $arrCliente[0]['cod_cliente'];
        $msgRetorno = 'Veiculo liberado com sucesso';
        $msgRetorno .= '<br> Deseja imprimir RPS? <a href="'.$url.'rotatividade/index.php?imprimir='.  base64_encode(strToHex('imprimeRPS')).'&cod_rotatividade='.$cod_rotatividade.'&cod_cliente='.$cod_cliente.'">Sim</a>';
        $val_total = "";
    }
}

if (isset($_GET) && !empty($_GET['imprimir'])) {
    $cod_rotatividade = $_GET['cod_rotatividade'];
    $cod_rotatividade = base64_decode(hexToStr($cod_rotatividade));
    $cod_cliente = $_GET['cod_cliente'];
    geraRPS($cod_rotatividade,1,$cod_cliente);
    Header("Location:" . $url . "rotatividade/index.php");
}
if (isset($_POST) && !empty($_POST['imprimirCupomEntrada']) && ($verificaImprimir == true)) {
	$imprime_cupom = true;
}


//$hora_entrada = date("H:i:s");
$hora_entrada = "";
$hora_saida = "";
$arrRotatividade = $objRotatividade->buscaCarrosEstacionados();
$arrMensalidadesAtrasadas = $objMensalidade->buscaMensalidadesAtrasadas();
$arrPlacas = $objPlacas->buscaClientes($objPlacas);
?>
<html>
    <head>
        <title><?php echo $titulo_pagina; ?> </title>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.maskedinput.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_lib_jquery . 'jquery.numeric.js'; ?>"></script>
        <script src="<?php echo $url_lib_jquery . 'plugins/jquery-ui/js/jquery-ui-1.9.2.custom.js'; ?>"></script>
        <script type="text/javascript" src="<?php echo $url_includes . 'script.js'; ?>"></script>
        <link rel="stylesheet" type="text/css" href="<?php echo $url_lib_jquery . 'plugins/jquery-ui/css/smoothness/jquery-ui-1.9.2.custom.css'; ?>">
        <script src="<?php echo $url_lib_jquery . 'plugins/chosen/chosen.jquery.js';?>" type="text/javascript"></script>
        <link rel="stylesheet" href="<?php echo $url_lib_jquery . 'plugins/chosen/chosen.css';?>" />
        <script language="javascript">

            function carrega() {
                document.getElementById("des_placa").focus();
				
            }
                    
            function setaModelo(modelo) {
                document.getElementById("codigo_modelo").value = modelo;
            }
					
            function consultaDesconto(desconto) {
                var val_cobrado = document.getElementById('val_total').value;
                if (desconto == "") {
                    document.getElementById('val_cobrado').value = document.getElementById('val_total').value;
                    document.getElementById('des_justificativa').value = "";
                } else {
                    url="consulta_desconto.php?cod_desconto="+desconto+"&val_total="+val_cobrado;								
                    ajax(url);	
                }
            }
			
            function alteraFormaCobranca(numero, preco) {
                if (document.getElementById("des_situacao").value === "L") {
                    url="consulta_cartao.php?cod_cartao="+numero+"&cod_preco="+preco; 								
                    ajax(url);
                }             
            }
            
            function consultaCartao(numero) {    
                if (numero != "") {
                    url="consulta_cartao.php?cod_cartao="+numero; 								
                    ajax(url); 
                    document.getElementById('cod_cartao').value = numero;
                }
            }
			
            function consultaPlaca(placa) {
                if (placa != "") {
                    var val_total = document.getElementById('val_total').value;
                    if (val_total === "") {
                        url="consulta_placa.php?des_placa="+placa;
                        ajax(url);
                    }
                }
            }
			 
            jQuery(function($){   
                $("#des_placa").mask("aaa-9999");
                $("#val_cobrado").mask("99,99");
                
                $('#cod_marca').chosen({allow_single_deselect: true});
                $('#cod_modelo').chosen({allow_single_deselect: true});
                $('#des_cor').chosen({allow_single_deselect: true});
                $('#cod_desconto').chosen({allow_single_deselect: true});
                $('#cod_preco').chosen({allow_single_deselect: true});
                
                
            });
            
            $(
            function()
            {
                $("input.numeric").numeric();
                
                $("#des_placa").autocomplete({
                    source: "consulta_placa.php",
                    minLength: 1
                });
            }
        );
        
        function exibeMensalistasAtrasados() {
            if (document.getElementById('tabelaAtrasados').style.display == 'none')
                document.getElementById('tabelaAtrasados').style.display='';
            else
                document.getElementById('tabelaAtrasados').style.display='none';
        }
        
        function updateClock ( )
            {
            var currentTime = new Date ( );
            var currentHours = currentTime.getHours ( );
            var currentMinutes = currentTime.getMinutes ( );
            var currentSeconds = currentTime.getSeconds ( );

            // Pad the minutes and seconds with leading zeros, if required
            currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
            currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;

            // Choose either "AM" or "PM" as appropriate
            var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";

            // Convert the hours component to 12-hour format if needed
            //currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;

            // Convert an hours component of "0" to "12"
            //currentHours = ( currentHours == 0 ) ? 12 : currentHours;

            // Compose the string for display
            var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds;

            if ($("#hor_saida:input").val() == "")
                $("#hor_entrada:input").val(currentTimeString);

         }

        <?php if ($hora_entrada == "") { ?>   
            $(document).ready(function()
            {
               setInterval('updateClock()', 1000);
            });      
        <?php } ?>
        </script>
        <link href="../images/style.css" rel="stylesheet" type="text/css" />
    </head>
    <body onload="carrega();">
        <div class="content">
            <?php include_once("../cabecalho.php"); ?>                    

            <div style="clear:both;"></div>
            <div class="data">
                <p> M�dulo de rotatividade </p>
                <div id="clock"></div>
                <div class="success"> <?php echo $msgRetorno; ?> </div>		
                <div id="centro">
                    <div id="display_liberacao" style="display:none;">
                        <strong>Placa</strong> <input type="text" name="des_placa2" id="des_placa2" size="8" readonly style="text-transform: uppercase;height:40px;color:red;font-weight:bolder;font-size:32pt;">
                        <strong>Valor</strong> <input type="text" name="val_cobrado2" id="val_cobrado2" size="8" readonly style="text-transform: uppercase;height:40px;color:red;font-weight:bolder;font-size:32pt;">
                    </div>
                    <div id="esquerdo">
                        <form method="POST" name="form" id="form" action="index.php" onSubmit="return validaEntradaVeiculos()">					

                            <fieldset>
                                <legend> Dados do veiculo </legend>
                                <label for="cod_cartao">Cart�o:</label>
                                <input type="text" class="text numeric" onChange="consultaCartao(this.value);" onBlur="consultaCartao(this.value);" name="cod_cartao" id="cod_cartao" maxlength="20" size="20">
                                       <label for="des_placa">Placa:</label>
                                <input style="text-transform: uppercase;"  class="text"  value="" onChange="consultaPlaca(this.value);" onBlur="consultaPlaca(this.value)"; type="text" name="des_placa" id="des_placa" maxlength="8" size="10">
                                       <br>
                                <label for="cod_marca">Marca:</label>
                                <select name="cod_marca" onChange="exibeModeloSelect(this.value,document.form.cod_modelo.value);" onBlur="exibeModeloSelect(this.value,document.form.cod_modelo.value);" id="cod_marca">
                                    <option value="0">Procurar >></option>
                                    <?php
                                    $marca = get_marcas();
                                    $ind_popular = true;
                                    for ($i = 0; $i < count($marca); $i++) {
                                        if ($ind_popular == true && $marca[$i]['ind_popular'] == 0) {
                                            echo '<option value=""></option>';
                                            $ind_popular = false;
                                        }
                                        ?>
                                        <option value="<?php echo $marca[$i]['id_marca']; ?>">
                                            <?php echo $marca[$i]['ds_marca']; ?>
                                        </option>
                                        <?php
                                    }
                                    ?>	
                                </select>
                                <label for="cod_modelo">Modelo:</label>
                                <select name="cod_modelo" onChange="setaModelo(this.value);" onBlur="setaModelo(this.value);" id="cod_modelo">
                                    <option value="0">Procure >></option>
                                </select>
                                <br>
                                <label for="des_cor">Cor:</label>
                                <select name="des_cor" id="des_cor">
                                    <option value="0">Procure >></option>
                                    <option value="1">Amarela</option>
                                    <option value="2">Azul</option>
                                    <option value="3">Bege</option>
                                    <option value="4">Bordo</option>
                                    <option value="5">Branca</option>
                                    <option value="6">Champagne</option>
                                    <option value="7">Cinza</option>
                                    <option value="8">Dourada</option>
                                    <option value="9">Grafite</option>
                                    <option value="17">Laranja</option>
                                    <option value="10">Marrom</option>
                                    <option value="11">Ouro</option>
                                    <option value="12">Prata</option>
                                    <option value="13">Preta</option>
                                    <option value="18">Rosa</option>
                                    <option value="14">Roxa</option>
                                    <option value="15">Verde</option>
                                    <option value="16">Vermelha</option>
                                </select><br/>
                            </fieldset>	
                            <fieldset>
                                <legend>Estacionamento </legend>				
                                <label for="hor_entrada">Entrada</label>: <input type="text" class="text"  name="hor_entrada" id="hor_entrada" size="7" value="">
                                <label for="hor_saida">Sa�da</label>: <input type="text"  readonly  class="text"  name="hor_saida" id="hor_saida" size="7" value="<?php echo $hora_saida; ?>">
                                <label for="tem_permanencia">Tempo</label>: <input type="text" readonly class="text" name="tem_permanencia" id="tem_permanencia" size="5"><br>
                                <label for="cod_preco">Forma de cobran�a</label>: <select id="cod_preco" name="cod_preco" onChange="alteraFormaCobranca(document.form.cod_cartao.value,this.value);">
                                    <?php
                                    for ($i = 0; $i < count($arrPrecos); $i++) {
                                        echo sprintf('<option value="%s">%s</option>"', $arrPrecos[$i]['cod_preco'], $arrPrecos[$i]['des_preco']) . chr(10);
                                    }
                                    ?>
                                </select> <div id="data_entrada" style="display:none;"><label for="dat_entrada">Data de entrada</label>: <input type="text" size="8" class="text"  readonly id="dat_entrada" name="dat_entrada" value=""></div><br>					

                            </fieldset>	
                            <fieldset>
                                <legend> Cobran�a </legend>
                                <label for="val_total">Valor Total</label>: <input class="text" type="text" style="width:50px;" readonly name="val_total" id="val_total" value="<?php echo $val_total; ?>">
                                <label for="cod_desconto">Desconto</label>: 
                                <select onChange="consultaDesconto(this.value);" onBlur="consultaDesconto(this.value);" class="text" id="cod_desconto" name="cod_desconto">	
                                        <option value=""> Sem desconto </option>
                                            <?php
                                            for ($i = 0; $i < count($arrDescontos); $i++) {
                                                echo sprintf('<option value="%s">%s</option>', $arrDescontos[$i]['cod_desconto'], $arrDescontos[$i]['des_desconto']) . chr(10);
                                            }
                                            ?>
                                </select>
                                <br>
                                <label for="des_justificativa">Justificativa:</label> 
                                <input type="text" class="text" name="des_justificativa" id="des_justificativa"><br>
                                <label for="val_cobrado">Valor Cobrado</label>: <input class="text" type="text" style="" name="val_cobrado" id="val_cobrado" value="<?php echo $val_total; ?>">

                            </fieldset>
                            <input type="hidden" id="des_situacao" name="des_situacao" value="">
                            <input type="hidden" name="codigo_modelo" id="codigo_modelo" value="0">
                            <input type="hidden" name="cod_rotatividade" id="cod_rotatividade" value="<?php echo $cod_rotatividade; ?>">
                            <input type="hidden" name="dat_cadastro" id="dat_cadastro" value="<?php echo date('d/m/Y'); ?>">
                            <input type="hidden" name="hor_entrada" id="hor_entrada" value="<?php echo $hora_entrada; ?>">
							<strong>Imprimir cupom</strong> <input type="checkbox" name="imprimirCupomEntrada" id="imprimirCupomEntrada" value="1" checked="checked">
                            <input type="submit" name="_submit" value="Enviar">
                        </form>		
                    </div>
                    <p style="text-align:center;border:none;"> <strong> Carros estacionados <br>
                            Total: <?php echo count($arrRotatividade); ?> </strong> </p>

                    <div id="direito">
                        <table class="noclass" border="0">
                            <tr>
                                <td style="font-size:12pt;"><strong>Cart�o</strong></td>
                                <td style="font-size:12pt;"><strong>Placa</strong></td>
                                <td style="font-size:12pt;"><strong>Modelo</strong></td>
                            </tr>
                            <?php
                            for ($i = 0; $i < count($arrRotatividade); $i++) {
                                if ($arrRotatividade[$i]['des_modelo'] == "N�o informado") {
                                    $des_modelo = '<span style="color:red;">' . $arrRotatividade[$i]['des_modelo'] . '</span>';
                                } else {
                                    $des_modelo = $arrRotatividade[$i]['des_modelo'];
                                }
                                echo '<tr>' . chr(10);
                                echo sprintf('<td style="font-size:12pt;"><a href="#" style="color:#002AF6;" onClick="consultaCartao(%1$s)">%s</a></td>', $arrRotatividade[$i]['cod_cartao']) . chr(10);
                                echo sprintf('<td style="font-size:12pt;">%s</td>', $arrRotatividade[$i]['des_placa']) . chr(10);
                                echo sprintf('<td style="font-size:12pt;">%s</td>', $des_modelo) . chr(10);
                                echo '</tr>';
                            }
                            ?>			
                        </table>
                    </div>
                    <br/>
                    <p style="text-align:center;border:none;"> <strong> Mensalistas A Vencer/Vencidos <a href="#" onClick="exibeMensalistasAtrasados();">Exibir</a> <br></p>
                    <div id="tabelaAtrasados" style="display:none;">
                    <div id="direito">                            
                        Total: <?php echo count($arrMensalidadesAtrasadas); ?> </strong><br/>
                        <table class="noclass" border="0">
                            <tr>
                                <td style="font-size:12pt;"><strong>Vencto Dia</strong></td>
                                <td style="font-size:12pt;"><strong>Cliente</strong></td>
                            </tr>
                            <?php
                                if (is_array($arrMensalidadesAtrasadas)) {
                                    $aux = 0;
                                    foreach($arrMensalidadesAtrasadas as $key => $value) {
                                        echo "<tr>".chr(10);
                                        echo sprintf('<td style="font-size:12pt;"><a href="%s">%s</a></td>',$url."admin/clientes/mensalidade.php?cod_cliente=".$arrMensalidadesAtrasadas[$aux]['cod_cliente'],$arrMensalidadesAtrasadas[$aux]['dia_vencimento']).chr(10);
                                        echo sprintf('<td style="font-size:12pt;"><a href="%s">%s</a></td>',$url."admin/clientes/mensalidade.php?cod_cliente=".$arrMensalidadesAtrasadas[$aux]['cod_cliente'],$arrMensalidadesAtrasadas[$aux]['nom_cliente']).chr(10);
                                        echo "</tr>".chr(10);
                                        $aux++;
                                    }
                                } else {
                                    echo '<tr><td colspan="2" style="font-size:12pt;">N�o existem mensalistas atrasados.</td></tr>';
                                }
                            ?>			
                        </table>                        
                        
                    </div>
                    </div>
                </div>
                <div style="clear:both;"></div>
            </div>
            <?php
            include_once($path_relative . 'rodape.php');
            ?>        
        </div>
<?php
        if ($imprime_cupom) {
?>
            <script>
                jQuery(function($){   
                    window.open('<?php echo $url;?>rotatividade/imprimeCupomEntrada.php?cod_rotatividade='+<?php echo $cod_rotatividade; ?>, 'imprimeCupom', 'window settings');
                });
            </script>        
<?php
        }
?>
    </body>
</html>