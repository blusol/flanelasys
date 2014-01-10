<?php

include_once($path_classes . 'fla_conexao.class.php');

class fla_mensalidade {

    private $cod_mensalidade;
    private $des_mensalidade;
    private $val_mensalidade;
    private $ind_ativo;
    private $dat_criacao;

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

    public function editaMensalidade($objMensalidade) {
        $objConexao = new fla_conexao();

        $parametros_where = get_object_vars($objMensalidade);
        $parametros_where = array_filter($parametros_where, 'strlen');
        $tamanho_parametros = count($parametros_where);
        $update = "";
        $aux = 1;
        if (is_array($parametros_where)) {
            foreach ($parametros_where as $atributo => $valor) {
                if (($atributo != "cod_mensalidade")) {
                    if ((!is_null($valor))) {
                        if ($aux != $tamanho_parametros) {
                            $and = " , ";
                        } else {
                            $and = "";
                        }

                        if (is_numeric($valor)) {
                            $update .= $atributo . " = " . $valor . $and;
                        } else {
                            $update .= $atributo . " = '" . $valor . "'" . $and;
                        }
                    }
                }
                $aux++;
            }
        }
        $SQL = sprintf('UPDATE fla_mensalidade SET ' . $update . ' WHERE cod_mensalidade = %s', $objMensalidade->get_cod_mensalidade());
        //echo $SQL;
        $query = $objConexao->prepare($SQL);
        $query->Execute();
    }

    public function buscaMensalidade() {
        $objConexao = new fla_conexao();
        $where = "";
        $separador = "";
        $colunas_select = "";
        $and = "";
        $arrClientes = array();

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

        $SQL = sprintf("select %s from fla_mensalidade rot %s", $colunas_select, $where);
        //echo $SQL;
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

    function buscaMensalidadesAtrasadas() {
        $objConexao = new fla_conexao();
        $arrMensalidadeAtrasada = array();
        $sql = "select
                        cli.dia_vencimento
                        , cli.cod_cliente
                        , cli.nom_cliente
                from
                        fla_clientes cli
                        LEFT JOIN fla_mensalidade_usuario menusu ON (menusu.cod_cliente = cli.cod_cliente)
                where
                        cli.dia_vencimento > 0
						and cli.ind_ativo = 1
                        and
                        cli.cod_cliente not in 
                        (
                                select 
                                    cod_cliente 
                                from 
                                    fla_mensalidade_usuario
                                where 
                                    '" . date("Y-m-d") . "' between periodo_inicial and periodo_final
                        )
				group by
					cli.cod_cliente
                order by
                        cli.dia_vencimento asc , cli.nom_cliente asc";
		echo "<pre>".$sql."</pre>";
        $rsMensalidadeAtrasada = $objConexao->prepare($sql);
        $rsMensalidadeAtrasada->execute();
        $count = $rsMensalidadeAtrasada->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($mensalidade_atrasada = $rsMensalidadeAtrasada->fetch(PDO::FETCH_ASSOC)) {
                foreach ($mensalidade_atrasada as $key => $value) {
                    if (!empty($value))
                        $arrMensalidadeAtrasada[$aux][$key] = $value;
                    else
                        $arrMensalidadeAtrasada[$aux][$key] = '';
                }
                $aux++;
            }
            return $arrMensalidadeAtrasada;
        }
    }
    
