<?php
include_once($path_classes . 'fla_conexao.class.php');
include_once($path_classes . 'fla_clientes.class.php');
include_once($path_classes.'fla_empresas.class.php');
include_once($path_classes.'fla_modelos.class.php');
include_once($path_libraries.'tcpdf/config/lang/eng.php');
include_once($path_libraries.'tcpdf/tcpdf.php');
class fla_mensalidade_usuario {
    private $cod_mensalidade_usuario;
    private $valor_pago;
    private $periodo_inicial;
    private $periodo_final;
    private $data_pagamento;
    private $des_justificativa;
    private $cod_cliente;
    private $cod_mensalidade;
    
    public function get_cod_mensalidade_usuario() {
        return $this->cod_mensalidade_usuario;
    }

    public function set_cod_mensalidade_usuario($cod_mensalidade_usuario) {
        $this->cod_mensalidade_usuario = $cod_mensalidade_usuario;
    }

    public function get_valor_pago() {
        return $this->valor_pago;
    }

    public function set_valor_pago($valor_pago) {
        $this->valor_pago = $valor_pago;
    }

    public function get_periodo_inicial() {
        return $this->periodo_inicial;
    }

    public function set_periodo_inicial($periodo_inicial) {
        $this->periodo_inicial = $periodo_inicial;
    }

    public function get_periodo_final() {
        return $this->periodo_final;
    }

    public function set_periodo_final($periodo_final) {
        $this->periodo_final = $periodo_final;
    }

    public function get_data_pagamento() {
        return $this->data_pagamento;
    }

    public function set_data_pagamento($data_pagamento) {
        $this->data_pagamento = $data_pagamento;
    }

    public function get_des_justificativa() {
        return $this->des_justificativa;
    }

    public function set_des_justificativa($des_justificativa) {
        $this->des_justificativa = $des_justificativa;
    }

    public function get_cod_cliente() {
        return $this->cod_cliente;
    }

