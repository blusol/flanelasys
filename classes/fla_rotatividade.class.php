<?php

//include_once('../includes/config.php');
include_once($path_classes . 'fla_conexao.class.php');
include_once($path_libraries . 'tcpdf/config/lang/eng.php');
include_once($path_libraries . 'tcpdf/tcpdf.php');
include_once($path_classes . 'fla_empresas.class.php');
include_once($path_classes . 'fla_modelos.class.php');
include_once($path_classes . 'fla_clientes.class.php');

class fla_rotatividade {

    private $cod_rotatividade;
    private $des_placa;
    private $hor_entrada;
    private $hor_saida;
    private $dat_cadastro;
    private $cod_preco;
    private $cod_desconto;
    private $val_total;
    private $val_cobrado;
    private $des_justificativa;
    private $tem_permanencia;
    private $des_situacao;
    private $cod_cartao;
    private $dat_saida;

    public function get_cod_rotativade() {
        return $this->cod_rotatividade;
    }

    public function set_cod_rotatividade($cod_rotatividade) {
        $this->cod_rotatividade = $cod_rotatividade;
    }

    public function get_des_placa() {
        return $this->des_placa;
    }

    public function set_des_placa($des_placa) {
        $this->des_placa = $des_placa;
    }

    public function get_hor_entrada() {
        return $this->hor_entrada;
    }

    public function set_hor_entrada($hor_entrada) {
        $this->hor_entrada = $hor_entrada;
    }

    public function get_hor_saida() {
        return $this->hor_saida;
    }

    public function set_hor_saida($hor_saida) {
        $this->hor_saida = $hor_saida;
    }

    public function get_dat_cadastro() {
        return $this->dat_cadastro;
    }

    public function set_dat_cadastro($dat_cadastro) {
        $this->dat_cadastro = $dat_cadastro;
    }

    public function get_dat_saida() {
        return $this->dat_saida;
    }

    public function set_dat_saida($dat_saida) {
        $this->dat_saida = $dat_saida;
    }

    public function get_cod_preco() {
        return $this->cod_preco;
    }

    public function set_cod_preco($cod_preco) {
        $this->cod_preco = $cod_preco;
    }

    public function get_cod_desconto() {
        return $this->cod_desconto;
    }

    public function set_cod_desconto($cod_desconto) {
        $this->cod_desconto = $cod_desconto;
    }

    public function get_val_total() {
        return $this->val_total;
    }

    public function set_val_total($val_total) {
        $this->val_total = $val_total;
    }

    public function get_val_cobrado() {
        return $this->val_cobrado;
    }

    public function set_val_cobrado($val_cobrado) {
        $this->val_cobrado = $val_cobrado;
    }

    public function get_des_justificativa() {
        return $this->des_justificativa;
    }

    public function set_des_justificativa($des_justificativa) {
        $this->des_justificativa = $des_justificativa;
    }

    public function get_des_situacao() {
        return $this->des_situacao;
    }

    public function set_des_situacao($des_situacao) {
        $this->des_situacao = $des_situacao;
    }

    public function get_cod_cartao() {
        return $this->cod_cartao;
    }

    public function set_cod_cartao($cod_cartao) {
        $this->cod_cartao = $cod_cartao;
    }

    public function set_tem_permanencia($tem_permanencia) {
        $this->tem_permanencia = $tem_permanencia;
    }

    public function get_tem_permanencia() {
        return $this->tem_permanencia;
    }

