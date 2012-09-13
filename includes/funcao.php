<?php
    function calculaMinutos($data1,$data2) {
        //$arrHor1 = explode(":",$data1);
        //$arrHor2 = explode(":",$data2);
		
        ///$minutos_1 = ($arrHor1[0] * 60) + $arrHor1[1];
		
        //$minutos_2 = ($arrHor2[0] * 60) + $arrHor2[1];
		$ano1    = substr($data1,0,4);
		$mes1    = substr($data1,5,2);
		$dia1    = substr($data1,8,2);
		$hora1   = substr($data1,11,2);
		$minuto1 = substr($data1,14,2);
		$minutos_1 = mktime($hora1,$minuto1,00,$mes1,$dia1,$ano1);
		
		$ano2    = substr($data2,0,4);
		$mes2    = substr($data2,5,2);
		$dia2    = substr($data2,8,2);
		$hora2   = substr($data2,11,2);
		$minuto2 = substr($data2,14,2);
		
		$minutos_2 = mktime($hora2,$minuto2,00,$mes2,$dia2,$ano2);
		
        $diferenca = ($minutos_2 - $minutos_1);
		
		$diferenca = $diferenca / 60;
		
        return $diferenca;
    }

    function mostraData ($data) {
        if ($data!='') {
            return (substr($data,8,2).'/'.substr($data,5,2).'/'.substr($data,0,4));
        }
        else {
            return '';
        }
   }

    // Passando data do text box "DD/MM/AAAA" para "AAAA-MM-DD"
    function gravaData ($data) {
        if ($data != '') {
            $arrData = explode("/",$data);
            return $arrData[2].'/'.$arrData[1].'/'.$arrData[0];
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

        // Matemática da quinta série
        // Detalhe: Aqui também pode se usar o abs()
        if ($mins < 0)
            $horas *= -1; 

        // Separa a hora dos minutos
        $sep = explode('.', $horas); 
        $h = $sep[0]; 
        if (empty($sep[1]))
            $sep[1] = 00; 

        $m = $sep[1]; 

        // Aqui um pequeno artifício pra colocar um zero no final
        if (strlen($m) < 2)
            $m = $m . 0; 

        return sprintf('%02d:%02d', $h, $m); 
    }  	
    
    function existeDiretorio($periodo,$caminho) {
        if ($periodo == "A") {
            if (!is_dir($caminho.date("Y"))){
                mkdir($caminho.date("Y"),0777);
            }
        }
        
        if ($periodo == "M") {
            if (!is_dir($caminho.date("m"))){
                mkdir($caminho.date("m"),0777);
            }
        }        
    }
?>
