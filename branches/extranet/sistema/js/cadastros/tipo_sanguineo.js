$(function($) {  
		   
	$("#formularioTipoSanguineo").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Tipo Sanguineo',
		buttons: {
			'Salvar': function() {
												
				var nomeTipoSanguineo      = $("#nomeTipoSanguineo").val();
				var descricaoTipoSanguineo = $("#descricaoTipoSanguineo").val();
				
				$.post('inc/cadastros/tipo_sanguineo_ins.php', {nomeTipoSanguineo: nomeTipoSanguineo, descricaoTipoSanguineo: descricaoTipoSanguineo}, function(resposta) {
																																																																																																				
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
										$("#formularioTipoSanguineo").dialog("close");
									}
								}
							});
							$("#nomeTipoSanguineo").val(""); 
							$("#descricaoTipoSanguineo").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeTipoSanguineo").val(""); 
				$("#descricaoTipoSanguineo").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/tipo_sanguineo_grid.php");
		}
	});
	
	$("#confirmaExcluirTipoSanguineo").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Tipo Sanguineo",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/tipo_sanguineo_ex.php", {codigoTipoSanguineo: codigoTipoSanguineo}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoSanguineo").dialog("close");
							}
						}
						});
					}else{
						$("<p>Tipo Sanguineo excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoSanguineo").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_sanguineo_grid.php");
			}
	});
	
	$("a[name=alterarTipoSanguineo]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarTipoSanguineo").load("inc/cadastros/tipo_sanguineo_form_alt.php?codigoTipoSanguineo="+$(this).attr("id"));
		$("#formularioAlterarTipoSanguineo").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Tipo Sanguineo",
			buttons: {
				"Salvar": function() {
																	
					var codigoTipoSanguineo           = $("#codigoTipoSanguineo").val();
					var nomeTipoSanguineoAlterar      = $("#nomeTipoSanguineoAlterar").val();
					var descricaoTipoSanguineoAlterar = $("#descricaoTipoSanguineoAlterar").val();
											
					$.post("inc/cadastros/tipo_sanguineo_alt.php", {codigoTipoSanguineo: codigoTipoSanguineo, nomeTipoSanguineoAlterar: nomeTipoSanguineoAlterar, descricaoTipoSanguineoAlterar: descricaoTipoSanguineoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarTipoSanguineo").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_sanguineo_grid.php");									
			}
			});
	});
	
	$("#adicionarTipoSanguineo")
	    .button()
		.click(function() {
		$( "#formularioTipoSanguineo" ).dialog("open");
	});
		
	$("a[name=excluirTipoSanguineo]").click(function(e){
		e.preventDefault();
		codigoTipoSanguineo = $(this).attr("id");
		$("#confirmaExcluirTipoSanguineo").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/tipo_sanguineo_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/tipo_sanguineo_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/