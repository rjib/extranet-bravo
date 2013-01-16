$(function($) { 
	
	//boxLoadingEtiqueta
	$( "#boxLoadingEtiqueta" ).dialog({
		autoOpen: false,
        modal: true,
		height: 150,
		width: 250,
        closeOnEscape:false,
		resizable:false,
		draggable:false,
		title: 'Gerando etiquetas...'
	}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();
	

	$("#horaInicioInserir").mask("99:99");
	$("#horaFimInserir").mask("99:99");
			   
	$("#formularioApontamento").dialog({
		autoOpen: false,
		height: 300,
		width: 670,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Apontamento',
		buttons: {
			'Salvar': function() {
												
				var dataApontamento   = $("#dataApontamento").val();
				var codigoRecurso     = $("#codigoRecurso").val();
				var horaInicioInserir = $("#horaInicioInserir").val();
				var flagApontamento   = $("#flagApontamento").val();
				var codigoMotivo      = $("#codigoMotivo").val();
				var codigoPcpOp       = $("#codigoPcpOp").val();
				
				if($("input[name='flagApontamentoParada']").is(':checked')){
					flagApontamento = "1";
				}

				if($("input[name='flagApontamentoProducao']").is(':checked')){
					flagApontamento = "2";
				}
				
				$.post('inc/pcp/apontamento_ins.php', {dataApontamento: dataApontamento, codigoRecurso: codigoRecurso, horaInicioInserir: horaInicioInserir, flagApontamento: flagApontamento, codigoMotivo: codigoMotivo, codigoPcpOp: codigoPcpOp}, function(resposta) {
																																																																																																				
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
										$("#formularioApontamento").dialog("close");
									}
								}
							});
							$("#dataApontamento").val(""); 
							$("#dataApontamento02").val("");
							$("#usuario").val(""); 
							$("#codigoRecurso").val("");	
							$("#horaInicioInserir").val("");	
							$("#flagApontamento").val("");	
							$("#nomeMotivo").val("");	
							$("#descricaoMotivo").val(""); 
							$("#ordemProducao").val(""); 
							$("#descricaoProduto").val(""); 
							$("#loteOp").val(""); 
							$("#dataEmissaoOp").val(""); 
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#dataApontamento").val(""); 
				$("#dataApontamento02").val("");
				$("#usuario").val(""); 
				$("#codigoRecurso").val("");	
				$("#horaInicioInserir").val("");	
				$("#flagApontamento").val("");	
				$("#nomeMotivo").val("");	
				$("#descricaoMotivo").val(""); 
				$("#ordemProducao").val(""); 
				$("#descricaoProduto").val("");
				$("#loteOp").val(""); 
				$("#dataEmissaoOp").val("");  
			}
		},
		close: function() {
		    $("#grid").load("inc/pcp/apontamento_grid.php");
			$(window.document.location).attr('href','inicio.php?pg=apontamento');
		}
	});
	
	$("a[name=inserirHoraFimApontamento]").click(function (event){
		event.preventDefault();
		$("#formularioInserirHoraFimApontamento").load("inc/pcp/apontamento_form_hora_fim.php?codigoApontamento="+$(this).attr("id"));
		$("#formularioInserirHoraFimApontamento").dialog({
			autoOpen: true,
			height: 480,
			width: 730,
			modal: true,
			resizable: false,
			title: "Inserir Hora Fim Apontamento",
			buttons: {
				"Salvar": function() {
																	
					var codigoApontamento      = $("#codigoApontamento").val();
					var flagApontamentoHoraFim = $("#flagApontamentoHoraFim").val();
					var flagOrdemProducao      = $("#flagOrdemProducao").val();
					var quantidadeProduto      = $("#quantidadeProduto").val();
					var horaFimInserir         = $("#horaFimInserir").val();
					var horaInicio             = $("#horaInicio").val();
																
					$.post("inc/pcp/apontamento_hora_fim.php", {codigoApontamento: codigoApontamento, flagApontamentoHoraFim: flagApontamentoHoraFim, flagOrdemProducao: flagOrdemProducao, quantidadeProduto: quantidadeProduto, horaFimInserir: horaFimInserir, horaInicio: horaInicio}, function(resposta) {
																																																																																																											
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
						$("<p>Cadastro Hora Fim efetuado com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$("#formularioInserirHoraFimApontamento").dialog("close");
								$(this).dialog("close");
							}
						}
						});																											
					}
				});
											
			},
			"Cancelar": function() {
				$(this).dialog("close");
				$("#codigoApontamento").val(""); 
				$("#horaFimInserir").val(""); 
			}
			},
			close: function() {
				$("#grid").load("inc/pcp/apontamento_grid.php");
				$(window.document.location).attr('href','inicio.php?pg=apontamento');									
			}
			});
	});
	
	$("a[name=detalhesApontamento]").click(function (event){
		event.preventDefault();
		$("#formularioDetalhesApontamento").load("inc/pcp/apontamento_form_detalhe.php?codigoApontamento="+$(this).attr("id"));
		$("#formularioDetalhesApontamento").dialog({
			autoOpen: true,
			height: 430,
			width: 730,
			modal: true,
			resizable: false,
			title: "Detalhes Apontamento",
			buttons: {
				"Fechar": function() {
				    $(this).dialog("close");
					$("#codigoAcessoVisitante").val(""); 
					$("#horaEntradaAlterar").val(""); 
					$("#tipoVeiculoAlterar").val(""); 	
					$("#placaVeiculoAlterar").val("");	
					$("#numeroCartaoAlterar").val("");	
			}
			}
			});
	});
		
	$("#adicionarApontamento")
	    .button()
		.click(function() {
		$("#formularioApontamento").dialog("open");
	});
		
});

