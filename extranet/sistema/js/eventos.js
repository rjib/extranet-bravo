//INICIO FUNCAO ABRE ABA
function AbreAba(nome_div){
        var total_divs = document.getElementsByTagName('div').length;
        var div = "";
        var td = "";

        for (var i=1; i < total_divs+1; i++){
            div = "div"+i;
            td = "td"+i;
            document.getElementById(div).style.display = "none"; 
            document.getElementById(td).style.backgroundColor = "";
            document.getElementById(div).className="div"; 

            if (div == nome_div){
                document.getElementById(nome_div).style.display = "block"; 
            }
        }
    }
//FIM FUNCAO ABRE ABA

//INICIO FUNCAO SHOW LINE
	function showLine(idLine){
		var line = document.getElementById("line_" + idLine);
		line.style.display = (line.style.display == "none") ? "" : "none";
	}
//FIM FUNCAO SHOW LINE

//INICIO FUNCAO NOME LINE
function NoneLine(idLine){
    document.getElementById("line_" + idLine).style.display = "none"; 		
}
//FIM FUNCAO NOME LINE

//INICIO FUNCAO CONFIRMA EXCLUSAO
  function confirmaExclusao(aURL) {
    if(confirm('Voc� tem certeza que deseja excluir?')) {
      location.href = aURL;
    }
  }
//FIM FUNCAO CONFIRMA EXCLUSAO

//INICIO PULA PARA A CAIXA DE TEXTO DEFINIDA AO ALCANCAR O TAMANHO MAXIMO DE CARACTERES
function pula(maxlength, idObj, idNext){
  var next = document.getElementById(idNext);
  var obj = document.getElementById(idObj);
  if (next.type.toLowerCase() == "text" || next.type.toLowerCase() == "password"){
     if(obj.value.length >= maxlength){
        next.select();
     }
  }else if (next.type.toLowerCase() == "select-one"){
      if(obj.value.length >= maxlength){
           next.focus();
         next.selectedIndex=0;
      }
  }else if (next.type.toLowerCase() == "submit"){
     if(obj.value.length >= maxlength){
         if (navigator.appName == "Microsoft Internet Explorer"){
             next.select();
         }else{
             next.focus();
         }
     }
  }
}
//FIM PULA PARA A CAIXA DE TEXTO DEFINIDA AO ALCANCAR O TAMANHO MAXIMO DE CARACTERES

//INICIO FUN��O PERMITE DIGITAR SOMENTE N�MERO EM DETERMINADOS CAMPOS
function isNum(caractere){
	var strValidos = "0123456789"
	if ( strValidos.indexOf( caractere ) == -1 )
	return false;
	return true;
}
function validaTecla(campo, event){
	var BACKSPACE= 8;
	var key;
	var tecla;
	CheckTAB=true;

	if(navigator.appName.indexOf("Netscape")!= -1) 
		tecla= event.which;
 	else
		tecla= event.keyCode;
		key = String.fromCharCode( tecla); 
		//alert( 'key: ' + tecla + ' -> campo: ' + campo.value);
	if (tecla == 13)
 		return false;
	if (tecla == BACKSPACE)
 		return true;
 		return (isNum(key));
 	}
//FIM FUN��O PERMITE DIGITAR SOMENTE N�MERO EM DETERMINADOS CAMPOS

