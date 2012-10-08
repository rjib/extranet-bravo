$(function($) {  
		   
	$("#formularioSetor").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Setor',
		buttons: {
			'Salvar': function() {
												
				var nomeSetor      = $("#nomeSetor").val();
				var descricaoSetor = $("#descricaoSetor").val();
				
				$.post('inc/cadastros/setor_ins.php', {nomeSetor: nomeSetor, descricaoSetor: descricaoSetor}, function(resposta) {
																																																																																																				
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
										$("#formularioSetor").dialog("close");
									}
								}
							});
							$("#nomeSetor").val(""); 
							$("#descricaoSetor").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeSetor").val(""); 
				$("#descricaoSetor").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/setor_grid.php");
		}
	});
	
	$("#confirmaExcluirSetor").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Setor",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/setor_ex.php", {codigoSetor: codigoSetor}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirSetor").dialog("close");
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
								$("#confirmaExcluirSetor").dialog("close");
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
				$("#grid").load("inc/cadastros/setor_grid.php");
			}
	});
	
	$("a[name=alterarSetor]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarSetor").load("inc/cadastros/setor_form_alt.php?codigoSetor="+$(this).attr("id"));
		$("#formularioAlterarSetor").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Setor",
			buttons: {
				"Salvar": function() {
																	
					var codigoSetor           = $("#codigoSetor").val();
					var nomeSetorAlterar      = $("#nomeSetorAlterar").val();
					var descricaoSetorAlterar = $("#descricaoSetorAlterar").val();
											
					$.post("inc/cadastros/setor_alt.php", {codigoSetor: codigoSetor, nomeSetorAlterar: nomeSetorAlterar, descricaoSetorAlterar: descricaoSetorAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarSetor").dialog("close");
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
				$("#grid").load("inc/cadastros/setor_grid.php");									
			}
			});
	});
	
	$("#adicionarSetor")
	    .button()
		.click(function() {
		$( "#formularioSetor" ).dialog( "open" );
	});
		
	$("a[name=excluirSetor]").click(function(e){
		e.preventDefault();
		codigoSetor = $(this).attr("id");
		$("#confirmaExcluirSetor").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/setor_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/setor_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/