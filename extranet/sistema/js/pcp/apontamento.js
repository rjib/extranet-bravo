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
	
	$("input[name='quantidadeProduto']").bind("keyup blur focus", function(e) {
        e.preventDefault();
        var expre = /[^0-9]/g;
        //REMOVE OS CARACTERES DA EXPRESSAO ACIMA
        if($(this).val().match(expre))
            $(this).val($(this).val().replace(expre,''));
    });
			   
	$("#formularioApontamento").dialog({
		autoOpen: false,
		height: 330,
		width: 670,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Apontamento',
		buttons: {
			'Salvar': function() {
												
				var dataApontamento    = $("#dataApontamento").val();
				var codigoRecurso      = $("#codigoRecurso").val();
				var horaInicioInserir  = $("#horaInicioInserir").val();
				var flagApontamento    = $("#flagApontamento").val();
				var codigoMotivoParada = $("#codigoMotivoParada").val();
				var codigoPcpOp        = $("#codigoPcpOp").val();
				var codigoOperacao     = $("#codigoOperacao").val();
				
				if($("input[name='flagApontamentoParada']").is(':checked')){
					flagApontamento = "1";
				}

				if($("input[name='flagApontamentoProducao']").is(':checked')){
					flagApontamento = "2";
				}
				
				$.post('inc/pcp/apontamento_ins.php', {dataApontamento: dataApontamento, codigoRecurso: codigoRecurso, horaInicioInserir: horaInicioInserir, flagApontamento: flagApontamento, codigoMotivoParada: codigoMotivoParada, codigoPcpOp: codigoPcpOp, codigoOperacao: codigoOperacao}, function(resposta) {
																																																																																																				
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
							$("#codigoOperacao").val(""); 
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
				$("#codigoOperacao").val("");  
			}
		},
		close: function() {
		    $("#grid").load("inc/pcp/apontamento_grid.php");
			$(window.document.location).attr('href','inicio.php?pg=apontamento');
		}
	});
	
	$("#confirmaExcluirApontamento").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Apontamento",
		buttons: {
			"Sim": function() {
					
				$.get("inc/pcp/apontamento_ex.php", {codigoApontamento: codigoApontamento}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirApontamento").dialog("close");
							}
						}
						});
					}else{
						$("<p>Apontamento excluido com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirApontamento").dialog("close");
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
				$("#grid").load("inc/pcp/apontamento_grid.php");
			}
	});
	
	$("a[name=inserirHoraFimApontamento]").click(function (event){
		event.preventDefault();
		$("#formularioInserirHoraFimApontamento").load("inc/pcp/apontamento_form_hora_fim.php?codigoApontamento="+$(this).attr("id"));
		$("#formularioInserirHoraFimApontamento").dialog({
			autoOpen: true,
			height: 490,
			width: 690,
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
			height: 440,
			width: 720,
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
	
	$(document).ready(function(){
	 
		//Default Action
		$(".tab_content").hide(); //Hide all content
		$("ul.tabs li:first").addClass("active").show(); //Activate first tab
		$(".tab_content:first").show(); //Show first tab content
		
		//On Click Event
		$("ul.tabs li").click(function() {
			$("ul.tabs li").removeClass("active"); //Remove any "active" class
			$(this).addClass("active"); //Add "active" class to selected tab
			$(".tab_content").hide(); //Hide all tab content
			var activeTab = $(this).find("a").attr("href"); //Find the rel attribute value to identify the active tab + content
			$(activeTab).fadeIn(); //Fade in the active content
			return false;
		});
		
		$("table").tablesorter();
		$('#gridApontamento').load('inc/pcp/apontamento_grid_produtos.php');
		
	});
		
	$("#adicionarApontamento")
	    .button()
		.click(function() {
		$("#formularioApontamento").dialog("open");
	});
	
	$("#adicionarApontamentoJob")
	    .button()
		.click(function() {
		$(window.document.location).attr('href','inicio.php?pg=apontamento_job');	
	});
	
	$("#adicionarApontamentoPerda")
	    .button()
		.click(function() {
		$(window.document.location).attr('href','inicio.php?pg=apontamento_perda');	
	});
	
	$("a[name=excluirApontamento]").click(function(e){
		e.preventDefault();
		codigoApontamento = $(this).attr("id");
		$("#confirmaExcluirApontamento").dialog("open");
	});		
		
});

function getMotivoParada() {
	if($.trim($("#nomeMotivoParada").val()) != ""){
		if($("#nomeMotivoParada").val() != null && $("#nomeMotivoParada").val() != ""){
		  $.get('inc/pcp/pesquisa_motivo_parada.php', {'nomeMotivoParada': $("#nomeMotivoParada").val()}, function(resposta){
			if(resposta){			  			  
			  $("#codigoMotivoParada").val(resposta.codigoPcpMotivoParada);
			  $("#descricaoMotivoParada").val(resposta.descricaoMotivoParada);
			}else{
				alert("Motivo Parada não encontrada!");		
			}
		  }, 'json');  
		}
	}			
}

function getMotivoPerda() {
	if($.trim($("#nomeMotivoPerda").val()) != ""){
		if($("#nomeMotivoPerda").val() != null && $("#nomeMotivoPerda").val() != ""){
		  $.get('inc/pcp/pesquisa_motivo_perda.php', {'nomeMotivoPerda': $("#nomeMotivoPerda").val()}, function(resposta){
			if(resposta){			  			  
			  $("#codigoMotivoPerda").val(resposta.codigoMotivoPerda);
			  $("#descricaoMotivoPerda").val(resposta.descricaoMotivoPerda);
			}else{
				alert("Motivo Perda não encontrada!");		
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
				$("#opQuantidadeNecessaria").val(resposta.quantidadeProdutoOP); 
				$("#codigoProduto").val(resposta.codigoProduto);
				$("#codigoInternoProduto").val(resposta.codigoInterno);
				$("#corProduto").val(resposta.corProduto); 
				
				$('#apontamentoProducao05').show('fast');
				
				buscaOperacaoProduto(resposta.codigoProduto);
				
			}else{
				alert("OP não encontrada!");		
			}
		  }, 'json');  
		}
	}			
}

function getOrdemProducaoPerda() {
	if($.trim($("#ordemProducaoPerda").val()) != ""){
		if($("#ordemProducaoPerda").val() != null && $("#ordemProducaoPerda").val() != ""){
		  $.get('inc/pcp/pesquisa_ordem_producao_perda.php', {'ordemProducaoPerda': $("#ordemProducaoPerda").val()}, function(resposta){
			if(resposta){			  			  
			    $("#codigoPcpOpPerda").val(resposta.codigoPcpOp);
			    $("#descricaoProdutoPerda").val(resposta.descricaoProduto);
			    $("#loteOpPerda").val(resposta.loteOp);
			    $("#dataEmissaoOpPerda").val(resposta.dataEmissaoOP);
				$("#opPerdaQuantidadeNecessaria").val(resposta.quantidadeProdutoOP); 
			    $("#codigoProdutoPerda").val(resposta.codigoProduto); 
				$("#codigoInternoProdutoPerda").val(resposta.codigoInterno); 
				$("#corProdutoPerda").val(resposta.corProduto); 
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
        $('#horaInicioTitle').show('fast');
		$('#horaInicioInserir').show('fast');
		$('#apontamentoParada').show('fast');
		$('#apontamentoProducao01').hide('fast');
		$('#apontamentoProducao02').hide('fast');
		$('#apontamentoProducao03').hide('fast');
		$('#apontamentoProducao05').hide('fast');
		$("#ordemProducao").val("");
		$("#codigoPcpOp").val("");
		$("#descricaoProduto").val("");
		$("#quantidadeProduto").val("");
		$("#codigoInternoProduto").val(""); 
		$("#codigoProduto").val(""); 
		$("#loteOp").val("");
		$("#dataEmissaoOp").val("");
		$("input[name='flagApontamentoProducao']").attr('checked', false);
   }else if(v=='2'){
		$('#apontamentoParada').hide('fast');
		$('#horaInicioTitle').show('fast');
		$('#horaInicioInserir').show('fast');
		$('#apontamentoProducao01').show('fast');
		$('#apontamentoProducao02').show('fast');
		$('#apontamentoProducao03').show('fast');
				
		$("#nomeMotivo").val(""); 
		$("#codigoMotivo").val(""); 
		$("#descricaoMotivo").val("")
		$("input[name='flagApontamentoParada']").attr('checked', false);
		$("#ordemProducao").focus();
   }else if(v=='3'){
	    $('#horaInicioTitle').hide('fast');
		$('#horaInicioInserir').hide('fast');
		$('#apontamentoParada').hide('fast');	
		$('#apontamentoProducao01').hide('fast');
		$('#apontamentoProducao02').hide('fast');
		$('#apontamentoProducao03').hide('fast');
		$('#apontamentoProducao05').hide('fast');	
		$("#nomeMotivo").val(""); 
		$("#codigoMotivo").val(""); 
		$("#descricaoMotivo").val("")
		$("input[name='flagApontamentoParada']").attr('checked', false);
		$("input[name='flagApontamentoProducao']").attr('checked', false);
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
 