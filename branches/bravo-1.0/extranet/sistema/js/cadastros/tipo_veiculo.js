$(function($) {  
		   
	$("#formularioTipoVeiculo").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Tipo Veiculo',
		buttons: {
			'Salvar': function() {
												
				var nomeTipoVeiculo      = $("#nomeTipoVeiculo").val();
				var descricaoTipoVeiculo = $("#descricaoTipoVeiculo").val();
				
				$.post('inc/cadastros/tipo_veiculo_ins.php', {nomeTipoVeiculo: nomeTipoVeiculo, descricaoTipoVeiculo: descricaoTipoVeiculo}, function(resposta) {
																																																																																																				
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
										$("#formularioTipoVeiculo").dialog("close");
									}
								}
							});
							$("#nomeTipoVeiculo").val(""); 
							$("#descricaoTipoVeiculo").val("");													
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeTipoVeiculo").val(""); 
				$("#descricaoTipoVeiculo").val(""); 
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/tipo_veiculo_grid.php");
		}
	});
	
	$("#confirmaExcluirTipoVeiculo").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Tipo Veiculo",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/tipo_veiculo_ex.php", {codigoTipoVeiculo: codigoTipoVeiculo}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoVeiculo").dialog("close");
							}
						}
						});
					}else{
						$("<p>Tipo Veiculo excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirTipoVeiculo").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_veiculo_grid.php");
			}
	});
	
	$("a[name=alterarTipoVeiculo]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarTipoVeiculo").load("inc/cadastros/tipo_veiculo_form_alt.php?codigoTipoVeiculo="+$(this).attr("id"));
		$("#formularioAlterarTipoVeiculo").dialog({
			autoOpen: true,
			height: 380,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Tipo Veiculo",
			buttons: {
				"Salvar": function() {
																	
					var codigoTipoVeiculo           = $("#codigoTipoVeiculo").val();
					var nomeTipoVeiculoAlterar      = $("#nomeTipoVeiculoAlterar").val();
					var descricaoTipoVeiculoAlterar = $("#descricaoTipoVeiculoAlterar").val();
											
					$.post("inc/cadastros/tipo_veiculo_alt.php", {codigoTipoVeiculo: codigoTipoVeiculo, nomeTipoVeiculoAlterar: nomeTipoVeiculoAlterar, descricaoTipoVeiculoAlterar: descricaoTipoVeiculoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarTipoVeiculo").dialog("close");
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
				$("#grid").load("inc/cadastros/tipo_veiculo_grid.php");									
			}
			});
	});
	
	$("#adicionarTipoVeiculo")
	    .button()
		.click(function() {
		$( "#formularioTipoVeiculo" ).dialog("open");
	});
		
	$("a[name=excluirTipoVeiculo]").click(function(e){
		e.preventDefault();
		codigoTipoVeiculo = $(this).attr("id");
		$("#confirmaExcluirTipoVeiculo").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/tipo_veiculo_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/tipo_veiculo_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/