// JavaScript Document 
// FUN��O RESPONS�VEL DE CONECTAR A UMA PAGINA EXTERNA NO NOSSO CASO A BUSCA_NOME.PHP E RETORNAR OS RESULTADOS 
function ajax( url )
{
    req = null;
    // Procura por um objeto nativo (Mozilla/Safari)
    if (window.XMLHttpRequest) {
        req = new XMLHttpRequest();
        req.onreadystatechange = processReqChange;
        req.open("GET",url,true);
        req.send(null);
        // Procura por uma vers�o ActiveX (IE)
    }else if (window.ActiveXObject){
        req = new ActiveXObject("Microsoft.XMLHTTP");
        if (req){
            req.onreadystatechange = processReqChange;
            req.open("GET",url,true);
            req.send();
        }
    }
}

// Verificando se foi inserida a justificativa caso o valor cobrado seja menor que o valor total
function validaEntradaVeiculos() {
	var val_cobrado = document.form.val_cobrado.value;
	var val_total   = document.form.val_total.value;
	var des_justificativa = document.form.des_justificativa.value;
	var cod_desconto = document.form.cod_desconto.selectedIndex;
	var cod_cartao = document.form.cod_cartao.value;

	// Verificando se o valores s�o diferentes
	if (val_cobrado != val_total) {	
		// Verifica se foi aplicado algum desconto
		if (cod_desconto != 0) {
			document.form.des_justificativa.value = document.form.cod_desconto.options[cod_desconto].text;
		} else {
			if (des_justificativa == "") {
				alert('Por favor, justifique porque foi cobrado um valor diferente');
				document.form.des_justificativa.focus();
				return false;
			}
		}
	}
	
	// Verificando se foi inserido o c�digo do cart�o
	if (cod_cartao == "") {
		alert('Por favor insira o n�mero do cart�o');
		document.form.cod_cartao.focus();
		return false;
	}
	
	
}				


var timeout         = 500;
var closetimer		= 0;
var ddmenuitem      = 0;

function jsddm_open()
{	jsddm_canceltimer();
		jsddm_close();
		ddmenuitem = $(this).find('ul').eq(0).css('visibility', 'visible');}

