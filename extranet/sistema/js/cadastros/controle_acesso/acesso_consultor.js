$(document).ready(function(){
    $('#nomeConsultor').simpleAutoComplete('inc/auto_completa_prestador.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'consultor'
	},nomeConsultorCallback);
});
	
function nomeConsultorCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoConsultor").val(""); 
	    $("#nomeConsultor").val(""); 
		$("#cpfConsultor").val(""); 
	}
    $("#codigoConsultor").val( par[1] );
	$("#cpfConsultor").val( par[2] );
}

$(function($) {  

	$("#horaEntrada").mask("99:99");
	$("#horaEntradaAlterar").mask("99:99");
	$("#horaSaida").mask("99:99");
	$("#horaSaidaInserir").mask("99:99");
	$("#placaVeiculo").mask("aaa-9999");
	$("#placaVeiculoAlterar").mask("aaa-9999");
		   
	$("#formularioAcessoConsultor").dialog({
		autoOpen: false,
		height: 320,
		width: 530,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Acesso Consultor',
		buttons: {
			'Salvar': function() {
												
				var codigoConsultor = $("#codigoConsultor").val();
				var horaEntrada     = $("#horaEntrada").val();
				var tipoVeiculo     = $("#tipoVeiculo").val();
				var placaVeiculo    = $("#placaVeiculo").val();
				var numeroCartao    = $("#numeroCartao").val();
				
				$.post('inc/cadastros/controle_acesso/acesso_consultor_ins.php', {codigoConsultor: codigoConsultor, horaEntrada: horaEntrada, tipoVeiculo: tipoVeiculo, placaVeiculo: placaVeiculo, numeroCartao: numeroCartao}, function(resposta) {
																																																																																																				
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
										$("#formularioAcessoConsultor").dialog("close");
									}
								}
							});
							$("#nomeConsultor").val(""); 
							$("#cpfConsultor").val("");
							$("#codigoConsultor").val(""); 
							$("#horaEntrada").val("");	
							$("#tipoVeiculo").val("");	
							$("#placaVeiculo").val("");	
							$("#numeroCartao").val("");	
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeConsultor").val(""); 
							$("#cpfConsultor").val("");
							$("#codigoConsultor").val(""); 
							$("#horaEntrada").val("");	
							$("#tipoVeiculo").val("");	
							$("#placaVeiculo").val("");	
							$("#numeroCartao").val("");	
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/controle_acesso/acesso_consultor_grid.php");	
			$(window.document.location).attr('href','inicio.php?pg=acesso_consultor');		
		}
	});
	
	$("a[name=inserirHoraSaidaAcessoConsultor]").click(function (event){
		event.preventDefault();
		$("#formularioInserirHoraSaidaAcessoConsultor").load("inc/cadastros/controle_acesso/acesso_consultor_form_hora_saida.php?codigoAcessoConsultor="+$(this).attr("id"));
		$("#formularioInserirHoraSaidaAcessoConsultor").dialog({
			autoOpen: true,
			height: 400,
			width: 680,
			modal: true,
			resizable: false,
			title: "Inserir Hora Saida Acesso Consultor",
			buttons: {
				"Salvar": function() {
																	
					var codigoAcessoConsultor = $("#codigoAcessoConsultor").val();
					var horaSaidaInserir      = $("#horaSaidaInserir").val();
					var horaEntrada = $("#horarioEntrada").val();
																
					$.post("inc/cadastros/controle_acesso/acesso_consultor_hora_saida.php", {horaEntrada:horaEntrada, codigoAcessoConsultor: codigoAcessoConsultor, horaSaidaInserir: horaSaidaInserir}, function(resposta) {
																																																																																																											
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
								$("#formularioInserirHoraSaidaAcessoConsultor").dialog("close");
								$(this).dialog("close");
							}
						}
						});																											
					}
				});
											
			},
			"Cancelar": function() {
				$(this).dialog("close");
				$("#codigoAcessoConsultor").val(""); 
				$("#horaSaidaInserir").val(""); 
			}
			},
			close: function() {
				$("#grid").load("inc/cadastros/controle_acesso/acesso_consultor_grid.php");
				$(window.document.location).attr('href','inicio.php?pg=acesso_consultor');										
			}
			});
	});
	
	$("a[name=alterarAcessoConsultor]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarAcessoConsultor").load("inc/cadastros/controle_acesso/acesso_consultor_form_alt.php?codigoAcessoConsultor="+$(this).attr("id"));
		$("#formularioAlterarAcessoConsultor").dialog({
			autoOpen: true,
			height: 400,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Acesso Consultor",
			buttons: {
				"Salvar": function() {
																	
					var codigoAcessoConsultor   = $("#codigoAcessoConsultor").val();
					var horaEntradaAlterar      = $("#horaEntradaAlterar").val();
					var tipoVeiculoAlterar      = $("#tipoVeiculoAlterar").val();
					var placaVeiculoAlterar     = $("#placaVeiculoAlterar").val();
					var numeroCartaoAlterar     = $("#numeroCartaoAlterar").val();
											
					$.post("inc/cadastros/controle_acesso/acesso_consultor_alt.php", {codigoAcessoConsultor: codigoAcessoConsultor, horaEntradaAlterar: horaEntradaAlterar, tipoVeiculoAlterar: tipoVeiculoAlterar, placaVeiculoAlterar: placaVeiculoAlterar, numeroCartaoAlterar: numeroCartaoAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarAcessoConsultor").dialog("close");
								$(this).dialog("close");
							}
						}
						});																											
					}
				});
											
			},
			"Cancelar": function() {
				$(this).dialog("close");
				$("#codigoAcessoConsultor").val(""); 
				$("#horaEntradaAlterar").val(""); 
				$("#tipoVeiculoAlterar").val(""); 	
				$("#placaVeiculoAlterar").val("");	
				$("#numeroCartaoAlterar").val("");	
			}
			},
			close: function() {
				$("#grid").load("inc/cadastros/controle_acesso/acesso_consultor_grid.php");
				$(window.document.location).attr('href','inicio.php?pg=acesso_consultor');										
			}
			});
	});
	
	$("a[name=detalhesAcessoConsultor]").click(function (event){
		event.preventDefault();
		$("#formularioDetalhesAcessoConsultor").load("inc/cadastros/controle_acesso/acesso_consultor_form_detalhe.php?codigoAcessoConsultor="+$(this).attr("id"));
		$("#formularioDetalhesAcessoConsultor").dialog({
			autoOpen: true,
			height: 400,
			width: 620,
			modal: true,
			resizable: false,
			title: "Detalhes Acesso Consultor",
			buttons: {
				"Fechar": function() {
				    $(this).dialog("close");
					$("#codigoAcessoConsultor").val(""); 
					$("#horaEntradaAlterar").val(""); 
					$("#tipoVeiculoAlterar").val(""); 	
					$("#placaVeiculoAlterar").val("");	
					$("#numeroCartaoAlterar").val("");	
			}
			},
			close: function() {
				$("#grid").load("inc/cadastros/controle_acesso/acesso_consultor_grid.php");
				$(window.document.location).attr('href','inicio.php?pg=acesso_consultor');										
			}
			});
	});
	
	$("#confirmaExcluirAcessoConsultor").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Usuario",
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
				$(window.document.location).attr('href','inicio.php?pg=acesso_consultor');	
			}
	});
	
	$("#adicionarAcessoConsultor")
	    .button()
		.click(function() {
		$( "#formularioAcessoConsultor" ).dialog( "open" );
	});
		
	$("a[name=excluirAcessoConsultor]").click(function(e){
		e.preventDefault();
		codigoAcessoConsultor = $(this).attr("id");
		$("#confirmaExcluirAcessoConsultor").dialog("open");
	});		
		
});

     /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estiliza��o nos controles
	 var controlsscript		=	'inc/cadastros/controle_acesso/acesso_consultor_grid.php';			//Documento com o conte�do do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid ser� carregado
	 var gridscript	=	'inc/cadastros/controle_acesso/acesso_consultor_grid.php';					//Documento com o conte�do do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Par�metros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div respons�vel por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou anima��o durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/


function desabilitaPlaca()
{   
   var i = document.getElementById("tipoVeiculo").selectedIndex;
   var v = 	document.getElementById("tipoVeiculo").options[i].id;
   
   if(v=='N'){		
		$('#placaVeiculo').hide('fast');
		$('#placaVeiculoLabel').hide('fast');
		$('#placaVeiculo').val('');
	}else{
		$('#placaVeiculo').show('fast');
		$('#placaVeiculoLabel').show('fast');
		$('#placaVeiculo').focus();
	}
}

function desabilitaPlacaAlterar()
{   
   var i = document.getElementById("tipoVeiculoAlterar").selectedIndex;
   var v = 	document.getElementById("tipoVeiculoAlterar").options[i].id;
  
   if(v=='N'){		
		$('#placaVeiculoAlterar').hide('fast');
		$('#placaVeiculoLabelAlterar').hide('fast');
		$('#placaVeiculoAlterar').val('');
				
	}else{
		$('#placaVeiculoAlterar').show('fast');
		$('#placaVeiculoLabelAlterar').show('fast');
		$('#placaVeiculoAlterar').focus();
	}
}