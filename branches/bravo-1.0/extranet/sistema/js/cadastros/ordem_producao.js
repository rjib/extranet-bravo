/**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
/* Variaveis de configuracao dos controles do grid*/
var controlsdivclass	=	'.controls';		//Classe para aplicar a estilização nos controles
//Documento com o conteúdo do grid em formato html
var gridscript	=	'inc/ordem_producao_pi_grid.php';			
var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid			
/* Variaveis de configuracao do grid*/
var griddivid 	=	'#grid';
//Documento com o conteúdo do grid em formato html					//Div onde o grid será carregado
var controlsscript		=	'inc/ordem_producao_pi_grid.php';								
var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
var gridheaders =	{};							//Parâmetros utilizados pelo plugin tablesorter para manipular os headers da tabela			
/* Variaveis para a exibicao de mensagens e carregamento */
var consolediv = '#console';					//Div responsável por mostrar as mensagens de erro, info etc
var loadmsg = 'Carregando...aguarde';			//Mensagem ou animação durante a fase de carregamento
var searchdiv = '#searching';					//Div utilizada para realizar o search
			
/***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/	 	
$(document).ready(function(){
	//Ações click pesquesar PI
	$("#btPesquisarPI").click(function(){		
		var dataInicial = $("#dataInicial").val();
		var dataFinal = $("#dataFinal").val();
		var cor = $("#cor").val();
		var flag = $("#ck:checked").val();
		var espessura = $("#espessura").val();
		if(dataInicial !='' && dataFinal != ''){
			controlsscript		=	'inc/ordem_producao_pi_grid.php?dataInicial='+dataInicial+'&dataFinal='+dataFinal+'&cor='+cor+'&flag='+flag+'&espessura='+espessura;
			gridscript	=	'inc/ordem_producao_pi_grid.php?dataInicial='+dataInicial+'&dataFinal='+dataFinal+'&cor='+cor+'&flag='+flag+'&espessura='+espessura;
			/*## Chamada dos metodos para reload do grid ##*/			
			search();	
			gridLoader(searchfor, page);
			$("#grid").show();
			$("#pesquisaListaPi").show();
			$("#btGerarArquivo").show();
			$("#grid").show();
			$("#controls").show();
			$("#console").show();
			$("#btSelecionarTudo").show();
		}else{
			$('#boxAlerta').dialog('open');	
		}
	});
	//Ações click gerar arquivo AD
	$("#btGerarArquivo").click(function(){
		var $tamanho = $('#pi_selecionado:checked').length;	
		$.post('inc/cadastros/controle_acesso/acesso_visitante_ins.php', {codigoVisitante: codigoVisitante}, function(resposta) {
																																																																																																				
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
									$("#formularioAcessoVisitante").dialog("close");
								}
							}
				});
				$("#nomeVisitante").val(""); 
			}
		});								
		
	});
					
	});
	//Selecionar todos ckeckbox
	$("#btSelecionarTudo").click(function(){
		MarcarTodosCheckbox();	
	});	
	
	//Box data de emissão nao informada
	$( "#boxAlerta" ).dialog({
			autoOpen: false,
            modal: true,
            buttons: {
                Ok: function() {
                    $( this ).dialog( "close" );
					$('#dataInicial').focus();
                }
            }
    });
});
// Metodo para selecionar todos checkboxes
function MarcarTodosCheckbox(){

	$("input[name='pi_selecionado']").each(function(){
		if(!this.checked){
			$(this).attr("checked", "checked");
		}else{
			$(this).removeAttr("checked");
		}
	});

}
	 

