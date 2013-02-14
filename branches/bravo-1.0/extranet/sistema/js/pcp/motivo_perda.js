$(function($) {  
		   
	$("#formularioMotivoPerda").dialog({
		autoOpen: false,
		height: 350,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Motivo Perda',
		buttons: {
			'Salvar': function() {
												
				var nomeMotivoPerda      = $("#nomeMotivoPerda").val();
				var descricaoMotivoPerda = $("#descricaoMotivoPerda").val();
				var statusMotivoPerda    = $("#statusMotivoPerda").val();
				
				$.post('inc/pcp/motivo_perda_ins.php', {nomeMotivoPerda: nomeMotivoPerda, descricaoMotivoPerda: descricaoMotivoPerda, statusMotivoPerda: statusMotivoPerda}, function(resposta) {
																																																																																																				
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
										$("#formularioMotivoPerda").dialog("close");
									}
								}
							});
							$("#nomeMotivoPerda").val(""); 
							$("#descricaoMotivoPerda").val("");
							$("#statusMotivoPerda").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeMotivoPerda").val(""); 
				$("#descricaoMotivoPerda").val("");
				$("#statusMotivoPerda").val("");	
			}
		},
		close: function() {
		    $("#grid").load("inc/pcp/motivo_perda_grid.php");
		}
	});
	
	$("#confirmaExcluirMotivoPerda").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Motivo Perda",
		buttons: {
			"Sim": function() {
					
				$.get("inc/pcp/motivo_perda_ex.php", {codigoMotivoPerda: codigoMotivoPerda}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirMotivoPerda").dialog("close");
							}
						}
						});
					}else{
						$("<p>Motivo Perda excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirMotivoPerda").dialog("close");
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
				$("#grid").load("inc/pcp/motivo_perda_grid.php");
			}
	});
	
	$("a[name=alterarMotivoPerda]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarMotivoPerda").load("inc/pcp/motivo_perda_form_alt.php?codigoMotivoPerda="+$(this).attr("id"));
		$("#formularioAlterarMotivoPerda").dialog({
			autoOpen: true,
			height: 420,
			width: 640,
			modal: true,
			resizable: false,
			title: "Alterar Motivo Perda",
			buttons: {
				"Salvar": function() {
																						
					var codigoMotivoPerda           = $("#codigoMotivoPerda").val();
					var nomeMotivoPerdaAlterar      = $("#nomeMotivoPerdaAlterar").val();
					var descricaoMotivoPerdaAlterar = $("#descricaoMotivoPerdaAlterar").val();
					var statusMotivoPerdaAlterar    = $("#statusMotivoPerdaAlterar").val();
											
					$.post("inc/pcp/motivo_perda_alt.php", {codigoMotivoPerda: codigoMotivoPerda, nomeMotivoPerdaAlterar: nomeMotivoPerdaAlterar, descricaoMotivoPerdaAlterar: descricaoMotivoPerdaAlterar, statusMotivoPerdaAlterar: statusMotivoPerdaAlterar}, function(resposta) {
																																																																																																											
					if (resposta != false) {
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
							}
						}
						});
					}else{		
						$("<p>Altera&ccedil;&atilde;o efetuada com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$("#formularioAlterarMotivoPerda").dialog("close");
								$(this).dialog("close");
							}
						}
						});																											
					}
				});
											
			},
			"Cancelar": function() {
				$(this).dialog("close");
			}
			},
			close: function() {
				$("#grid").load("inc/pcp/motivo_perda_grid.php");									
			}
			});
	});
	
	$("#adicionarMotivoPerda")
	    .button()
		.click(function() {
		$( "#formularioMotivoPerda" ).dialog( "open" );
	});
		
	$("a[name=excluirMotivoPerda]").click(function(e){
		e.preventDefault();
		codigoMotivoPerda = $(this).attr("id");
		$("#confirmaExcluirMotivoPerda").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/pcp/motivo_perda_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/pcp/motivo_perda_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/