<?php
include_once($path_classes.'fla_conexao.class.php');
class fla_descontos {

	private $cod_desconto;
	private $des_desconto;
	private $val_desconto;


	public function get_cod_desconto() {
		return $this->cod_desconto;
	}
	
	public function get_des_desconto() {
		return $this->des_desconto();
	}
	
	public function get_val_desconto() {
		return $this->val_desconto();
	}
	
	public function set_cod_desconto($cod_desconto) {
		$this->cod_desconto = $cod_desconto;
	}
	
	public function set_des_desconto($des_desconto) {
		$this->des_desconto = $des_desconto;
	}
	
	public function set_val_desconto($val_desconto) {
		$this->val_desconto = $val_desconto;
	}
	
    function buscaDescontos($objDesconto){
        $objConexao = new fla_conexao();
		
		if ($objDesconto->get_cod_desconto() != "") {
		    $where = " WHERE cod_desconto = " . $objDesconto->get_cod_desconto();
		}				
		
        $SQL = "SELECT
                    cod_desconto,
                    des_desconto,
                    val_desconto
                FROM
                    fla_descontos "
				. $where . "							
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
