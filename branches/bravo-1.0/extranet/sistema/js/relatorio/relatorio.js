$("#boxLoadingEtiquetaHeader").dialog({
	autoOpen : false,
	modal : true,
	height : 150,
	width : 250,
	closeOnEscape : false,
	resizable : false,
	draggable : false,
	title : 'Gerando etiquetas...'
}).dialog("widget").find("a.ui-dialog-titlebar-close").remove();

// BOX ETIQUETA DE PECA CASADEI
$("#boxEtiquetaPecaCasadeiStep1")
		.dialog(
				{
					autoOpen : false,
					height : 250,
					width : 550,
					modal : true,
					resizable : false,
					title : "Etiqueta Peca Casadei",
					buttons : {
						'Imprimir Etiquetas' : function() {

							if ($("#numeroOrdemProducaoStep1").val() != ''
									&& $("#descricaoProdutoStep1").val() != '') {
								$("#boxLoadingEtiquetaHeader").dialog("open");
								$
										.post(
												'ireport/relatorio/gerarCodeBarEtiquetaPecaCasaDeiPorOP.php',
												{
													'nu_op' : $(
															"#numeroOrdemProducaoStep1")
															.val()
												},
												function(data, status) {
													if (status == "success") {
														window
																.open(
																		"ireport/relatorio/pcp_etiqueta_casadei.php?nu_op="
																				+ $(
																						"#numeroOrdemProducaoStep1")
																						.val(),
																		"Etiqueta Peça (Casadei)",
																		"menubar=0,resizable=1,width=410,height=500,location=0");
														$(
																"#boxLoadingEtiquetaHeader")
																.dialog("close");
														$(
																"#boxEtiquetaPecaCasadeiStep1")
																.dialog("close");
														$(
																"#numeroOrdemProducaoStep1")
																.val('')
													}
												});
							} else {
								alert("Nenhuma OP válida foi encontrada!");

							}
						},
						'Cancelar' : function() {
							$(this).dialog('close');
							$("#numeroOrdemProducaoStep1").val('')
						}
					}
				});

$("#step1").hide();
$("#step2").hide();
$("#step3").hide();

// BOX ETIQUETA D PECA PI
$("#boxEtiquetaPecaStep2")
		.dialog(
				{
					autoOpen : false,
					height : 250,
					width : 550,
					modal : true,
					resizable : false,
					title : "Etiqueta Peca (PI)",
					buttons : {
						'Imprimir Etiquetas' : function() {

							if ($("#numeroOrdemProducaoStep2").val() != ''
									&& $("#descricaoProdutoStep2").val() != '') {
								$("#boxLoadingEtiquetaHeader").dialog("open");
								window
										.open(
												"ireport/relatorio/pcp_etiqueta_peca.php?nu_op="
														+ $(
																"#numeroOrdemProducaoStep2")
																.val(),
												"Etiqueta Peça (Casadei)",
												"menubar=0,resizable=1,width=410,height=500,location=0");
								$("#boxLoadingEtiquetaHeader").dialog("close");
								$("#boxEtiquetaPecaStep2").dialog("close");
								$("#numeroOrdemProducaoStep2").val('')
							} else {
								alert("Nenhuma OP válida foi encontrada!");
								$("#numeroOrdemProducaoStep2").focus();

							}
						},
						'Cancelar' : function() {
							$(this).dialog('close');
							$("#numeroOrdemProducaoStep2").val('')
						}
					}
				});

//BOX ETIQUETA DE PACOTE
$("#boxEtiquetaPecaStep3")
		.dialog(
				{
					autoOpen : false,
					height : 275,
					width : 550,
					modal : true,
					resizable : false,
					title : "Etiqueta de Pacote",
					buttons : {
						'Imprimir Etiquetas' : function() {
							 var tipo = $("input[@name=FlTipoEtiqueta]:checked").val();
							 
							if ($("#numeroOrdemProducaoStep3").val() != ''
									&& $("#descricaoProdutoStep3").val() != '') {
								$("#boxLoadingEtiquetaHeader").dialog("open");
								if(tipo =="Encantos"){
								$
										.post(
												'ireport/relatorio/gerarCodeBarEtiquetaPacotePorOP.php',
												{
													'nu_op' : $(
															"#numeroOrdemProducaoStep3")
															.val()
												},
												function(data, status) {
													if (status == "success") {
														window
																.open(
																		"ireport/relatorio/pcp_etiqueta_pacote_encantos.php?nu_op="
																				+ $(
																						"#numeroOrdemProducaoStep3")
																						.val(),
																		"Etiqueta Pacote",
																		"menubar=0,resizable=1,width=410,height=500,location=0");
														$(
																"#boxLoadingEtiquetaHeader")
																.dialog("close");
														$(
																"#boxEtiquetaPecaStep3")
																.dialog("close");
														$(
																"#numeroOrdemProducaoStep3")
																.val('')
													}
												});
								}else if(tipo =="Bravo"){
									$
									.post(
											'ireport/relatorio/gerarCodeBarEtiquetaPacotePorOP.php',
											{
												'nu_op' : $(
														"#numeroOrdemProducaoStep3")
														.val()
											},
											function(data, status) {
												if (status == "success") {
													window
															.open(
																	"ireport/relatorio/pcp_etiqueta_pacote_bravo.php?nu_op="
																			+ $(
																					"#numeroOrdemProducaoStep3")
																					.val(),
																	"Etiqueta Pacote",
																	"menubar=0,resizable=1,width=410,height=500,location=0");
													$(
															"#boxLoadingEtiquetaHeader")
															.dialog("close");
													$(
															"#boxEtiquetaPecaStep3")
															.dialog("close");
													$(
															"#numeroOrdemProducaoStep3")
															.val('')
												}
											});									
								}
								
							} else {
								alert("Nenhuma OP válida foi encontrada!");
								$("#numeroOrdemProducaoStep3").focus();

							}
						},
						'Cancelar' : function() {
							$(this).dialog('close');
							$("#numeroOrdemProducaoStep3").val('')
						}
					}
				});