function jsddm_close()
{	if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

function jsddm_timer()
{	closetimer = window.setTimeout(jsddm_close, timeout);}

function jsddm_canceltimer()
{	if(closetimer)
		{	window.clearTimeout(closetimer);
				closetimer = null;}}

$(document).ready(function()
{	$('#jsddm > li').bind('mouseover', jsddm_open);
		$('#jsddm > li').bind('mouseout',  jsddm_timer);});

document.onclick = jsddm_close;


function showHide(obj,action) {
 var el = document.getElementById(obj);
 el.style.display = action;
}


function exibeModeloSelect(id_marca,id_modelo) {
		/*$.ajax(
				{
				  type: "POST",
				  url: "processa.php",
				  data: "acao=exibeModeloSelect&id_marca=" + id_marca + "&id_modelo="+id_modelo,
				  beforeSend: function() {
						// enquanto a fun��o esta sendo processada, voc�
						// pode exibir na tela uma
						// msg de carregando
				  },
				  success: function(txt) {
						// pego o id da div que envolve o select com
						// name="id_modelo" e a substituiu
						// com o texto enviado pelo php, que � um novo
						//select com dados da marca x
						$('#ajax_marca').html(txt);
				  },
				  error: function(txt) {
						// em caso de erro voc� pode dar um alert('erro');
				  }
				}
		);*/
		
$(document).ready(function(){

        $.ajax({
			type: "POST",
			url: "processa.php",
			data: "acao=exibeModeloSelect&id_marca=" + id_marca + "&id_modelo="+id_modelo,
            success: function(msg){
                if (msg != ''){
                    $("#cod_modelo").html(msg).show();
                    $("#result").html('');
                }
                else{
                    $("#result").html('<em>No item result</em>');
                }
            }
        });
});		
 }

function clearAll(){
	document.getElementById('des_placa').value = "";
	document.getElementById('des_placa2').value = "";
	document.getElementById('cod_marca').options[0].selected = true;
	document.getElementById('cod_modelo').options[0].selected = true;
	document.getElementById('des_cor').options[0].selected = true;
	document.getElementById('cod_preco').options[0].selected = true;
	document.getElementById('hor_saida').value = "";
	document.getElementById('tem_permanencia').value = "";
	document.getElementById('cod_desconto').options[0].selected = true;	
	document.getElementById('val_total').value = "";
	document.getElementById('val_cobrado').value = "";
	document.getElementById('val_cobrado2').value = "";
	document.getElementById('des_justificativa').value = "";
	document.getElementById('codigo_modelo').value = "";
	document.getElementById('dat_entrada').value = ""
	showHide('data_entrada','hidden');
	
	document.getElementById('cod_desconto').disabled = false;					
	document.getElementById('val_cobrado').disabled = false;										
	document.getElementById('des_justificativa').disabled = false;	
	document.getElementById('des_situacao').value = "P";
	
	
}
 
 
// Fun��o para marcar/desmarcar todos os veiculos como Ativo
$(document).ready(function() {
	$('#selecionar_ativos').click(function() {
		if(this.checked == true){
			$("input[id=ind_disponivel]").each(function() { 
				this.checked = true; 
			});
		} else {
			$("input[id=ind_disponivel]").each(function() { 
				this.checked = false; 
			});
		}
	});	
});

// Fun��o para marcar/desmarcar todos os veiculos como popular
$(document).ready(function() {
	$('#selecionar_popular').click(function() {
		if(this.checked == true){
			$("input[id=ind_popular]").each(function() { 
				this.checked = true; 
			});
		} else {
			$("input[id=ind_popular]").each(function() { 
				this.checked = false; 
			});
		}
	});	
});
 
function processReqChange() { 

	// apenas quando o estado for "completado" 
	if (req.readyState == 4) { 
		// apenas se o servidor retornar "OK" 
		if (req.status ==200) { 
			// procura pela div id="pagina" e insere o conteudo 
			// retornado nela, como texto HTML 
			
				var myArray = eval(req.responseText);
				var posicao = url.indexOf(".php");
				var acao = url.slice(0,posicao);
				//alert(acao);
				if (acao == "consulta_cartao") {
					if (myArray !== undefined) {
						if (myArray[0] !== "" || myArray[9] === "P") {
							document.getElementById('des_placa').value = myArray[0];
							document.getElementById('des_placa2').value = myArray[0];
							document.getElementById('hor_entrada').value = myArray[1]; 
							var arrCodMarca  = document.getElementById('cod_marca');
							for (i=0;i<arrCodMarca.length;i++) {
								 if (arrCodMarca.options[i].value == myArray[2]) {
									arrCodMarca.options[i].selected = true;
								 }
								 
							}
							exibeModeloSelect(myArray[2],myArray[3]);
							var arrDesCor = document.getElementById('des_cor');				
							for (i=0;i<arrDesCor.length;i++) {
								if (arrDesCor.options[i].value == myArray[4]) {
									arrDesCor.options[i].selected = true;
								}					 
							}	

							var arrTipPreco = document.getElementById('cod_preco');
							for (i=0;i<arrTipPreco.length;i++) {
								if (arrTipPreco.options[i].value == myArray[5]) {
									arrTipPreco.options[i].selected = true;
								}					 
							}
                            
							document.getElementById('val_total').value = myArray[6];
							document.getElementById('val_cobrado').value = myArray[6];
							document.getElementById('val_cobrado2').value = 'R$ ' + myArray[6];
							document.getElementById('hor_saida').value = myArray[7];
							document.getElementById('tem_permanencia').value = myArray[8];
							document.getElementById('des_justificativa').value = myArray[10];
							if (myArray[11] != "") {
								document.getElementById('dat_entrada').value = myArray[11];
								showHide('data_entrada','');
							}
                            document.getElementById('des_situacao').value = "L";
							
						} else {
							clearAll();							
						}						
					}
				}
			 
				if (acao == "consulta_desconto") {
					if (myArray !== undefined) {						
						document.getElementById('val_cobrado').value = myArray[2];
						document.getElementById('val_cobrado2').value = 'R$ ' + myArray[2];
						document.getElementById('des_justificativa').value = myArray[0];
					}
				}
				
				if (acao == "consulta_placa") {
					if (myArray !== undefined) {										
						var arrCodMarca  = document.getElementById('cod_marca');
						for (i=0;i<arrCodMarca.length;i++) {
							 if (arrCodMarca.options[i].value == myArray[0]) {
								arrCodMarca.options[i].selected = true;
							 }
							 
						}
						exibeModeloSelect(myArray[0],myArray[1]);
						var arrDesCor = document.getElementById('des_cor');				
						for (i=0;i<arrDesCor.length;i++) {
							if (arrDesCor.options[i].value == myArray[2]) {
								arrDesCor.options[i].selected = true;
							}					 
						}							
					}
				}
			
		} else { 
			alert("Houve um problema ao obter os dados:n" + req.statusText); 
		} 
	} 
} 
