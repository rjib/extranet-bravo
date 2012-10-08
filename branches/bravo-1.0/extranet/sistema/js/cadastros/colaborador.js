$(document).ready(function(){
    $('#nomePessoa').simpleAutoComplete('inc/auto_completa_pessoa_fisica_colaborador.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'pessoa'
	},nomePessoaCallback);
});
	
function nomePessoaCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoPessoa").val(""); 
	    $("#nomePessoa").val(""); 
		$("#cpfPessoa").val(""); 
	}
    $("#codigoPessoa").val( par[1] );
	$("#cpfPessoa").val( par[2] );
}

$(function($) {  
		
	$("#formularioColaborador").dialog({
		autoOpen: false,
		height: 450,
		width: 580,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Colaborador',
		buttons: {
			'Salvar': function() {
				
				var codigoPessoa          = $("#codigoPessoa").val();
				var tipoColaborador	      = $("#tipoColaborador").val();
				var nivelFormacao 		  = $("#nivelFormacao").val();
				var cargo 				  = $("#cargo").val();
				var setor 				  = $("#setor").val();
				var tipoSanguineo 		  = $("#tipoSanguineo").val();
				var descricaoColaborador  = $("#descricaoColaborador").val();
				
				$.post('inc/cadastros/colaborador_ins.php', {codigoPessoa: codigoPessoa, tipoColaborador: tipoColaborador, nivelFormacao: nivelFormacao, cargo: cargo, setor: setor, tipoSanguineo: tipoSanguineo, descricaoColaborador: descricaoColaborador}, function(resposta) {
																																																																																																				
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
						}else {
							$('<p>Cadastro efetuado com sucesso!</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$(this).dialog("close");
										$("#formularioColaborador").dialog("close");
									}
								}
							});
							$("#codigoPessoa").val(""); 
							$("#nomePessoa").val(""); 
							$("#cpfPessoa").val(""); 
							$("#tipoColaborador").val("");	
							$("#nivelFormacao").val("");	
							$("#cargo").val("");	
							$("#setor").val("");	
							$("#tipoSanguineo").val("");	
							$("#descricaoColaborador").val("");	
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#codigoPessoa").val(""); 
				$("#nomePessoa").val(""); 
				$("#cpfPessoa").val(""); 
				$("#tipoColaborador").val("");	
				$("#nivelFormacao").val("");	
				$("#cargo").val("");	
				$("#setor").val("");	
				$("#tipoSanguineo").val("");	
				$("#descricaoColaborador").val("");	
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/colaborador_grid.php");
		}
	});
	
	$("#confirmaExcluirColaborador").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Colaborador",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/colaborador_ex.php", {codigoColaborador: codigoColaborador}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirColaborador").dialog("close");
							}
						}
						});
					}else{
						$("<p>Colaborador excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirColaborador").dialog("close");
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
				$("#grid").load("inc/cadastros/colaborador_grid.php");
			}
	});
	
	$("a[name=alterarColaborador]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarColaborador").load("inc/cadastros/colaborador_form_alt.php?codigoColaborador="+$(this).attr("id"));
		$("#formularioAlterarColaborador").dialog({
			autoOpen: true,
			height: 450,
		    width: 580,
			modal: true,
			resizable: false,
			title: "Alterar Colaborador",
			buttons: {
				"Salvar": function() {
								
					var codigoColaborador 			 = $("#codigoColaborador").val();
					var tipoColaboradorAlterar 		 = $("#tipoColaboradorAlterar").val();
					var nivelFormacaoAlterar   		 = $("#nivelFormacaoAlterar").val();
					var cargoAlterar           		 = $("#cargoAlterar").val();
					var setorAlterar           		 = $("#setorAlterar").val();
					var tipoSanguineoAlterar         = $("#tipoSanguineoAlterar").val();
					var descricaoColaboradorAlterar  = $("#descricaoColaboradorAlterar").val();
											
					$.post("inc/cadastros/colaborador_alt.php", {codigoColaborador: codigoColaborador, tipoColaboradorAlterar: tipoColaboradorAlterar, nivelFormacaoAlterar: nivelFormacaoAlterar, cargoAlterar: cargoAlterar, setorAlterar: setorAlterar, tipoSanguineoAlterar: tipoSanguineoAlterar, descricaoColaboradorAlterar: descricaoColaboradorAlterar}, function(resposta) {
																																																																																																											
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
								$(this).dialog("close");
								$("#formularioAlterarColaborador").dialog("close");
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
				$("#grid").load("inc/cadastros/colaborador_grid.php");									
			}
			});
	});
	
	$("#adicionarColaborador")
	    .button()
		.click(function() {
		$( "#formularioColaborador" ).dialog( "open" );
	});
		
	$("a[name=excluirColaborador]").click(function(e){
		e.preventDefault();
		codigoColaborador = $(this).attr("id");
		$("#confirmaExcluirColaborador").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/colaborador_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/colaborador_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/