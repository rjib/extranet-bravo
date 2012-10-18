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
	$("#btPesquisarPI").click(function(){		
		var dataInicial = $("#dataInicial").val();
		var dataFinal = $("#dataFinal").val();
		var cor = $("#cor").val();
		var flag = $("#ck").val();
		var espessura = $("#espessura").val();
		if(dataInicial !='' && dataFinal != ''){
			controlsscript		=	'inc/ordem_producao_pi_grid.php?dataInicial='+dataInicial+'&dataFinal='+dataFinal+'&cor='+cor+'&flag='+flag+'&espessura='+espessura;
			gridscript	=	'inc/ordem_producao_pi_grid.php?dataInicial='+dataInicial+'&dataFinal='+dataFinal+'&cor='+cor+'&flag='+flag+'&espessura='+espessura;
			//Inicia a função search para o input designado para esta função			
			search();	
			//Carrega o grid
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
	
	$("#btSelecionarTudo").click(function(){
		MarcarTodosCheckbox();	
	});
	
	
	
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

function MarcarTodosCheckbox(){

	$("input[name='pi_selecionado[]']").each(function(){
		if(!this.checked){
			$(this).attr("checked", "checked");
		}else{
			$(this).removeAttr("checked");
		}
	});

}
	 

