$(function($) { 
	
	
	$("#boxMensagem").dialog({
		autoOpen:false,
		modal:true,
		height:120,
		width:230,
		title:'Atenção',
		buttons:{
			'Ok': function(){
				$(window.document.location).attr('href','inicio.php?pg=papel');
				$("#boxMensagem").dialog('close');
				$("#boxEditarModulos").dialog("close");				
				$("#boxEditarRegras").dialog("close");
				

			}
		},
		close:function (){
			$("#boxEditarModulos").dialog("close");
			$("#boxEditarRegras").dialog("close");
			$(this).dialog("close");
			$(window.document.location).attr('href','inicio.php?pg=papel');
		}
		
	});

	
	//BOX ADICIONAR Modulos
	$("#boxEditarModulos").dialog({
		autoOpen: false,
		height: 600,
		width: 730,
		modal: true,
		resizable: false,
		title: 'Atribuir módulos ao papel',
		buttons:{
			'Salvar':function(){
				var co_papel = $("#co_papel").val();
				var co_modulo = new Array();
				$("input[type=checkbox][name='modulo_selecao[]']:checked").each(function(){
					co_modulo.push($(this).val());
				});
				//if(co_modulo.length!=0){
					//$("#boxEditarRules").dialog('open');
					//$("#boxTeste").load("inc/configuracoes/acoes_ins.php",{co_papel:co_papel, co_modulo:co_modulo});
	            	$.post('inc/configuracoes/acoes_modulos_ins.php',{
	            			co_papel:co_papel, 
	            			co_modulo:co_modulo});
	            	 $("#boxMensagem").html('Operacao realizada com sucesso!');
					 $("#boxMensagem").dialog('open');
            	
				
			},
			'Cancelar':function(){
				$("#boxEditarModulos").dialog('close');	
				$(window.document.location).attr('href','inicio.php?pg=papel');
			}
		}
			
	});
	
	

	//BOX REGRAS
	$("#boxEditarRegras").dialog({
		autoOpen: false,
		height: 600,
		width: 730,
		modal: true,
		resizable: false,
		title: 'Atribuir regras ao papel',
		buttons:{
			'Salvar':function(){
				var acao_editar = new Array();
				var acao_excluir = new Array();
				var acao_incluir = new Array();
				var co_papel_regra = $("#co_papel_regra").val();
				$("input[type=checkbox][name='acao_editar[]']:checked").each(function(){
					acao_editar.push($(this).val());
				});
				$("input[type=checkbox][name='acao_excluir[]']:checked").each(function(){
					acao_excluir.push($(this).val());
				});
				$("input[type=checkbox][name='acao_incluir[]']:checked").each(function(){
					acao_incluir.push($(this).val());
				});
				//$("#boxEditarRules").dialog('open');
				//$("#boxTeste").load("inc/configuracoes/acoes_ins.php",{co_papel:co_papel, co_modulo:co_modulo});
            	$.post('inc/configuracoes/acoes_regras_ins.php',{
            		acao_editar:acao_editar, 
            		acao_excluir:acao_excluir,
            		acao_incluir:acao_incluir,
            		co_papel_regra:co_papel_regra
            		});
            	 $("#boxMensagem").html('Operação realizada com sucesso!');
				 $("#boxMensagem").dialog('open');
            	
				
			},
			'Cancelar':function(){				
				$("#boxEditarRegras").dialog('close');
				$(window.document.location).attr('href','inicio.php?pg=papel');
			}
		}
			
	});
	
	
	
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
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estiliza��o nos controles
	 var controlsscript		=	'inc/cadastros/papel_grid.php';			//Documento com o conte�do do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid ser� carregado
	 var gridscript	=	'inc/cadastros/papel_grid.php';					//Documento com o conte�do do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Par�metros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div respons�vel por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou anima��o durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/
     
     
function editarModulos(papel){
	//$("#boxEditarRules").dialog('open');
	$("#boxEditarModulos").load("configuracoes/papeis_form_modulos.php",{co_papel:papel});
	$("#boxEditarModulos").dialog('open');
	
} 

function editarRegras(papel){
	//$("#boxEditarRules").dialog('open');
	$("#boxEditarRegras").load("configuracoes/papeis_form_regras.php",{co_papel:papel});
	$("#boxEditarRegras").dialog('open');
	
}   