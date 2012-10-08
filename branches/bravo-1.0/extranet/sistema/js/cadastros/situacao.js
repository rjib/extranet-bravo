$(function($) {  
		   
	$("#formularioSituacao").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Situacao',
		buttons: {
			'Salvar': function() {
												
				var nomeSituacao      = $("#nomeSituacao").val();
				var descricaoSituacao = $("#descricaoSituacao").val();
				
				$.post('inc/cadastros/situacao_ins.php', {nomeSituacao: nomeSituacao, descricaoSituacao: descricaoSituacao}, function(resposta) {
																																																																																																				
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
										$("#formularioSituacao").dialog("close");
									}
								}
							});
							$("#nomeSituacao").val(""); 
							$("#descricaoSituacao").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeSituacao").val(""); 
				$("#descricaoSituacao").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/situacao_grid.php");
		}
	});
	
	$("#confirmaExcluirSituacao").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Situacao",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/situacao_ex.php", {codigoSituacao: codigoSituacao}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirSituacao").dialog("close");
							}
						}
						});
					}else{
						$("<p>Situacao excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirSituacao").dialog("close");
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
				$("#grid").load("inc/cadastros/situacao_grid.php");
			}
	});
	
	$("a[name=alterarSituacao]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarSituacao").load("inc/cadastros/situacao_form_alt.php?codigoSituacao="+$(this).attr("id"));
		$("#formularioAlterarSituacao").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Situacao",
			buttons: {
				"Salvar": function() {
																	
					var codigoSituacao           = $("#codigoSituacao").val();
					var nomeSituacaoAlterar      = $("#nomeSituacaoAlterar").val();
					var descricaoSituacaoAlterar = $("#descricaoSituacaoAlterar").val();
											
					$.post("inc/cadastros/situacao_alt.php", {codigoSituacao: codigoSituacao, nomeSituacaoAlterar: nomeSituacaoAlterar, descricaoSituacaoAlterar: descricaoSituacaoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarSituacao").dialog("close");
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
				$("#grid").load("inc/cadastros/situacao_grid.php");									
			}
			});
	});
	
	$("#adicionarSituacao")
	    .button()
		.click(function() {
		$( "#formularioSituacao" ).dialog( "open" );
	});
		
	$("a[name=excluirSituacao]").click(function(e){
		e.preventDefault();
		codigoSituacao = $(this).attr("id");
		$("#confirmaExcluirSituacao").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/situacao_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/situacao_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/