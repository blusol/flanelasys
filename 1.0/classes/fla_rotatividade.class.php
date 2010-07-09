<?php
include_once('../includes/config.php');
include_once($path_classes.'fla_conexao.class.php');
class fla_rotatividade {
        private $cod_rotativade;
        private $des_placa;
        private $hor_entrada;
        private $hor_saida;
        private $dat_cadastro;
        private $cod_preco;
        private $val_total;
        private $val_cobrado;
        private $des_justificativa;
		private $tem_permanencia;
        private $des_situacao;
        private $cod_cartao;

        public function get_cod_rotativade() {
            return $this->cod_rotativade;
        }

        public function set_cod_rotativade($cod_rotativade) {
            $this->cod_rotativade = $cod_rotativade;
        }

        public function get_des_placa() {
            return $this->des_placa;
        }

        public function set_des_placa($des_placa) {
            $this->des_placa = $des_placa;
        }

        public function get_hor_entrada() {
            return $this->hor_entrada;
        }

        public function set_hor_entrada($hor_entrada) {
            $this->hor_entrada = $hor_entrada;
        }

        public function get_hor_saida() {
            return $this->hor_saida;
        }

        public function set_hor_saida($hor_saida) {
            $this->hor_saida = $hor_saida;
        }

        public function get_dat_cadastro() {
            return $this->dat_cadastro;
        }

        public function set_dat_cadastro($dat_cadastro) {
            $this->dat_cadastro = $dat_cadastro;
        }

        public function get_cod_preco() {
            return $this->cod_preco;
        }

        public function set_cod_preco($cod_preco) {
            $this->cod_preco = $cod_preco;
        }

        public function get_val_total() {
            return $this->val_total;
        }

        public function set_val_total($val_total) {
            $this->val_total = $val_total;
        }

        public function get_val_cobrado() {
            return $this->val_cobrado;
        }

        public function set_val_cobrado($val_cobrado) {
            $this->val_cobrado = $val_cobrado;
        }

        public function get_des_justificativa() {
            return $this->des_justificativa;
        }

        public function set_des_justificativa($des_justificativa) {
            $this->des_justificativa = $des_justificativa;
        }

        public function get_des_situacao() {
            return $this->des_situacao;
        }

        public function set_des_situacao($des_situacao) {
            $this->des_situacao = $des_situacao;
        }

        public function get_cod_cartao() {
            return $this->cod_cartao;
        }

        public function set_cod_cartao($cod_cartao) {
            $this->cod_cartao = $cod_cartao;
        }

		public function set_tem_permanencia($tem_permanencia) {
			$this->tem_permanencia = $tem_permanencia;
		}
		
		public function get_tem_permanencia() {
			return $this->tem_permanencia;
		}
		
        public function insereRotatividade($objRotatividade) {
              $objConexao = new fla_conexao();
			  // Verificando 
			$SQL = sprintf('INSERT INTO
								fla_rotatividade
							  (des_placa,hor_entrada,dat_cadastro,cod_preco,cod_cartao,des_situacao)
								VALUES
								("%s","%s","%s","%s",%s,"%s")',
							$objRotatividade->get_des_placa(),
							$objRotatividade->get_hor_entrada(),
							$objRotatividade->get_dat_cadastro(),
							$objRotatividade->get_cod_preco(),
							$objRotatividade->get_cod_cartao(),
							$objRotatividade->get_des_situacao());								
				 $query = $objConexao->prepare($SQL) or die ($objConexao->errorInfo());
				 $query->Execute();
		}
		
		public function removeRotatividade($objRotatividade) {
			$objConexao = new fla_conexao();
			$SQL = sprintf('UPDATE 
								fla_rotatividade
							SET
								hor_saida = "%s"
								, val_total = "%s"
								, val_cobrado = "%s"
								, des_justificativa = "%s"
								, tem_permanencia = "%s"
								, des_situacao = "L"
							WHERE
								cod_cartao = %s
						   ',$objRotatividade->get_hor_saida()
						    ,$objRotatividade->get_val_total()
							,$objRotatividade->get_val_cobrado()
							,$objRotatividade->get_des_justificativa()
							,$objRotatividade->get_tem_permanencia()
							,$objRotatividade->get_cod_cartao());

			$rsRemoveRotatividade = $objConexao->prepare($SQL);
			$rsRemoveRotatividade->execute();
		}
		
		// Metodo para verificar se um determinado carro já está estacionado
		public function buscaCarro($objRotatividade) {
			$objConexao = new fla_conexao();
			$SQL =	sprintf("select
						rot.cod_cartao
					from
						fla_rotatividade rot
					where
						rot.des_situacao = 'P'
						AND des_placa  = '%s'",$this->get_des_placa());
			$rsCarrosEstacionados = $objConexao->prepare($SQL);
			$rsCarrosEstacionados->execute();
			$count = $rsCarrosEstacionados->rowCount();
			if ($count > 0) {
				return false;
			} else {
				return true;
			}
		}
		
		public function buscaCarrosEstacionados() {
			$objConexao = new fla_conexao();			
			$SQL =	"select
						rot.cod_cartao,
						cli.des_placa,
						modelo.des_modelo,
                        rot.cod_preco
					from
						fla_clientes cli,
						fla_rotatividade rot,
						fla_modelos modelo
					where
						cli.des_placa = rot.des_placa
						and rot.des_situacao = 'P'
						and (cli.cod_modelo IS NULL OR modelo.cod_modelo = cli.cod_modelo)
					order by
						rot.hor_entrada DESC";
			
			$rsCarrosEstacionados = $objConexao->prepare($SQL);
			$rsCarrosEstacionados->execute();
			$arrCarrosEstacionados = array();
			$aux = 0;
			while($carrosEstacionados = $rsCarrosEstacionados->fetch(PDO::FETCH_ASSOC)){
				$arrCarrosEstacionados[$aux]['cod_cartao']  = $carrosEstacionados['cod_cartao'];
				$arrCarrosEstacionados[$aux]['des_placa']  = $carrosEstacionados['des_placa'];
				$arrCarrosEstacionados[$aux]['des_modelo'] = $carrosEstacionados['des_modelo'];
                $arrCarrosEstacionados[$aux]['cod_preco'] = $carrosEstacionados['cod_preco'];
				$aux++;
			}
			return $arrCarrosEstacionados;		
		}		
}
?>