$(document).ready(function(){
    $('#nomePessoa').simpleAutoComplete('inc/auto_completa_pessoa_fisica.php',{
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
		
	$("#formularioConsultor").dialog({
		autoOpen: false,
		height: 420,
		width: 630,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Consultor',
		buttons: {
			'Salvar': function() {
				
				var codigoPessoa          = $("#codigoPessoa").val();
				var setor 				  = $("#setor").val();
				var tipoSanguineo 		  = $("#tipoSanguineo").val();
				var descricaoConsultor    = $("#descricaoConsultor").val();
				
				$.post('inc/cadastros/consultor_ins.php', {codigoPessoa: codigoPessoa, setor: setor, tipoSanguineo: tipoSanguineo, descricaoConsultor: descricaoConsultor}, function(resposta) {
																																																																																																				
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
										$("#formularioConsultor").dialog("close");
									}
								}
							});
							$("#codigoPessoa").val(""); 
							$("#nomePessoa").val(""); 
							$("#cpfPessoa").val(""); 
							$("#setor").val("");	
							$("#tipoSanguineo").val("");	
							$("#descricaoConsultor").val("");	
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#codigoPessoa").val(""); 
				$("#nomePessoa").val(""); 
				$("#cpfPessoa").val(""); 	
				$("#setor").val("");	
				$("#tipoSanguineo").val("");	
				$("#descricaoConsultor").val("");	
			}
		},
		close: function() {
		    $("#grid").load("inc/cadastros/consultor_grid.php");
		}
	});
	
	$("#confirmaExcluirConsultor").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Consultor",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/consultor_ex.php", {codigoConsultor: codigoConsultor}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirConsultor").dialog("close");
							}
						}
						});
					}else{
						$("<p>Consultor excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirConsultor").dialog("close");
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
				$("#grid").load("inc/cadastros/consultor_grid.php");
			}
	});
	
	$("a[name=alterarConsultor]").click(function (event){
		event.preventDefault();
		$("#formularioAlterarConsultor").load("inc/cadastros/consultor_form_alt.php?codigoConsultor="+$(this).attr("id"));
		$("#formularioAlterarConsultor").dialog({
			autoOpen: true,
			height: 480,
		    width: 680,
			modal: true,
			resizable: false,
			title: "Alterar Consultor",
			buttons: {
				"Salvar": function() {
								
					var codigoConsultor 			 = $("#codigoConsultor").val();
					var setorAlterar           		 = $("#setorAlterar").val();
					var tipoSanguineoAlterar         = $("#tipoSanguineoAlterar").val();
					var descricaoConsultorAlterar  = $("#descricaoConsultorAlterar").val();
											
					$.post("inc/cadastros/consultor_alt.php", {codigoConsultor: codigoConsultor, setorAlterar: setorAlterar, tipoSanguineoAlterar: tipoSanguineoAlterar, descricaoConsultorAlterar: descricaoConsultorAlterar}, function(resposta) {
																																																																																																											
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
								$("#formularioAlterarConsultor").dialog("close");
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
				$("#grid").load("inc/cadastros/consultor_grid.php");									
			}
			});
	});
	
	$("#adicionarConsultor")
	    .button()
		.click(function() {
		$( "#formularioConsultor" ).dialog( "open" );
	});
		
	$("a[name=excluirConsultor]").click(function(e){
		e.preventDefault();
		codigoConsultor = $(this).attr("id");
		$("#confirmaExcluirConsultor").dialog("open");
	});		
		
});

    /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
	 var controlsscript		=	'inc/cadastros/consultor_grid.php';			//Documento com o conteúdo do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid será carregado
	 var gridscript	=	'inc/cadastros/consultor_grid.php';					//Documento com o conteúdo do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/