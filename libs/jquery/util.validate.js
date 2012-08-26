function isCnpj(cnpj) {
	var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
	if (cnpj.length == 0) {
		return false;
	}
	
	cnpj = cnpj.replace(/\D+/g, '');
	digitos_iguais = 1;

	for (i = 0; i < cnpj.length - 1; i++)
		if (cnpj.charAt(i) != cnpj.charAt(i + 1)) {
			digitos_iguais = 0;
			break;
		}
	if (digitos_iguais)
		return false;
	
	tamanho = cnpj.length - 2;
	numeros = cnpj.substring(0,tamanho);
	digitos = cnpj.substring(tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}
	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	if (resultado != digitos.charAt(0)){
		return false;
	}
	tamanho = tamanho + 1;
	numeros = cnpj.substring(0,tamanho);
	soma = 0;
	pos = tamanho - 7;
	for (i = tamanho; i >= 1; i--) {
		soma += numeros.charAt(tamanho - i) * pos--;
		if (pos < 2)
			pos = 9;
	}

	resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	
	return (resultado == digitos.charAt(1));
}

function isCnpjFormatted(cnpj) {
	var validCNPJ = /\d{2,3}.\d{3}.\d{3}\/\d{4}-\d{2}/;
	return cnpj.match(validCNPJ);
}


function isCpf(cpf){
    exp = /\.|-/g;
    cpf = cpf.toString().replace(exp, "");
    var digitoDigitado = eval(cpf.charAt(9)+cpf.charAt(10));
    var digitoGerado = 0;
    var soma1=0, soma2=0;
    var vlr =11;

    for(i=0;i<9;i++){
        soma1 += eval(cpf.charAt(i)*(vlr-1));
        soma2 += eval(cpf.charAt(i)*vlr);
        vlr--;
    }
	
    soma1 = (soma1%11) < 2 ? 0 : 11 - (soma1%11);
    aux = soma1 * 2;
    soma2 = soma2 + aux;
    soma2 = (soma2%11) < 2 ? 0 : 11 - (soma2%11);
   
   if(cpf == "11111111111" || cpf == "22222222222" || cpf ==
			"33333333333" || cpf == "44444444444" || cpf == "55555555555" || cpf ==
			"66666666666" || cpf == "77777777777" || cpf == "88888888888" || cpf ==
			"99999999999" || cpf == "00000000000" ){
	digitoGerado = null;
    }else{
        digitoGerado = eval(soma1.toString().charAt(0) + soma2.toString().charAt(0));
    }
	
	if(digitoGerado != digitoDigitado){
       return false;
    }
    return true;
}
function isCpfFormatted(cpf) {
	var validCPF = /^\d{3}\.\d{3}\.\d{3}\-\d{2}$/;
	return cpf.match(validCPF);
}

(function($) {
	$.validator.addMethod("cpf", function(value, element, type) {
		if (value == "")
			return true;
		
		if ((type == 'format' || type == 'both') && !isCpfFormatted(value))
			return false;
		else
			return ((type == 'valid' || type == 'both')) ? isCpf(value) : true;
		
	}, function(type,element) {
		return (type == 'format' || (type == 'both' && !isCpfFormatted($(element).val()))) ?
				'Formato do CPF não é válido' : 'Por favor digite um CPF válido';
	});
	$.validator.addMethod("cnpj", function(value, element, type) {
		if (value == "")
			return true;
		
		if ((type == 'format' || type == 'both') && !isCnpjFormatted(value))
			return false;
		else
			return ((type == 'valid' || type == 'both')) ? isCnpj(value) : true;
		
	}, function(type,element) {
		return (type == 'format' || (type == 'both' && !isCnpjFormatted($(element).val()))) ?
				'Formato do CNPJ não é válido' : 'Por favor digite um CNPJ válido';
	});
})(jQuery);