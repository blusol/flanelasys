<?php
include_once($path_classes.'fla_conexao.class.php');
class fla_modelos {
	private $cod_modelo;
	private $des_modelo;
	private $cod_marca;
	private $ind_disponivel;
	private $ind_popular;
	public function set_cod_modelo($cod_modelo) {
		$this->cod_modelo = $cod_modelo;
	}
	
	public function set_des_modelo($des_modelo) {
		$this->des_modelo = $des_modelo;
	}
	
	public function set_cod_marca($cod_marca) {
		$this->cod_marca = $cod_marca;
	}
	
	public function set_ind_disponivel($ind_disponivel) {
		$this->ind_disponivel = $ind_disponivel;
	}

	public function set_ind_popular($ind_popular) {
		$this->ind_popular = $ind_popular;
	}
	
	public function get_cod_modelo() {
		return $this->cod_modelo;
	}
	
	public function get_des_modelo() {
		return $this->des_modelo;
	}
	
	public function get_cod_marca() {
		return $this->cod_marca;
	}
	
	public function get_ind_disponivel() {
		return $this->ind_disponivel;
	}
	
	public function get_ind_popular() {
		return $this->ind_popular;
	}	
	
	public function buscaModelos($objModelos) {
		$objConexao = new fla_conexao();
		
		$where = " WHERE 1 = 1 ";
		if ($objModelos->get_cod_modelo() != "") {
		    $where .= " AND cod_modelo = " . $objModelos->get_cod_modelo();
		}		
		
		if ($objModelos->get_cod_marca() != "") {
			$where .= " AND cod_marca = " . $objModelos->get_cod_marca();
		}
		
		// Query SQL
		$SQL = "SELECT 
					cod_modelo,
					des_modelo,
					cod_marca,
					ind_disponivel,
					ind_popular
				FROM
					fla_modelos
				" . $where . " 
				ORDER BY des_modelo";

		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ($objConexao->errorInfo());
		$arrModelos = array();
		$aux = 0;
		while ($modelo = $rsModelos->fetch(PDO::FETCH_ASSOC)) {
			$arrModelos[$aux]['cod_modelo'] = $modelo['cod_modelo'];
			$arrModelos[$aux]['des_modelo'] = $modelo['des_modelo'];
			$arrModelos[$aux]['cod_marca']  = $modelo['cod_marca'];
			$arrModelos[$aux]['ind_disponivel']  = $modelo['ind_disponivel'];
			$arrModelos[$aux]['ind_popular']  = $modelo['ind_popular'];
			$aux++;
		}
		return $arrModelos;
	}
	
	public function cadastraModelos($objModelo) {
		$objConexao = new fla_conexao();
		$SQL = sprintf("INSERT INTO fla_modelos (
						des_modelo,
						cod_marca,
						ind_disponivel,
						ind_popular)
						VALUES ('%s',%s,%s,%s)"
						, $objModelo->get_des_modelo()
						, $objModelo->get_cod_marca()
						, $objModelo->get_ind_disponivel()
						, $objModelo->get_ind_popular());
		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ($objConexao->errorInfo().'<br>Query: '.$SQL);		
	}
	public function editaModelos($objModelo) {
		$objConexao = new fla_conexao();
		
		$SQL = sprintf("UPDATE
						fla_modelos
					   SET
						cod_marca = %s
						, des_modelo = '%s'
						, ind_disponivel = %s
						, ind_popular = %s
				       WHERE
						cod_modelo = %s"
						, $objModelo->get_cod_marca()
						, $objModelo->get_des_modelo()
						, $objModelo->get_ind_disponivel()
						, $objModelo->get_ind_popular()
						, $objModelo->get_cod_modelo());
		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ($objConexao->errorInfo().'<br>Query: '.$SQL);		
	}
	
	public function editaAtivos($arrModelos,$marca = "") {
		$objConexao = new fla_conexao();
		$modelos_disponivel = 0;
		// Transformando a variavel passado por parametro em um array
		$arrModelos = (array) $arrModelos;
		
		
		// Verifica se foi passado uma marca como parâmetro
		if ($marca <> "") {
			$where_marca = " cod_marca = " . $marca;
			$SQL = "UPDATE fla_modelos SET ind_disponivel = 0 WHERE " . $where_marca;
		} else {
			$where_marca = "";
		}
		
		// Setando todos os veiculos para indisponivel
		
		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ($objConexao->errorInfo());
		
		// Pegando o código dos veiculos que estão selecionados como disponivel
		if (count($arrModelos) > 0) { 
			$modelos_disponivel = implode(",",$arrModelos);
		}
		
		// Setando os modelos do array para ativos
		$SQL = sprintf("UPDATE fla_modelos SET ind_disponivel = 1 WHERE cod_modelo IN (%s) AND cod_marca = %s",$modelos_disponivel,$marca);
		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ('Erro: <br>'.$objConexao->errorInfo().'<br> SQL: ' . $SQL);		
		
		$SQL = sprintf("UPDATE fla_marcas SET ind_disponivel = 1 WHERE cod_marca = %s",$marca);
		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ('Erro: <br>'.$objConexao->errorInfo().'<br> SQL: ' . $SQL);				
	}
	
	public function editaPopulares($arrModelos) {
		$objConexao = new fla_conexao();
		
		// Transformando a variavel passado por parametro em um array
		$arrModelos = (array) $arrModelos;
		$modelos_populares = 0;
		
		// Setando todos os veiculos para indisponivel
		$SQL = "UPDATE fla_modelos SET ind_popular = 0";

		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ($objConexao->errorInfo());
		
		// Pegando o código dos veiculos que estão selecionados como disponivel
		if (count($arrModelos)) {
			$modelos_populares = implode(",",$arrModelos);
		}
		
		// Setando os modelos do array para ativos
		$SQL = sprintf("UPDATE fla_modelos SET ind_popular = 1 WHERE cod_modelo IN (%s)",$modelos_populares);
		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ('Erro: <br>'.$objConexao->errorInfo().'<br> SQL: ' . $SQL);			
	}
	
	public function excluirModelos($arrModelos) {
		$objConexao = new fla_conexao();
		
		// Transformando a variavel passado por parametro em um array
		$arrModelos = (array) $arrModelos;

		// Pegando o código dos veiculos que estão selecionados como disponivel
		if (count($arrModelos)) {
			$modelos_populares = implode(",",$arrModelos);
		}
		
		// Setando os modelos do array para ativos
		$SQL = sprintf("DELETE FROM fla_modelos WHERE cod_modelo IN (%s)",$modelos_populares);
		$rsModelos = $objConexao->prepare($SQL);
		$rsModelos->execute() or die ('Erro: <br>'.$objConexao->errorInfo().'<br> SQL: ' . $SQL);			
	}	
}	
?>