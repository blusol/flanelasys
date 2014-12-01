<?php

include_once($path_classes . 'fla_conexao.class.php');

class fla_precos {

    private $cod_preco;
    private $des_preco;
    private $val_minimo;
    private $val_hora;
    private $val_fracao;
    private $val_diaria;
    private $tip_cobranca;
    private $tem_tolerancia;
    private $tem_diaria;
    private $tem_minimo;
	private $ind_disponivel;

    public function get_cod_preco() {
        return $this->cod_preco;
    }

    public function get_des_preco() {
        return $this->des_preco;
    }

    public function get_val_minimo() {
        return $this->val_minimo;
    }

    public function get_val_hora() {
        return $this->val_hora;
    }

    public function get_val_fracao() {
        return $this->val_fracao;
    }

    public function get_tip_cobranca() {
        return $this->tip_cobranca;
    }

    public function get_tem_tolerancia() {
        return $this->tem_tolerancia;
    }

    public function get_tem_diaria() {
        return $this->tem_diaria;
    }

    public function get_tem_minimo() {
        return $this->tem_minimo;
    }

    public function get_val_diaria() {
        return $this->val_diaria;
    }

    public function get_ind_disponivel() {
        return $this->ind_disponivel;
    }

    public function set_cod_preco($cod_preco) {
        $this->cod_preco = $cod_preco;
    }

    public function set_des_preco($des_preco) {
        $this->des_preco = $des_preco;
    }

    public function set_val_minimo($val_minimo) {
        $this->val_minimo = $val_minimo;
    }

    public function set_val_hora($val_hora) {
        $this->val_hora = $val_hora;
    }

    public function set_val_fracao($val_fracao) {
        $this->val_fracao = $val_fracao;
    }

    public function set_tip_cobranca($tip_cobranca) {
        $this->tip_cobranca = $tip_cobranca;
    }

    public function set_tem_tolerancia($tem_tolerancia) {
        $this->tem_tolerancia = $tem_tolerancia;
    }

    public function set_tem_diaria($tem_diaria) {
        $this->tem_diaria = $tem_diaria;
    }

    public function set_tem_minimo($tem_minimo) {
        $this->tem_minimo = $tem_minimo;
    }

    public function set_val_diaria($val_diaria) {
        $this->val_diaria = $val_diaria;
    }

    public function set_ind_disponivel($ind_disponivel) {
        $this->ind_disponivel = $ind_disponivel;
    }

    function buscaPrecos($objPreco) {
        $objConexao = new fla_conexao();
        $where = "";

        if ($objPreco->get_cod_preco() != "") {
            $where = " WHERE cod_preco = " . $objPreco->get_cod_preco();
        }
		if ($objPreco->get_ind_disponivel() != "") {
			$where = " WHERE ind_disponivel = " . $objPreco->get_ind_disponivel();
		}

        $SQL = "SELECT
                    cod_preco,
                    des_preco,
                    val_minimo,
					val_hora,
					val_fracao,
					val_diaria,
                    tip_cobranca,
					tem_tolerancia,
					tem_diaria,
					tem_minimo,
					ind_disponivel
                FROM
                    fla_precos "
                . $where . "		
                ORDER BY
                    cod_preco";

        $rsPreco = $objConexao->query($SQL);
        $arrPrecos = array();
        $aux = 0;
        while ($preco = $rsPreco->fetch(PDO::FETCH_ASSOC)) {
            $arrPrecos[$aux]['cod_preco'] = $preco['cod_preco'];
            $arrPrecos[$aux]['des_preco'] = $preco['des_preco'];
            $arrPrecos[$aux]['val_minimo'] = $preco['val_minimo'];
            $arrPrecos[$aux]['val_hora'] = $preco['val_hora'];
            $arrPrecos[$aux]['val_fracao'] = $preco['val_fracao'];
            $arrPrecos[$aux]['val_diaria'] = $preco['val_diaria'];
            $arrPrecos[$aux]['tip_cobranca'] = $preco['tip_cobranca'];
            $arrPrecos[$aux]['tem_tolerancia'] = $preco['tem_tolerancia'];
            $arrPrecos[$aux]['tem_diaria'] = $preco['tem_diaria'];
            $arrPrecos[$aux]['tem_minimo'] = $preco['tem_minimo'];
            $arrPrecos[$aux]['ind_disponivel'] = $preco['ind_disponivel'];
            $aux++;
        }
        return $arrPrecos;
    }

    function editaPrecos($objPreco) {
        $objConexao = new fla_conexao();


        $SQL = sprintf("UPDATE fla_precos
				SET
					des_preco = '%s',
					val_minimo = '%.2f',
					val_hora   = '%.2f',
					val_fracao = '%.2f',
					val_diaria = '%.2f',
					tip_cobranca = '%s',
					tem_tolerancia = '%d',
					tem_diaria = '%d',
					tem_minimo = '%d',
					ind_disponivel = '%s'
				WHERE
					cod_preco = %d"
                , $objPreco->get_des_preco()
                , $objPreco->get_val_minimo()
                , $objPreco->get_val_hora()
                , $objPreco->get_val_fracao()
                , $objPreco->get_val_diaria()
                , $objPreco->get_tip_cobranca()
                , $objPreco->get_tem_tolerancia()
                , $objPreco->get_tem_diaria()
                , $objPreco->get_tem_minimo()
                , $objPreco->get_ind_disponivel()
                , $objPreco->get_cod_preco());

        $query = $objConexao->prepare($SQL);
        $query->Execute();
    }

