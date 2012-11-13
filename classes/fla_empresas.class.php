<?php

include_once($path_classes . 'fla_conexao.class.php');
class fla_empresas {
    private $cod_empresa;
    private $nom_fantasia;
    private $raz_social;
    private $num_cnpj;
    private $num_insc_municipal;
    private $num_ie;
    private $cep_empresa;
    private $des_endereco;
    private $des_bairro;
    private $des_estado;
    private $des_cidade;
    private $num_telefone;
    private $num_celular;
    private $tip_empresa;
    private $ind_disponivel;
    
    public function get_cod_empresa() {
        return $this->cod_empresa;
    }

    public function set_cod_empresa($cod_empresa) {
        $this->cod_empresa = $cod_empresa;
    }

    public function get_nom_fantasia() {
        return $this->nom_fantasia;
    }

    public function set_nom_fantasia($nom_fantasia) {
        $this->nom_fantasia = $nom_fantasia;
    }

    public function get_raz_social() {
        return $this->raz_social;
    }

    public function set_raz_social($raz_social) {
        $this->raz_social = $raz_social;
    }

    public function get_num_cnpj() {
        return $this->num_cnpj;
    }

    public function set_num_cnpj($num_cnpj) {
        $this->num_cnpj = $num_cnpj;
    }

    public function get_num_insc_municipal() {
        return $this->num_insc_municipal;
    }

    public function set_num_insc_municipal($num_insc_municipal) {
        $this->num_insc_municipal = $num_insc_municipal;
    }

    public function get_num_ie() {
        return $this->num_ie;
    }

    public function set_num_ie($num_ie) {
        $this->num_ie = $num_ie;
    }

    public function get_cep_empresa() {
        return $this->cep_empresa;
    }

    public function set_cep_empresa($cep_empresa) {
        $this->cep_empresa = $cep_empresa;
    }

    public function get_des_endereco() {
        return $this->des_endereco;
    }

    public function set_des_endereco($des_endereco) {
        $this->des_endereco = $des_endereco;
    }

    public function get_des_bairro() {
        return $this->des_bairro;
    }

    public function set_des_bairro($des_bairro) {
        $this->des_bairro = $des_bairro;
    }

    public function get_des_estado() {
        return $this->des_estado;
    }

    public function set_des_estado($des_estado) {
        $this->des_estado = $des_estado;
    }

    public function get_des_cidade() {
        return $this->des_cidade;
    }

    public function set_des_cidade($des_cidade) {
        $this->des_cidade = $des_cidade;
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

    public function get_tip_empresa() {
        return $this->tip_empresa;
    }

    public function set_tip_empresa($tip_empresa) {
        $this->tip_empresa = $tip_empresa;
    }

    public function get_ind_disponivel() {
        return $this->ind_disponivel;
    }

    public function set_ind_disponivel($ind_disponivel) {
        $this->ind_disponivel = $ind_disponivel;
    }

    public function insereEmpresa($objEmpresa) {
        $objConexao = new fla_conexao();
        $parametros_insert = get_object_vars($objEmpresa);
        $parametros_insert = array_filter($parametros_insert,'strlen');
        $tamanho_parametros = count($parametros_insert);
        $aux = 1;
        if (is_array($parametros_insert)) {
            foreach ($parametros_insert as $atributo => $valor) {
                if ( (!is_null($valor)) ) {
                        if ($aux != $tamanho_parametros) {
                            $and = " , ";
                        } else {
                            $and = "";
                        }

                        if (is_numeric($valor)) {
                            $insert_values .= sprintf("%s %s ",$valor,$and); 
                        } else {
                            $insert_values .= sprintf('"%s" %s ',$valor,$and); 
                        }

                        $insert_field  .= $atributo . $and;
                }
                $aux++;
            }
            try {
                $SQL = "INSERT INTO fla_empresas (".$insert_field.") VALUES (".$insert_values.")";
                $query = $objConexao->prepare($SQL) or die($objConexao->errorInfo());
                $query->Execute();
                return true;
            } catch (PDOException $e) {
                print $e->getMessage();
            }
        }        
    }
    
    public function buscaEmpresas($objEmpresa) {
        $objConexao = new fla_conexao();
        $where = "";
        $separador = "";
        $colunas_select = "";        
        $and = "";
        $arrEmpresas = array();
        
        $parametros_where = get_object_vars($objEmpresa);
        $parametros_where = array_filter($parametros_where,'strlen');
        $tamanho_parametros = count($parametros_where);
        
        $arrAtributos = get_class_vars(get_class($objEmpresa));
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
                        $where .= $atributo." = \"".$valor."\"".$and;
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

        $SQL = sprintf("select %s from fla_empresas rot %s",$colunas_select,$where);
        try
        {
            $rsEmpresas = $objConexao->prepare($SQL);
            $rsEmpresas->execute();
            $count = $rsEmpresas->rowCount();
        }catch(PDOException $err)
        {
            echo "<p style='border:none;'>Erro ao executar operação no banco de dados: ".$err->getMessage()."</p>";
            echo "<p style='border:none;'>SQL: ".$SQL."</p>";
        }
        $aux = 0;
        if ($count > 0) {
            while ($empresas = $rsEmpresas->fetch(PDO::FETCH_ASSOC)) {
                foreach ($empresas as $key => $value) {
                    if (!empty($value))
                        $arrEmpresas[$aux][$key] = $value;
                    else
                        $arrEmpresas[$aux][$key] = 0;
                }
                $aux++;
            }
            return $arrEmpresas;
        } else {
            return false;
        }
        return $arrEmpresas;
    }
    
    public function editaEmpresa($objEmpresa) {
        $objConexao = new fla_conexao();
        
        $parametros_where = get_object_vars($objEmpresa);
        $parametros_where = array_filter($parametros_where,'strlen');
        $tamanho_parametros = count($parametros_where);
        $update = "";
        $aux = 1;
        if (is_array($parametros_where)) {
            foreach ($parametros_where as $atributo => $valor) {
                if (($atributo != "cod_empresa")) {
                    if ( (!is_null($valor)) ) {
                        if ($aux != $tamanho_parametros) {
                            $and = " , ";
                        } else {
                            $and = "";
                        }

                        if ( ($atributo == "cpf_cnpj_cliente") || ($atributo == "insc_municipal_cliente") || ($atributo == "insc_estadual_cliente")) {
                            $valor = str_replace(array("-","/","."), array(""),$valor);
                        }

                        if (is_numeric($valor) && (!in_array($atributo,array("cpf_cnpj_cliente","insc_municipal_cliente","insc_estadual_cliente")))) {
                            $update .= $atributo." = ".$valor.$and;
                        } else {
                            $update .= $atributo." = \"".$valor."\"".$and;
                        }
                    }
                }
                $aux++;
            }
                
        }        
        $SQL = sprintf('UPDATE fla_empresas SET '.$update . ' WHERE cod_empresa = %s',$objEmpresa->get_cod_empresa());
        $query = $objConexao->prepare($SQL);
        $query->Execute();
    }
    
            
    function ResetObject($objeto) {
        foreach ($objeto as $key => $value) {
            unset($this->$key);
        }
    }  
}
?>
