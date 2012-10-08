$(function($) {  
	
	$("#cnpj").mask("99.999.999/9999-99");  
	
	$("#formularioEmpresa").dialog({
		autoOpen: false,
		height: 200,
		width: 620,
		modal: true,
		resizable: false,
		title: 'Adicionar nova Empresa',
		buttons: {
			'Salvar': function() {
												
				var razaoSocial       = $("#razaoSocial").val();
				var nomeFantasia      = $("#nomeFantasia").val();
				var cnpj              = $("#cnpj").val();
				var inscricaoEstadual = $("#inscricaoEstadual").val();
				
				$.post('inc/configuracoes/empresa_ins.php', {razaoSocial: razaoSocial, nomeFantasia: nomeFantasia, cnpj: cnpj, inscricaoEstadual: inscricaoEstadual}, function(resposta) {
																																																																																																				
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
										$("#formularioEmpresa").dialog("close");
									}
								}
							});		
							$("#razaoSocial").val(""); 
							$("#nomeFantasia").val("");
							$("#cnpj").val(""); 
							$("#inscricaoEstadual").val("");	
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#razaoSocial").val(""); 
				$("#nomeFantasia").val("");
				$("#cnpj").val(""); 
				$("#inscricaoEstadual").val("");	
			}
		},
		close: function() {
		    $("#grid").load("inc/configuracoes/empresa_grid.php");
		}
	});
	
	$("#confirmaExcluirEmpresa").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Empresa",
		buttons: {
			"Sim": function() {
					
				$.get("inc/configuracoes/empresa_ex.php", {codigoEmpresa: codigoEmpresa}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirEmpresa").dialog("close");
							}
						}
						});
					}else{
						$("<p>Empresa excluida com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirEmpresa").dialog("close");
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
				$("#grid").load("inc/configuracoes/empresa_grid.php");
			}
	});
	
	$("a[name=alterarEmpresa]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarEmpresa").load("inc/configuracoes/empresa_form_alt.php?codigoEmpresa="+$(this).attr("id"));
		$("#formularioAlterarEmpresa").dialog({
			autoOpen: true,
			height: 260,
			width: 620,
			modal: true,
			resizable: false,
			title: "Alterar Empresa",
			buttons: {
				"Salvar": function() {
																	
					var codigoEmpresa            = $("#codigoEmpresa").val();
					var razaoSocialAlterar       = $("#razaoSocialAlterar").val();
					var nomeFantasiaAlterar      = $("#nomeFantasiaAlterar").val();
					var cnpjAlterar              = $("#cnpjAlterar").val();
					var inscricaoEstadualAlterar = $("#inscricaoEstadualAlterar").val();
											
					$.post("inc/configuracoes/empresa_alt.php", {codigoEmpresa: codigoEmpresa, razaoSocialAlterar: razaoSocialAlterar, nomeFantasiaAlterar: nomeFantasiaAlterar, cnpjAlterar: cnpjAlterar, inscricaoEstadualAlterar: inscricaoEstadualAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarEmpresa").dialog("close");
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
				$("#grid").load("inc/configuracoes/empresa_grid.php");									
			}
			});
	});
	
	$("#adicionarEmpresa")
	    .button()
		.click(function() {
		$( "#formularioEmpresa" ).dialog( "open" );
	});
		
	$("a[name=excluirEmpresa]").click(function(e){
		e.preventDefault();
		codigoEmpresa = $(this).attr("id");
		$("#confirmaExcluirEmpresa").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/configuracoes/empresa_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/configuracoes/empresa_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/