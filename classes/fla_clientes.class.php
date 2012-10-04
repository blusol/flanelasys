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
            $SQL = sprintf('INSERT INTO fla_clientes
                            (cod_cliente
                             ,nom_cliente
                             ,des_cor
                             ,des_placa
                             ,cod_modelo
                             ,cod_marca)
                             VALUES
                             (0,"%s","%s","%s",%s,%s)'
                    , $objCliente->get_nom_cliente()
                    , $objCliente->get_des_cor()
                    , $objCliente->get_des_placa()
                    , $objCliente->get_cod_modelo()
                    , $objCliente->get_cod_marca()
            );
            $query = $objConexao->prepare($SQL);
            $query->Execute();
        }
    }

    public function editaCliente($objCliente) {
        $objConexao = new fla_conexao();
        
        $parametros_where = get_object_vars($objCliente);
        $parametros_where = array_filter($parametros_where,'strlen');
        $tamanho_parametros = count($parametros_where);
        $update = "";
        $aux = 1;
        if (is_array($parametros_where)) {
            foreach ($parametros_where as $atributo => $valor) {
                if (!is_null($valor)) {
                    if ($aux != $tamanho_parametros) {
                        $and = " , ";
                    } else {
                        $and = "";
                    }
                    
                    if ($atributo == "cpf_cnpj_cliente") {
                        $valor = str_replace(array("-","/",".   "), array(""),$valor);
                    }
                    
                    if (is_numeric($valor)) {
                        $update .= $atributo." = ".$valor.$and;
                    } else {
                        $update .= $atributo." = '".$valor."'".$and;
                    }
                }
                $aux++;
            }
                
        }        
        $SQL = sprintf('UPDATE fla_clientes SET '.$update . ' WHERE cod_cliente = %s',$objCliente->get_cod_cliente());
        $query = $objConexao->prepare($SQL);
        $query->Execute();
    }

    public function buscaClientes($objCliente) {
        $objConexao = new fla_conexao();
        $where = "";
        $separador = "";
        $colunas_select = "";        
        $and = "";
        $arrClientes = array();
        
        $parametros_where = get_object_vars($objCliente);
        $parametros_where = array_filter($parametros_where,'strlen');
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
                        $where .= $atributo." = ".$valor.$and;
                    } else {
                        $where .= $atributo." = '".$valor."'".$and;
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
                
                $colunas_select .= $key.$separador.chr(10);
                $aux++;                
            }
        }

        if (!empty($where)) {
            $where = " where ".$where;
        }
        
        /*if ($objCliente->cod_cliente != "") {
            $where = " WHERE cod_cliente = " . $objCliente->cod_cliente;
        }*/
        $SQL = sprintf("select %s from fla_clientes rot %s",$colunas_select,$where);
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
                        $arrClientes[$aux][$key] = 0;
                }
                $aux++;
            }
            return $arrClientes;
        } else {
            return false;
        }
        return $arrClientes;
    }
    
    function ResetObject() {
        foreach ($this as $key => $value) {
            unset($this->$key);
        }
    }

}

?>
