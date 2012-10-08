$(function($) {  
		   
	$("#formularioNacionalidade").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar nova Nacionalidade',
		buttons: {
			'Salvar': function() {
												
				var nomeNacionalidade      = $("#nomeNacionalidade").val();
				var descricaoNacionalidade = $("#descricaoNacionalidade").val();
				
				$.post('inc/cadastros/nacionalidade_ins.php', {nomeNacionalidade: nomeNacionalidade, descricaoNacionalidade: descricaoNacionalidade }, function(resposta) {
																																																																																																				
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
										$("#formularioNacionalidade").dialog("close");
									}
								}
							});
							$("#nomeNacionalidade").val(""); 
							$("#descricaoNacionalidade").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeNacionalidade").val(""); 
				$("#descricaoNacionalidade").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/nacionalidade_grid.php");
		}
	});
	
	$("#confirmaExcluirNacionalidade").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Nacionalidade",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/nacionalidade_ex.php", {codigoNacionalidade: codigoNacionalidade}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirNacionalidade").dialog("close");
							}
						}
						});
					}else{
						$("<p>Nacionalidade excluida com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirNacionalidade").dialog("close");
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
				$("#grid").load("inc/cadastros/nacionalidade_grid.php");
			}
	});
	
	$("a[name=alterarNacionalidade]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarNacionalidade").load("inc/cadastros/nacionalidade_form_alt.php?codigoNacionalidade="+$(this).attr("id"));
		$("#formularioAlterarNacionalidade").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Nacionalidade",
			buttons: {
				"Salvar": function() {
																	
					var codigoNacionalidade           = $("#codigoNacionalidade").val();
					var nomeNacionalidadeAlterar      = $("#nomeNacionalidadeAlterar").val();
					var descricaoNacionalidadeAlterar = $("#descricaoNacionalidadeAlterar").val();
											
					$.post("inc/cadastros/nacionalidade_alt.php", {codigoNacionalidade: codigoNacionalidade, nomeNacionalidadeAlterar: nomeNacionalidadeAlterar, descricaoNacionalidadeAlterar: descricaoNacionalidadeAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarNacionalidade").dialog("close");
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
				$("#grid").load("inc/cadastros/nacionalidade_grid.php");									
			}
			});
	});
	
	$("#adicionarNacionalidade")
	    .button()
		.click(function() {
		$( "#formularioNacionalidade" ).dialog( "open" );
	});
		
	$("a[name=excluirNacionalidade]").click(function(e){
		e.preventDefault();
		codigoNacionalidade = $(this).attr("id");
		$("#confirmaExcluirNacionalidade").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/nacionalidade_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/nacionalidade_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/