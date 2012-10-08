$(function($) {  
	
	$("#numeroCartaoIdentificacao").mask("999");
	$("#numeroCartaoIdentificacaoAlterar").mask("999");
		   
	$("#formularioCartaoIdentificacao").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Cart&atilde;o Identifica&ccedil;&atilde;o',
		buttons: {
			'Salvar': function() {
												
				var numeroCartaoIdentificacao      = $("#numeroCartaoIdentificacao").val();
				var descricaoCartaoIdentificacao   = $("#descricaoCartaoIdentificacao").val();
				
				$.post('inc/cadastros/cartao_identificacao_ins.php', {numeroCartaoIdentificacao: numeroCartaoIdentificacao, descricaoCartaoIdentificacao: descricaoCartaoIdentificacao}, function(resposta) {
																																																																																																				
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
										$("#formularioCartaoIdentificacao").dialog("close");
									}
								}
							});
							$("#numeroCartaoIdentificacao").val(""); 
							$("#descricaoCartaoIdentificacao").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#numeroCartaoIdentificacao").val(""); 
				$("#descricaoCartaoIdentificacao").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/cartao_identificacao_grid.php");
		}
	});
	
	$("#confirmaExcluirCartaoIdentificacao").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Cart&atilde;o Identifica&ccedil;&atilde;o",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/cartao_identificacao_ex.php", {codigoCartaoIdentificacao: codigoCartaoIdentificacao}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCartaoIdentificacao").dialog("close");
							}
						}
						});
					}else{
						$("<p>Cart&atilde;o Identifica&ccedil;&atilde;o excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirCartaoIdentificacao").dialog("close");
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
				$("#grid").load("inc/cadastros/cartao_identificacao_grid.php");
			}
	});
	
	$("a[name=alterarCartaoIdentificacao]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarCartaoIdentificacao").load("inc/cadastros/cartao_identificacao_form_alt.php?codigoCartaoIdentificacao="+$(this).attr("id"));
		$("#formularioAlterarCartaoIdentificacao").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Cart&atilde;o Identifica&ccedil;&atilde;o",
			buttons: {
				"Salvar": function() {
																	
					var codigoCartaoIdentificacao           = $("#codigoCartaoIdentificacao").val();
					var numeroCartaoIdentificacaoAlterar    = $("#numeroCartaoIdentificacaoAlterar").val();
					var descricaoCartaoIdentificacaoAlterar = $("#descricaoCartaoIdentificacaoAlterar").val();
											
					$.post("inc/cadastros/cartao_identificacao_alt.php", {codigoCartaoIdentificacao: codigoCartaoIdentificacao, numeroCartaoIdentificacaoAlterar: numeroCartaoIdentificacaoAlterar, descricaoCartaoIdentificacaoAlterar: descricaoCartaoIdentificacaoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarCartaoIdentificacao").dialog("close");
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
				$("#grid").load("inc/cadastros/cartao_identificacao_grid.php");									
			}
			});
	});
	
	$("#adicionarCartaoIdentificacao")
	    .button()
		.click(function() {
		$( "#formularioCartaoIdentificacao" ).dialog( "open" );
	});
		
	$("a[name=excluirCartaoIdentificacao]").click(function(e){
		e.preventDefault();
		codigoCartaoIdentificacao = $(this).attr("id");
		$("#confirmaExcluirCartaoIdentificacao").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/cartao_identificacao_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/cartao_identificacao_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/