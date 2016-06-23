
var req;

function validarDados(campo, valor) {

	if(window.XMLHttpRequest) {
		req	= new XMLHttpRequest();
	}
	
	else if(window.ActiveXObject) {
		req = new ActiveXObject("Microsoft.XMLHTTP");
	}
	

	var url = "http://localhost/site/validacao.php?campo="+campo+"&valor="+valor;
	
	
	req.open("Get", url, true); 

	req.onreadystatechange = function() {
	
		if(req.readyState == 1) {
			document.getElementById('campo_' + campo + '').innerHTML = '<font color="gray">Verificando...</font>';
		}
	
		
		if(req.readyState == 4 && req.status == 200) {
	        
			var resposta = req.responseText;
			
			document.getElementById('campo_'+ campo +'').innerHTML = resposta;
		}
	
	}
	
	req.send(null);
	
}