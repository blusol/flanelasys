<?php

include_once($path_classes . 'fla_conexao.class.php');

class fla_nfes {

    private $cod_nfe;
    private $cod_cliente;
    private $cod_rotatividade;
    private $cod_mensalidade_usuario;
    private $dat_criacao;
    private $ind_enviado;
    private $dat_enviado;
    private $nom_arquivo;

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
    public function get_cod_mensalidade_usuario() {
        return $this->cod_mensalidade_usuario;
    }

    public function set_cod_mensalidade_usuario($cod_mensalidade_usuario) {
        $this->cod_mensalidade_usuario = $cod_mensalidade_usuario;
    }

    public function get_cod_cliente() {
        return $this->cod_cliente;
    }

    public function set_cod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }
    
    public function get_nom_arquivo() {
        return $this->nom_arquivo;
    }

    public function set_nom_arquivo($nom_arquivo) {
        $this->nom_arquivo = $nom_arquivo;
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
        //echo $SQL;
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
    
    
    public function consultaRPS($objNFE,$dat_inicio,$dat_final) {
        $objConexao = new fla_conexao();
        $where = "";
        
        $parametros_where = get_object_vars($objNFE);
        $parametros_where = array_filter($parametros_where,'strlen');
        $tamanho_parametros = count($parametros_where);
        
        $arrAtributos = get_class_vars(get_class($objNFE));
        $countArrAtributos = count($arrAtributos);
        
        $aux = 1;
        
        if (count($parametros_where) > 0) {
            foreach ($parametros_where as $atributo => $valor) {
                if (!is_null($valor)) {
                    if ($aux != $tamanho_parametros) {
                        $and = " AND ";
                    } else {
                        $and = "";
                    }
                    if (is_numeric($valor)) {
                        $where .= "nf.".$atributo." = ".$valor.$and;
                    } else {
                        $where .= "nf.".$atributo." = '".$valor."'".$and;
                    }
                }
                $aux++;
            }
            $where .= ' AND nf.dat_criacao BETWEEN "'.$dat_inicio.' 00:00:00" AND "'.$dat_final.' 23:59:00"';
        } else {
            $where .= '  nf.dat_criacao BETWEEN "'.$dat_inicio.' 00:00:00" AND "'.$dat_final.' 23:59:00"';
        }        
        
        if (!empty($where)) {
            $where = " where ".$where;
        }        
        
        $SQL = "select
                    nf.cod_nfe
                    , nf.dat_criacao
                    , nf.ind_enviado
                    , nf.dat_enviado
                    , rot.cod_rotatividade
                    , menusu.cod_mensalidade_usuario
                    , cli.nom_cliente
                    , UPPER(cli.des_placa) as des_placa
                    , menusu.valor_pago
                    , rot.val_cobrado
                    , men.des_mensalidade
                    , nf.nom_arquivo
                from
                    fla_nfes nf
                        LEFT JOIN fla_rotatividade rot  ON (rot.cod_rotatividade = nf.cod_rotatividade)
                        LEFT JOIN fla_mensalidade_usuario menusu ON (menusu.cod_mensalidade_usuario = nf.cod_mensalidade_usuario)
                        LEFT JOIN fla_clientes cli ON (cli.cod_cliente = nf.cod_cliente)
                        LEFT JOIN fla_mensalidade men ON (men.cod_mensalidade = menusu.cod_mensalidade) ".$where.' ORDER BY ind_enviado DESC, nom_arquivo, dat_criacao';
        $rsData = $objConexao->prepare($SQL);
        //echo "<pre>$SQL</pre>";
        $rsData->execute();
        $count = $rsData->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($resultado = $rsData->fetch(PDO::FETCH_ASSOC)) {
                $arrRPS[$aux]['cod_nfe']            = $resultado['cod_nfe'];
                $arrRPS[$aux]['dat_criacao']        = $resultado['dat_criacao'];
                $arrRPS[$aux]['ind_enviado']        = $resultado['ind_enviado'];
                $arrRPS[$aux]['dat_enviado']        = $resultado['dat_enviado'];
                $arrRPS[$aux]['cod_rotatividade']   = $resultado['cod_rotatividade'];
                $arrRPS[$aux]['cod_mensalidade_usuario'] = $resultado['cod_mensalidade_usuario'];
                $arrRPS[$aux]['nom_cliente']             = $resultado['nom_cliente'];
                $arrRPS[$aux]['des_placa']               = $resultado['des_placa'];
                $arrRPS[$aux]['valor_pago']              = $resultado['valor_pago'];
                $arrRPS[$aux]['val_cobrado']             = $resultado['val_cobrado'];
                $arrRPS[$aux]['des_mensalidade']         = $resultado['des_mensalidade'];
                $arrRPS[$aux]['nom_arquivo']         = $resultado['nom_arquivo'];
                $aux++;
            }
            return $arrRPS;
        }        
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
    
    public function setGeradoLote($codigo,$nome_arquivo) {
        $objConexao = new fla_conexao();
        $dat_enviado = date("Y-m-d H:i:s");
        $SQL = "UPDATE fla_nfes SET dat_enviado = '".$dat_enviado."', ind_enviado = 1, nom_arquivo = '".$nome_arquivo."' WHERE cod_nfe = ".$codigo;
        //echo $SQL;
        $rsData = $objConexao->prepare($SQL);
        $rsData->execute();
    }
    
}

?>
