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