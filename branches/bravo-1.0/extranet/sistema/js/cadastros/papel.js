$(function($) {  
		   
	$("#formularioPapel").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Papel',
		buttons: {
			'Salvar': function() {
												
				var nomePapel      = $("#nomePapel").val();
				var descricaoPapel = $("#descricaoPapel").val();
				
				$.post('inc/cadastros/papel_ins.php', {nomePapel: nomePapel, descricaoPapel: descricaoPapel}, function(resposta) {
																																																																																																				
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
										$("#formularioPapel").dialog("close");
									}
								}
							});
							$("#nomePapel").val(""); 
							$("#descricaoPapel").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomePapel").val(""); 
				$("#descricaoPapel").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/papel_grid.php");
		}
	});
	
	$("#confirmaExcluirPapel").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Papel",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/papel_ex.php", {codigoPapel: codigoPapel}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirPapel").dialog("close");
							}
						}
						});
					}else{
						$("<p>Papel excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirPapel").dialog("close");
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
				$("#grid").load("inc/cadastros/papel_grid.php");
			}
	});
	
	$("a[name=alterarPapel]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarPapel").load("inc/cadastros/papel_form_alt.php?codigoPapel="+$(this).attr("id"));
		$("#formularioAlterarPapel").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Papel",
			buttons: {
				"Salvar": function() {
																	
					var codigoPapel           = $("#codigoPapel").val();
					var nomePapelAlterar      = $("#nomePapelAlterar").val();
					var descricaoPapelAlterar = $("#descricaoPapelAlterar").val();
											
					$.post("inc/cadastros/papel_alt.php", {codigoPapel: codigoPapel, nomePapelAlterar: nomePapelAlterar, descricaoPapelAlterar: descricaoPapelAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarPapel").dialog("close");
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
				$("#grid").load("inc/cadastros/papel_grid.php");									
			}
			});
	});
	
	$("#adicionarPapel")
	    .button()
		.click(function() {
		$( "#formularioPapel" ).dialog( "open" );
	});
		
	$("a[name=excluirPapel]").click(function(e){
		e.preventDefault();
		codigoPapel = $(this).attr("id");
		$("#confirmaExcluirPapel").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/papel_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/papel_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/