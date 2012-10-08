$(function($) {  

	$("#numeroCep").mask("99999-999");
		   
	$("#formularioCep").dialog({
		autoOpen: false,
		height: 280,
		width: 450,
		modal: true,
		resizable: false,
		title: 'Adicionar novo CEP',
		buttons: {
			'Salvar': function() {
												
				var codigoBairro   = $("#codigoBairro").val();
				var numeroCep      = $("#numeroCep").val();
				var nomeLogradouro = $("#nomeLogradouro").val();
				
				$.post('inc/cep_ins.php', {codigoBairro: codigoBairro, numeroCep: numeroCep, nomeLogradouro: nomeLogradouro}, function(resposta) {
																																																																																																				
						if (resposta != false) {
							$('<p>' + resposta + '</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$(this).dialog("close");
									}
								}
							});
						} 
						else {
							$('<p>Cadastro efetuado com sucesso!</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$(this).dialog("close");
										$("#formularioCep").dialog("close");
									}
								}
							});
							$("#codigoCidade").val(""); 
							$("#codigoBairro").val("");
							$("#numeroCep").val("");	
							$("#nomeLogradouro").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#codigoCidade").val(""); 
				$("#codigoBairro").val(""); 
				$("#numeroCep").val(""); 
				$("#nomeLogradouro").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cep_grid.php");
		}
	});
	
	$("#confirmaExcluirCep").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir CEP",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cep_ex.php", {codigoCep: codigoCep}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCep").dialog("close");
							}
						}
						});
					}else{
						$("<p>CEP excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCep").dialog("close");
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
				$("#grid").load("inc/cep_grid.php");
			}
	});
	
	$("#adicionarCep")
	    .button()
		.click(function() {
		$( "#formularioCep" ).dialog( "open" );
	});
		
	$("a[name=excluirCep]").click(function(e){
		e.preventDefault();
		codigoCep = $(this).attr("id");
		$("#confirmaExcluirCep").dialog("open");
	});		
		
});

	/**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/

	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cep_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cep_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
	
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/