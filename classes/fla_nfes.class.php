<?php

include_once($path_classes . 'fla_conexao.class.php');

class fla_nfes {

    private $cod_nfe;
    private $cod_rotatividade;
    private $dat_criacao;
    private $ind_enviado;
    private $dat_enviado;

    public function get_cod_nfe() {
        return $this->cod_nfe;
    }

    public function set_cod_nfe($cod_nfe) {
        $this->cod_nfe = $cod_nfe;
    }

    public function get_cod_rotatividade() {
        return $this->cod_rotatividade;
    }

    public function set_cod_rotatividade($cod_rotatividade) {
        $this->cod_rotatividade = $cod_rotatividade;
    }

    public function get_dat_criacao() {
        return $this->dat_criacao;
    }

    public function set_dat_criacao($dat_criacao) {
        $this->dat_criacao = $dat_criacao;
    }

    public function get_ind_enviado() {
        return $this->ind_enviado;
    }

    public function set_ind_enviado($ind_enviado) {
        $this->ind_enviado = $ind_enviado;
    }

    public function get_dat_enviado() {
        return $this->dat_enviado;
    }

    public function set_dat_enviado($dat_enviado) {
        $this->dat_enviado = $dat_enviado;
    }
    
    public function insereNFE($objNFE) {
        $objConexao = new fla_conexao();
        $objRotatividade = new fla_rotatividade();
        
        /*
        $objRotatividade->set_cod_rotatividade($objNFE->get_cod_rotatividade());
        $objRotatividade->set_des_situacao("L");
        $arrRotatividade = $objRotatividade->buscaCarro($objRotatividade);
        */
        
        $objNFE->set_dat_criacao(date("Y-m-d H:i:s"));
        $parametros_insert = get_object_vars($objNFE);
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
                        
                        if ($atributo == "dat_criacao") 
                            $insert_values .= sprintf("'%s' %s ",$valor,$and); 
                        else
                            $insert_values .= $valor . $and; 
                        
                        $insert_field  .= $atributo . $and;
                }
                $aux++;
            }
            try {
                $SQL = "INSERT INTO fla_nfes (".$insert_field.") VALUES (".$insert_values.")";
                $query = $objConexao->prepare($SQL) or die($objConexao->errorInfo());
                $query->Execute();
            } catch (PDOException $e) {
                print $e->getMessage();
            }
            return $objConexao->lastInsertId();
        }        
    }
    
    public function buscaNFE($objNFE) {
        $objConexao = new fla_conexao();
        $where = "";
        $separador = "";
        $colunas_select = "";        
        $and = "";
        $arrNFEs = array();
        
        $parametros_where = get_object_vars($objNFE);
        $parametros_where = array_filter($parametros_where,'strlen');
        $tamanho_parametros = count($parametros_where);
        
        $arrAtributos = get_class_vars(get_class($objNFE));
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
        
        $SQL = sprintf("select %s from fla_nfes nfe %s",$colunas_select,$where);
        $rsNFEs = $objConexao->prepare($SQL);
        $rsNFEs->execute();
        $count = $rsNFEs->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($nfes = $rsNFEs->fetch(PDO::FETCH_ASSOC)) {
                foreach ($nfes as $key => $value) {
                    if (!empty($value))
                        $arrNFEs[$aux][$key] = $value;
                    else
                        $arrNFEs[$aux][$key] = 0;
                }
                $aux++;
            }
            return $arrNFEs;
        } else {
            return false;
        }
        return $arrNFEs;
    }    
    
    public function getDataInicioFim($codigos) {
        $objConexao = new fla_conexao();
        $arrDataInicioFim = array();
        $SQL = "select min(dat_criacao) data_inicio,max(dat_criacao) data_fim from fla_nfes where cod_nfe IN (".$codigos.")";
        $rsData = $objConexao->prepare($SQL);
        $rsData->execute();
        $count = $rsData->rowCount();
        if ($count > 0) {
            $resultado = $rsData->fetch(PDO::FETCH_ASSOC);
            $arrDataInicioFim['data_inicio'] = $resultado['data_inicio'];
            $arrDataInicioFim['data_final'] = $resultado['data_fim'];
            return $arrDataInicioFim;
        }
    }
    
    public function setGeradoLote($codigo) {
        $objConexao = new fla_conexao();
        $dat_enviado = date("Y-m-d H:i:s");
        $SQL = "UPDATE fla_nfes SET dat_enviado = '".$dat_enviado."', ind_enviado = 1 WHERE cod_nfe = ".$codigo;
        $rsData = $objConexao->prepare($SQL);
        $rsData->execute();
    }
    
}

?>