    public function set_cod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }

    public function get_cod_mensalidade() {
        return $this->cod_mensalidade;
    }

    public function set_cod_mensalidade($cod_mensalidade) {
        $this->cod_mensalidade = $cod_mensalidade;
    }

    public function cadastraPagamento() {
        $objConexao = new fla_conexao();

        $parametros_insert = get_object_vars($this);
        $parametros_insert = array_filter($parametros_insert, 'strlen');
        $tamanho_parametros = count($parametros_insert);
        $aux = 1;
        if (is_array($parametros_insert)) {
            foreach ($parametros_insert as $atributo => $valor) {
                if ((!is_null($valor))) {
                    if ($aux != $tamanho_parametros) {
                        $and = " , ";
                    } else {
                        $and = "";
                    }

                    if (is_numeric($valor)) {
                        $insert_values .= sprintf("%s %s ", $valor, $and);
                    } else {
                        $insert_values .= sprintf("'%s' %s ", $valor, $and);
                    }
                    $insert_field .= $atributo . $and;
                    $aux++;
                }
            }
            try {
                $SQL = "INSERT INTO fla_mensalidade_usuario (" . $insert_field . ") VALUES (" . $insert_values . ")";
                $query = $objConexao->prepare($SQL) or die($objConexao->errorInfo());
                $query->Execute();
            } catch (PDOException $e) {
                print $e->getMessage();
            }
            return $objConexao->lastInsertId();
        }
    }
    
	public function excluirPagamento() {
		$objConexao = new fla_conexao();		
		try {
			$SQL = "DELETE FROM fla_mensalidade_usuario WHERE cod_mensalidade_usuario = ".$this->get_cod_mensalidade_usuario();
			$query = $objConexao->prepare($SQL) or die($objConexao->errorInfo());
			$query->Execute();
			return '<span style="color:green;">Pagamento excluído com sucesso</span>';
		} catch (PDOException $e) {
			return '<span style="color:red;">Erro ao excluir pagamento: '.$e->getMessage().'</span>';
		}
	}
	
    public function buscaPagamentos() {
        $objConexao = new fla_conexao();
        $where = "";
        $separador = "";
        $colunas_select = "";
        $and = "";
        $arrMensalidaeUsuario = array();

        $parametros_where = get_object_vars($this);
        $parametros_where = array_filter($parametros_where, 'strlen');
        $tamanho_parametros = count($parametros_where);

        $arrAtributos = get_class_vars(get_class($this));
        $countArrAtributos = count($arrAtributos);
        $aux = 1;
        if (is_array($parametros_where)) {
            foreach ($parametros_where as $atributo => $valor) {
                if (!is_null($valor)) {
                    if ($aux != $tamanho_parametros) {
                        $and = " AND ";
                    } else {
                        $and = "";
                    }
                    if (is_numeric($valor)) {
                        $where .= $atributo . " = " . $valor . $and;
                    } else {
                        $where .= $atributo . " LIKE '%" . $valor . "%'" . $and;
                    }
                }
                $aux++;
            }
        }
        $aux = 1;
        if (is_array($arrAtributos)) {
            foreach ($arrAtributos as $key => $value) {
                if ($aux != $countArrAtributos)
                    $separador = ",";
                else
                    $separador = "";

                $colunas_select .= $key . $separador . chr(10);
                $aux++;
            }
        }

        if (!empty($where)) {
            $where = " where " . $where;
        }

        $SQL = sprintf("select %s from fla_mensalidade_usuario rot %s", $colunas_select, $where);
        //echo $SQL;
        $rsClientes = $objConexao->prepare($SQL);
        $rsClientes->execute();
        $count = $rsClientes->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($clientes = $rsClientes->fetch(PDO::FETCH_ASSOC)) {
                foreach ($clientes as $key => $value) {
                    if (!empty($value))
                        $arrMensalidaeUsuario[$aux][$key] = $value;
                    else
                        $arrMensalidaeUsuario[$aux][$key] = '';
                }
                $aux++;
            }
            return $arrMensalidaeUsuario;
        } else {
            return false;
        }        
    }
	
	public function geraComprovante() {
		$objCliente = new fla_clientes();
		$objEmpresa = new fla_empresas();
		$objModelo = new fla_modelos();
		
		$arrMensalidadeUsuario = $this->buscaPagamentos();
		$arrEmpresa = $objEmpresa->buscaEmpresas($objEmpresa);
		
		$objCliente->set_cod_cliente($arrMensalidadeUsuario[0]['cod_cliente']);
		$arrCliente = $objCliente->buscaClientes($objCliente);
		
		$objModelo->set_cod_modelo($arrCliente[0]['cod_modelo']);		
        $arrModelo = $objModelo->buscaModelos($objModelo);
		$des_modelo = $arrModelo[0]['des_modelo'];		
		$des_modelo = remove_acentuacao($des_modelo);
        $pdf = new TCPDF("P", "in", 'ETIQUETA', true, 'IBM850', false);        
        $pdf->SetMargins(0,0,0,true);
        $pdf->SetFont('times', '', 8);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();        

        $nom_prestador  = remove_acentuacao($arrEmpresa[0]['nom_fantasia']);
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
        
        $cabecalho = sprintf("\r\n%s\r\n%s\r\nBairro: %s - CEP: %s\r\n%s/%s\r\nTelefone: %s\r\n%s\r\n\r\n",
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
					
		$pdf->SetFont('times', '', 10);		
        $pdf->Write($h=0, $cabecalho, $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);					
		
        $titulo = "Ref: Pgto Mensalidade";		
		$pdf->SetFont('times', 'B', 12);		
        $pdf->Write($h=0, $titulo, $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);					
		
		$descricao = "Recebemos de: ".limitar($arrCliente[0]['nom_cliente'],30)."\r\n";
		//$descricao .= $arrCliente[0]['nom_cliente']."\r\n";
		$descricao .= "CPF/CNPJ: ". $arrCliente[0]['cpf_cnpj_cliente']."\r\n";
		$descricao .= "A importancia de R$ ".$arrMensalidadeUsuario[0]['valor_pago']."\r\n";
		$descricao .= "Referente ao pagamento de\r\nmensalidade do veiculo: \r\n";
		$descricao .= "Modelo: ".$des_modelo." Placa: \r\n".strtoupper($arrCliente[0]['des_placa'])."\r\n";
		$descricao .= "Data Pgto: ".mostraData($arrMensalidadeUsuario[0]['data_pagamento']);
		//$descricao .= "Para uso do estacionamento no periodo entre: \r\n";
		//$descricao .= mostraData($arrMensalidadeUsuario[0]['periodo_inicial'])." a ".mostraData($arrMensalidadeUsuario[0]['periodo_final']);
		
		//$conteudo = sprintf("%s\r\n%s",$sub_titulo, $descricao);	
        //$conteudo_impressao = iconv('UTF-8','IBM850',$descricao);
		//var_dump($conteudo_impressao);exit;
		$pdf->SetFont('times', 'B', 10);				
        $pdf->Write($h=0, $descricao, $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);
		
		$rodape =  "\r\n---------------------------\r\nAgradecemos a preferencia";
		
		$pdf->SetFont('times', 'B', 10);		
        $pdf->Write($h=0,$rodape, $link='', $fill=0, $align='L', $ln=true, $stretch=0, $firstline=false, $firstblock=false, $maxh=0);							
		
        $pdf->Output('Comprovante-'.str_replace(" ","_",$arrCliente[0]['nom_cliente']),"I");					
	}
    
    function ResetObject() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
    
}

?>
