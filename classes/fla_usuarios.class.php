<?php
  include_once($path_classes.'fla_conexao.class.php');
  class fla_usuarios {
      private $cod_usuario;
      private $nom_usuario;
      private $des_login;
      private $des_senha;
      private $ind_ativo;
      private $cod_tipo;
      
      public function set_cod_usuario($cod_usuario) {
        $this->cod_usuario = $cod_usuario;
      }
      
      public function set_nom_usuario($nom_usuario) {
        $this->nom_usuario = $nom_usuario;
      }
      
      public function set_des_login($des_login) {
          $this->des_login = $des_login;
      }
      
      public function set_des_senha($des_senha) {
          $this->des_senha = $des_senha;
      }
      
      public function set_ind_ativo($ind_ativo) {
          $this->ind_ativo = $ind_ativo;
      }
      
      public function set_cod_tipo($cod_tipo) {
          $this->cod_tipo = $cod_tipo;
      }
      
      
      public function get_cod_usuario() {
          return $this->cod_usuario;
      }
      
      public function get_nom_usuario() {
          return $this->nom_usuario;
      }
      
      public function get_des_login() {
          return $this->des_login;
      }
      
      public function get_des_senha() {
          return $this->des_senha;
      }
      
      public function get_ind_ativo() {
          return $this->ind_ativo;
      }
      
      public function get_cod_tipo() {
          return $this->cod_tipo;
      }      
      
      public function insereUsuarios($objUsuarios) {
          $objConexao = new fla_conexao();
          $SQL = sprintf(
                           "INSERT INTO 
                                fla_usuarios 
                            (
                                nom_usuario,
                                des_login,
                                des_senha,
                                ind_ativo,
                                cod_tipo
                            ) 
                            VALUES
                            (
                                '%s',
                                '%s',
                                '%s',
                                %s,
								%s								
                            )",
                            $objUsuarios->get_nom_usuario(),
                            $objUsuarios->get_des_login(),
                            $objUsuarios->get_des_senha(),
                            $objUsuarios->get_ind_ativo(),
                            $objUsuarios->get_cod_tipo()
                         );			 
          $query = $objConexao->prepare($SQL);
		  $query->Execute();                         
      }
      
      public function editaUsuario($objUsuarios) {
        $objConexao = new fla_conexao();
        $SQL = sprintf("
                           UPDATE 
                               fla_usuarios
                           SET
                               nom_usuario = '%s',
                               des_login = '%s',
                               des_senha = '%s',                               
                               ind_ativo = %s,
                               cod_tipo = %s
                            WHERE   
                                cod_usuario = %s",
                            $objUsuarios->get_nom_usuario(),
                            $objUsuarios->get_des_login(),
                            $objUsuarios->get_des_senha(),
                            $objUsuarios->get_ind_ativo(),
                            $objUsuarios->get_cod_tipo(),
                            $objUsuarios->get_cod_usuario());
          $query = $objConexao->prepare($SQL);
		  $query->Execute(); 
      }
      
      public function buscaUsuarios($objUsuario) {
            $objConexao = new fla_conexao();
    		if ($objUsuario->get_cod_usuario() != "" ) {
    		    $where = " WHERE cod_usuario = " . $objUsuario->get_cod_usuario();
    		}
            
            // Query SQL
            $SQL = "SELECT
                      cod_usuario,
                      nom_usuario,
                      des_login,
                      des_senha,
                      cod_tipo,
                      ind_ativo
                    FROM
                      fla_usuarios
				    " . $where . " 	
				      ORDER BY
					       nom_usuario";
					 
    		$rsUsuarios = $objConexao->prepare($SQL);
    		$rsUsuarios->execute() or die ($objConexao->errorInfo());
    		$arrUsuarios = array();
    		$aux = 0;
    		while($cliente = $rsUsuarios->fetch(PDO::FETCH_ASSOC)){
    			$arrUsuarios[$aux]['cod_usuario']  = $cliente['cod_usuario'];
    			$arrUsuarios[$aux]['nom_usuario']  = $cliente['nom_usuario'];
    			$arrUsuarios[$aux]['des_login']    = $cliente['des_login'];
    			$arrUsuarios[$aux]['des_senha']    = $cliente['des_senha'];
    			$arrUsuarios[$aux]['cod_tipo']     = $cliente['cod_tipo'];
    			$arrUsuarios[$aux]['ind_ativo']    = $cliente['ind_ativo'];
    			$aux++;
    		}
    		return $arrUsuarios;					       
      }

        public function logaUsuario($objUsuarios) {
            $objConexao = new fla_conexao();
            $SQL = sprintf("SELECT 
                                nom_usuario,
                                ind_ativo,
                                cod_tipo
                            FROM
                                fla_usuarios
                            WHERE
                                des_login = '%s'
                                AND 
                                des_senha = '%s'"
                                , $objUsuarios->get_des_login()
                                , $objUsuarios->get_des_senha());
            $rsUsuario = $objConexao->query($SQL);
            $aux = 0;
            $arrUsuario;
            while($usuario = $rsUsuario->fetch(PDO::FETCH_ASSOC)) { 
                $arrUsuario[$aux]['nom_usuario'] = $usuario['nom_usuario'];
                $arrUsuario[$aux]['ind_ativo'] = $usuario['ind_ativo'];
                $arrUsuario[$aux]['cod_tipo'] = $usuario['cod_tipo'];
                $aux++;
            }
            return $arrUsuario;
        }
  }
?>