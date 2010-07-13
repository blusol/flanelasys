<?php

include('../../includes/config.php');
//include($path_relative.'includes/conexao.php');
include_once($path_classes.'fla_conexao.class.php');

 // Para solicionar problema de ACENTOS
 header('Content-Type: text/html; charset=ISO-8859-1');

 function get_marcas() {

 	// Aqui criamos um array bidimensional, que poderá vi do banco de
	// dados da mesma forma
	// basta você fazer um select * from tabela_marca -> a tabela_marca
	// deve conter: id_marca, ds_marca
        $objConexao = new fla_conexao();
        $rsMarcas = $objConexao->query("SELECT cod_marca, UPPER(des_marca) as des_marca, ind_popular FROM fla_marcas WHERE ind_disponivel = 1 ORDER BY ind_popular DESC, des_marca");
	$marcas = array();
        $aux = 0;
        while($marca = $rsMarcas->fetch(PDO::FETCH_ASSOC)){
            $marcas[$aux]['id_marca'] = $marca['cod_marca'];
            $marcas[$aux]['ds_marca'] = $marca['des_marca'];
			$marcas[$aux]['ind_popular'] = $marca['ind_popular'];
            $aux++;
        }
        
        return $marcas;
 }

 function get_modelos($id_marca) {
	// Ao invés de buscar num array (é como estou fazendo aqui), você
	// pode da um select na tabela
	// do banco de dados que armazena o modelo, e retorna todos os
	//modelos da marca $id_marca
	// select * from tabela_modelo where id_marca = $id_marca -> a
	// abela_modelo deve conter: id_marca, id_modelo, ds_modelo
	// depois do select você retorna os dados do banco na função
        $objConexao = new fla_conexao();
        $SQL = "SELECT cod_modelo, UPPER(des_modelo) AS des_modelo, cod_marca, ind_popular FROM fla_modelos WHERE ind_disponivel = 1 and cod_marca = " . $id_marca .  " ORDER BY ind_popular DESC, des_modelo";
        $rsModelos = $objConexao->query($SQL);
        $tabela_modelo = array();
        $aux = 0;
        while($modelo = $rsModelos->fetch(PDO::FETCH_ASSOC)){
            $tabela_modelo[$aux]['id_marca'] = $modelo['cod_marca'];
            $tabela_modelo[$aux]['ds_modelo'] = $modelo['des_modelo'];
            $tabela_modelo[$aux]['id_modelo'] = $modelo['cod_modelo'];
			$tabela_modelo[$aux]['ind_popular'] = $modelo['ind_popular'];
            $aux++;
        }

	//$modelo = array();
	/*$cont = 0;
	for($i=0; $i < count($tabela_modelo); $i++) {
		if($tabela_modelo[$i]['id_marca'] == $id_marca) {
			$modelo[$cont]['id_marca']= $tabela_modelo[$i]['id_marca'];
			$modelo[$cont]['ds_modelo'] = $tabela_modelo[$i]['ds_modelo'];
			$cont++;
		}
	}*/
	return $tabela_modelo;
 }

 switch ($_POST['acao']) {
	case "exibeModeloSelect":
		$txt .= '<option value="0">Selecione o Modelo</option>';

                $modelo = get_modelos($_POST['id_marca']);

		if (!empty($_POST['id_modelo'])) {		
			$id_modelo = $_POST['id_modelo'];
		} else {
			$id_modelo = "";
		}
		
		$ind_popular = true;		
		for ($i=0;$i < count($modelo);$i++) {
		
		if ($ind_popular == true && $modelo[$i]['ind_popular'] == 0) {
			$txt .= '<option value="0"></option>';
			$ind_popular = false;
		}
		
		
			if ($id_modelo == $modelo[$i]['id_modelo']) {
				$txt .= '<option selected value="'.$modelo[$i]['id_modelo'].'">' . $modelo[$i]['ds_modelo'] . '</option>';
			} else {
				$txt .= '<option value="'.$modelo[$i]['id_modelo'].'">' . $modelo[$i]['ds_modelo'] . '</option>';			
			}
		}

		echo $txt;
	break;
 }
?>