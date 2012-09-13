<?php
include_once('../includes/config.php');
include_once($path_includes.'funcao.php');
include_once($path_classes.'fla_conexao.class.php');

$des_placa = "";
$valor = 0;

if (isset($_GET['placa']) && !empty($_GET['placa'])) {
    $des_placa = $_GET['placa'];
    $des_placa = strtoupper($des_placa);
}

if (isset($_GET['valor']) && !empty($_GET['valor'])) {
    $valor = $_GET['valor'];
}

geraLoteRPS($des_placa,$valor);


function geraLoteRPS($placa,$valor) {
    global $path_notablu;
    $ano_atual = date("Y");
    $mes_atual = date("m");
    $hoje = date("d");
    $caminho_arquivo = $path_notablu.$ano_atual.DS.$mes_atual.DS;
    $nome_arquivo = date("d").".txt";
    $serie_rps = "71"; // Confirmar contadora
    $serie_rps = str_pad($serie_rps,15," ",STR_PAD_RIGHT);
    $serie_rps = str_replace(" "," ",$serie_rps);
    $numero_rps = str_pad(1,15,"0",STR_PAD_LEFT);
    $data_rps = date("Ymd");
    $situacao_rps = "T";
    $codigo_servico_rps = "44448888"; // Confirmar contadora
    $aliquota_rps = "00000"; // Confirmar contadora
    $iss_retido_rps = "0"; // Confirmar contadora
    $indicador_cnpj_cpf_tomador_rps = "1";
    $cnpj_cpf_tomador_rps = "03366544996";
    $inscricao_municipal_tomador = "";
    $inscricao_estadual_tomador = "";
    $nome_tomador = "";
    $nome_tomador = str_pad($nome_tomador,115," ",STR_PAD_RIGHT);
    $nome_tomador = str_replace(" "," ",$nome_tomador);
    $tipo_endereco = "Rua";
    $tipo_endereco = str_pad($tipo_endereco,15," ",STR_PAD_RIGHT);
    $tipo_endereco = str_replace(" "," ",$tipo_endereco);
    $endereco_tomador = "Divinopolis";
    $endereco_tomador = str_pad($endereco_tomador,100," ",STR_PAD_RIGHT);
    $endereco_tomador = str_replace(" "," ",$endereco_tomador);
    $numero_endereco_tomador = "866";
    $numero_endereco_tomador = str_pad($numero_endereco_tomador,10," ",STR_PAD_RIGHT);
    $numero_endereco_tomador = str_replace(" "," ",$numero_endereco_tomador);
    $complemento_endereco_tomador = "Bloco 4 Ap 421";
    $complemento_endereco_tomador = str_pad($complemento_endereco_tomador,60," ",STR_PAD_RIGHT);
    $complemento_endereco_tomador = str_replace(" "," ",$complemento_endereco_tomador);
    $bairro_tomador = "Velha";
    $bairro_tomador = str_pad($bairro_tomador,72," ",STR_PAD_RIGHT);
    $bairro_tomador = str_replace(" "," ",$bairro_tomador);    
    $cidade_tomador = "Blumenau";
    $cidade_tomador = str_pad($cidade_tomador,50," ",STR_PAD_RIGHT);
    $cidade_tomador = str_replace(" "," ",$cidade_tomador);    
    $estado_tomador = "SC";
    $cep_tomador = 89040400;
    $email_tomador = "denisbr@gmail.com";
    $email_tomador = str_pad($email_tomador,80," ",STR_PAD_RIGHT);
    $email_tomador = str_replace(" "," ",$email_tomador);
    $discriminacao_servico = "Estacionamento rotativo de veiculo|Placa: ".$placa;
    
    $valor_rps = $valor;
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
    
    existeDiretorio("A",$path_notablu);
    existeDiretorio("M",$path_notablu.$ano_atual.DS);
    
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
    
    Header("Location:".$url."index.php");
}
?>
