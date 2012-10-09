$(document).ready(function(){	
	
    $('#nomeVisitante').simpleAutoComplete('inc/auto_completa_pessoa.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'pessoa'
	},nomeVisitanteCallback);

	
});
	
function nomeVisitanteCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoVisitante").val(""); 
	    $("#nomeVisitante").val(""); 
		$("#cpfVisitante").val(""); 
	}
    $("#codigoVisitante").val( par[1] );
	$("#cpfVisitante").val( par[2] );
}

$(function($) { 

	$("#horaEntrada").mask("99:99");
	$("#horaEntradaAlterar").mask("99:99");
	$("#horaSaida").mask("99:99");
	$("#horaSaidaInserir").mask("99:99");
	$("#placaVeiculo").mask("aaa-9999");
	$("#placaVeiculoAlterar").mask("aaa-9999");
		   
	$("#formularioAcessoVisitante").dialog({
		autoOpen: false,
		height: 290,
		width: 530,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Acesso Visitante',
		buttons: {
			'Salvar': function() {
												
				var codigoVisitante = $("#codigoVisitante").val();
				var horaEntrada     = $("#horaEntrada").val();
				var tipoVeiculo     = $("#tipoVeiculo").val();
				var placaVeiculo    = $("#placaVeiculo").val();
				var numeroCartao    = $("#numeroCartao").val();
				
				$.post('inc/cadastros/controle_acesso/acesso_visitante_ins.php', {codigoVisitante: codigoVisitante, horaEntrada: horaEntrada, tipoVeiculo: tipoVeiculo, placaVeiculo: placaVeiculo, numeroCartao: numeroCartao}, function(resposta) {
																																																																																																				
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
										$("#formularioAcessoVisitante").dialog("close");
									}
								}
							});
							$("#nomeVisitante").val(""); 
							$("#cpfVisitante").val("");
							$("#codigoVisitante").val(""); 
							$("#horaEntrada").val("");	
							$("#tipoVeiculo").val("");	
							$("#placaVeiculo").val("");	
							$("#numeroCartao").val("");	
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeVisitante").val(""); 
							$("#cpfVisitante").val("");
							$("#codigoVisitante").val(""); 
							$("#horaEntrada").val("");	
							$("#tipoVeiculo").val("");	
							$("#placaVeiculo").val("");	
							$("#numeroCartao").val("");	
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/controle_acesso/acesso_visitante_grid.php");
		}
	});
	
	$("a[name=inserirHoraSaidaAcessoVisitante]").click(function (event){
		event.preventDefault();
		$("#formularioInserirHoraSaidaAcessoVisitante").load("inc/cadastros/controle_acesso/acesso_visitante_form_hora_saida.php?codigoAcessoVisitante="+$(this).attr("id"));
		$("#formularioInserirHoraSaidaAcessoVisitante").dialog({
			autoOpen: true,
			height: 400,
			width: 630,
			modal: true,
			resizable: false,
			title: "Inserir Hora Saida Acesso Visitante",
			buttons: {
				"Salvar": function() {
																	
					var codigoAcessoVisitante = $("#codigoAcessoVisitante").val();
					var horaSaidaInserir      = $("#horaSaidaInserir").val();
					var horaEntrada = $("#horarioEntrada").val();
																
					$.post("inc/cadastros/controle_acesso/acesso_visitante_hora_saida.php", {horaEntrada:horaEntrada, codigoAcessoVisitante: codigoAcessoVisitante, horaSaidaInserir: horaSaidaInserir}, function(resposta) {
																																																																																																											
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
								$("#formularioInserirHoraSaidaAcessoVisitante").dialog("close");
								$(this).dialog("close");
							}
						}
						});																											
					}
				});
											
			},
			"Cancelar": function() {
				$(this).dialog("close");
				$("#codigoAcessoVisitante").val(""); 
				$("#horaSaidaInserir").val(""); 
			}
			},
			close: function() {
				$("#grid").load("inc/cadastros/controle_acesso/acesso_visitante_grid.php");									
			}
			});
	});
	
	$("a[name=alterarAcessoVisitante]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarAcessoVisitante").load("inc/cadastros/controle_acesso/acesso_visitante_form_alt.php?codigoAcessoVisitante="+$(this).attr("id"));
		$("#formularioAlterarAcessoVisitante").dialog({
			autoOpen: true,
			height: 400,
			width: 630,
			modal: true,
			resizable: false,
			title: "Alterar Acesso Visitante",
			buttons: {
				"Salvar": function() {
																	
					var codigoAcessoVisitante   = $("#codigoAcessoVisitante").val();
					var horaEntradaAlterar      = $("#horaEntradaAlterar").val();
					var tipoVeiculoAlterar      = $("#tipoVeiculoAlterar").val();
					var placaVeiculoAlterar     = $("#placaVeiculoAlterar").val();
					var numeroCartaoAlterar     = $("#numeroCartaoAlterar").val();
											
					$.post("inc/cadastros/controle_acesso/acesso_visitante_alt.php", {codigoAcessoVisitante: codigoAcessoVisitante, horaEntradaAlterar: horaEntradaAlterar, tipoVeiculoAlterar: tipoVeiculoAlterar, placaVeiculoAlterar: placaVeiculoAlterar, numeroCartaoAlterar: numeroCartaoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarAcessoVisitante").dialog("close");
								$(this).dialog("close");
							}
						}
						});																											
					}
				});
											
			},
			"Cancelar": function() {
				$(this).dialog("close");
				$("#codigoAcessoVisitante").val(""); 
				$("#horaEntradaAlterar").val(""); 
				$("#tipoVeiculoAlterar").val(""); 	
				$("#placaVeiculoAlterar").val("");	
				$("#numeroCartaoAlterar").val("");	
			}
			},
			close: function() {
				$("#grid").load("inc/cadastros/controle_acesso/acesso_visitante_grid.php");									
			}
			});
	});
	
	$("a[name=detalhesAcessoVisitante]").click(function (event){
		event.preventDefault();
		$("#formularioDetalhesAcessoVisitante").load("inc/cadastros/controle_acesso/acesso_visitante_form_detalhe.php?codigoAcessoVisitante="+$(this).attr("id"));
		$("#formularioDetalhesAcessoVisitante").dialog({
			autoOpen: true,
			height: 400,
			width: 630,
			modal: true,
			resizable: false,
			title: "Detalhes Acesso Visitante",
			buttons: {
				"Fechar": function() {
				    $(this).dialog("close");
					$("#codigoAcessoVisitante").val(""); 
					$("#horaEntradaAlterar").val(""); 
					$("#tipoVeiculoAlterar").val(""); 	
					$("#placaVeiculoAlterar").val("");	
					$("#numeroCartaoAlterar").val("");	
			}
			},
			close: function() {
				$("#grid").load("inc/cadastros/controle_acesso/acesso_visitante_grid.php");									
			}
			});
	});
	
	$("#confirmaExcluirAcessoVisitante").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Visitante",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/usuario_ex.php", {codigoUsuario: codigoUsuario}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirUsuario").dialog("close");
							}
						}
						});
					}else{
						$("<p>Usuario excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirUsuario").dialog("close");
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
				$("#grid").load("inc/cadastros/usuario_grid.php");
			}
	});
	
	$("#adicionarAcessoVisitante")
	    .button()
		.click(function() {
		$( "#formularioAcessoVisitante" ).dialog({
			autoOpen: true,
			height: 310,
			width: 505,
			modal: true,
			resizable: false });
	});
		
	$("a[name=excluirAcessoVisitante]").click(function(e){
		e.preventDefault();
		codigoAcessoVisitante = $(this).attr("id");
		$("#confirmaExcluirAcessoVisitante").dialog("open");
	});		
		
});

     /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/controle_acesso/acesso_visitante_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/controle_acesso/acesso_visitante_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/