    public function insereRotatividade($objRotatividade) {
        $objConexao = new fla_conexao();
        // Verificando 
        $SQL = sprintf('INSERT INTO
								fla_rotatividade
							  (des_placa,hor_entrada,dat_cadastro,cod_preco,cod_cartao,des_situacao,dat_saida)
								VALUES
								("%s","%s","%s","%s",%s,"%s","0000/00/00")', $objRotatividade->get_des_placa(), $objRotatividade->get_hor_entrada(), $objRotatividade->get_dat_cadastro(), $objRotatividade->get_cod_preco(), $objRotatividade->get_cod_cartao(), $objRotatividade->get_des_situacao());
        $query = $objConexao->prepare($SQL) or die($objConexao->errorInfo());
        $query->Execute();
        return $objConexao->lastInsertId();
    }

    public function removeRotatividade($objRotatividade) {
        $objConexao = new fla_conexao();
        $SQL = sprintf('UPDATE 
								fla_rotatividade
							SET
								hor_saida = "%s"
								, dat_saida = "%s"
								, val_total = "%s"
								, val_cobrado = "%s"
								, des_justificativa = "%s"
								, tem_permanencia = "%s"
								, des_situacao = "L"
								, cod_desconto = %s
							WHERE
								cod_cartao = %s
								AND des_placa = "%s"
								AND cod_rotatividade = %s
						   ', $objRotatividade->get_hor_saida()
                , $objRotatividade->get_dat_saida()
                , $objRotatividade->get_val_total()
                , $objRotatividade->get_val_cobrado()
                , $objRotatividade->get_des_justificativa()
                , $objRotatividade->get_tem_permanencia()
                , $objRotatividade->get_cod_desconto()
                , $objRotatividade->get_cod_cartao()
                , $objRotatividade->get_des_placa()
                , base64_decode(hexToStr($objRotatividade->get_cod_rotativade())));
        $rsRemoveRotatividade = $objConexao->prepare($SQL);

        $rsRemoveRotatividade->execute();
    }

    // Metodo para verificar se um determinado carro já está estacionado
    public function buscaCarro($objRotatividade, $des_situacao = null) {
        $objConexao = new fla_conexao();
        $where = "";
        $separador = "";
        $colunas_select = "";
        $and = "";
        $arrCarros = array();

        $parametros_where = get_object_vars($objRotatividade);
        $parametros_where = array_filter($parametros_where, 'strlen');
        $tamanho_parametros = count($parametros_where);

        $arrAtributos = get_class_vars(get_class($objRotatividade));
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
                        $where .= $atributo . " = '" . $valor . "'" . $and;
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
        $SQL = sprintf("select %s from fla_rotatividade rot %s", $colunas_select, $where);
        $rsCarrosEstacionados = $objConexao->prepare($SQL);
        $rsCarrosEstacionados->execute();
        $count = $rsCarrosEstacionados->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($carrosEstacionados = $rsCarrosEstacionados->fetch(PDO::FETCH_ASSOC)) {
                foreach ($carrosEstacionados as $key => $value) {
                    $arrCarros[$aux][$key] = $value;
                }
                $aux++;
            }
            return $arrCarros;
        } else {
            return false;
        }
    }

    public function buscaCarrosEstacionados() {
        $objConexao = new fla_conexao();
        $SQL = "select
						rot.cod_cartao,
						cli.des_placa,
						modelo.des_modelo,
                        rot.cod_preco
					from
						fla_clientes cli 
						LEFT JOIN fla_modelos modelo ON (cli.cod_modelo = modelo.cod_modelo OR cli.cod_modelo IS NULL)
						LEFT JOIN fla_rotatividade rot ON (rot.des_placa = cli.des_placa)
					where
						rot.des_situacao = 'P'
					order by
						rot.hor_entrada DESC";
        $rsCarrosEstacionados = $objConexao->prepare($SQL);
        $rsCarrosEstacionados->execute();
        $arrCarrosEstacionados = array();
        $aux = 0;
        while ($carrosEstacionados = $rsCarrosEstacionados->fetch(PDO::FETCH_ASSOC)) {
            $arrCarrosEstacionados[$aux]['cod_cartao'] = $carrosEstacionados['cod_cartao'];
            $arrCarrosEstacionados[$aux]['des_placa'] = $carrosEstacionados['des_placa'];
            $arrCarrosEstacionados[$aux]['des_modelo'] = $carrosEstacionados['des_modelo'];
            $arrCarrosEstacionados[$aux]['cod_preco'] = $carrosEstacionados['cod_preco'];
            $aux++;
        }
        return $arrCarrosEstacionados;
    }

