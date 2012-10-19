<?php
include_once('../includes/config.php');
include_once($path_libraries.'tcpdf/config/lang/eng.php');
include_once($path_libraries.'tcpdf/tcpdf.php');
include_once($path_classes.'fla_rotatividade.class.php');
include_once($path_classes.'fla_clientes.class.php');
include_once($path_classes.'fla_nfes.class.php');

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
        
        $arrNFE = array();
        $arrRotatividade = array();
        $arrClientes = array();
        $objNFE->set_cod_nfe($cod_nfe);
        $arrNFE = $objNFE->buscaNFE($objNFE);

        $objRotatividade->set_cod_rotatividade($arrNFE[0]['cod_rotatividade']);
        $arrRotatividade = $objRotatividade->buscaCarro($objRotatividade);
        
        $objClientes->set_des_placa($arrRotatividade[0]['des_placa']);
        $arrClientes = $objClientes->buscaClientes($objClientes);
        
        $pdf = new TCPDF("P", "cm", 'G7', true, 'IBM850', false);        
        $pdf->SetMargins(0,0,0,false);
        $pdf->SetFont('times', 'BI', 14);
        $pdf->AddPage();        
        
        $nom_prestador  = "Hermann's Park";
        $end_prestador  = "Rua Eng. Rodolfo Ferraz, 293";
        $bairro_prestador = "Centro";
        $cep_prestador = "00000-000";
        $cid_prestador  = "Blumenau";
        $est_prestador  = "SC";
        $tel_prestador  = "(00) 0000-0000";
        $cnpj_prestador = "00.000.000/0000-00";
        $insc_municipal_prestador = "000.000.000";
        if ($insc_estadual_prestador != "")
            $insc_estadual_prestador = "000.000.000.000";
        else
            $insc_estadual_prestador = "ISENTO";
        
        $cabecalho = sprintf("%s\r\n%s\r\nBairro: %s - CEP: %s\r\n%s/%s\r\nTelefone: %s\r\n%s\r\n",
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
        $titulo = "RECIBO PROVISORIO DE SERVICOS - RPS";
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
        $texto_rodape = "Este RPS sera convertido em NFS-e em ate 10dias.\r\nPara confirmar acesse www.blumenau.sc.gov.br/nfse";
        $documento_tomador = $arrClientes[0]['cpf_cnpj_cliente'];
        if (strlen($documento_tomador) == 14)
            $documento_tomador = mascara_string ("##.###.###/####-##", $documento_tomador);
        else
            $documento_tomador = mascara_string ("###.###.###-##", $documento_tomador);
        
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
        //echo "<pre>$conteudo_impressao</pre>";
        //$pdf->Write($h=0, $conteudo_impressao, $link='', $fill=0, $align='C', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
        //$pdf->Output('example_002.pdf', 'I');
        //echo rawurlencode($conteudo_impressao);
        
// GUID no registro do windos
 $bema = new COM("{310DBDAC-85FF-4008-82A8-E22A09F9460B}"); 
// na porta paralela 1
 $init = $bema->IniciaPorta("COM4"); 
 if ($init <= 0) {
    echo "Problemas de Comunicacao com a impressora";
    exit;
 }
 $bema->FormataTX("Teste 01\n", 2, 0 , 0, 0, 0);

 $bema->FormataTX("Teste 02\n", 2, 1 , 0, 1, 0);

 $bema->FormataTX("Teste 03\n", 3, 0 , 0, 0, 0);

 $bema->AcionaGuilhotina(1);
 $bema->FechaPorta();        
        
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
