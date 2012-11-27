<?php

//include_once('../../includes/config.php');
include_once($path_classes . 'fla_conexao.class.php');

class fla_clientes {

    private $cod_cliente;
    private $nom_cliente;
    private $des_cor;
    private $cod_modelo;
    private $cod_marca;
    private $des_placa;
    private $cpf_cnpj_cliente;
    private $insc_municipal_cliente;
    private $insc_estadual_cliente;
    private $email_cliente;
    private $cep_cliente;
    private $tip_rua_cliente;
    private $des_end_cliente;
    private $num_end_cliente;
    private $com_end_cliente;
    private $bairro_end_cliente;
    private $estado_cliente;
    private $cidade_cliente;
    private $tipo_cliente;
    private $num_telefone;
    private $num_celular;
    private $ind_ativo;
    private $des_observacao;
    private $tip_mensalidade;
    private $dat_contratacao;
    private $dia_vencimento;

    public function get_cod_cliente() {
        return $this->cod_cliente;
    }

    public function set_cod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }

    public function get_nom_cliente() {
        return $this->nom_cliente;
    }

    public function set_nom_cliente($nom_cliente) {
        if ($nom_cliente == "") {
            $this->nom_cliente = "Não Informado";
        } else {
            $this->nom_cliente = $nom_cliente;
        }
    }

    public function get_des_cor() {
        return $this->des_cor;
    }

    public function set_des_cor($des_cor) {
        $this->des_cor = $des_cor;
    }

    public function get_des_placa() {
        return $this->des_placa;
    }

    public function set_des_placa($des_placa) {
        $this->des_placa = $des_placa;
    }

    public function get_cod_modelo() {
        return $this->cod_modelo;
    }

    public function set_cod_modelo($cod_modelo) {
        $this->cod_modelo = $cod_modelo;
    }

    public function get_cod_marca() {
        return $this->cod_marca;
    }

    public function set_cod_marca($cod_marca) {
        $this->cod_marca = $cod_marca;
    }

    public function get_cpf_cnpj_cliente() {
        return $this->cpf_cnpj_cliente;
    }

    public function set_cpf_cnpj_cliente($cpf_cnpj_cliente) {
        $this->cpf_cnpj_cliente = $cpf_cnpj_cliente;
    }

    public function get_insc_municipal_cliente() {
        return $this->insc_municipal_cliente;
    }

    public function set_insc_municipal_cliente($insc_municipal_cliente) {
        $this->insc_municipal_cliente = $insc_municipal_cliente;
    }

    public function get_insc_estadual_cliente() {
        return $this->insc_estadual_cliente;
    }

    public function set_insc_estadual_cliente($insc_estadual_cliente) {
        $this->insc_estadual_cliente = $insc_estadual_cliente;
    }

    public function get_email_cliente() {
        return $this->email_cliente;
    }

    public function set_email_cliente($email_cliente) {
        $this->email_cliente = $email_cliente;
    }

    public function get_cep_cliente() {
        return $this->cep_cliente;
    }

    public function set_cep_cliente($cep_cliente) {
        $this->cep_cliente = $cep_cliente;
    }

    public function get_tip_rua_cliente() {
        return $this->tip_rua_cliente;
    }

    public function set_tip_rua_cliente($tip_rua_cliente) {
        $this->tip_rua_cliente = $tip_rua_cliente;
    }

    public function get_des_end_cliente() {
        return $this->des_end_cliente;
    }

    public function set_des_end_cliente($des_end_cliente) {
        $this->des_end_cliente = $des_end_cliente;
    }

    public function get_num_end_cliente() {
        return $this->num_end_cliente;
    }

    public function set_num_end_cliente($num_end_cliente) {
        $this->num_end_cliente = $num_end_cliente;
    }

    public function get_com_end_cliente() {
        return $this->com_end_cliente;
    }

    public function set_com_end_cliente($com_end_cliente) {
        $this->com_end_cliente = $com_end_cliente;
    }

    public function get_bairro_end_cliente() {
        return $this->bairro_end_cliente;
    }

    public function set_bairro_end_cliente($bairro_end_cliente) {
        $this->bairro_end_cliente = $bairro_end_cliente;
    }

    public function get_estado_cliente() {
        return $this->estado_cliente;
    }

    public function set_estado_cliente($estado_cliente) {
        $this->estado_cliente = $estado_cliente;
    }

    public function get_cidade_cliente() {
        return $this->cidade_cliente;
    }

    public function set_cidade_cliente($cidade_cliente) {
        $this->cidade_cliente = $cidade_cliente;
    }

    public function get_tipo_cliente() {
        return $this->tipo_cliente;
    }

    public function set_tipo_cliente($tipo_cliente) {
        $this->tipo_cliente = $tipo_cliente;
    }

    public function get_num_telefone() {
        return $this->num_telefone;
    }

    public function set_num_telefone($num_telefone) {
        $this->num_telefone = $num_telefone;
    }

    public function get_num_celular() {
        return $this->num_celular;
    }

    public function set_num_celular($num_celular) {
        $this->num_celular = $num_celular;
    }

    public function get_ind_ativo() {
        return $this->ind_ativo;
    }

    public function set_ind_ativo($ind_ativo) {
        $this->ind_ativo = $ind_ativo;
    }

    public function get_des_observacao() {
        return $this->des_observacao;
    }

    public function set_des_observacao($des_observacao) {
        $this->des_observacao = $des_observacao;
    }

    public function get_tip_mensalidade() {
        return $this->tip_mensalidade;
    }

    public function set_tip_mensalidade($tip_mensalidade) {
        $this->tip_mensalidade = $tip_mensalidade;
    }

    public function get_dat_contratacao() {
        return $this->dat_contratacao;
    }

    public function set_dat_contratacao($dat_contratacao) {
        $this->dat_contratacao = $dat_contratacao;
    }

    public function get_dia_vencimento() {
        return $this->dia_vencimento;
    }

    public function set_dia_vencimento($dia_vencimento) {
        $this->dia_vencimento = $dia_vencimento;
    }    
    
    public function insereCliente($objCliente) {
        $objConexao = new fla_conexao();

        // Verifica se o cliente já está cadastrado
        $SQL = "SELECT
                    cod_cliente
                FROM
                    fla_clientes
                WHERE
                    des_placa = '" . $objCliente->get_des_placa() . "'";
        $cliente = $objConexao->prepare($SQL);
        $cliente->Execute();
        if ($cliente->rowCount() == 0) {

            $parametros_insert = get_object_vars($objCliente);
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

                        if (($atributo == "cpf_cnpj_cliente") || ($atributo == "insc_municipal_cliente") || ($atributo == "insc_estadual_cliente") || ($atributo == 'num_telefone') || ($atributo == 'num_celular')) {
                            $valor = str_replace(array("-", "/", ".", ")", "(", " "), array(""), $valor);
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
                    $SQL = "INSERT INTO fla_clientes (" . $insert_field . ") VALUES (" . $insert_values . ")";
                    $query = $objConexao->prepare($SQL) or die($objConexao->errorInfo());
                    $query->Execute();
                } catch (PDOException $e) {
                    print $e->getMessage();
                }
                return $objConexao->lastInsertId();
            }
        } else {
            return false;
        }
    }

    public function editaCliente($objCliente) {
        $objConexao = new fla_conexao();

        $parametros_where = get_object_vars($objCliente);
        $parametros_where = array_filter($parametros_where, 'strlen');
        $tamanho_parametros = count($parametros_where);
        $update = "";
        $aux = 1;
        if (is_array($parametros_where)) {
            foreach ($parametros_where as $atributo => $valor) {
                if (($atributo != "cod_cliente")) {
                    if ((!is_null($valor))) {
                        if ($aux != $tamanho_parametros) {
                            $and = " , ";
                        } else {
                            $and = "";
                        }

                        if (($atributo == "cpf_cnpj_cliente") || ($atributo == "insc_municipal_cliente") || ($atributo == "insc_estadual_cliente") || ($atributo == 'num_telefone') || ($atributo == 'num_celular')) {
                            $valor = str_replace(array("-", "/", ".", ")", "(", " "), array(""), $valor);
                        }

                        if (is_numeric($valor) && (!in_array($atributo, array("cpf_cnpj_cliente", "insc_municipal_cliente", "insc_estadual_cliente")))) {
                            $update .= $atributo . " = " . $valor . $and;
                        } else {
                            $update .= $atributo . " = '" . $valor . "'" . $and;
                        }
                    }
                }
                $aux++;
            }
        }
        $SQL = sprintf('UPDATE fla_clientes SET ' . $update . ' WHERE cod_cliente = %s', $objCliente->get_cod_cliente());
        $query = $objConexao->prepare($SQL);
        $query->Execute();
    }

    public function consultahistorico($des_placa, $limite = null) {
        $objConexao = new fla_conexao();
        $arrHistorico = array();
        if (!is_null($limite))
            $limite = " LIMIT " . $limite;
        else
            $limite = "";

        $SQL = 'SELECT 
                    dat_cadastro
                    , hor_entrada
                    , hor_saida
                 FROM 
                    fla_rotatividade
                 WHERE 
                    des_placa = "' . $des_placa . '"
                 ORDER BY 
                    dat_cadastro DESC' . $limite;

        $rsHistorico = $objConexao->prepare($SQL);
        $rsHistorico->execute();
        $count = $rsHistorico->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($historico = $rsHistorico->fetch(PDO::FETCH_ASSOC)) {
                foreach ($historico as $key => $value) {
                    if (!empty($value))
                        $arrHistorico[$aux][$key] = $value;
                    else
                        $arrHistorico[$aux][$key] = 0;
                }
                $aux++;
            }
            return $arrHistorico;
        } else {
            return false;
        }
    }

    public function buscaClientes($objCliente) {
        $objConexao = new fla_conexao();
        $where = "";
        $separador = "";
        $colunas_select = "";
        $and = "";
        $arrClientes = array();

        $parametros_where = get_object_vars($objCliente);
        $parametros_where = array_filter($parametros_where, 'strlen');
        $tamanho_parametros = count($parametros_where);

        $arrAtributos = get_class_vars(get_class($objCliente));
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

        $SQL = sprintf("select %s from fla_clientes rot %s", $colunas_select, $where);
        $rsClientes = $objConexao->prepare($SQL);
        $rsClientes->execute();
        $count = $rsClientes->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($clientes = $rsClientes->fetch(PDO::FETCH_ASSOC)) {
                foreach ($clientes as $key => $value) {
                    if (!empty($value))
                        $arrClientes[$aux][$key] = $value;
                    else
                        $arrClientes[$aux][$key] = '';
                }
                $aux++;
            }
            return $arrClientes;
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
