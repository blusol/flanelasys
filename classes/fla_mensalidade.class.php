<?php

include_once($path_classes . 'fla_conexao.class.php');

class fla_mensalidade {

    private $cod_mensalidade;
    private $des_mensalidade;
    private $val_mensalidade;
    private $ind_ativo;
    private $dat_criacao;
    private $dat_reajuste;

    public function get_cod_mensalidade() {
        return $this->cod_mensalidade;
    }

    public function set_cod_mensalidade($cod_mensalidade) {
        $this->cod_mensalidade = $cod_mensalidade;
    }

    public function get_des_mensalidade() {
        return $this->des_mensalidade;
    }

    public function set_des_mensalidade($des_mensalidade) {
        $this->des_mensalidade = $des_mensalidade;
    }

    public function get_val_mensalidade() {
        return $this->val_mensalidade;
    }

    public function set_val_mensalidade($val_mensalidade) {
        $this->val_mensalidade = $val_mensalidade;
    }

    public function get_ind_ativo() {
        return $this->ind_ativo;
    }

    public function set_ind_ativo($ind_ativo) {
        $this->ind_ativo = $ind_ativo;
    }

    public function get_dat_criacao() {
        return $this->dat_criacao;
    }

    public function set_dat_criacao($dat_criacao) {
        $this->dat_criacao = $dat_criacao;
    }

    public function get_dat_reajuste() {
        return $this->dat_reajuste;
    }

    public function set_dat_reajuste($dat_reajuste) {
        $this->dat_reajuste = $dat_reajuste;
    }

    public function cadastraMensalidade($objMensalidade) {
        $objConexao = new fla_conexao();

        $parametros_insert = get_object_vars($objMensalidade);
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
                $SQL = "INSERT INTO fla_mensalidade (" . $insert_field . ") VALUES (" . $insert_values . ")";
                $query = $objConexao->prepare($SQL) or die($objConexao->errorInfo());
                $query->Execute();
            } catch (PDOException $e) {
                print $e->getMessage();
            }
            return $objConexao->lastInsertId();
        } else {
            return false;
        }
    }

}

?>
