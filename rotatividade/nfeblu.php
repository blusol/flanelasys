<?php
include_once('../includes/config.php');
include_once($path_includes.'funcao.php');
include_once($path_classes.'fla_conexao.class.php');
include_once($path_classes.'fla_rotatividade.class.php');
include_once($path_classes.'fla_clientes.class.php');
include_once($path_classes.'fla_nfes.class.php');
include_once($path_classes.'fla_notablu.class.php');

$cod_rotatividade = "";
$valor = 0;
$arrClientes = array();

/*
if (isset($_GET['cod_rotatividade']) && !empty($_GET['cod_rotatividade'])) {
    $cod_rotatividade = $_GET['cod_rotatividade'];
    $cod_rotatividade = base64_decode(hexToStr($cod_rotatividade));
} else {
    Header("Location:".$url."index.php");
}

//geraLoteRPS($cod_rotatividade);
geraRPS($cod_rotatividade);
*/
function imprimeRPS($cod_rps) {
    $objNotablu = new fla_notablu();    
    $objNotablu->geraImpressao($cod_rps);
}

function geraRPS($cod_rotatividade) {
    $objNotablu = new fla_notablu();    
    $objNFE = new FLA_NFES();
    
    $objNFE->set_cod_rotatividade($cod_rotatividade);
    $cod_rps = $objNFE->insereNFE($objNFE);
   // imprimeRPS($cod_rps);
   // exit;
    Header("Location:".$url."rotatividade/index.php");
}