function openBoxEtiquetaPecaCasadei() {
	$("#boxEtiquetaPecaCasadeiStep1").dialog('open');
	$("#numeroOrdemProducaoStep1").focus();
	$("#step1").hide();
}
function openBoxEtiquetaPecaPI() {
	$("#boxEtiquetaPecaStep2").dialog('open');
	$("#numeroOrdemProducaoStep2").focus();
	$("#step2").hide();
}
function openBoxEtiquetaPacote() {
	$("#boxEtiquetaPecaStep3").dialog('open');
	$("#numeroOrdemProducaoStep3").focus();
	$("#step3").hide();
}
function getValidaOrdemProducaoPecaCasadei() {
	if ($.trim($("#numeroOrdemProducaoStep1").val()) != "") {
		if ($("#numeroOrdemProducaoStep1").val() != null
				&& $("#numeroOrdemProducaoStep1").val() != "") {
			$.get('inc/relatorios/etiquetas/etiqueta_casadei_pesquisa_op.php',
					{
						'numeroOrdemProducaoStep1' : $(
								"#numeroOrdemProducaoStep1").val()
					}, function(resposta) {
						if (resposta) {
							$("#descricaoProdutoStep1")
									.val(resposta.ds_produto);
							$("#quantidadeProdutoStep1").val(
									resposta.qtd_produto);
							$("#loteStep1").val(resposta.nu_lote);
							$("#step1").show('fast');
						} else {
							alert("OP não encontrada!");
							$("#descricaoProdutoStep1").val('');
							$("#quantidadeProdutoStep1").val('');
							$("#loteStep1").val('');
							$("#step1").hide('fast');
						}
					}, 'json');
		}
	}
}

function getValidaOrdemProducaoPecaStep2() {
	if ($.trim($("#numeroOrdemProducaoStep2").val()) != "") {
		if ($("#numeroOrdemProducaoStep2").val() != null
				&& $("#numeroOrdemProducaoStep2").val() != "") {
			$.get('inc/relatorios/etiquetas/etiqueta_casadei_pesquisa_op.php',
					{
						'numeroOrdemProducaoStep1' : $(
								"#numeroOrdemProducaoStep2").val()
					}, function(resposta) {
						if (resposta) {
							$("#descricaoProdutoStep2")
									.val(resposta.ds_produto);
							$("#quantidadeProdutoStep2").val(
									resposta.qtd_produto);
							$("#loteStep2").val(resposta.nu_lote);
							$("#step2").show('fast');
						} else {
							alert("OP não encontrada!");
							$("#descricaoProdutoStep2").val('');
							$("#quantidadeProdutoStep2").val('');
							$("#loteStep2").val('');
							$("#step2").hide('fast');
						}
					}, 'json');
		}
	}
}
function getValidaOrdemProducaoPecaStep3() {
	if ($.trim($("#numeroOrdemProducaoStep3").val()) != "") {
		if ($("#numeroOrdemProducaoStep3").val() != null
				&& $("#numeroOrdemProducaoStep3").val() != "") {
			
			$.get('inc/relatorios/etiquetas/etiqueta_casadei_pesquisa_op.php',
					{
						'numeroOrdemProducaoStep3' : $(
								"#numeroOrdemProducaoStep3").val()
					}, function(resposta) {
						if (resposta) {
							$("#descricaoProdutoStep3")
									.val(resposta.ds_produto);
							$("#quantidadeProdutoStep3").val(
									resposta.qtd_produto);
							$("#loteStep3").val(resposta.nu_lote);
							$("#step3").show('fast');
						} else {
							alert("OP não encontrada!");
							$("#descricaoProdutoStep3").val('');
							$("#quantidadeProdutoStep3").val('');
							$("#loteStep3").val('');
							$("#step3").hide('fast');
						}
					}, 'json');
		}
	}
}