$(function($) {  
		   
	$("#formularioCargo").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Cargo',
		buttons: {
			'Salvar': function() {
												
				var nomeCargo      = $("#nomeCargo").val();
				var descricaoCargo = $("#descricaoCargo").val();
				
				$.post('inc/cadastros/cargo_ins.php', {nomeCargo: nomeCargo, descricaoCargo: descricaoCargo}, function(resposta) {
																																																																																																				
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
										$("#formularioCargo").dialog("close");
									}
								}
							});
							$("#nomeCargo").val(""); 
							$("#descricaoCargo").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeCargo").val(""); 
				$("#descricaoCargo").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/cargo_grid.php");
		}
	});
	
	$("#confirmaExcluirCargo").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Cargo",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/cargo_ex.php", {codigoCargo: codigoCargo}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCargo").dialog("close");
							}
						}
						});
					}else{
						$("<p>Cargo excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCargo").dialog("close");
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
				$("#grid").load("inc/cadastros/cargo_grid.php");
			}
	});
	
	$("a[name=alterarCargo]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarCargo").load("inc/cadastros/cargo_form_alt.php?codigoCargo="+$(this).attr("id"));
		$("#formularioAlterarCargo").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Cargo",
			buttons: {
				"Salvar": function() {
																	
					var codigoCargo           = $("#codigoCargo").val();
					var nomeCargoAlterar      = $("#nomeCargoAlterar").val();
					var descricaoCargoAlterar = $("#descricaoCargoAlterar").val();
											
					$.post("inc/cadastros/cargo_alt.php", {codigoCargo: codigoCargo, nomeCargoAlterar: nomeCargoAlterar, descricaoCargoAlterar: descricaoCargoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarCargo").dialog("close");
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
				$("#grid").load("inc/cadastros/cargo_grid.php");									
			}
			});
	});
	
	$("#adicionarCargo")
	    .button()
		.click(function() {
		$( "#formularioCargo" ).dialog( "open" );
	});
		
	$("a[name=excluirCargo]").click(function(e){
		e.preventDefault();
		codigoCargo = $(this).attr("id");
		$("#confirmaExcluirCargo").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/cargo_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/cargo_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/