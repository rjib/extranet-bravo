$(function($) {  
		   
	$("#formularioBairro").dialog({
		autoOpen: false,
		height: 200,
		width: 400,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Bairro',
		buttons: {
			'Salvar': function() {
												
				var codigoCidade  = $("#codigoCidade").val();
				var nomeBairro    = $("#nomeBairro").val();
				
				$.post('inc/bairro_ins.php', {codigoCidade: codigoCidade, nomeBairro: nomeBairro}, function(resposta) {
																																																																																																				
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
										$("#formularioBairro").dialog("close");
									}
								}
							});
							$("#codigoCidade").val(""); 
							$("#nomeBairro").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#codigoCidade").val(""); 
				$("#nomeBairro").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/bairro_grid.php");
		}
	});
	
	$("#confirmaExcluirBairro").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Bairro",
		buttons: {
			"Sim": function() {
					
				$.get("inc/bairro_ex.php", {codigoBairro: codigoBairro}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirBairro").dialog("close");
							}
						}
						});
					}else{
						$("<p>Bairro excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirBairro").dialog("close");
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
				$("#grid").load("inc/bairro_grid.php");
			}
	});
	
	$("#adicionarBairro")
	    .button()
		.click(function() {
		$( "#formularioBairro" ).dialog( "open" );
	});
		
	$("a[name=excluirBairro]").click(function(e){
		e.preventDefault();
		codigoBairro = $(this).attr("id");
		$("#confirmaExcluirBairro").dialog("open");
	});		
		
});

	/**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/

	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/bairro_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/bairro_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
	
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/