    public function imprimeCupomEntrada() {
        $objEmpresa = new fla_empresas();
        global $path_relative;
        $arrEmpresa = array();
        $arrRotatividade = array();
        $objModelo = new fla_modelos();
        $objCliente = new fla_clientes();

        $arrEmpresa = $objEmpresa->buscaEmpresas($objEmpresa);

        $pdf = new TCPDF("P", PDF_UNIT, 'ETIQUETA', true, 'IBM850', false);
        //$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);        
        $pdf->SetMargins(0, 0, 0, true);
        //$pdf->SetMargins(PDF_MARGIN_LEFT,PDF_MARGIN_TOP,PDF_MARGIN_RIGHT);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);
        $pdf->AddPage();

        // $nom_prestador  = limitar($arrEmpresa[0]['nom_fantasia'],25);
        $nom_prestador = $arrEmpresa[0]['nom_fantasia'];
        $end_prestador = $arrEmpresa[0]['des_endereco'];
        $tel_prestador = $arrEmpresa[0]['num_telefone'];
        $tel_prestador = mascara_string("(##) ####-####", $tel_prestador);

        $horario_atendimento = "Horario de atendimento:\r\n07:00hrs as 19:00hrs";
        $multa = "A perda deste cupom implicara \r\nem multa de R$ 10,00";

        $arrRotatividade = $this->buscaCarro($this);
        $cod_cartao = $arrRotatividade[0]['cod_cartao'];
        $hora_entrada = $arrRotatividade[0]['hor_entrada'];
        $dat_entrada = mostraData($arrRotatividade[0]['dat_cadastro']);
        $des_placa = strtoupper($arrRotatividade[0]['des_placa']);

        $objCliente->set_des_placa($des_placa);
        $arrCliente = $objCliente->buscaClientes($objCliente);
        if (!empty($arrCliente[0]['cod_modelo'])) {
            $objModelo->set_cod_modelo($arrCliente[0]['cod_modelo']);
            $arrModelo = $objModelo->buscaModelos($objModelo);
            $des_modelo = $arrModelo[0]['des_modelo'];
        } else {
            $des_modelo = 'Nao cadastrado';
        }

        $des_modelo = remove_acentuacao($des_modelo);
        $pdf->SetFont('times', 'B', 8);
        $pdf->Write($h = 0, $nom_prestador, $link = '', $fill = 0, $align = 'L', $ln = true, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0);

        $pdf->SetFont('times', 'B', 10);
        $conteudo_cabecalho = sprintf("%s \r\nTelefone: %s\r\n\r\n", $end_prestador, $tel_prestador);
        
        $conteudo_cabecalho = iconv('UTF-8', 'IBM850', $conteudo_cabecalho);
        $pdf->Write($h = 0, $conteudo_cabecalho, $link = '', $fill = 0, $align = 'L', $ln = true, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0);

        $style = array(
            'position' => 'L',
            'border' => false,
            'padding' => 5,
            'fgcolor' => array(0, 0, 0),
            'bgcolor' => false,
            'text' => false,
            'font' => 'helvetica',
            'fontsize' => 3,
            'stretchtext' => 2
        );

        $pdf->write1DBarcode($cod_cartao, 'C128', '', '', 60, 18, 0.4, $style, 'N');
        //$pdf->write1DBarcode($cod_cartao, 'C128A','','',60,18,0.4,$style,'N');
        //$pdf->write1DBarcode($cod_cartao, 'C128B','','',60,18,0.4,$style,'N');
        //$pdf->write1DBarcode($cod_cartao, 'C128C','','',60,18,0.4,$style,'N');
        //$pdf->write1DBarcode($cod_cartao, 'C128B', '', '', 5, 5, 0.4, $style, 'N');

        $cod_cartao = iconv('UTF-8', 'IBM850', $cod_cartao);
        $pdf->Write($h = 0, 'Cartao: ' . $cod_cartao, $link = '', $fill = 0, $align = 'L', $ln = true, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0);

        $pdf->SetFont('times', 'B', 12);
        $pdf->Write($h = 0, "Dia: $dat_entrada \r\nHorario: $hora_entrada", $link = '', $fill = 0, $align = 'L', $ln = true, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0);
        $conteudo_rodape = sprintf("\r\nVeiculo: %s\r\nPlaca: %s\r\n%s\r\n", $des_modelo, $des_placa, $horario_atendimento);        
        
		$pdf->SetFont('times', 'B', 12);
        $conteudo_rodape = iconv('UTF-8', 'IBM850', $conteudo_rodape);
        $pdf->Write($h = 0, $conteudo_rodape, $link = '', $fill = 0, $align = 'L', $ln = true, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0);

		$pdf->SetFont('times', 'B', 10);
        $multa = iconv('UTF-8', 'IBM850', $multa);
        $pdf->Write($h = 0, $multa, $link = '', $fill = 0, $align = 'L', $ln = true, $stretch = 0, $firstline = false, $firstblock = false, $maxh = 0);		
		
        //$arquivo_cartao = $pdf->Output('CupomEntrada-'.$cod_cartao,"S");
        //var_dump(file_put_contents($path_relative.'cupons/CupomEntrada-'.$cod_cartao, $arquivo_cartao));
        //$arquivo = $path_relative.'cuponsEntrada/CupomEntrada-' . $cod_cartao.'.pdf';
        //$pdf->Output($path_relative.'cuponsEntrada/CupomEntrada-' . $cod_cartao.'.pdf',);
		$pdf->Output('CupomEntrada-' . $cod_cartao.'.pdf','I');
        
        //$comando = "C:\FoxitSoftware\FoxitReader.exe -z 200 /t ".$arquivo." \"MP-2500 TH\"";
        //exec($comando);
    }

    public function geraProximaNumeroCartao() {
        $objConexao = new fla_conexao();
        $sql = "select max(cod_cartao) ultimo_cartao from fla_rotatividade where dat_cadastro = '" . date("Y-m-d") . "'";
        $rsUltimoCartao = $objConexao->query($sql)->fetchObject() or die("ERROR: " . implode(":", $objConexao->errorInfo()) . "<p>$sql</p>");
        if ($rsUltimoCartao->ultimo_cartao) {
            $cod_cartao = $rsUltimoCartao->ultimo_cartao + 1;
        } else {
            $cod_cartao = date("Ymd") . (int) 1;
        }
        return $cod_cartao;
    }

}

?>