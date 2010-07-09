<?php
include_once($path_classes.'fla_conexao.class.php');
class fla_marcas {
	private $cod_marca;
	private $des_marca;
	private $ind_popular;
	private $ind_disponivel;
		
	public function set_cod_marca($cod_marca) {
		$this->cod_marca = $cod_marca;
	}
	
	public function set_des_marca($des_marca) {
		$this->des_marca = $des_marca;
	}
	
	public function set_ind_disponivel($ind_disponivel) {
		$this->ind_disponivel = $ind_disponivel;
	}

	public function set_ind_popular($ind_popular) {
		$this->ind_popular = $ind_popular;
	}	
	
	public function get_cod_marca() {
		return $this->cod_marca;
	}
	
	public function get_des_marca() {
		return $this->des_marca;
	}
	
	public function get_ind_disponivel() {
		return $this->ind_disponivel;
	}
	
	public function get_ind_popular() {
		return $this->ind_popular;
	}		
	
	public function buscaMarcas($objMarca) {
		$objConexao = new fla_conexao();
		
		if ($objMarca->get_cod_marca() != "") {
		    $where = " WHERE cod_marca = " . $objMarca->get_cod_marca();
		}

		$SQL = "SELECT
					mar.cod_marca,
					mar.des_marca,
					mar.ind_disponivel,
					mar.ind_popular
				FROM
					fla_marcas mar
				" . $where . " ORDER BY mar.des_marca";

		$rsMarcas = $objConexao->prepare($SQL);
		$rsMarcas->execute() or die ($objConexao->errorInfo());
		$arrMarcas = array();
		$aux = 0;
		while ($marca = $rsMarcas->fetch(PDO::FETCH_ASSOC)) {
			$arrMarcas[$aux]['cod_marca'] = $marca['cod_marca'];
			$arrMarcas[$aux]['des_marca'] = $marca['des_marca'];
			$arrMarcas[$aux]['ind_disponivel'] = $marca['ind_disponivel'];
			$arrMarcas[$aux]['ind_popular'] = $marca['ind_popular'];
			$aux++;
		}
		return $arrMarcas;				
	}
	
	public function cadastraMarcas($objMarca) {
		$objConexao = new fla_conexao();
		$SQL = sprintf("INSERT INTO fla_marcas (
						des_marca,
						ind_disponivel,
						ind_popular)
						VALUES ('%s',%s,%s)"
						, $objMarca->get_des_marca()
						, $objMarca->get_ind_disponivel()
						, $objMarca->get_ind_popular());
		$rsMarcas = $objConexao->prepare($SQL);
		$rsMarcas->execute() or die ($objConexao->errorInfo().'<br>Query: '.$SQL);		
	}
	public function editaMarcas($objMarca) {
		$objConexao = new fla_conexao();
		
		$SQL = sprintf("UPDATE
						fla_marcas
					   SET
						  des_marca = '%s'
						, ind_disponivel = %s
						, ind_popular = %s
				       WHERE
						cod_marca = %s"
						, $objMarca->get_des_marca()
						, $objMarca->get_ind_disponivel()
						, $objMarca->get_ind_popular()
						, $objMarca->get_cod_marca());
		$rsMarcas = $objConexao->prepare($SQL);
		$rsMarcas->execute() or die ($objConexao->errorInfo().'<br>Query: '.$SQL);		
	}
}
	
?>