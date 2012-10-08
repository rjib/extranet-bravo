$(function($) {  
		   
	$("#formularioNivelFormacao").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Nivel Forma&ccedil;&atilde;o',
		buttons: {
			'Salvar': function() {
												
				var nomeNivelFormacao      = $("#nomeNivelFormacao").val();
				var descricaoNivelFormacao = $("#descricaoNivelFormacao").val();
				
				$.post('inc/cadastros/nivel_formacao_ins.php', {nomeNivelFormacao: nomeNivelFormacao, descricaoNivelFormacao: descricaoNivelFormacao}, function(resposta) {
																																																																																																				
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
										$("#formularioNivelFormacao").dialog("close");
									}
								}
							});
							$("#nomeNivelFormacao").val(""); 
							$("#descricaoNivelFormacao").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeNivelFormacao").val(""); 
				$("#descricaoNivelFormacao").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/nivel_formacao_grid.php");
		}
	});
	
	$("#confirmaExcluirNivelFormacao").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Nivel Forma&ccedil;&atilde;o",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/nivel_formacao_ex.php", {codigoNivelFormacao: codigoNivelFormacao}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirNivelFormacao").dialog("close");
							}
						}
						});
					}else{
						$("<p>Setor excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirNivelFormacao").dialog("close");
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
				$("#grid").load("inc/cadastros/nivel_formacao_grid.php");
			}
	});
	
	$("a[name=alterarNivelFormacao]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarNivelFormacao").load("inc/cadastros/nivel_formacao_form_alt.php?codigoNivelFormacao="+$(this).attr("id"));
		$("#formularioAlterarNivelFormacao").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Nivel Forma&ccedil;&atilde;o",
			buttons: {
				"Salvar": function() {
																	
					var codigoNivelFormacao           = $("#codigoNivelFormacao").val();
					var nomeNivelFormacaoAlterar      = $("#nomeNivelFormacaoAlterar").val();
					var descricaoNivelFormacaoAlterar = $("#descricaoNivelFormacaoAlterar").val();
											
					$.post("inc/cadastros/nivel_formacao_alt.php", {codigoNivelFormacao: codigoNivelFormacao, nomeNivelFormacaoAlterar: nomeNivelFormacaoAlterar, descricaoNivelFormacaoAlterar: descricaoNivelFormacaoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarNivelFormacao").dialog("close");
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
				$("#grid").load("inc/cadastros/nivel_formacao_grid.php");									
			}
			});
	});
	
	$("#adicionarNivelFormacao")
	    .button()
		.click(function() {
		$( "#formularioNivelFormacao" ).dialog( "open" );
	});
		
	$("a[name=excluirNivelFormacao]").click(function(e){
		e.preventDefault();
		codigoNivelFormacao = $(this).attr("id");
		$("#confirmaExcluirNivelFormacao").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/nivel_formacao_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/nivel_formacao_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/