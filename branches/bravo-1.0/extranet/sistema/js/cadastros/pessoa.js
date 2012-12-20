$(document).ready(function(){
$('#numeroCep').simpleAutoComplete('inc/auto_completa_cep.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'numeroCep'
	},cepCallback);
});
	
function cepCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoCep").val(""); 
		$("#numeroCep").val(""); 
		$("#logradouro").val("");
		$("#bairroLogradouro").val("");
		$("#estadoLogradouro").val("");
		$("#cidadeLogradouro").val("");			  
	}
	$("#codigoCep").val( par[1] );
	$("#numeroCep").val( par[2] );
	$("#logradouro").val( par[3] );
	$("#bairroLogradouro").val( par[4] );
	$("#estadoLogradouro").val( par[5] );
	$("#cidadeLogradouro").val( par[6] );
}

$(document).ready(function(){
    $('#nomeContatoTelefone').simpleAutoComplete('inc/auto_completa_contato.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'contato'
	},nomeContatoTelefoneCallback);
});
	
function nomeContatoTelefoneCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoContatoTelefone").val(""); 
	    $("#nomeContatoTelefone").val("");
	}
    $("#codigoContatoTelefone").val( par[1] );
}

$(document).ready(function(){
    $('#nomeContatoEmail').simpleAutoComplete('inc/auto_completa_contato.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'contato'
	},nomeContatoEmailCallback);
});

$(document).ready(function(){
    $('#nomeEmpresa').simpleAutoComplete('inc/auto_completa_empresa.php',{
	autoCompleteClassName: 'autocomplete',
	selectedClassName: 'sel',
	attrCallBack: 'rel',
	identifier: 'empresa'
	},nomeEmpresaCallback);
});

function nomeEmpresaCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoEmpresa").val(""); 
	    $("#nomeEmpresa").val("");
	}
    $("#codigoEmpresa").val( par[1] );
}

	
function nomeContatoEmailCallback(par){
	if(par[0] == "naoEcontrou"){
		$("#codigoContatoEmail").val(""); 
	    $("#nomeContatoEmail").val("");
	}
    $("#codigoContatoEmail").val( par[1] );
}