function geraLoteRPS($arrRPS) {
    $objRotatividade = new fla_rotatividade();
    $objClientes = new fla_clientes();
    $objNFE = new fla_nfes();
    global $path_notablu;
    
    $ano_atual = date("Y");
    $mes_atual = date("m");
    $hoje = date("d");
    $caminho_arquivo = $path_notablu.$ano_atual.DS.$mes_atual.DS;
    $nome_arquivo = date("d").".txt";
    
    existeDiretorio("A",$path_notablu);
    existeDiretorio("M",$path_notablu.$ano_atual.DS);
    
    foreach($arrRPS as $rps) {     
        $objNFE->set_cod_nfe($rps);
        $buscaRPS = $objNFE->buscaNFE($objNFE);
        
        $cod_rotatividade = $buscaRPS[0]['cod_rotatividade'];
        $objRotatividade->set_cod_rotatividade($cod_rotatividade);
        $objRotatividade->set_des_situacao("L");
        $arrRotatividade = $objRotatividade->buscaCarro($objRotatividade);

        $objClientes->set_des_placa($arrRotatividade[0]['des_placa']);
        $arrClientes = $objClientes->buscaClientes($objClientes);
        if (!is_array($arrClientes)) {
            echo "Voltou zero!";
        }


        $serie_rps = "71"; // Confirmar contadora
        $serie_rps = str_pad($serie_rps,5," ",STR_PAD_RIGHT);
        $serie_rps = str_replace(" "," ",$serie_rps);

        $numero_rps = str_pad(1,15,"0",STR_PAD_LEFT);

        $data_rps = date("Ymd");

        $situacao_rps = "T";

        $codigo_servico_rps = "44448888"; // Confirmar contadora

        $aliquota_rps = "00000"; // Confirmar contadora

        $iss_retido_rps = "0"; // Confirmar contadora

        $cnpj_cpf_tomador_rps = $arrClientes[0]["cpf_cnpj_cliente"];

        if (strlen($cnpj_cpf_tomador_rps) == 14) {
            $indicador_cnpj_cpf_tomador_rps = "2";
            $nome_tomador = $arrClientes[0]["nom_cliente"];       
        } elseif ($cnpj_cpf_tomador_rps == 11) {
            $indicador_cnpj_cpf_tomador_rps = "1";
            $nome_tomador = "";
        } else {
            $indicador_cnpj_cpf_tomador_rps = "3";
            $cnpj_cpf_tomador_rps = 0;
            $nome_tomador = "";
        }

        if (strlen($arrClientes[0]["cpf_cnpj_cliente"]) == "14") {
            $inscricao_municipal_tomador = $arrClientes[0]["insc_municipal_cliente"];
            $inscricao_estadual_tomador = $arrClientes[0]["insc_estadual_cliente"];
        } else {
            $inscricao_municipal_tomador = "";
            $inscricao_estadual_tomador = "";        
        }

        $nome_tomador = str_pad($nome_tomador,115," ",STR_PAD_RIGHT);
        $nome_tomador = str_replace(" "," ",$nome_tomador);     

        $cnpj_cpf_tomador_rps = str_pad($cnpj_cpf_tomador_rps,14,0, STR_PAD_LEFT);
        $inscricao_municipal_tomador = str_pad($inscricao_municipal_tomador,15,0, STR_PAD_LEFT);
        $inscricao_estadual_tomador = str_pad($inscricao_estadual_tomador,15,0, STR_PAD_LEFT);

        $tipo_endereco = $arrClientes[0]["tip_rua_cliente"];
        $tipo_endereco = substr($tipo_endereco,0,2);
        $tipo_endereco = str_pad($tipo_endereco,3," ",STR_PAD_RIGHT);
        $tipo_endereco = str_replace(" "," ",$tipo_endereco);

        $endereco_tomador = $arrClientes[0]["des_end_cliente"];
        $endereco_tomador = str_pad($endereco_tomador,100," ",STR_PAD_RIGHT);
        $endereco_tomador = str_replace(" "," ",$endereco_tomador);

        $numero_endereco_tomador = $arrClientes[0]["num_end_cliente"];
        $numero_endereco_tomador = str_pad($numero_endereco_tomador,10," ",STR_PAD_RIGHT);
        $numero_endereco_tomador = str_replace(" "," ",$numero_endereco_tomador);

        $complemento_endereco_tomador = $arrClientes[0]["com_end_cliente"];
        $complemento_endereco_tomador = str_pad($complemento_endereco_tomador,60," ",STR_PAD_RIGHT);
        $complemento_endereco_tomador = str_replace(" "," ",$complemento_endereco_tomador);

        $bairro_tomador = $arrClientes[0]["bairro_end_cliente"];
        $bairro_tomador = str_pad($bairro_tomador,72," ",STR_PAD_RIGHT);
        $bairro_tomador = str_replace(" "," ",$bairro_tomador);

        $cidade_tomador = $arrClientes[0]["cidade_cliente"];
        $cidade_tomador = str_pad($cidade_tomador,50," ",STR_PAD_RIGHT);
        $cidade_tomador = str_replace(" "," ",$cidade_tomador);

        $estado_tomador = $arrClientes[0]["estado_cliente"];

        $cep_tomador = $arrClientes[0]["cep_cliente"];

        $email_tomador = $arrClientes[0]["email_cliente"];
        $email_tomador = str_pad($email_tomador,80," ",STR_PAD_RIGHT);
        $email_tomador = str_replace(" "," ",$email_tomador);

        $discriminacao_servico = "Estacionamento rotativo de veiculo|Placa: ".strtoupper($arrRotatividade[0]['des_placa']);

        $valor_rps = $arrRotatividade[0]["val_cobrado"];
        $valor_rps = str_replace(array(",","."),array("",""),$valor_rps);
        $valor_rps = str_pad($valor_rps,15,"0",STR_PAD_LEFT);    

        $valor_deducao_rps = $valor; // Confirmar contadora
        $valor_deducao_rps = str_replace(array(",","."),array("",""),$valor_deducao_rps);
        $valor_deducao_rps = str_pad($valor_deducao_rps,15,"0",STR_PAD_LEFT);    

        $valor_confins = $valor; // Confirmar contadora
        $valor_confins = str_replace(array(",","."),array("",""),$valor_confins);
        $valor_confins = str_pad($valor_confins,15,"0",STR_PAD_LEFT);

        $valor_csll = $valor; // Confirmar contadora
        $valor_csll = str_replace(array(",","."),array("",""),$valor_csll);
        $valor_csll = str_pad($valor_csll,15,"0",STR_PAD_LEFT);

        $valor_inss = $valor; // Confirmar contadora
        $valor_inss = str_replace(array(",","."),array("",""),$valor_inss);
        $valor_inss = str_pad($valor_inss,15,"0",STR_PAD_LEFT);

        $valor_irpj = $valor; // Confirmar contadora
        $valor_irpj = str_replace(array(",","."),array("",""),$valor_irpj);
        $valor_irpj = str_pad($valor_irpj,15,"0",STR_PAD_LEFT);

        $valor_pis = $valor; // Confirmar contadora
        $valor_pis = str_replace(array(",","."),array("",""),$valor_pis);
        $valor_pis = str_pad($$valor_pis,15,"0",STR_PAD_LEFT);

        $conteudo_arquivo = sprintf("20%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s%s",
                                        $serie_rps,
                                        $numero_rps,
                                        $data_rps,
                                        $situacao_rps,
                                        $valor_rps,
                                        $valor_deducao_rps,
                                        $codigo_servico_rps,
                                        $aliquota_rps,
                                        $iss_retido_rps,
                                        $indicador_cnpj_cpf_tomador_rps,
                                        $cnpj_cpf_tomador_rps,
                                        $inscricao_municipal_tomador,
                                        $inscricao_estadual_tomador,
                                        $nome_tomador,
                                        $tipo_endereco,
                                        $endereco_tomador,
                                        $numero_endereco_tomador,
                                        $complemento_endereco_tomador,
                                        $bairro_tomador,
                                        $cidade_tomador,
                                        $estado_tomador,
                                        $cep_tomador,
                                        $email_tomador,
                                        $valor_confins,
                                        $valor_csll,
                                        $valor_inss,
                                        $valor_irpj,
                                        $valor_pis,
                                        $discriminacao_servico
                                ).chr(13).chr(10);
        $arquivo = fopen($caminho_arquivo.$nome_arquivo,"a");
        fwrite($arquivo,$conteudo_arquivo);
        fclose($arquivo);    
    }
}
?>
