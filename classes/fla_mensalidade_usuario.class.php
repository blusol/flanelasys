<?php
include_once($path_classes . 'fla_conexao.class.php');
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
    
    function ResetObject() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }
    
}

?>
