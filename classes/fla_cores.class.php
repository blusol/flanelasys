<?php
//include_once('../../includes/config.php');
include_once($path_classes.'fla_conexao.class.php');
class fla_cores {

	private $cod_cor;
	private $des_cor;
	
	
	public function set_cod_cor($cod_cor) {
		$this->cod_cor = $cod_cor;
	}
	
	public function set_des_cor($des_cor) {
		$this->des_cor = $des_cor;
	}
	
	public function get_cod_cor() {
		return $this->cod_cor;
	}
	
	public function get_des_cor() {
		return $this->des_cor;
	}

    public function buscaCores($objCores){
        $objConexao = new fla_conexao();
		if ($this->get_cod_cor() != "") {
			$where = sprintf(" WHERE cod_cor = %s ",$this->get_cod_cor());
		}
        $SQL = "SELECT
                    cod_cor,
                    des_cor
                FROM
                    fla_cores " . $where . " 					
                ORDER BY
                    des_cor";					

        $rsCores = $objConexao->query($SQL);
        $arrCores = array();
        $aux = 0;
        while($cores = $rsCores->fetch(PDO::FETCH_ASSOC)) {
            $arrCores[$aux]['cod_cor'] = $cores['cod_cor'];
            $arrCores[$aux]['des_cor'] = $cores['des_cor'];
            $aux++;
        }
        return $arrCores;
    }
	
	
	public function insereCores($objCores) {
		$objConexao = new fla_conexao();
		$SQL = sprintf("INSERT INTO fla_cores (des_cor) VALUES ('%s')",$objCores->get_des_cor());
		$query = $objConexao->prepare($SQL);
		$query->Execute();		
	}
	
	public function editaCores($objCores) {
		$objConexao = new fla_conexao();
		$SQL = sprintf("UPDATE fla_cores SET des_cor = '%s' WHERE cod_cor = %s",$objCores->get_des_cor(),$objCores->get_cod_cor());
		$query = $objConexao->prepare($SQL);
        $query->Execute();		
	}
}
?>