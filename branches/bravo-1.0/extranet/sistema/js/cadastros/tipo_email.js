$(function($) {  
		   
	$("#formularioTipoEmail").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Tipo Email',
		buttons: {
			'Salvar': function() {
												
				var nomeTipoEmail      = $("#nomeTipoEmail").val();
				var descricaoTipoEmail = $("#descricaoTipoEmail").val();
				
				$.post('inc/cadastros/tipo_email_ins.php', {nomeTipoEmail: nomeTipoEmail, descricaoTipoEmail: descricaoTipoEmail}, function(resposta) {
																																																																																																				
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
										$("#formularioTipoEmail").dialog("close");
									}
								}
							});
							$("#nomeTipoEmail").val(""); 
							$("#descricaoTipoEmail").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeTipoEmail").val(""); 
				$("#descricaoTipoEmail").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/tipo_email_grid.php");
		}
	});
	
	$("#confirmaExcluirTipoEmail").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Tipo Email",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/tipo_email_ex.php", {codigoTipoEmail: codigoTipoEmail}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoEmail").dialog("close");
							}
						}
						});
					}else{
						$("<p>Tipo Email excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoEmail").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_email_grid.php");
			}
	});
	
	$("a[name=alterarTipoEmail]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarTipoEmail").load("inc/cadastros/tipo_email_form_alt.php?codigoTipoEmail="+$(this).attr("id"));
		$("#formularioAlterarTipoEmail").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Tipo Email",
			buttons: {
				"Salvar": function() {
																	
					var codigoTipoEmail           = $("#codigoTipoEmail").val();
					var nomeTipoEmailAlterar      = $("#nomeTipoEmailAlterar").val();
					var descricaoTipoEmailAlterar = $("#descricaoTipoEmailAlterar").val();
											
					$.post("inc/cadastros/tipo_email_alt.php", {codigoTipoEmail: codigoTipoEmail, nomeTipoEmailAlterar: nomeTipoEmailAlterar, descricaoTipoEmailAlterar: descricaoTipoEmailAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarTipoEmail").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_email_grid.php");									
			}
			});
	});
	
	$("#adicionarTipoEmail")
	    .button()
		.click(function() {
		$( "#formularioTipoEmail" ).dialog("open");
	});
		
	$("a[name=excluirTipoEmail]").click(function(e){
		e.preventDefault();
		codigoTipoEmail = $(this).attr("id");
		$("#confirmaExcluirTipoEmail").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/tipo_email_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/tipo_email_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/