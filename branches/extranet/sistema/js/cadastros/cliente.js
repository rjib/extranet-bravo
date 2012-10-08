$(function($) {  
	
	$("#confirmaExcluirCliente").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Cliente",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/cliente_ex.php", {codigoCliente: codigoCliente}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCliente").dialog("close");
							}
						}
						});
					}else{
						$("<p>Cliente excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCliente").dialog("close");
							}
						}
						});
					}
												
				});
			},
			"Nao": function() {
				$(this).dialog("close");
			}
			},
			close: function() {
				$("#grid").load("inc/cadastros/cliente_grid.php");
			}
	});
	
	$("#paginaAdicionarCliente")
	    .button()
		.click(function() {
		$(window.document.location).attr('href','inicio.php?pg=pessoa_ins');
	});
	
	$("a[name=excluirCliente]").click(function(e){
		e.preventDefault();
		codigoCliente = $(this).attr("id");
		$("#confirmaExcluirCliente").dialog("open");
	});	
	
	$("#voltarPagina")
	    .button()
		.click(function() {
		history.back();
	});	
	
});

	/**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/

	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/cliente_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/cliente_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
	
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/