function getMotivoParada() {
	if($.trim($("#nomeMotivo").val()) != ""){
		if($("#nomeMotivo").val() != null && $("#nomeMotivo").val() != ""){
		  $.get('inc/pcp/pesquisa_motivo_parada.php', {'nomeMotivo': $("#nomeMotivo").val()}, function(resposta){
			if(resposta){			  			  
			  $("#codigoMotivo").val(resposta.codigoPcpMotivoParada);
			  $("#descricaoMotivo").val(resposta.descricaoMotivoParada);
			}else{
				alert("Motivo Parada não encontrada!");		
			}
		  }, 'json');  
		}
	}			
}

function getOrdemProducao() {
	if($.trim($("#ordemProducao").val()) != ""){
		if($("#ordemProducao").val() != null && $("#ordemProducao").val() != ""){
		  $.get('inc/pcp/pesquisa_ordem_producao.php', {'ordemProducao': $("#ordemProducao").val()}, function(resposta){
			if(resposta){			  			  
			  $("#codigoPcpOp").val(resposta.codigoPcpOp);
			  $("#descricaoProduto").val(resposta.descricaoProduto);
			  $("#loteOp").val(resposta.loteOp);
			  $("#dataEmissaoOp").val(resposta.dataEmissaoOP);
			}else{
				alert("OP não encontrada!");		
			}
		  }, 'json');  
		}
	}			
}

function getValidaOrdemProducao(ordemProducao) {
	if($.trim($("#ordemProducaoValida").val()) != ""){
		if($("#ordemProducaoValida").val() != null && $("#ordemProducaoValida").val() != ""){
			
			if(ordemProducao != $("#ordemProducaoValida").val()){
				$("#ordemProducaoValida").val("");
				$("#flagOrdemProducao").val("1");
				
				$('#colunaQuantidade01').hide('fast');
				$('#colunaQuantidade02').hide('fast');
				$('#colunaHoraFim01').hide('fast');
				$('#colunaHoraFim02').hide('fast');
				
				alert("OP diferente do Apontamento!");	
			}else{
				$("#flagOrdemProducao").val("2");
				$('#colunaQuantidade01').show('fast');
				$('#colunaQuantidade02').show('fast');
				$('#colunaHoraFim01').show('fast');
				$('#colunaHoraFim02').show('fast');
				$('#quantidadeProduto').focus();
			}
			  
		}
	}			
}

function verificaApontamento(v){
   
   if(v=='1'){		
		$('#apontamentoParada').show('fast');
		$('#apontamentoProducao01').hide('fast');
		$('#apontamentoProducao02').hide('fast');
		$("#ordemProducao").val("");
		$("#codigoPcpOp").val("");
		$("#descricaoProduto").val("");
		$("#quantidadeProduto").val("");
		$("#loteOp").val("");
		$("#dataEmissaoOp").val("");
		$("input[name='flagApontamentoProducao']").attr('checked', false);
		
   }else if(v=='2'){
		$('#apontamentoParada').hide('fast');
		$('#apontamentoProducao01').show('fast');
		$('#apontamentoProducao02').show('fast');
		$("#nomeMotivo").val(""); 
		$("#codigoMotivo").val(""); 
		$("#descricaoMotivo").val(""); 
		$("input[name='flagApontamentoParada']").attr('checked', false);
		$("#ordemProducao").focus();
   }
   
}

     /**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/
	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estiliza��o nos controles
	 var controlsscript		=	'inc/pcp/apontamento_grid.php';			//Documento com o conte�do do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid ser� carregado
	 var gridscript	=	'inc/pcp/apontamento_grid.php';					//Documento com o conte�do do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Par�metros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div respons�vel por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou anima��o durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/
     
    

     
 