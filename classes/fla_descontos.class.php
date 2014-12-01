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
		return $this->des_desconto;
	}
	
	public function get_val_desconto() {
		return $this->val_desconto;
	}
	
	public function get_ind_disponivel() {
		return $this->ind_disponivel;
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
	
	public function set_ind_disponivel($ind_disponivel) {
		$this->ind_disponivel = $ind_disponivel;
	}	
	
    public function buscaDescontos($objDesconto){
        $objConexao = new fla_conexao();
        $where = "";
		
		if ($objDesconto->get_cod_desconto() != "") {
		    $where = " WHERE cod_desconto = " . $objDesconto->get_cod_desconto();
		}				
		
		if ($objDesconto->get_ind_disponivel() != "") {
		    $where = " WHERE ind_disponivel = " . $objDesconto->get_ind_disponivel();
		}						
		
        $SQL = "SELECT
                    cod_desconto,
                    des_desconto,
                    val_desconto,
					ind_disponivel
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
            $arrDescontos[$aux]['ind_disponivel'] = $desconto['ind_disponivel'];
            $aux++;
        }
        return $arrDescontos;
    }
	
	public function insereDescontos($objDesconto) {
		$objConexao = new fla_conexao();
		
		$SQL = sprintf("INSERT INTO 
							fla_descontos
						(
							des_desconto,
							val_desconto,
							ind_disponivel
						)
						VALUES
						(
							'%s',
							%s,
							%s
						)",
						$objDesconto->get_des_desconto(),
						$objDesconto->get_val_desconto(),
						$objDesconto->get_ind_disponivel()
		              );
       $query = $objConexao->prepare($SQL);
	   $query->Execute();
	}
	
	public function editaDescontos($objDesconto) {
        $objConexao = new fla_conexao();
		
		$SQL = sprintf("UPDATE 
							fla_descontos
						SET
							des_desconto = '%s',
							val_desconto = %s,
							ind_disponivel = %s
						WHERE
							cod_desconto = %s",
						$objDesconto->get_des_desconto(),
						$objDesconto->get_val_desconto(),
						$objDesconto->get_ind_disponivel(),
						$objDesconto->get_cod_desconto()
					  );
         $query = $objConexao->prepare($SQL);
		 $query->Execute(); 					  
	}
}
?>
