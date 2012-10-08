$(function($) {  
		   
	$("#formularioEstadoCivil").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Estado Civil',
		buttons: {
			'Salvar': function() {
												
				var nomeEstadoCivil      = $("#nomeEstadoCivil").val();
				var descricaoEstadoCivil = $("#descricaoEstadoCivil").val();
				
				$.post('inc/cadastros/estado_civil_ins.php', {nomeEstadoCivil: nomeEstadoCivil, descricaoEstadoCivil: descricaoEstadoCivil }, function(resposta) {
																																																																																																				
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
										$("#formularioEstadoCivil").dialog("close");
									}
								}
							});
							$("#nomeEstadoCivil").val(""); 
							$("#descricaoEstadoCivil").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeEstadoCivil").val(""); 
				$("#descricaoEstadoCivil").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/estado_civil_grid.php");
		}
	});
	
	$("#confirmaExcluirEstadoCivil").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Estado Civil",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/estado_civil_ex.php", {codigoEstadoCivil: codigoEstadoCivil}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirEstadoCivil").dialog("close");
							}
						}
						});
					}else{
						$("<p>Estado Civil excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirEstadoCivil").dialog("close");
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
				$("#grid").load("inc/cadastros/estado_civil_grid.php");
			}
	});
	
	$("a[name=alterarEstadoCivil]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarEstadoCivil").load("inc/cadastros/estado_civil_form_alt.php?codigoEstadoCivil="+$(this).attr("id"));
		$("#formularioAlterarEstadoCivil").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Estado Civil",
			buttons: {
				"Salvar": function() {
																	
					var codigoEstadoCivil           = $("#codigoEstadoCivil").val();
					var nomeEstadoCivilAlterar      = $("#nomeEstadoCivilAlterar").val();
					var descricaoEstadoCivilAlterar = $("#descricaoEstadoCivilAlterar").val();
											
					$.post("inc/cadastros/estado_civil_alt.php", {codigoEstadoCivil: codigoEstadoCivil, nomeEstadoCivilAlterar: nomeEstadoCivilAlterar, descricaoEstadoCivilAlterar: descricaoEstadoCivilAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarEstadoCivil").dialog("close");
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
				$("#grid").load("inc/cadastros/estado_civil_grid.php");									
			}
			});
	});
	
	$("#adicionarEstadoCivil")
	    .button()
		.click(function() {
		$( "#formularioEstadoCivil" ).dialog( "open" );
	});
		
	$("a[name=excluirEstadoCivil]").click(function(e){
		e.preventDefault();
		codigoEstadoCivil = $(this).attr("id");
		$("#confirmaExcluirEstadoCivil").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/estado_civil_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/estado_civil_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/