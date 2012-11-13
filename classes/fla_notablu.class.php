<?php
include_once('../includes/config.php');
include_once($path_libraries.'tcpdf/config/lang/eng.php');
include_once($path_libraries.'tcpdf/tcpdf.php');
include_once($path_classes.'fla_rotatividade.class.php');
include_once($path_classes.'fla_clientes.class.php');
include_once($path_classes.'fla_nfes.class.php');
include_once($path_classes.'fla_empresas.class.php');

class fla_notablu {
    public function geraCabecalho() {
        $arrCabecalho = array();
    }
    
    public function geraDetalhe() {
        
    }
    
    public function geraRodape() {
        
    }
    
    public function geraImpressao($cod_nfe) {
        $objNFE = new FLA_NFES();
        $objRotatividade = new FLA_ROTATIVIDADE();
        $objClientes = new FLA_CLIENTES();
        $objEmpresa = new fla_empresas();
        
        $arrNFE = array();
        $arrRotatividade = array();
        $arrClientes = array();
        $arrEmpresa = array();
        $objNFE->set_cod_nfe($cod_nfe);
        $arrNFE = $objNFE->buscaNFE($objNFE);

        $objRotatividade->set_cod_rotatividade($arrNFE[0]['cod_rotatividade']);
        $arrRotatividade = $objRotatividade->buscaCarro($objRotatividade);
        
        $objClientes->set_des_placa($arrRotatividade[0]['des_placa']);
        $arrClientes = $objClientes->buscaClientes($objClientes);
        
        $arrEmpresa = $objEmpresa->buscaEmpresas($objEmpresa);
        
        $pdf = new TCPDF("P", "in", 'ETIQUETA', true, 'IBM850', false);        
        $pdf->SetMargins(0,0,0,true);
        $pdf->SetFont('times', 'B', 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();        
        
        $nom_prestador  = $arrEmpresa[0]['nom_fantasia'];
        $end_prestador  = $arrEmpresa[0]['des_endereco'];
        $bairro_prestador = $arrEmpresa[0]['des_bairro'];
        
        $cep_prestador = $arrEmpresa[0]['cep_empresa'];
        $cep_prestador  = mascara_string("#####-###",$cep_prestador);
        
        $cid_prestador  = $arrEmpresa[0]['des_cidade'];
        $est_prestador  = $arrEmpresa[0]['des_estado'];
        
        $tel_prestador  = $arrEmpresa[0]['num_telefone'];
        $tel_prestador  = mascara_string("(##) ####-####",$tel_prestador);
        
        $cnpj_prestador = $arrEmpresa[0]['num_cnpj'];
        $cnpj_prestador = mascara_string("##.###.###/####-##",$cnpj_prestador);
        
        $insc_municipal_prestador = $arrEmpresa[0]['num_insc_municipal'];
        if ($insc_estadual_prestador != "")
            $insc_estadual_prestador = "000.000.000.000";
        else
            $insc_estadual_prestador = "ISENTO";
        
        $cabecalho = sprintf("\r\n%s\r\n%s\r\nBairro: %s - CEP: %s\r\n%s/%s\r\nTelefone: %s\r\n%s\r\n",
                            $nom_prestador
                            , $end_prestador
                            , $bairro_prestador
                            , $cep_prestador                
                            , $cid_prestador
                            , $est_prestador
                            , $tel_prestador
                            , "CNPJ: ".$cnpj_prestador
                            , "Insc. Municipal: ".$insc_municipal_prestador
                            , "Insc. Estadual:".$insc_estadual_prestador
                    );
        $titulo = "RECIBO PROVISORIO DE SERVICOS(RPS)";
        $sub_titulo = "ESTADIA EM ESTACIONAMENTO\r\n";
        $dat_recibo = mostraData($arrRotatividade[0]['dat_cadastro']);
        $numero_rps = $arrNFE[0]['cod_nfe'];
        $serie_rps = 1;
        $num_cartao = $arrRotatividade[0]['cod_cartao'];
        $horario_entrada = $arrRotatividade[0]['hor_entrada'];
        $horario_saida = $arrRotatividade[0]['hor_saida'];
        $periodo_estadia = $arrRotatividade[0]['tem_permanencia'];
        $val_total = number_format($val_total, 2, ',', ' ');
        $valor = $arrRotatividade[0]['val_cobrado'];
        $des_placa = strtoupper($arrRotatividade[0]['des_placa']);
        
        $conteudo = sprintf("%s\r\n%s\r\n%s\r\n%s\r\n%s\r\n%s\r\n%s\r\n%s\r\n%s\r\n%s\r\n%s",
                                $titulo
                                , $sub_titulo
                                , "Data: ".$dat_recibo
                                , "No do RPS: ".$numero_rps
                                , "Serie: ".$serie_rps
                                , "Cartao: ".$num_cartao
                                , "Placa: ".$des_placa
                                , "Horario de entrada: ".$horario_entrada
                                , "Horario de saida: ".$horario_saida
                                , "Periodo: ".$periodo_estadia
                                , "Total do servico: R$ ".$valor
                    );
        $texto_rodape = "Este RPS sera convertido em NFS-e em ate\r\n10 dias.\r\nPara confirmar acesse\r\nwww.blumenau.sc.gov.br/nfse";
        $documento_tomador = $arrClientes[0]['cpf_cnpj_cliente'];
        if ($documento_tomador > 0) {
            if (strlen($documento_tomador) == 14)
                $documento_tomador = mascara_string ("##.###.###/####-##", $documento_tomador);
            else
                $documento_tomador = mascara_string ("###.###.###-##", $documento_tomador);
        } else {
            $documento_tomador = "Nao informado";
        }
        
        $documento_tomador = "CPF/CNPJ: " . $documento_tomador;
        $texto_rodape_ = "VOLTE SEMPRE";
        $texto_rodape_ = str_pad($texto_rodape_,22,"*",STR_PAD_BOTH);
        $rodape = sprintf("\r\n%s\r\n%s\r\n%s\r\n",
                          $texto_rodape
                          , $documento_tomador
                          , $texto_rodape_
                        );
        $conteudo_impressao = $cabecalho."\r\n".$conteudo.$rodape;
        $conteudo_impressao = iconv('UTF-8','IBM850',$conteudo_impressao);
        $pdf->Write($h=0, $conteudo_impressao, $link='', $fill=0, $align='J', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
        $pdf->Output('RPS-'.$numero_rps, 'D');
        Header("Location:" . $url . "rotatividade/index.php");
    }
    
    function enviaDados($dados) {
            $fp = fopen("bemafilx.cmd","w"); // abre o arquivo de comandos
            fwrite($fp,$dado);
            fclose($fp);
            $executa = "./bemafilx.out";
            $comando = `$executa`;
    }
}

?>