$(function($) {  
	
	$("#cpf").mask("999.999.999-99");
	$("#cnpj").mask("99.999.999/9999-99");  
    $("#dataEmissao").mask("99/99/9999");
	$("#dataNascimento").mask("99/99/9999");
	$("#telefoneContato").mask("(99) 9999-9999");
	$("#dataInicioRenda").mask("99/99/9999");
	$("#numeroCep").mask("99999-999");
	
	$("#clienteDesde").datepicker({
	    maxDate: new Date()
	});
	
	$(document).ready(function(){
	    
		//$("#palco > div").hide();
		$("input[name='pessoaTipoJuridica']").click(function(){
				$("#palco > div").hide();
				$("#pessoaTipoFisica").attr('checked', false); 
				$( '#'+$( this ).val() ).show('fast');
		});
		
		$("input[name='pessoaTipoFisica']").click(function(){
				$("#palco > div").hide();
				$("#pessoaTipoJuridica").attr('checked', false); 
				$( '#'+$( this ).val() ).show('fast');
		});
		
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
		//$("#gridEndereco").load("inc/cadastros/pessoa_grid_endereco.php");
		//$("#gridContato").load("inc/cadastros/pessoa_grid_contato.php");
		//$("#gridTelefone").load("inc/cadastros/pessoa_grid_telefone.php");
		//var codigoPessoa = $("#codigoPessoa").val(); 
		//$("#gridEmpresa").load("inc/cadastros/pessoa_alt_grid_empresa.php?codigoPessoa="+codigoPessoa);
		 
		
			
	});
	
	$("#formularioPessoa").submit(function() {
								 
		var pessoaTipoFisica   = $("#pessoaTipoFisica").val();
		var pessoaTipoJuridica = $("#pessoaTipoJuridica").val();
		var pessoaTipo;
		var nome             = $("#nome").val();
		var email           = $("#email").val();
		var site            = $("#site").val();
		
		var cnpj            = $("#cnpj").val();
		var ie              = $("#ie").val();
		
		var cpf             = $("#cpf").val();
		var rg              = $("#rg").val();
		var orgaoExpedidor  = $("#orgaoExpedidor").val();
		var dataEmissao     = $("#dataEmissao").val();
		var sexo            = $("#sexo").val();
		var dataNascimento  = $("#dataNascimento").val();
		var estadoCivil     = $("#estadoCivil").val();
		var nacionalidade   = $("#nacionalidade").val();
		var codigoEstado    = $("#codigoEstado").val();
		var codigoCidade    = $("#codigoCidade").val();
		var nivelFormacao   = $("#nivelFormacao").val();
		var profissao       = $("#profissao").val();		
		var codigoIr        = $("#codigoIr").val();
		var dataInicioRenda = $("#dataInicioRenda").val();
		var nomePai         = $("#nomePai").val();
		var nomeMae         = $("#nomeMae").val();
		
		if($('#pessoaTipoFisica').is(':checked')){
		    pessoaTipo = "F";
		}
								
		if($('#pessoaTipoJuridica').is(':checked')){
			pessoaTipo = "J";
		}
				
		$.post('inc/cadastros/pessoa_ins.php', {pessoaTipo: pessoaTipo, nome: nome, email: email, site: site, cnpj: cnpj, ie: ie, cpf: cpf, rg: rg, orgaoExpedidor: orgaoExpedidor, dataEmissao: dataEmissao, sexo: sexo, dataNascimento: dataNascimento, estadoCivil: estadoCivil, nacionalidade: nacionalidade, codigoEstado: codigoEstado, codigoCidade: codigoCidade, nivelFormacao: nivelFormacao, profissao: profissao, nomePai: nomePai, nomeMae: nomeMae}, function(resposta) {
		
				if (resposta != false) {
					$('<p>' + resposta + '!</p>').dialog({
						modal: true,
						resizable: false,
						title: 'Aten&ccedil;&atilde;o',
						buttons: {
							Ok: function() {
								$( this ).dialog( "close" );
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
								$( this ).dialog( "close" );
							}
						}
					});
					
					$("#botaoSalvar").hide();
					$("#botaoAdicionarEndereco").show('fast');
					$("#botaoAdicionarContato").show('fast');
					$("#botaoAdicionarCliente").show('fast');
					$("#botaoAdicionarTelefone").show('fast');
					$("#botaoAdicionarEmail").show('fast');
					$("#botaoAdicionarEmpresa").show('fast');
															
					// Atribuindo valor as campos					
					$("#pessoaTipo").val();
					$("#nome").val();
					$("#email").val();
					$("#site").val();
					
					$("#razaoSocial").val();
					$("#cnpj").val();
					$("#ie").val();
					
					$("#cpf").val();
					$("#rg").val();
					$("#orgaoExpedidor").val();
					$("#dataEmissao").val();
					$("#sexo").val();
					$("#dataNascimento").val();
					$("#estadoCivil").val();
					$("#nacionalidade").val();
					$("#codigoEstado").val();
					$("#codigoCidade").val();
					$("#nivelFormacao").val();
					$("#profissao").val();
					$("#nomePai").val();
					$("#nomeMae").val();
					
					// Desabilitando os campos					
					$("#pessoaTipo").attr("disabled", true);					
					$("#nome").attr("disabled", true);;
					$("#email").attr("disabled", true);
					$("#site").attr("disabled", true);
					
					$("#razaoSocial").attr("disabled", true);
					$("#cnpj").attr("disabled", true);
					$("#ie").attr("disabled", true);
					
					$("#cpf").attr("disabled", true);
					$("#rg").attr("disabled", true);
					$("#orgaoExpedidor").attr("disabled", true);
					$("#dataEmissao").attr("disabled", true);
					$("#sexo").attr("disabled", true);
					$("#dataNascimento").attr("disabled", true);
					$("#estadoCivil").attr("disabled", true);
					$("#nacionalidade").attr("disabled", true);
					$("#codigoEstado").attr("disabled", true);
					$("#codigoCidade").attr("disabled", true);
					$("#nivelFormacao").attr("disabled", true);
					$("#profissao").attr("disabled", true);					
					$("#nomePai").attr("disabled", true);
					$("#nomeMae").attr("disabled", true);
										
				}
		});
		
	});
	
	$("#confirmaExcluirPessoa").dialog({
		autoOpen: false,
		height: 140,
		modal: true,
		resizable: false,
		title: "Excluir Pessoa",
		buttons: {
			"Sim": function() {
					
				$.get("inc/cadastros/pessoa_ex.php", {codigoPessoa: codigoPessoa}, function(resposta) {
																																																																																																										
					if(resposta != false){
						$("<p>" + resposta + "</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								$(this).dialog("close");
								$("#confirmaExcluirPessoa").dialog("close");
							}
						}
						});
					}else{
						$("<p>Pessoa excluida com sucesso!</p>").dialog({
						modal: true,
						resizable: false,
						title: "Aten&ccedil;&atilde;o",
						buttons: {
							Ok: function() {
								var codigoPessoa = $("#codigoPessoa").val();
								$(this).dialog("close");
								$("#confirmaExcluirPessoa").dialog("close");
								$("#grid").load("inc/cadastros/pessoa_grid.php");
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
				var nomeContato = $("#nomeContato").val();
				var codigoPessoa  = $("#codigoPessoa").val();	
				//$(window.document.location).attr('href','inicio.php?pg=pessoa_alt&codigoPessoa='+codigoPessoa);
				$("#grid").load("inc/cadastros/pessoa_grid.php");
			}
	});
		
	$("#formularioEndereco").dialog({
		autoOpen: false,
		height: 420,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Endere&ccedil;o',
		buttons: {
			'Salvar': function() {
												
				var codigoPessoa              = $("#codigoPessoa").val(); 
				var codigoCep                 = $("#codigoCep").val(); 
				var numeroCep                 = $("#numeroCep").val(); 
				var logradouro                = $("#logradouro").val();
				var numeroLogradouro          = $("#numeroLogradouro").val();
				var complementoLogradouro     = $("#complementoLogradouro").val();
				var bairroLogradouro          = $("#bairroLogradouro").val();
				var estadoLogradouro          = $("#estadoLogradouro").val();
				var cidadeLogradouro          = $("#cidadeLogradouro").val();
				var principalLogradouro       = $("#principalLogradouro").val();
				var cobrancaLogradouro        = $("#cobrancaLogradouro").val(); 
				var correspondenciaLogradouro = $("#correspondenciaLogradouro").val();
				
				if($('#principalLogradouro').is(':checked')){
					principalLogradouro = "S";
				}else{
					principalLogradouro = "";
				}
								
				if($('#cobrancaLogradouro').is(':checked')){
					cobrancaLogradouro = "S";
				}else{
					cobrancaLogradouro = "";
				}
				
				if($('#correspondenciaLogradouro').is(':checked')){
					correspondenciaLogradouro = "S";
				}else{
					correspondenciaLogradouro = "";
				}
				
				$.post('inc/cadastros/pessoa_endereco_ins.php', {codigoCep: codigoCep, numeroCep: numeroCep, logradouro: logradouro, numeroLogradouro: numeroLogradouro, complementoLogradouro: complementoLogradouro, bairroLogradouro: bairroLogradouro, estadoLogradouro: estadoLogradouro, cidadeLogradouro: cidadeLogradouro, principalLogradouro: principalLogradouro, cobrancaLogradouro: cobrancaLogradouro, correspondenciaLogradouro: correspondenciaLogradouro, codigoPessoa:codigoPessoa}, function(resposta) {
																																																																																																				
						if (resposta != false) {
							$('<p>' + resposta + '</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$( this ).dialog( "close" );
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
										var codigoPessoa = $("#codigoPessoa").val();
										$( this ).dialog( "close" );
										$( "#formularioEndereco" ).dialog( "close" );
										$("#gridEndereco").load("inc/cadastros/pessoa_grid_endereco.php?codigoPessoa="+codigoPessoa);
										// $(window.document.location).attr("inicio.php?pg=pessoa_alt&codigoPessoa="+codigoPessoa+"#tab1");
										// $(window.document.location).attr("href","inicio.php?pg=pessoa_alt&codigoPessoa="+codigoPessoa+"#tab1");
									}
								}
							});
							
							$("#codigoCep").val(""); 
							$("#numeroCep").val("");
							$("#logradouro").val("");
							$("#numeroLogradouro").val("");
							$("#complementoLogradouro").val("");
							$("#bairroLogradouro").val("");
							$("#estadoLogradouro").val("");
							$("#cidadeLogradouro").val("");
							$("#principalLogradouro").attr('checked', false); 
							$("#cobrancaLogradouro").attr('checked', false); 
							$("#correspondenciaLogradouro").attr('checked', false); 
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#codigoCep").val(""); 
				$("#numeroCep").val("");
				$("#logradouro").val("");
				$("#numeroLogradouro").val("");
				$("#complementoLogradouro").val("");
				$("#bairroLogradouro").val("");
				$("#estadoLogradouro").val("");
				$("#cidadeLogradouro").val("");
				$("#principalLogradouro").attr('checked', false); 
				$("#cobrancaLogradouro").attr('checked', false); 
				$("#correspondenciaLogradouro").attr('checked', false); 
				
				
			}
		},
		close: function() {
			var codigoPessoa = $("#codigoPessoa").val();
		    $("#gridEndereco").load("inc/cadastros/pessoa_grid_endereco.php?codigoPessoa="+codigoPessoa);
		    //var nomeContato = $("#nomeContato").val();
			//var codigoPessoa  = $("#codigoPessoa").val();	
			//$(window.document.location).attr('href','inicio.php?pg=pessoa_alt&codigoPessoa='+codigoPessoa);
			
		}
	});
	

	$("#formularioEmpresa").dialog({
		autoOpen: false,
		height: 300,
		width: 450,
		modal: true,
		resizable: false,
		title: 'Adicionar Empresa',
		buttons: {
			'Salvar': function() {
												
				var codigoPessoa   = $("#codigoPessoa").val();
				var codigoEmpresa  = $("#codigoEmpresa").val();
								
				$.post('inc/cadastros/pessoa_empresa_ins.php', {codigoPessoa: codigoPessoa, codigoEmpresa:codigoEmpresa}, function(resposta) {
																																																																																																				
						if (resposta != false) {
							$('<p>' + resposta + '</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$( this ).dialog( "close" );
									}
								}
							});
						} 
						else {
							
							$('<p>Cadastro efetuado com sucesso!</p>').dialog({
								modal: true,
								resizable: false,
								height:150,
								width:250,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$( this ).dialog( "close" );
										$( "#formularioEmpresa" ).dialog( "close" );																		
										//$(window.document.location).attr("href","inicio.php?pg=pessoa_alt&codigoPessoa="+codigoPessoa+"#tab2");
										 $("#gridEmpresa").load("inc/cadastros/pessoa_grid_empresa.php?codigoPessoa="+codigoPessoa+"#tab6");
									}
								}
							});
							
							$("#nomeContato").val(""); 
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeContato").val(""); 
			}
		},
		close: function() {
			//var nomeContato = $("#nomeContato").val();
			var codigoPessoa  = $("#codigoPessoa").val();	
			//$(window.document.location).attr('href','inicio.php?pg=pessoa_alt&codigoPessoa='+codigoPessoa);
		   $("#gridEmpresa").load("inc/cadastros/pessoa_grid_empresa.php?codigoPessoa="+codigoPessoa+"#tab6");
		}
	});	
	
	
	$("#formularioContato").dialog({
		autoOpen: false,
		height: 150,
		width: 350,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Contato',
		buttons: {
			'Salvar': function() {
												
				var nomeContato = $("#nomeContato").val();
				var codigoPessoa  = $("#codigoPessoa").val();				
								
				$.post('inc/cadastros/pessoa_contato_ins.php', {nomeContato: nomeContato, codigoPessoa: codigoPessoa}, function(resposta) {
																																																																																																				
						if (resposta != false) {
							$('<p>' + resposta + '</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$( this ).dialog( "close" );
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
										var nomeContato = $("#nomeContato").val();
										var codigoPessoa  = $("#codigoPessoa").val();	
										$( this ).dialog( "close" );
										$( "#formularioContato" ).dialog( "close" );
										$("#gridContato").load("inc/cadastros/pessoa_grid_contato.php?codigoPessoa="+codigoPessoa);
										 
									}
								}
							});
							
							$("#nomeContato").val(""); 
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeContato").val(""); 
			}
		},
		close: function() {
			var nomeContato = $("#nomeContato").val();
			var codigoPessoa  = $("#codigoPessoa").val();			
			 $("#gridContato").load("inc/cadastros/pessoa_grid_contato.php?codigoPessoa="+codigoPessoa);
		}
	});
	
	$("#formularioCliente").dialog({
		autoOpen: false,
		height: 280,
		width: 600,
		modal: true,
		resizable: false,
		title: 'Adicionar Cliente',
		buttons: {
			'Salvar': function() {
				
				var situacaoCliente    = $("#situacaoCliente").val(); 
				var atividadeCliente   = $("#atividadeCliente").val(); 
				var clienteDesde       = $("#clienteDesde").val(); 
				var observacaoCliente  = $("#observacaoCliente").val(); 
								
				$.post('inc/cadastros/pessoa_cliente_ins.php', {situacaoCliente: situacaoCliente, atividadeCliente: atividadeCliente, clienteDesde: clienteDesde, observacaoCliente: observacaoCliente}, function(resposta) {
																																																																																																				
						if (resposta != false) {
							$('<p>' + resposta + '</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$( this ).dialog( "close" );
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
										$("#formularioCliente").dialog("close");
										$("#botaoAdicionarCliente").hide();
									}
								}
							});
							
							$("#situacaoCliente").val(""); 
							$("#atividadeCliente").val(""); 
							$("#clienteDesde").val(""); 
							$("#observacaoCliente").val(""); 
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#situacaoCliente").val(""); 
				$("#atividadeCliente").val(""); 
				$("#clienteDesde").val(""); 
				$("#observacaoCliente").val(""); 
			}
		},
		close: function() {
		    $("#gridCliente").load("inc/cadastros/pessoa_grid_cliente.php");
		}
	});
	
	$("#formularioTelefone").dialog({
		autoOpen: false,
		height: 220,
		width: 500,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Telefone',
		buttons: {
			'Salvar': function() {
				
				var codigoPessoa          = $("#codigoPessoa").val(); 
				var codigoContatoTelefone = $("#codigoContatoTelefone").val(); 
				var tipoTelefoneContato   = $("#tipoTelefoneContato").val(); 
				var flagFichaPessoaFisicaTelefone = $("#flagFichaPessoaFisicaTelefone").val(); 
				var telefoneContato       = $("#telefoneContato").val(); 
								
				$.post('inc/cadastros/pessoa_telefone_ins.php', {codigoPessoa: codigoPessoa, codigoContatoTelefone: codigoContatoTelefone, tipoTelefoneContato: tipoTelefoneContato, flagFichaPessoaFisicaTelefone: flagFichaPessoaFisicaTelefone, telefoneContato: telefoneContato}, function(resposta) {
																																																																																																				
						if (resposta != false) {
							$('<p>' + resposta + '</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$( this ).dialog( "close" );
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
										$( this ).dialog( "close" );
										$( "#formularioTelefone" ).dialog( "close" );
										 $("#gridTelefone").load("inc/cadastros/pessoa_grid_telefone.php?codigoPessoa="+codigoPessoa);
									}
								}
							});
							
							$("#nomeContatoTelefone").val(""); 
							$("#codigoContatoTelefone").val(""); 
							$("#tipoTelefoneContato").val("");
							$("#flagFichaPessoaFisicaTelefone").val("");
							$("#telefoneContato").val("");
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeContatoTelefone").val(""); 
				$("#codigoContatoTelefone").val(""); 
				$("#tipoTelefoneContato").val("");
				$("#flagFichaPessoaFisicaTelefone").val("");
				$("#telefoneContato").val("");
			}
		},
		close: function() {
			var nomeContato = $("#nomeContato").val();
			var codigoPessoa  = $("#codigoPessoa").val();			
			 $("#gridTelefone").load("inc/cadastros/pessoa_grid_telefone.php?codigoPessoa="+codigoPessoa);
		}
	});
	
	$("#formularioEmail").dialog({
		autoOpen: false,
		height: 200,
		width: 500,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Email',
		buttons: {
			'Salvar': function() {
				
				var codigoPessoa       = $("#codigoPessoa").val(); 
				var codigoContatoEmail = $("#codigoContatoEmail").val(); 
				var tipoEmailContato   = $("#tipoEmailContato").val(); 
				var emailContato       = $("#emailContato").val(); 
								
				$.post('inc/cadastros/pessoa_email_ins.php', {codigoPessoa: codigoPessoa, codigoContatoEmail: codigoContatoEmail, tipoEmailContato: tipoEmailContato, emailContato: emailContato}, function(resposta) {
																																																																																																				
						if (resposta != false) {
							$('<p>' + resposta + '</p>').dialog({
								modal: true,
								resizable: false,
								title: 'Aten&ccedil;&atilde;o',
								buttons: {
									Ok: function() {
										$( this ).dialog( "close" );
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
										$( this ).dialog( "close" );
										$( "#formularioEmail" ).dialog( "close" );
										var codigoPessoa  = $("#codigoPessoa").val();
										 $("#gridEmail").load("inc/cadastros/pessoa_grid_email.php?codigoPessoa="+codigoPessoa);
									}
								}
							});
							
							$("#nomeContatoEmail").val(""); 
							$("#codigoContatoEmail").val(""); 
							$("#tipoEmailContato").val(""); 
							$("#emailContato").val(""); 
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#nomeContatoEmail").val(""); 
				$("#codigoContatoEmail").val(""); 
				$("#tipoEmailContato").val(""); 
				$("#emailContato").val(""); 
			}
		},
		close: function() {
			var nomeContato = $("#nomeContato").val();
			var codigoPessoa  = $("#codigoPessoa").val();	
			 $("#gridEmail").load("inc/cadastros/pessoa_grid_email.php?codigoPessoa="+codigoPessoa);
			
		}
	});
			
	$("#paginaAdicionarPessoa")
	    .button()
		.click(function() {
		$(window.document.location).attr('href','inicio.php?pg=pessoa_ins');
	});
	
	$("#adicionarPessoa")
	    .button()
		.click(function() {
		$("#formularioPessoa").submit();
	});	
		
	$("#adicionarEndereco")
	    .button()
		.click(function() {
		$( "#formularioEndereco" ).dialog( "open" );
	});
	$("#adicionarEmpresa")
    .button()
	.click(function() {
	$( "#formularioEmpresa" ).dialog( "open" );
});
		
	$("#adicionarContato")
	    .button()
		.click(function() {
		$( "#formularioContato" ).dialog( "open" );
	});
		
	$("#adicionarCliente")
	    .button()
		.click(function() {
		$( "#formularioCliente" ).dialog( "open" );
	});
	
	$("#adicionarTelefone")
	    .button()
		.click(function() {
		$("#formularioTelefone").dialog("open");
	});
	
	$("#adicionarEmail")
	    .button()
		.click(function() {
		$("#formularioEmail").dialog("open");
	});
		
	$("a[name=excluirPessoa]").click(function(e){
		e.preventDefault();
		codigoPessoa = $(this).attr("id");
		$("#confirmaExcluirPessoa").dialog("open");
	});
	
	$("a[name=alterarPessoa]").click(function(e){
		e.preventDefault();
		$(window.document.location).attr('href','inicio.php?pg=pessoa_alt&codigoPessoa='+$(this).attr("id"));
	});
	
	$("#voltarPagina")
	    .button()
		.click(function() {
		history.back();
	});	
	
});



function verificaCPF() {
	
	if(validaCPF($("#cpf").val())){	
	
		if($("#cpf").val() != null && $("#cpf").val() != ""){
			
			$.get('inc/verifica_cpf.php', {'cpf': $("#cpf").val()}, function(resposta){
			if(resposta){			  			  
				$(function($) {
					$('<p>CPF j&aacute; cadastrado para a pessoa de c&oacute;digo: '+resposta.codigoPessoa+'</p>').dialog({
						modal: true,
						resizable: false,
						title: 'Aten&ccedil;&atilde;o',
						buttons: {
						Ok: function() {
							$(this).dialog('close');						
							$("#cpf").val(""); 
						}
					}
				});$("#cpf").val("");  });
			}
			}, 'json'); 
		}
	}else{
		$(function($) {
					$('<p>CPF inv&aacute;lido</p>').dialog({
						modal: true,
						resizable: false,
						title: 'Aten&ccedil;&atilde;o',
						buttons: {
						Ok: function() {
							$(this).dialog('close');						
							$("#cpf").val(""); 
						}
				 }
			});});
	}		
}

function verificaRG() {
    if($("#rg").val() != null && $("#rg").val() != ""){
	    $.get('inc/verifica_rg.php', {'rg': $("#rg").val()}, function(resposta){
		if(resposta){			  			  
			$(function($) {
			    $('<p>RG j&aacute; cadastrado para a pessoa de c&oacute;digo: '+resposta.codigoPessoa+'</p>').dialog({
				    modal: true,
				    resizable: false,
				    title: 'Aten&ccedil;&atilde;o',
				    buttons: {
				    Ok: function() {
						$(this).dialog('close');
						$("#rg").val(""); 
				    }
				}
			}); });
		}
		}, 'json'); 
	}		
}

	/**** INICIO CONFIGURACAO SCRIPT TABLESORTER *****/

	 /* Variaveis de configuracao dos controles do grid*/
	 var controlsdivclass	=	'.controls';		//Classe para aplicar a estiliza��o nos controles
	 var controlsscript		=	'inc/cadastros/pessoa_grid.php';			//Documento com o conte�do do grid em formato html
	 var controlsclass		= 	'tablesorter';		//Nome da classe aplicada aos controles do grid
	
	 /* Variaveis de configuracao do grid*/
	 var griddivid 	=	'#grid';					//Div onde o grid ser� carregado
	 var gridscript	=	'inc/cadastros/pessoa_grid.php';					//Documento com o conte�do do grid em formato html
	 var gridclass	= 	'tablesorter';				//Nome da classe aplicada ao grid
	 var gridheaders =	{};							//Par�metros utilizados pelo plugin tablesorter para manipular os headers da tabela
	
	 /* Variaveis para a exibicao de mensagens e carregamento */
	 var consolediv = '#console';					//Div respons�vel por mostrar as mensagens de erro, info etc
	 var loadmsg = 'Carregando...aguarde';			//Mensagem ou anima��o durante a fase de carregamento
     var searchdiv = '#searching';					//Div utilizada para realizar o search
	
     /***** FIM CONFIGURACAO SCRIPT TABLESORTER *****/
	 
	 
