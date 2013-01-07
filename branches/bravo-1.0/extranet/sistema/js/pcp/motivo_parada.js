$(function($) {  
		   
	$("#formularioMotivoParada").dialog({
		autoOpen: false,
		height: 350,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Motivo Parada',
		buttons: {
			'Salvar': function() {
												
				var nomeMotivoParada      = $("#nomeMotivoParada").val();
				var descricaoMotivoParada = $("#descricaoMotivoParada").val();
				var statusMotivoParada    = $("#statusMotivoParada").val();
				
				$.post('inc/pcp/motivo_parada_ins.php', {nomeMotivoParada: nomeMotivoParada, descricaoMotivoParada: descricaoMotivoParada, statusMotivoParada: statusMotivoParada}, function(resposta) {
																																																																																																				
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
										$("#formularioMotivoParada").dialog("close");
									}
								}
							});
							$("#nomeMotivoParada").val(""); 
							$("#descricaoMotivoParada").val("");
							$("#statusMotivoParada").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeMotivoParada").val(""); 
				$("#descricaoMotivoParada").val("");
				$("#statusMotivoParada").val("");	
			}
		},
		close: function() {
		    $("#grid").load("inc/pcp/motivo_parada_grid.php");
		}
	});
	
	$("#confirmaExcluirMotivoParada").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Motivo Parada",
		buttons: {
			"Sim": function() {
					
				$.get("inc/pcp/motivo_parada_ex.php", {codigoMotivoParada: codigoMotivoParada}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirMotivoParada").dialog("close");
							}
						}
						});
					}else{
						$("<p>Motivo Parada excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirMotivoParada").dialog("close");
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
				$("#grid").load("inc/pcp/motivo_parada_grid.php");
			}
	});
	
	$("a[name=alterarMotivoParada]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarMotivoParada").load("inc/pcp/motivo_parada_form_alt.php?codigoMotivoParada="+$(this).attr("id"));
		$("#formularioAlterarMotivoParada").dialog({
			autoOpen: true,
			height: 420,
			width: 640,
			modal: true,
			resizable: false,
			title: "Alterar Motivo Parada",
			buttons: {
				"Salvar": function() {
																						
					var codigoMotivoParada           = $("#codigoMotivoParada").val();
					var nomeMotivoParadaAlterar      = $("#nomeMotivoParadaAlterar").val();
					var descricaoMotivoParadaAlterar = $("#descricaoMotivoParadaAlterar").val();
					var statusMotivoParadaAlterar    = $("#statusMotivoParadaAlterar").val();
											
					$.post("inc/pcp/motivo_parada_alt.php", {codigoMotivoParada: codigoMotivoParada, nomeMotivoParadaAlterar: nomeMotivoParadaAlterar, descricaoMotivoParadaAlterar: descricaoMotivoParadaAlterar, statusMotivoParadaAlterar: statusMotivoParadaAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarMotivoParada").dialog("close");
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
				$("#grid").load("inc/pcp/motivo_parada_grid.php");									
			}
			});
	});
	
	$("#adicionarMotivoParada")
	    .button()
		.click(function() {
		$( "#formularioMotivoParada" ).dialog( "open" );
	});
		
	$("a[name=excluirMotivoParada]").click(function(e){
		e.preventDefault();
		codigoMotivoParada = $(this).attr("id");
		$("#confirmaExcluirMotivoParada").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/pcp/motivo_parada_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/pcp/motivo_parada_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/