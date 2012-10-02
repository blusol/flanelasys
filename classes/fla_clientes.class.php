<?php
//include_once('../../includes/config.php');
include_once($path_classes.'fla_conexao.class.php');

class fla_clientes {
    private $cod_cliente;
    private $nom_cliente;
    private $des_cor;
    private $cod_modelo;
    private $cod_marca;
    
    public function get_cod_cliente() {
        return $this->cod_cliente;
    }
    
    public function set_cod_cliente($cod_cliente) {
        $this->cod_cliente = $cod_cliente;
    }
    
    public function get_nom_cliente() {
        return $this->nom_cliente;
    }
    
    public function set_nom_cliente($nom_cliente) {
		if ($nom_cliente == "") {
			$this->nom_cliente = "Não Informado";
		} else {
			$this->nom_cliente = $nom_cliente;
		}
    }
    
    public function get_des_cor() {
        return $this->des_cor;
    }
    
    public function set_des_cor($des_cor) {
        $this->des_cor = $des_cor;
    }
    
    public function get_des_placa() {
        return $this->des_placa;
    }
    
    public function set_des_placa($des_placa) {
        $this->des_placa = $des_placa;
    }
    
    public function get_cod_modelo() {
        return $this->cod_modelo;
    }
    
    public function set_cod_modelo($cod_modelo) {
        $this->cod_modelo = $cod_modelo;
    }
    
    public function get_cod_marca() {
        return $this->cod_marca;
    }
    
    public function set_cod_marca($cod_marca) {
        $this->cod_marca = $cod_marca;
    }
    
    public function insereCliente($objCliente) {
        $objConexao = new fla_conexao();

        // Verifica se o cliente já está cadastrado
        $SQL = "SELECT
                    cod_cliente
                FROM
                    fla_clientes
                WHERE
                    des_placa = '" . $objCliente->get_des_placa()."'";			
        $cliente = $objConexao->prepare($SQL);
        $cliente->Execute();
        if ($cliente->rowCount() == 0) {
            $SQL = sprintf('INSERT INTO fla_clientes
                            (cod_cliente
                             ,nom_cliente
                             ,des_cor
                             ,des_placa
                             ,cod_modelo
                             ,cod_marca)
                             VALUES
                             (0,"%s","%s","%s",%s,%s)'
                            , $objCliente->get_nom_cliente()
                            , $objCliente->get_des_cor()
                            , $objCliente->get_des_placa()
                            , $objCliente->get_cod_modelo()
                            , $objCliente->get_cod_marca()
                          );			  
            $query = $objConexao->prepare($SQL);
            $query->Execute();
        }

    }
	
	public function editaCliente($objCliente) {
		$objConexao = new fla_conexao();
		$SQL = sprintf('UPDATE 
					fla_clientes 
				SET
					nom_cliente = "%s",
					des_cor     = %s,
					des_placa   = "%s",
					cod_modelo  = %s,
					cod_marca   = %s
				WHERE	
					cod_cliente = %s'
				,$objCliente->get_nom_cliente()
				,$objCliente->get_des_cor()
				,$objCliente->get_des_placa()
				,$objCliente->get_cod_modelo()
				,$objCliente->get_cod_marca()
				,$objCliente->get_cod_cliente());
	
		$query = $objConexao->prepare($SQL);
        $query->Execute();
	}
	
	public function buscaClientes($objCliente) {
		$objConexao = new fla_conexao();
		
		if ($objCliente->get_cod_cliente() != "") {
		    $where = " WHERE cod_cliente = " . $objCliente->get_cod_cliente();
		}
		
		// Query SQL
		$SQL = "SELECT
					cli.cod_cliente,
					cli.nom_cliente,
					cli.des_placa,
					cor.cod_cor,
					cor.des_cor,
					cli.cod_modelo,
					modelo.des_modelo,
					cli.cod_marca,
					mar.des_marca
				FROM
					fla_clientes cli
					LEFT JOIN fla_cores cor ON (cli.des_cor = cor.cod_cor)
					LEFT JOIN fla_modelos modelo ON (cli.cod_modelo = modelo.cod_modelo)
					LEFT JOIN fla_marcas mar ON (cli.cod_marca = mar.cod_marca)
				" . $where . " 	
				ORDER BY
					cli.nom_cliente";
		$rsClientes = $objConexao->prepare($SQL);
		$rsClientes->execute() or die ($objConexao->errorInfo());
		$arrClientes = array();
		$aux = 0;
		while($cliente = $rsClientes->fetch(PDO::FETCH_ASSOC)){
			$arrClientes[$aux]['cod_cliente']  = $cliente['cod_cliente'];
			$arrClientes[$aux]['nom_cliente']  = $cliente['nom_cliente'];
			$arrClientes[$aux]['des_placa']    = $cliente['des_placa'];
			$arrClientes[$aux]['cod_cor']      = $cliente['cod_cor'];
			$arrClientes[$aux]['des_cor']      = $cliente['des_cor'];
			$arrClientes[$aux]['cod_modelo']   = $cliente['cod_modelo'];
			$arrClientes[$aux]['des_modelo']   = $cliente['des_modelo'];
			$arrClientes[$aux]['cod_marca']    = $cliente['cod_marca'];
			$arrClientes[$aux]['des_marca']    = $cliente['des_marca'];
			$aux++;
		}
		return $arrClientes;		
	}
    
}
?>
