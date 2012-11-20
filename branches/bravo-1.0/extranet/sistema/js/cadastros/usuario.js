$(document).ready(function(){
    $('#nomeColaborador').simpleAutoComplete('inc/auto_completa_colaborador.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'colaboradorUsuario'
	},nomeColaboradorCallback);
});
	
function nomeColaboradorCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoColaborador").val(""); 
	    $("#nomeColaborador").val(""); 
		$("#cpfColaborador").val(""); 
	}
    $("#codigoColaborador").val( par[1] );
	$("#cpfColaborador").val( par[2] );
}

$(function($) {  
		   
	$("#formularioUsuario").dialog({
		autoOpen: false,
		height: 320,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Usuario',
		buttons: {
			'Salvar': function() {
												
				var codigoColaborador = $("#codigoColaborador").val();
				var papelUsuario      = $("#papelUsuario").val();
				var loginUsuario      = $("#loginUsuario").val();
				var senhaUsuario      = $("#senhaUsuario").val();
				var statusUsuario     = $("#statusUsuario").val();
				
				$.post('inc/cadastros/usuario_ins.php', {codigoColaborador: codigoColaborador, papelUsuario: papelUsuario, loginUsuario: loginUsuario, senhaUsuario: senhaUsuario, statusUsuario: statusUsuario}, function(resposta) {
																																																																																																				
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
										$("#formularioUsuario").dialog("close");
										$(window.document.location).attr('href','inicio.php?pg=usuario');
									}
								}
							});
							$("#nomeColaborador").val(""); 
							$("#cpfColaborador").val("");
							$("#codigoColaborador").val(""); 
							$("#papelUsuario").val("");	
							$("#loginUsuario").val("");	
							$("#senhaUsuario").val("");	
							$("#statusUsuario").val("");	
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeColaborador").val(""); 
				$("#cpfColaborador").val("");
				$("#codigoColaborador").val(""); 
				$("#papelUsuario").val("");	
				$("#loginUsuario").val("");	
				$("#senhaUsuario").val("");	
				$("#statusUsuario").val("");
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/usuario_grid.php");
		}
	});
	
	$("#confirmaExcluirUsuario").dialog({
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
								$(window.document.location).attr('href','inicio.php?pg=usuario');
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
	
	$("a[name=alterarUsuario]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarUsuario").load("inc/cadastros/usuario_form_alt.php?codigoUsuario="+$(this).attr("id"));
		$("#formularioAlterarUsuario").dialog({
			autoOpen: true,
			height: 360,
			width: 600,
			modal: true,
			resizable: false,
			title: "Alterar Usuario",
			buttons: {
				"Salvar": function() {
																	
					var codigoUsuario            = $("#codigoUsuario").val();
					var papelUsuarioAlterar      = $("#papelUsuarioAlterar").val();
					var loginUsuarioAlterar      = $("#loginUsuarioAlterar").val();
					var statusUsuarioAlterar     = $("#statusUsuarioAlterar").val();
											
					$.post("inc/cadastros/usuario_alt.php", {codigoUsuario: codigoUsuario, papelUsuarioAlterar: papelUsuarioAlterar, loginUsuarioAlterar: loginUsuarioAlterar, statusUsuarioAlterar: statusUsuarioAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarUsuario").dialog("close");
								$(this).dialog("close");
								$(window.document.location).attr('href','inicio.php?pg=usuario');
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
				$("#grid").load("inc/cadastros/usuario_grid.php");									
			}
			});
	});
	
	$("a[name=alterarSenhaUsuario]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarSenhaUsuario").load("inc/cadastros/usuario_form_senha_alt.php?codigoUsuario="+$(this).attr("id"));
		$("#formularioAlterarSenhaUsuario").dialog({
			autoOpen: true,
			height: 150,
			width: 280,
			modal: true,
			resizable: false,
			title: "Alterar Senha Usuario",
			buttons: {
				"Salvar": function() {
																	
					var codigoUsuario            = $("#codigoUsuario").val();
					var senhaUsuarioAlterar      = $("#senhaUsuarioAlterar").val();
											
					$.post("inc/cadastros/usuario_alt_senha.php", {codigoUsuario: codigoUsuario, senhaUsuarioAlterar: senhaUsuarioAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarSenhaUsuario").dialog("close");
								$(this).dialog("close");
								$(window.document.location).attr('href','inicio.php?pg=usuario');
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
				$("#grid").load("inc/cadastros/usuario_grid.php");									
			}
			});
	});
	
	$("#adicionarUsuario")
	    .button()
		.click(function() {
		$( "#formularioUsuario" ).dialog( "open" );
	});
		
	$("a[name=excluirUsuario]").click(function(e){
		e.preventDefault();
		codigoUsuario = $(this).attr("id");
		$("#confirmaExcluirUsuario").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estiliza��o nos controles
	 var controlsscript		=	'inc/cadastros/usuario_grid.php';			//Documento com o conte�do do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid ser� carregado
	 var gridscript	=	'inc/cadastros/usuario_grid.php';					//Documento com o conte�do do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Par�metros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div respons�vel por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou anima��o durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/