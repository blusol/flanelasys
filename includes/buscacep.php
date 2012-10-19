<?php
include_once('config.php');
include_once('funcao.php');
include_once($path_libraries .'jquery/php-query.php');

$logradouro = "";

if (isset($_GET['cep']) && !empty($_GET['cep']) && is_numeric($_GET['cep']) && (strlen($_GET['cep']) == 8) ) {
    $cep = trim($_GET['cep']);
} else {
    die('Sem permissão para acessar o arquivo');
}

$html = simple_curl('http://m.correios.com.br/movel/buscaCepConfirma.do',array(
	'cepEntrada'=>$cep,
	'tipoCep'=>'',
	'cepTemp'=>'',
	'metodo'=>'buscarCep'
));

phpQuery::newDocumentHTML($html, $charset = 'utf-8');
$errCEP= array('erro'=> trim(pq('.erro:eq(0)')->html()));
        
if(empty($errCEP["erro"])){
    $dados =
    array(
            'logradouro'=> trim(pq('.caixacampobranco .resposta:contains("Logradouro: ") + .respostadestaque:eq(0)')->html()),
            'bairro'=> trim(pq('.caixacampobranco .resposta:contains("Bairro: ") + .respostadestaque:eq(0)')->html()),
            'cidade/uf'=> trim(pq('.caixacampobranco .resposta:contains("Localidade / UF: ") + .respostadestaque:eq(0)')->html()),
            'cep'=> trim(pq('.caixacampobranco .resposta:contains("CEP: ") + .respostadestaque:eq(0)')->html())
    );

    $arrLogradouro = explode(" ",$dados['logradouro']);
    $dados['tipo'] = $arrLogradouro[0];

    for ($i = 1;$i < count($arrLogradouro);$i++) {
            $logradouro .= $arrLogradouro[$i]." ";
    }
    $dados['logradouro'] = $logradouro;
    //$dados['logradouro'] = iconv('ISO-8859-1','UTF-8',$dados["logradouro"]);
    $dados['logradouro'] = trim($dados['logradouro']);

    $dados['cidade/uf'] = explode('/',$dados['cidade/uf']);
    $dados['cidade'] = trim($dados['cidade/uf'][0]);
    $dados['uf'] = trim($dados['cidade/uf'][1]);
    unset($dados['cidade/uf']);

    die(json_encode($dados));
} else {
    $dados['erro'] = iconv("ISO-8859-1","UTF-8","CEP não localizado!");
    die(json_encode($dados));
}
?>
    