//INICIO FUNCAO PARA CONTROLE DE ESTADO E CIDADES
   function BuscaCidade(valor) {
      //VERIFICA SE O BROWSER TEM SUPORTE A AJAX
	  try {
         ajax = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e) {
         try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
         }
	     catch(ex) {
            try {
               ajax = new XMLHttpRequest();
            }
	        catch(exc) {
               alert("Esse browser não tem recursos para uso do Ajax");
               ajax = null;
            }
         }
      }
	  //SE TIVER SUPORTE AJAX
	  if(ajax) {
	     //DEIXA APENAS O ELEMENTO 1 NO OPTION, OS OUTROS S�O EXCLUIDOS
		 document.forms[0].codigoCidade.options.length = 1;

		 idOpcao  = document.getElementById("opcoes");

	     ajax.open("POST", "inc/cidades_lista.php", true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		 ajax.onreadystatechange = function() {
            //enquanto estiver processando...emite a msg de carregando
			if(ajax.readyState == 1) {
			   idOpcao.innerHTML = "Carregando...";
	        }
			//ap�s ser processado - chama fun��o processXMLCidade que vai varrer os dados
            if(ajax.readyState == 4 ) {
			   if(ajax.responseXML) {
			      processXMLCidade(ajax.responseXML);
			   }
			   else {
			       //caso n�o seja um arquivo XML emite a mensagem abaixo
				   idOpcao.innerHTML = "--Primeiro selecione o estado--";
			   }
            }
         }
		 //passa o c�digo do estado escolhido
	     var params = "estado="+valor;
         ajax.send(params);
      }
   }

   function processXMLCidade(obj){
      //pega a tag cidade
      var dataArray   = obj.getElementsByTagName("cidade");

	  //total de elementos contidos na tag cidade
	  if(dataArray.length > 0) {
	     //percorre o arquivo XML paara extrair os dados
         for(var i = 0 ; i < dataArray.length ; i++) {
            var item = dataArray[i];
			//cont�udo dos campos no arquivo XML
			var codigo    =  item.getElementsByTagName("codigo")[0].firstChild.nodeValue;
			var descricao =  item.getElementsByTagName("descricao")[0].firstChild.nodeValue;

	        idOpcao.innerHTML = "Selecione uma das opcoes abaixo:";

			//cria um novo option dinamicamente
			var novo = document.createElement("option");
			    //atribui um ID a esse elemento
			    novo.setAttribute("id", "opcoes");
				//atribui um valor
			    novo.value = codigo;
				//atribui um texto
			    novo.text  = descricao;
				//finalmente adiciona o novo elemento
				document.forms[0].codigoCidade.options.add(novo);
		 }
	  }
	  else {
	    //caso o XML volte vazio, printa a mensagem abaixo
		idOpcao.innerHTML = "--Primeiro selecione o estado--";
	  }
   }
//FIM FUNCAO PARA CONTROLE DE ESTADO E CIDADES

//INICIO FUNCAO PARA CONTROLE DE CIDADE E BAIRROS
   function BuscaBairro(valor) {
      //VERIFICA SE O BROWSER TEM SUPORTE A AJAX
	  try {
         ajax = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e) {
         try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
         }
	     catch(ex) {
            try {
               ajax = new XMLHttpRequest();
            }
	        catch(exc) {
               alert("Esse browser n�o tem recursos para uso do Ajax");
               ajax = null;
            }
         }
      }
	  //SE TIVER SUPORTE AJAX
	  if(ajax) {
	     //DEIXA APENAS O ELEMENTO 1 NO OPTION, OS OUTROS S�O EXCLUIDOS
		 document.forms[0].codigoBairro.options.length = 1;

		 idOpcao  = document.getElementById("opcoes");

	     ajax.open("POST", "inc/bairros_lista.php", true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		 ajax.onreadystatechange = function() {
            //enquanto estiver processando...emite a msg de carregando
			if(ajax.readyState == 1) {
			   idOpcao.innerHTML = "Carregando...";
	        }
			//ap�s ser processado - chama fun��o processXMLCidade que vai varrer os dados
            if(ajax.readyState == 4 ) {
			   if(ajax.responseXML) {
			      processXMLBairro(ajax.responseXML);
			   }
			   else {
			       //caso n�o seja um arquivo XML emite a mensagem abaixo
				   idOpcao.innerHTML = "--Primeiro selecione o municipio--";
			   }
            }
         }
		 //passa o c�digo do estado escolhido
	     var params = "cidade="+valor;
         ajax.send(params);
      }
   }

   function processXMLBairro(obj){
      //pega a tag cidade
      var dataArray   = obj.getElementsByTagName("bairro");

	  //total de elementos contidos na tag cidade
	  if(dataArray.length > 0) {
	     //percorre o arquivo XML paara extrair os dados
         for(var i = 0 ; i < dataArray.length ; i++) {
            var item = dataArray[i];
			//cont�udo dos campos no arquivo XML
			var codigo    =  item.getElementsByTagName("codigo")[0].firstChild.nodeValue;
			var descricao =  item.getElementsByTagName("descricao")[0].firstChild.nodeValue;

	        idOpcao.innerHTML = "Selecione uma das opcoes abaixo:";

			//cria um novo option dinamicamente
			var novo = document.createElement("option");
			    //atribui um ID a esse elemento
			    novo.setAttribute("id", "opcoes");
				//atribui um valor
			    novo.value = codigo;
				//atribui um texto
			    novo.text  = descricao;
				//finalmente adiciona o novo elemento
				document.forms[0].codigoBairro.options.add(novo);
		 }
	  }
	  else {
	    //caso o XML volte vazio, printa a mensagem abaixo
		idOpcao.innerHTML = "--Primeiro selecione o municipio--";
	  }
   }