    function inserePrecos($objPreco) {
        $objConexao = new fla_conexao();
        $SQL = sprintf("INSERT INTO fla_precos 
		                    (des_preco,
							 val_minimo,
							 val_hora,
							 val_fracao,
							 val_diaria,
							 tip_cobranca,
							 tem_tolerancia,
							 tem_diaria,
							 tem_minimo,
							 ind_disponivel) 
							 VALUES 
							 ('%s','%d','%d','%d','%s','%s','%s')"
                , $objPreco->get_des_preco()
                , $objPreco->get_val_minimo()
                , $objPreco->get_val_hora()
                , $objPreco->get_val_fracao()
                , $objPreco->get_val_diaria()
                , $objPreco->get_tip_cobranca()
                , $objPreco->get_tem_tolerancia()
                , $objPreco->get_tem_diaria()
                , $objPreco->get_tem_minimo()
                , $objPreco->get_ind_disponivel()
        );
        $query = $objConexao->prepare($SQL);
        $query->Execute();
    }

    function buscaPrecoPagar($objPreco, $minutos) {
        $objConexao = new fla_conexao();

        $des_justificativa = "";
        $arrPreco = array();

        $SQL = "SELECT
					pre.cod_preco
					, pre.val_minimo
					, pre.val_hora
					, pre.val_fracao
					, pre.val_diaria
					, pre.tip_cobranca				
					, pre.cod_preco
					, pre.tem_tolerancia
					, pre.tem_diaria
					, pre.tem_minimo
				FROM
					fla_precos pre
				WHERE pre.cod_preco = " . $objPreco->get_cod_preco();

        $rsPreco = $objConexao->prepare($SQL);
        $rsPreco->execute();

        if ($rsPreco != false) {
            if ($rsPreco->rowCount() > 0) {
                while ($preco = $rsPreco->fetch(PDO::FETCH_ASSOC)) {
                    $cod_preco = $preco['cod_preco'];
                    $tem_tolerancia = $preco['tem_tolerancia'];
                    $tem_diaria = $preco['tem_diaria'] * 60;
                    $tem_minimo = $preco['tem_minimo'];
                    $val_hora = $preco['val_hora'];
                    $val_minimo = $preco['val_minimo'];
                    $val_fracao = $preco['val_fracao'];
                    $val_diaria = $preco['val_diaria'];
                    $tip_cobranca = $preco['tip_cobranca'];
                }

                if ($tip_cobranca == "H") {

                    $tempo_permanencia = m2h($minutos);
                    $tempo_tolerancia_primeira_hora = (60 + $tem_tolerancia);
                    // Se o cliente ficou menos que o tempo minimo, cobra o valor minimo
                    if ($minutos <= $tem_minimo) {
                        $val_total = str_pad($val_minimo, 4, "0");
                    } else {
                        // Verifica se será cobrado diária 
                        if ($minutos >= $tem_diaria) {
                            $val_total = $val_diaria;
                            $des_justificativa = "Cobrado diaria";
                        } else {
                            if (($minutos > $tem_minimo) && ($minutos <= $tempo_tolerancia_primeira_hora)) {
                                $val_total = str_pad($val_hora, 4, "0");
                            } else {
                                // Senão cobra o valor normal do rotativo
                                $minutos = number_format($minutos / 60, 2);
                                $arrTempoPermanencia = explode('.', $minutos);
                                $tempo_horas = $arrTempoPermanencia[0] - 1;
                                $val_horas = $val_hora + ($tempo_horas * $val_fracao);
                                // Verificando se o cliente ficou além do tempo de tolerância de cada hora, se sim, calcula o valor a mais
                                if (round($arrTempoPermanencia[1]) >= $tem_tolerancia) {
                                    $val_total = $val_horas + $val_fracao;
                                    $val_total = str_pad($val_total, 1, "0");
                                } else {
                                    $val_total = $val_horas;
                                    $val_total = str_pad($val_total, 1, "0");
                                }
                            }
                        }
                    }
                } else {
                    $hora_saida = date('H:i:s');
                    //$minutos = calculaMinutos($hor_entrada,$hora_saida);
                    $tempo_permanencia = m2h($minutos);
                    $val_total = sprintf("%01.2f", $val_minimo);
                }

                $val_total = number_format($val_total, 2, ',', ' ');

                $arrPreco['cod_preco'] = $cod_preco;
                $arrPreco['val_total'] = $val_total;
                $arrPreco['tempo_permanencia'] = $tempo_permanencia;
                $arrPreco['des_justificativa'] = $des_justificativa;
            }
        }

        return $arrPreco;
    }

}

?>
