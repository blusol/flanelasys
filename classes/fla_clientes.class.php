<?php
//include_once('../../includes/config.php');
include_once($path_classes.'fla_conexao.class.php');

class fla_clientes {
    private $data = array();
    public $declared = 1;
    private $hidden = 2;
    /*private $cod_cliente;
    private $nom_cliente;
    private $des_cor;
    private $cod_modelo;
    private $cod_marca;
    private $des_placa;
    private $cpf_cnpj_cliente;
    private $insc_municipal_cliente;
    private $insc_estadual_cliente;
    private $email_cliente;
    private $cep_cliente;
    private $tip_rua_cliente;
    private $des_end_cliente;
    private $num_end_cliente;
    private $com_end_cliente;
    private $bairro_end_cliente;
    private $estado_cliente;
    private $cidade_cliente;
    private $tipo_cliente;*/

    public function __set($name, $value) {
        $this->data[$name] = $value;
    }
    
    public function __get($name) {
        if (array_key_exists($name, $this->data)) {
            return $this->data[$name];
        }

        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $name .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE);
        return null;
     }
    /*public function get_cod_cliente() {
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
    }*/
    
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
					cod_marca   = %s,
                                        cpf_cnpj_cliente = %s,
                                        insc_municipal_cliente = %s,
                                        insc_estadual_cliente = %s,
                                        email_cliente = "%s",
                                        cep_cliente = "%s",
                                        tip_rua_cliente = "%s",
                                        des_end_cliente = "%s",
                                        num_end_cliente = %s,
                                        com_end_cliente = "%s",
                                        bairro_end_cliente = "%s",
                                        estado_cliente = "%s",
                                        cidade_cliente = "%s",
                                        tipo_cliente = "%s"                                        
				WHERE	
					cod_cliente = %s'
				,$objCliente->nom_cliente
				,$objCliente->des_cor
				,$objCliente->des_placa
				,$objCliente->cod_modelo
				,$objCliente->cod_marca
                                ,$objCliente->cpf_cnpj_cliente
                                ,$objCliente->insc_municipal_cliente
                                ,$objCliente->insc_estadual_cliente
                                ,$objCliente->email_cliente
                                ,$objCliente->cep_cliente
                                ,$objCliente->tip_rua_cliente
                                ,$objCliente->des_end_cliente
                                ,$objCliente->num_end_cliente
                                ,$objCliente->com_end_cliente
                                ,$objCliente->bairro_end_cliente
                                ,$objCliente->estado_cliente
                                ,$objCliente->cidade_cliente
                                ,$objCliente->tipo_cliente                                
				,$objCliente->cod_cliente);
		$query = $objConexao->prepare($SQL);
        $query->Execute();
	}
	
	public function buscaClientes($objCliente) {
		$objConexao = new fla_conexao();
		
		if ($objCliente->cod_cliente != "") {
		    $where = " WHERE cod_cliente = " . $objCliente->cod_cliente;
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
