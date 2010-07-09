<?php
include_once($path_classes.'fla_conexao.class.php');
class fla_descontos {

	private $cod_desconto;
	private $des_desconto;
	private $val_desconto;


    function buscaDescontos(){
        $objConexao = new fla_conexao();
        $SQL = "SELECT
                    cod_desconto,
                    des_desconto,
                    val_desconto
                FROM
                    fla_descontos
                ORDER BY
                    des_desconto";
        $rsDescontos = $objConexao->query($SQL);
        $arrDescontos = array();
        $aux = 0;
        while($desconto = $rsDescontos->fetch(PDO::FETCH_ASSOC)) {
            $arrDescontos[$aux]['cod_desconto'] = $desconto['cod_desconto'];
            $arrDescontos[$aux]['des_desconto'] = $desconto['des_desconto'];
            $arrDescontos[$aux]['val_desconto'] = $desconto['val_desconto'];
            $aux++;
        }
        return $arrDescontos;
    }
}
?>
