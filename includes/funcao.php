<?php

$arrEstadosSiglas = array("AC", "AL", "AM", "AP", "BA", "CE", "DF", "ES", "GO", "MA", "MG", "MS", "MT", "PA", "PB", "PE", "PI", "PR", "RJ", "RN", "RO", "RR", "RS", "SC", "SE", "SP", "TO");
$arrTiposRuas = array("Outros", "Aeroporto", "Alameda", "�rea", "Avenida", "Campo", "Ch�cara", "Col�nia", "Condom�nio", "Conjunto", "Distrito", "Esplanada", "Esta��o", "Estrada", "Favela", "Fazenda", "Feira", "Jardim", "Ladeira", "Lago", "Lagoa", "Largo", "Loteamento", "Morro", "N�cleo", "Parque", "Passarela", "P�tio", "Pra�a", "Quadra", "Recanto", "Residencial", "Rodovia", "Rua", "Setor", "S�tio", "Travessa", "Trecho", "Trevo", "Vale", "Vereda", "Via", "Viaduto", "Viela", "Vila");

function calculaMinutos($data1, $data2) {
    $ano1 = substr($data1, 0, 4);
    $mes1 = substr($data1, 5, 2);
    $dia1 = substr($data1, 8, 2);
    $hora1 = substr($data1, 11, 2);
    $minuto1 = substr($data1, 14, 2);
    $minutos_1 = mktime($hora1, $minuto1, 00, $mes1, $dia1, $ano1);

    $ano2 = substr($data2, 0, 4);
    $mes2 = substr($data2, 5, 2);
    $dia2 = substr($data2, 8, 2);
    $hora2 = substr($data2, 11, 2);
    $minuto2 = substr($data2, 14, 2);

    $minutos_2 = mktime($hora2, $minuto2, 00, $mes2, $dia2, $ano2);

    $diferenca = ($minutos_2 - $minutos_1);

    $diferenca = $diferenca / 60;

    return $diferenca;
}

function mostraData($data) {
    if ($data != '') {
        return (substr($data, 8, 2) . '/' . substr($data, 5, 2) . '/' . substr($data, 0, 4));
    } else {
        return '';
    }
}

// Passando data do text box "DD/MM/AAAA" para "AAAA-MM-DD"
function gravaData($data) {
    if ($data != '') {
        $arrData = explode("/", $data);
        return $arrData[2] . '/' . $arrData[1] . '/' . $arrData[0];
    } else {
        return '';
    }
}

function m2h($mins) {
    // Se os minutos estiverem negativos
    if ($mins < 0)
        $min = abs($mins);
    else
        $min = $mins;

    // Arredonda a hora
    $h = floor($min / 60);
    $m = ($min - ($h * 60)) / 100;
    $horas = $h + $m;

    // Matem�tica da quinta s�rie
    // Detalhe: Aqui tamb�m pode se usar o abs()
    if ($mins < 0)
        $horas *= -1;

    // Separa a hora dos minutos
    $sep = explode('.', $horas);
    $h = $sep[0];
    if (empty($sep[1]))
        $sep[1] = 00;

    $m = $sep[1];

    // Aqui um pequeno artif�cio pra colocar um zero no final
    if (strlen($m) < 2)
        $m = $m . 0;

    return sprintf('%02d:%02d', $h, $m);
}

function existeDiretorio($periodo, $caminho) {
    if ($periodo == "A") {
        if (!is_dir($caminho . date("Y"))) {
            mkdir($caminho . date("Y"), 0777);
        }
    }

    if ($periodo == "M") {
        if (!is_dir($caminho . date("m"))) {
            mkdir($caminho . date("m"), 0777);
        }
    }
}

// Converte uma string para Hexadecimal
function strToHex($string) {
    $hex = '';
    for ($i = 0; $i < strlen($string); $i++) {
        $hex .= dechex(ord($string[$i]));
    }
    return $hex;
}

// Converte um texto em hexadecimal para string
function hexToStr($hex) {
    $string = '';
    for ($i = 0; $i < strlen($hex) - 1; $i+=2) {
        $string .= chr(hexdec($hex[$i] . $hex[$i + 1]));
    }
    return $string;
}

function imprimeCodigo($objeto, $nomeObjeto) {
    $arrAtributosClasse = get_class_methods($objeto);
    foreach ($arrAtributosClasse as $key => $value) {
        $prefixo_metodo = substr($value, 0, 3);
        $atributo = substr($value, 4);
        if ($prefixo_metodo == "set") {
            $a = "<br/>" . '$obj' . $nomeObjeto . '->' . $value . '(' . '$_POST["' . $atributo . '"])' . ";";
            echo $a;
        }
    }
}

function mascara_string($mascara, $string) {
    $string = str_replace(" ", "", $string);
    for ($i = 0; $i < strlen($string); $i++) {
        $mascara[strpos($mascara, "#")] = $string[$i];
    }
    return $mascara;
}

function simple_curl($url, $post = array(), $get = array()) {
    $url = explode('?', $url, 2);
    if (count($url) === 2) {
        $temp_get = array();
        parse_str($url[1], $temp_get);
        $get = array_merge($get, $temp_get);
    }

    $ch = curl_init($url[0] . "?" . http_build_query($get));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    return curl_exec($ch);
}

function limitar($string, $tamanho, $encode = 'UTF-8') {
    if (strlen($string) > $tamanho)
        $string = mb_substr($string, 0, $tamanho - 3, $encode) . '.';
    else
        $string = mb_substr($string, 0, $tamanho, $encode);

    return $string;
}

/*  Fun��o para remover a acentua��o e caracteres especiais de uma string
 *   Par�metros: $str -> String a ser verificada
  $caracter -> caracter  usado para substituir
  (sen�o for especificado substitui pela letra/caracter equivalente Ex. � = A, � = C)
  Fonte: http://caioariede.com/2008/removendo-acentuacao-com-php-removing-accentuation
 */

function remove_acentuacao($str, $caracter = "") {

   // $str = htmlentities($str);
	
	$str = preg_replace("[^a-zA-Z0-9_]", "", strtr($str, "��������������������������", "aaaaeeiooouucAAAAEEIOOOUUC"));
    return $str;
}

?>