    function relatorioMensalistas($periodo_inicial,$periodo_final,$situacao = "T") {
        $objConexao = new fla_conexao();
        $arrMensalidadeAtrasada = array();

        switch ($situacao) {
            case "T":
                $sql = "(
                        SELECT
                            cli.dia_vencimento
                            , cli.cod_cliente
                            , cli.nom_cliente
                            , 'A' situacao
                            , men.des_mensalidade
                            , men.val_mensalidade
                        FROM
                            fla_clientes cli
                            LEFT JOIN fla_mensalidade_usuario menusu ON (menusu.cod_cliente = cli.cod_cliente)
                            LEFT JOIN fla_mensalidade men ON (cli.tip_mensalidade = men.cod_mensalidade)
                        WHERE
                            cli.dia_vencimento > 0 AND cli.ind_ativo = 1 
                            AND cli.cod_cliente NOT IN (
                                SELECT
                                    cod_cliente
                                FROM
                                    fla_mensalidade_usuario
                                WHERE
                                    periodo_inicial BETWEEN '".$periodo_inicial."' AND '".$periodo_final."' OR periodo_final BETWEEN '".$periodo_inicial."' AND '".$periodo_final."'
                            )
                        GROUP BY cli.cod_cliente
                        ORDER BY cli.dia_vencimento ASC, cli.nom_cliente ASC
                     )
                    UNION
                    (
                        SELECT
                            cli.dia_vencimento
                            , cli.cod_cliente
                            , cli.nom_cliente
                            , 'Q' as situacao
                            , men.des_mensalidade
                            , men.val_mensalidade
                        FROM
                            fla_clientes cli
                            LEFT JOIN fla_mensalidade_usuario menusu ON (menusu.cod_cliente = cli.cod_cliente)
                            LEFT JOIN fla_mensalidade men ON (cli.tip_mensalidade = men.cod_mensalidade)
                        WHERE
                            cli.dia_vencimento > 0  AND cli.ind_ativo = 1
                        AND cli.cod_cliente IN (
                            SELECT
                                cod_cliente
                            FROM
                                fla_mensalidade_usuario
                            WHERE
                                periodo_inicial BETWEEN '".$periodo_inicial."' AND '".$periodo_final."' OR periodo_final BETWEEN '".$periodo_inicial."' AND '".$periodo_final."'
                        GROUP BY cli.cod_cliente
                        ORDER BY cli.dia_vencimento ASC, cli.nom_cliente ASC)
                    )";
                break;
                
                case "Q":
                    $sql = "SELECT
                                cli.dia_vencimento
                                , cli.cod_cliente
                                , cli.nom_cliente
                                , 'Q' as situacao
                                , men.des_mensalidade
                                , men.val_mensalidade
                            FROM
                                fla_clientes cli
                                LEFT JOIN fla_mensalidade_usuario menusu ON (menusu.cod_cliente = cli.cod_cliente)
                                LEFT JOIN fla_mensalidade men ON (cli.tip_mensalidade = men.cod_mensalidade)
                            WHERE
                                cli.dia_vencimento > 0
                                AND cli.ind_ativo = 1
                                AND
                                cli.cod_cliente IN 
                                (
                                        SELECT 
                                            cod_cliente 
                                        FROM 
                                            fla_mensalidade_usuario
                                        WHERE 
                                            periodo_inicial BETWEEN '".$periodo_inicial."' AND '".$periodo_final."' OR periodo_final BETWEEN '".$periodo_inicial."' AND '".$periodo_final."'
                                )
                            GROUP BY
                                cli.cod_cliente
                            ORDER BY
                                cli.dia_vencimento ASC , cli.nom_cliente ASC";
                    break;
                case "A":
                    $sql = "SELECT
                                cli.dia_vencimento
                                , cli.cod_cliente
                                , cli.nom_cliente
                                , 'A' as situacao
                                , men.des_mensalidade
                                , men.val_mensalidade
                            FROM
                                fla_clientes cli
                                LEFT JOIN fla_mensalidade_usuario menusu ON (menusu.cod_cliente = cli.cod_cliente)
                                LEFT JOIN fla_mensalidade men ON (cli.tip_mensalidade = men.cod_mensalidade)
                            WHERE
                                cli.dia_vencimento > 0
                                AND cli.ind_ativo = 1
                                AND
                                cli.cod_cliente NOT IN 
                                (
                                        SELECT 
                                            cod_cliente 
                                        FROM 
                                            fla_mensalidade_usuario
                                        WHERE 
                                            (periodo_inicial BETWEEN '".$periodo_inicial."' AND '".$periodo_final."' AND '".$periodo_inicial."' AND '".$periodo_final."'
                                             OR periodo_final BETWEEN '".$periodo_inicial."' AND '".$periodo_final."' AND '".$periodo_inicial."' AND '".$periodo_final."'
                                             )
                                )
                            GROUP BY
                                cli.cod_cliente
                            ORDER BY
                                cli.dia_vencimento ASC , cli.nom_cliente ASC";
                    break;                
        }
        //echo "<pre>$sql</pre>";
        $rsMensalidadeAtrasada = $objConexao->prepare($sql);
        $rsMensalidadeAtrasada->execute();
        $count = $rsMensalidadeAtrasada->rowCount();
        $aux = 0;
        if ($count > 0) {
            while ($mensalidade_atrasada = $rsMensalidadeAtrasada->fetch(PDO::FETCH_ASSOC)) {
                foreach ($mensalidade_atrasada as $key => $value) {
                    if (!empty($value))
                        $arrMensalidadeAtrasada[$aux][$key] = $value;
                    else
                        $arrMensalidadeAtrasada[$aux][$key] = '';
                }
                $aux++;
            }
            return $arrMensalidadeAtrasada;
        }
    }    

}

?>
