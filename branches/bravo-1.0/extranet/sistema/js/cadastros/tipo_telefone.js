$(function($) {  
		   
	$("#formularioTipoTelefone").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Tipo Telefone',
		buttons: {
			'Salvar': function() {
												
				var nomeTipoTelefone      = $("#nomeTipoTelefone").val();
				var descricaoTipoTelefone = $("#descricaoTipoTelefone").val();
				
				$.post('inc/cadastros/tipo_telefone_ins.php', {nomeTipoTelefone: nomeTipoTelefone, descricaoTipoTelefone: descricaoTipoTelefone}, function(resposta) {
																																																																																																				
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
										$("#formularioTipoTelefone").dialog("close");
									}
								}
							});
							$("#nomeTipoTelefone").val(""); 
							$("#descricaoTipoTelefone").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeTipoTelefone").val(""); 
				$("#descricaoTipoTelefone").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/tipo_telefone_grid.php");
		}
	});
	
	$("#confirmaExcluirTipoTelefone").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Tipo Telefone",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/tipo_telefone_ex.php", {codigoTipoTelefone: codigoTipoTelefone}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoTelefone").dialog("close");
							}
						}
						});
					}else{
						$("<p>Tipo Telefone excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoTelefone").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_telefone_grid.php");
			}
	});
	
	$("a[name=alterarTipoTelefone]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarTipoTelefone").load("inc/cadastros/tipo_telefone_form_alt.php?codigoTipoTelefone="+$(this).attr("id"));
		$("#formularioAlterarTipoTelefone").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Tipo Telefone",
			buttons: {
				"Salvar": function() {
																	
					var codigoTipoTelefone           = $("#codigoTipoTelefone").val();
					var nomeTipoTelefoneAlterar      = $("#nomeTipoTelefoneAlterar").val();
					var descricaoTipoTelefoneAlterar = $("#descricaoTipoTelefoneAlterar").val();
											
					$.post("inc/cadastros/tipo_telefone_alt.php", {codigoTipoTelefone: codigoTipoTelefone, nomeTipoTelefoneAlterar: nomeTipoTelefoneAlterar, descricaoTipoTelefoneAlterar: descricaoTipoTelefoneAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarTipoTelefone").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_telefone_grid.php");									
			}
			});
	});
	
	$("#adicionarTipoTelefone")
	    .button()
		.click(function() {
		$( "#formularioTipoTelefone" ).dialog("open");
	});
		
	$("a[name=excluirTipoTelefone]").click(function(e){
		e.preventDefault();
		codigoTipoTelefone = $(this).attr("id");
		$("#confirmaExcluirTipoTelefone").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/tipo_telefone_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/tipo_telefone_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/