//FIM FUNCAO PARA CONTROLE DE ESTADO E CIDADES

//INICIO FUNCAO PARA CONTROLE DE OPERACAO NO APONTAMENTO
   function buscaOperacaoProduto(valor) {
      //VERIFICA SE O BROWSER TEM SUPORTE A AJAX
	  try {
         ajax = new ActiveXObject("Microsoft.XMLHTTP");
      }
      catch(e) {
         try {
            ajax = new ActiveXObject("Msxml2.XMLHTTP");
         }
	     catch(ex) {
            try {
               ajax = new XMLHttpRequest();
            }
	        catch(exc) {
               alert("Esse browser não tem recursos para uso do Ajax");
               ajax = null;
            }
         }
      }
	  //SE TIVER SUPORTE AJAX
	  if(ajax) {
	     //DEIXA APENAS O ELEMENTO 1 NO OPTION, OS OUTROS SÃO EXCLUIDOS
		 document.forms[0].codigoOperacao.options.length = 1;

		 idOpcao  = document.getElementById("opcoes");

	     ajax.open("POST", "inc/pcp/lista_operacao_produto.php", true);
		 ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

		 ajax.onreadystatechange = function() {
            //enquanto estiver processando...emite a msg de carregando
			if(ajax.readyState == 1) {
			   idOpcao.innerHTML = "Carregando...";
	        }
			//após ser processado - chama função processXMLOperacao que vai varrer os dados
            if(ajax.readyState == 4 ) {
			   if(ajax.responseXML) {
			      processXMLOperacao(ajax.responseXML);
			   }
			   else {
			       //caso não seja um arquivo XML emite a mensagem abaixo
				   idOpcao.innerHTML = "--Primeiro informe a OP--";
			   }
            }
         }
		 //passa o código do produto escolhido
	     var params = "codigoProduto="+valor;
         ajax.send(params);
      }
   }

   function processXMLOperacao(obj){
     
      var dataArray   = obj.getElementsByTagName("contato");

	  if(dataArray.length > 0) {
	     //percorre o arquivo XML paara extrair os dados
         for(var i = 0 ; i < dataArray.length ; i++) {
            var item = dataArray[i];
			//contéudo dos campos no arquivo XML
			var codigo =  item.getElementsByTagName("codigo")[0].firstChild.nodeValue;
			var nome   =  item.getElementsByTagName("nome")[0].firstChild.nodeValue;

	        idOpcao.innerHTML = "Selecione...";

			//cria um novo option dinamicamente
			var novo = document.createElement("option");
			    //atribui um ID a esse elemento
			    novo.setAttribute("id", "opcoes");
				//atribui um valor
			    novo.value = codigo;
				//atribui um texto
			    novo.text  = nome;
				//finalmente adiciona o novo elemento
				document.forms[0].codigoOperacao.options.add(novo);
		 }
	  }
	  else {
	    //caso o XML volte vazio, printa a mensagem abaixo
		idOpcao.innerHTML = "--Primeiro informe a OP--";
	  }
   }
   
//FIM FUNCAO PARA CONTROLE DE OPERACAO NO APONTAMENTO