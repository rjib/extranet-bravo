/**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
/* Variaveis de configuracao dos controles do grid*/
var controlsdivclass	=	'.controls';		//Classe para aplicar a estilizacao nos controles
//Documento com o conteudo do grid em formato html
var gridscript	=	'inc/ordem_producao_pi_grid.php';			
var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid			
/* Variaveis de configuracao do grid*/
var griddivid 	=	'#grid';
//Documento com o conteudo do grid em formato html					//Div onde o grid ser� carregado
var controlsscript		=	'inc/ordem_producao_pi_grid.php';								
var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
var gridheaders =	{};							//Parametros utilizados pelo plugin tablesorter para manipular os headers da tabela			
/* Variaveis para a exibicao de mensagens e carregamento */
var consolediv = '#console';					//Div respons�vel por mostrar as mensagens de erro, info etc
var loadmsg = 'Carregando...aguarde';			//Mensagem ou anima��o durante a fase de carregamento
var searchdiv = '#searching';					//Div utilizada para realizar o search
			
/***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/	 	
$(document).ready(function(){
	//Acoes clique pesquisar pi
	$("#btPesquisarPI").click(function(){		
		var dataInicial = $("#dataInicial").val();
		var dataFinal = $("#dataFinal").val();
		var cor = $("#cor").val();
		var flag = $("#ck:checked").val();
		var espessura = $("#espessura").val();
		if(dataInicial !='' && dataFinal != ''){
			controlsscript		=	'inc/ordem_producao_pi_grid.php?dataInicial='+dataInicial+'&dataFinal='+dataFinal+'&cor='+cor+'&flag='+flag+'&espessura='+espessura;
			gridscript	=	'inc/ordem_producao_pi_grid.php?dataInicial='+dataInicial+'&dataFinal='+dataFinal+'&cor='+cor+'&flag='+flag+'&espessura='+espessura;
			//alert(gridscript);
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
	//Ação clique gerar arquivo AD
	$("#btGerarArquivo").click(function(){
		
		var tamanho = $('#pi_selecionado:checked').length;	
		var co_pi = new Array();
		//pega valores selecionados
		$("input[type=checkbox][name='pi_selecionado[]']:checked").each(function(){
			co_pi.push($(this).val());
		});
		//Box gerar arquivo AD
		$( "#formularioGerarArquivoAD" ).dialog({
				autoOpen: true,
	            modal: true,
				height: 200,
				width: 400,
				title: 'Gerar Arquivo .AD',
	            buttons: {
	                'Cancelar': function() {
	                	$( this ).dialog( "close" );
						var nomeArquivo			= $("#nomeArquivo").val('');
						var unidadeComplementar =  $("#unidadeComplementar").val('');
	                    
	                },
					'Gerar': function(){
						
						//pegando valores do formulario
						var dataInicial 		= $("#dataInicial").val();
						var dataFinal 			= $("#dataFinal").val();
						var cor 				= $("#cor").val();
						var flag 				= $("#ck:checked").val();
						var espessura 			= $("#espessura").val();
						var nomeArquivo			= $("#nomeArquivo").val();
						var unidadeComplementar =  $("#unidadeComplementar").val();
						
						if(nomeArquivo!="" && unidadeComplementar !=""){ //valida dados do formulario para gerar arquivo					
							$( "#boxGerando" ).dialog('open');
							$.post('inc/cadastros/ordem_producao_pi_gerar_ad.php', {
								co_pi:co_pi
								,dataInicial:dataInicial
								,dataFinal:dataFinal
								,cor:cor
								,flag:flag
								,espessura:espessura
								,nomeArquivo:nomeArquivo
								,unidadeComplementar:unidadeComplementar}, function(resposta) {
								
								if (resposta != false) {
									$('<p>' + resposta + '</p>').dialog({
										modal: true,
										resizable: false,
										title: 'Aten&ccedil;&atilde;o',
										buttons: {
											Ok: function() {
												$( "#boxGerando" ).dialog('close');
												$(this).dialog("close");												
											}
										}
									});
								} 
								else {
									$( "#boxGerando" ).dialog('close');
									$("<p>Arquivo gerado com sucesso!</p>").dialog({
										modal: true,
										resizable: false,
										title: 'Aten&ccedil;&atilde;o',
										buttons: {
											Ok: function() {												
												$(this).dialog("close");
												$("#formularioGerarArquivoAD").dialog("close");
												 
											}
										}
									});
								}//fim else
							});//fim post
						}//fim do if
						else{
							alert('Por favor informe o nome e a unidade complementar para continuar');
							$("#unidadeComplementar").focus();
							
						}//fim else
					}// fim gerar
	            },// fim buttons
				close: function() {
					// $("#grid").load("inc/ordem_producao_pi_grid.php?dataInicial="+dataInicial+"&dataFinal="+dataFinal+"&co_cor="+cor+"&espessura="+espessura+"&flag="+flag);
					$(window.document.location).attr('href','inicio.php?pg=ordem_producao');
					
				}
	    	});//fim box
		});//fim click
	
	
	//Selecionar todos ckeckbox
	$("#btSelecionarTudo").click(function(){
		MarcarTodosCheckbox();	
	});	
	
	//Box data de emissao nao informada
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
	
	//Box gerando arquivo...
	$( "#boxGerando" ).dialog({
			autoOpen: false,
            modal: true,
            closeOnEscape:false,
    		resizable:false,
    		draggable:false,
	}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();
	

});
// Metodo para selecionar todos checkboxes
function MarcarTodosCheckbox(){

	$("input[name='pi_selecionado[]']").each(function(){
		if(!this.checked){
			$(this).attr("checked", "checked");
		}else{
			$(this).removeAttr("checked");
		}
	});

}
	 
// Metodo para ocultar botoes para evitar alteracao de valores no submit
function ocultarBotoes(){	
	$("#btSelecionarTudo").hide();
	$("#btGerarArquivo").hide();
}
