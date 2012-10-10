<?php

	/**
	 * Formulario alteracao de pessoa.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */
	 
	unset($_SESSION['codigoPessoa']); 

	$sqlPessoa = mysql_query("SELECT PESSOA.CO_PESSOA
							      , DATE_FORMAT(PESSOA.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
							      , PESSOA.NO_PESSOA
							      , PESSOA.TP_PESSOA
								  , PESSOA.EM_PESSOA
								  , PESSOA.SITE_PESSOA
							      , PESSOA_FISICA.CO_ESTADO_CIVIL
								  , PESSOA_FISICA.CPF_PESSOA_FISICA
								  , PESSOA_FISICA.RG_PESSOA_FISICA
								  , PESSOA_FISICA.RG_ORGAO_PESSOA_FISICA
								  , DATE_FORMAT(PESSOA_FISICA.DT_EMISSAO_RG_PESSOA_FISICA, '%d/%m/%Y') AS DT_EMISSAO_RG_PESSOA_FISICA
								  , DATE_FORMAT(PESSOA_FISICA.DT_NASCIMENTO_PESSOA_FISICA, '%d/%m/%Y') AS DT_NASCIMENTO_PESSOA_FISICA
								  , PESSOA_FISICA.TP_SEXO_PESSOA_FISICA
								  , PESSOA_FISICA.CO_NACIONALIDADE
								  , PESSOA_FISICA.CO_UF
								  , ESTADO.DS_UF
								  , PESSOA_FISICA.CO_MUNICIPIO
								  , MUNICIPIO.NO_MUNICIPIO
								  , PESSOA_FISICA.CO_NIVEL_FORMACAO
								  , PESSOA_FISICA.CO_PROFISSAO
								  , PESSOA_FISICA.NO_PAI
								  , PESSOA_FISICA.NO_MAE
								  , PESSOA_JURIDICA.CNPJ_PESSOA_JURIDICA
								  , PESSOA_JURIDICA.IE_PESSOA_JURIDICA
							  FROM tb_pessoa PESSOA
							      LEFT JOIN tb_pessoa_fisica PESSOA_FISICA
							          ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
							      LEFT JOIN tb_pessoa_juridica PESSOA_JURIDICA
							          ON PESSOA.CO_PESSOA = PESSOA_JURIDICA.CO_PESSOA
								  LEFT JOIN tb_uf ESTADO
									    ON PESSOA_FISICA.CO_UF = ESTADO.CO_UF
								  LEFT JOIN tb_municipio MUNICIPIO
									    ON PESSOA_FISICA.CO_MUNICIPIO = MUNICIPIO.CO_MUNICIPIO
							  WHERE PESSOA.CO_PESSOA = '".$_GET['codigoPessoa']."'")
	or die("<script>
			    alert('[Erro 01] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowPessoa=mysql_fetch_array($sqlPessoa);
	
    $sqlEstadoCivil = mysql_query("SELECT CO_ESTADO_CIVIL, NO_ESTADO_CIVIL FROM tb_estado_civil ORDER BY NO_ESTADO_CIVIL",$conexaoERP)
	or die("<script>
			    alert('[Erro 02] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	$sqlNacionalidade = mysql_query("SELECT CO_NACIONALIDADE, NO_NACIONALIDADE FROM tb_nacionalidade ORDER BY NO_NACIONALIDADE",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	$sqlNivelFormacao = mysql_query("SELECT CO_NIVEL_FORMACAO, NO_NIVEL_FORMACAO FROM tb_nivel_formacao ORDER BY NO_NIVEL_FORMACAO",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
			
	$sqlProfissao = mysql_query("SELECT CO_PROFISSAO, NO_PROFISSAO FROM tb_profissao ORDER BY NO_PROFISSAO",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	$sqlEstado = mysql_query("SELECT CO_UF, DS_UF FROM tb_uf ORDER BY DS_UF")
	or die ("<script>
			     alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			     history.back(-1);
			 </script>"); 
	$rowEstado = mysql_num_rows($sqlEstado);

	
	$sqlContatoTelefone = mysql_query("SELECT CO_CONTATO, NO_CONTATO FROM tb_contato WHERE CO_PESSOA = '".$_GET['codigoPessoa']."' ORDER BY NO_CONTATO ",$conexaoERP)
	or die("<script>
			    alert('[Erro 05] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	$sqlContatoEmail = mysql_query("SELECT CO_CONTATO, NO_CONTATO FROM tb_contato WHERE CO_PESSOA = '".$_GET['codigoPessoa']."' ORDER BY NO_CONTATO ",$conexaoERP)
	or die("<script>
			    alert('[Erro 05] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
			
	$sqlTipoTelefone = mysql_query("SELECT CO_TIPO_TELEFONE, NO_TIPO_TELEFONE FROM tb_tipo_telefone ORDER BY NO_TIPO_TELEFONE",$conexaoERP)
	or die("<script>
			    alert('[Erro 06] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	$sqlTipoEmail = mysql_query("SELECT CO_TIPO_EMAIL, NO_TIPO_EMAIL FROM tb_tipo_email ORDER BY NO_TIPO_EMAIL",$conexaoERP)
	or die("<script>
			    alert('[Erro 07] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
			 
?>
<script type="text/javascript" language="javascript">

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

$(function($) {  
	
	$("#cpf").mask("999.999.999-99");
	$("#cnpj").mask("99.999.999/9999-99");  
    $("#dataEmissao").mask("99/99/9999");
	$("#dataNascimento").mask("99/99/9999");
	$("#faxLogradouro").mask("(99) 9999-9999");
	$("#telefoneContato").mask("(99) 9999-9999");
	//$("#numeroCep").mask("99999-999");
		
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
		$("#gridEndereco").load("inc/cadastros/pessoa_alt_grid_endereco.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
		$("#gridContato").load("inc/cadastros/pessoa_alt_grid_contato.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
		$("#gridTelefone").load("inc/cadastros/pessoa_alt_grid_telefone.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
		$("#gridEmail").load("inc/cadastros/pessoa_alt_grid_email.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
		
	});
	
	$("#formularioPessoaAlterar").submit(function() {
								 
		var codigoPessoa   = $("#codigoPessoa").val();
		var pessoaTipo     = $("#pessoaTipo").val();
		var nome           = $("#nome").val();
		var email          = $("#email").val();
		var site           = $("#site").val();
		
		var razaoSocial    = $("#razaoSocial").val();
		var cnpj           = $("#cnpj").val();
		var ie             = $("#ie").val();
		
		var cpf                = $("#cpf").val();
		var rg                 = $("#rg").val();
		var orgaoExpedidor     = $("#orgaoExpedidor").val();
		var dataEmissao    	   = $("#dataEmissao").val();
		var sexo               = $("#sexo").val();
		var dataNascimento     = $("#dataNascimento").val();
		var estadoCivilAlterar = $("#estadoCivilAlterar").val();
		var nacionalidade      = $("#nacionalidade").val();
		var codigoEstado       = $("#codigoEstado").val();
		var codigoCidade       = $("#codigoCidade").val();
		var nivelFormacao      = $("#nivelFormacao").val();
		var profissao          = $("#profissao").val();
		var ocupacao           = $("#ocupacao").val();
		var codigoIr           = $("#codigoIr").val();
		var dataInicioRenda    = $("#dataInicioRenda").val();
		var nomePai            = $("#nomePai").val();
		var nomeMae            = $("#nomeMae").val();
		
		$.post('inc/cadastros/pessoa_alt.php', {codigoPessoa: codigoPessoa, pessoaTipo: pessoaTipo, nome: nome, email: email, site: site, razaoSocial: razaoSocial, cnpj: cnpj, ie: ie, cpf: cpf, rg: rg, orgaoExpedidor: orgaoExpedidor, dataEmissao: dataEmissao, sexo: sexo, dataNascimento: dataNascimento, estadoCivilAlterar: estadoCivilAlterar, nacionalidade: nacionalidade, codigoEstado: codigoEstado, codigoCidade: codigoCidade, nivelFormacao: nivelFormacao, profissao: profissao, ocupacao: ocupacao, codigoIr: codigoIr, dataInicioRenda: dataInicioRenda, nomePai: nomePai, nomeMae: nomeMae}, function(resposta) {
		
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
					
					$('<p>Altera&ccedil;&atilde;o efetuada com sucesso!</p>').dialog({
						modal: true,
						resizable: false,
						title: 'Aten&ccedil;&atilde;o',
						buttons: {
							Ok: function() {
								$( this ).dialog( "close" );
							}
						}
					});
										
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
					$("#estadoCivilAlterar").val();
					$("#nacionalidade").val();
					$("#codigoEstado").val();
					$("#codigoCidade").val();
					$("#nivelFormacao").val();
					$("#profissao").val();
					$("#ocupacao").val();
					$("#codigoIr").val();
					$("#dataInicioRenda").val();
					$("#nomePai").val();
					$("#nomeMae").val();
															
				}
		});
		
	});
	
	$("#formularioEndereco").dialog({
		autoOpen: false,
		height: 380,
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
				
				if($('#entregaLogradouro').is(':checked')){
					entregaLogradouro = "S";
				}else{
					entregaLogradouro = "";
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
				
				$.post('inc/cadastros/pessoa_endereco_ins.php', {codigoPessoa: codigoPessoa, codigoCep: codigoCep, numeroCep: numeroCep, logradouro: logradouro, numeroLogradouro: numeroLogradouro, complementoLogradouro: complementoLogradouro, bairroLogradouro: bairroLogradouro, estadoLogradouro: estadoLogradouro, cidadeLogradouro: cidadeLogradouro, principalLogradouro: principalLogradouro, cobrancaLogradouro: cobrancaLogradouro, correspondenciaLogradouro: correspondenciaLogradouro}, function(resposta) {
																																																																																																				
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
										$( "#formularioEndereco" ).dialog( "close" );
									}
								}
							});
							
							$("#codigoCep").val(""); 
							$("#numeroCep").val("");
							$("#logradouro").val("");
							$("#logradouro02").val("");
							$("#numeroLogradouro").val("");
							$("#complementoLogradouro").val("");
							$("#bairroLogradouro").val("");
							$("#bairroLogradouro02").val("");
							$("#estadoLogradouro").val("");
							$("#estadoLogradouro02").val("");
							$("#cidadeLogradouro").val("");
							$("#cidadeLogradouro02").val("");
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
				$("#logradouro02").val("");
				$("#numeroLogradouro").val("");
				$("#complementoLogradouro").val("");
				$("#bairroLogradouro").val("");
				$("#bairroLogradouro02").val("");
				$("#estadoLogradouro").val("");
				$("#estadoLogradouro02").val("");
				$("#cidadeLogradouro").val("");
				$("#cidadeLogradouro02").val("");
				$("#principalLogradouro").attr('checked', false); 
				$("#cobrancaLogradouro").attr('checked', false); 
				$("#correspondenciaLogradouro").attr('checked', false); 
				
			}
		},
		close: function() {
		    $("#gridEndereco").load("inc/cadastros/pessoa_alt_grid_endereco.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
			
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
				
				var codigoPessoa = $("#codigoPessoa").val(); 
				var nomeContato  = $("#nomeContato").val(); 
								
				$.post('inc/cadastros/pessoa_contato_ins.php', {codigoPessoa: codigoPessoa, nomeContato: nomeContato}, function(resposta) {
																																																																																																				
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
										$( "#formularioContato" ).dialog( "close" );
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
		    $("#gridContato").load("inc/cadastros/pessoa_alt_grid_contato.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
		}
	});
	
	$("#formularioTelefone").dialog({
		autoOpen: false,
		height: 200,
		width: 450,
		modal: true,
		resizable: false,
		title: 'Adicionar novo Telefone',
		buttons: {
			'Salvar': function() {
				
				var codigoPessoa                  = $("#codigoPessoa").val(); 
				var codigoContatoTelefone         = $("#codigoContatoTelefone").val(); 
				var tipoTelefoneContato           = $("#tipoTelefoneContato").val(); 
				var telefoneContato               = $("#telefoneContato").val(); 
								
				$.post('inc/cadastros/pessoa_telefone_ins.php', {codigoPessoa: codigoPessoa, codigoContatoTelefone: codigoContatoTelefone, tipoTelefoneContato: tipoTelefoneContato, telefoneContato: telefoneContato}, function(resposta) {
																																																																																																				
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
									}
								}
							});
							
							$("#codigoContatoTelefone").val(""); 
							$("#tipoTelefoneContato").val("");
							$("#telefoneContato").val("");
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#codigoContatoTelefone").val(""); 
				$("#tipoTelefoneContato").val("");
				$("#telefoneContato").val("");
			}
		},
		close: function() {
		    $("#gridTelefone").load("inc/cadastros/pessoa_alt_grid_telefone.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
		}
	});
	
	$("#formularioEmail").dialog({
		autoOpen: false,
		height: 200,
		width: 450,
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
									}
								}
							});
							
							$("#codigoContatoEmail").val(""); 
							$("#tipoEmailContato").val(""); 
							$("#emailContato").val(""); 
							
						}
				});
								
			},
			'Cancelar': function() {
				$(this).dialog("close");
				$("#codigoContatoEmail").val(""); 
				$("#tipoEmailContato").val(""); 
				$("#emailContato").val(""); 
			}
		},
		close: function() {
		    $("#gridEmail").load("inc/cadastros/pessoa_alt_grid_email.php?codigoPessoa=<?php echo $rowPessoa['CO_PESSOA']; ?>");
		}
	});
		
	$("#voltarPagina")
	    .button()
		.click(function() {
		history.back();
	});
	
	$("#adicionarPessoa")
	    .button()
		.click(function() {
		$("#formularioPessoaAlterar").submit();
	});		
		
	$("#adicionarEndereco")
	    .button()
		.click(function() {
		$("#formularioEndereco").dialog("open");
	});
		
	$("#adicionarContato")
	    .button()
		.click(function() {
		$("#formularioContato").dialog("open");
	});
		
	$("#adicionarCliente")
	    .button()
		.click(function() {
		$("#formularioCliente").dialog("open");
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
		
});

</script>
<script type="text/javascript" src="js/cadastros/pessoa.js"></script>
<div id="header-wrap">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="img/bg_header.jpg">
    <tr>
    <td>
	<!--INICIO HEADER-->
	<?php require("inc/header.php"); ?>
	<!--FINAL HEADER-->
	</td>
    </tr>
</table>
</div>

<!--INICIO CONTEUDO-->
<div id="ie6-container-wrap">
<div id="container">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td>
	        <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td><img src="img/title/title_pessoa.jpg" width="1003" height="40" /></td>
              </tr>
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr> 
		            <td valign="top">
                    <table width="1003" border="0" cellspacing="0" cellpadding="0" class="TABLE_FULL01">
		              <tr>
		                <td align="center" bgcolor="#F7F7F7"><img src="img/space.gif" width="8" height="8" /></td>
	                  </tr>
		              <tr>
		                <td align="center" bgcolor="#F7F7F7"><table width="986" border="0" cellspacing="0" cellpadding="0">
		                  <tr>
		                    <td align="center" bgcolor="#FFFFFF">
                            <form name="formularioPessoaAlterar" id="formularioPessoaAlterar" method="post" action="javascript:func()">
		                      <table width="970" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td height="40" colspan="4" align="left" valign="bottom"><font class="FONT03"><b>Pessoa:</b></font></td>
	                            </tr>
		                        <tr>
		                          <td colspan="4" align="left"><hr style="color:#A1A3A0; background-color:#A1A3A0; height: 1px; border: 0px "/></td>
	                            </tr>
		                        <tr>
		                          <td colspan="4" align="left" style="border: 2px solid rgb(255, 204, 0); padding: 7px;">
		                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
		                              <tr>
		                                <td width="11%"><b>Tipo de Pessoa:</b></td>
		                                <td width="7%"><input type="radio" name="pessoaTipoFisica" id="pessoaTipoFisica" value="F" <?php if($rowPessoa['TP_PESSOA'] == "F"){echo "checked='checked'";}?> disabled="disabled" />F&iacute;sica</td>
		                                <td width="82%">
                                        <input type="radio" name="pessoaTipoJuridica" id="pessoaTipoJuridica" value="J" <?php if($rowPessoa['TP_PESSOA'] == "J"){echo "checked='checked'";}?> disabled="disabled" />
		                                Juridica
		                                <input type="hidden" name="pessoaTipo" id="pessoaTipo" value="<?php echo $rowPessoa['TP_PESSOA']; ?>"/></td>
	                                  </tr>
                                  </table></td>
	                            </tr>
		                        <tr>
		                          <td align="left">&nbsp;<font class="FONT04"><b>C&oacute;digo:</b></font></td>
		                          <td colspan="3" align="left">
                                  <input title="C&oacute;digo" name="codigo" id="codigo" type="text" class="INPUT01" size="10" maxlength="80" value="<?php echo $rowPessoa['CO_PESSOA']; ?>" disabled="disabled"/>
                                  <input type="hidden" name="codigoPessoa" id="codigoPessoa" value="<?php echo $rowPessoa['CO_PESSOA']; ?>"/>
                                  </td>
	                            </tr>
		                        <tr>
		                          <td align="left">&nbsp;<font class="FONT04"><b>Data Cadastro:</b></font></td>
		                          <td colspan="3" align="left">
                                  <input title="Data Cadastro" name="dataCadastro" id="dataCadastro" type="text" class="INPUT03" size="16" maxlength="180" value="<?php echo $rowPessoa['DT_CADAS']; ?>" disabled="disabled"/>
                                  </td>
	                            </tr>
		                        <tr>
		                          <td width="88" align="left">&nbsp;<font class="FONT04"><b>Nome:</b></font></td>
		                          <td colspan="3" align="left"><input title="Nome" name="nome" id="nome" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowPessoa['NO_PESSOA']; ?>"/></td>
	                            </tr>
		                        <tr>
		                          <td width="88" align="left">&nbsp;<font class="FONT04"><b>E-mail:</b></font></td>
		                          <td width="240" align="left"><input title="E-mail" name="email" id="email" type="text" class="INPUT01" size="40" maxlength="80" value="<?php echo $rowPessoa['EM_PESSOA']; ?>"/></td>
		                          <td width="34" align="left"><font class="FONT04"><b>Site:</b></font></td>
		                          <td width="584" align="left"><input title="Site" name="site" id="site" type="text" class="INPUT01" size="60" maxlength="80" value="<?php echo $rowPessoa['SITE_PESSOA']; ?>"/></td>
	                            </tr>
		                        <tr>
		                          <td colspan="4" align="left">
                                  <div id="palco">
                                  
                                  <div id="J" <?php if($rowPessoa['TP_PESSOA'] == "F"){echo "style='display:none'";}?>>
                                  <table width="970" border="0" cellspacing="2" cellpadding="3">
                                  <tr>
                                    <td width="78"><b>CNPJ:</b></td>
                                    <td width="136" align="left"><input title="CNPJ" name="cnpj" id="cnpj" type="text" class="INPUT03" size="15" maxlength="18" value="<?php echo $rowPessoa['CNPJ_PESSOA_JURIDICA']; ?>"/></td>
                                    <td width="104" align="left"><b>Inscri&ccedil;&atilde;o Estadual:</b></td>
                                    <td width="618" align="left"><input title="Inscri&ccedil;&atilde;o Estadual" name="ie" type="text" class="INPUT01" size="30" maxlength="30" value="<?php echo $rowPessoa['IE_PESSOA_JURIDICA']; ?>"/></td>
                                  </tr>
                                  </table>
                                  </div>
                                  
                                  <div id="F" <?php if($rowPessoa['TP_PESSOA'] == "J"){echo "style='display:none'";}?>>
                                  <table width="970" border="0" cellspacing="2" cellpadding="3">
                                  <tr>
                                    <td width="75"><b>CPF:</b></td>
                                    <td width="151" align="left"><input title="CPF" name="cpf" id="cpf" type="text" class="INPUT01" size="20" maxlength="180" value="<?php echo $rowPessoa['CPF_PESSOA_FISICA']; ?>"  onblur="verificaCPF()"/></td>
                                    <td width="98" align="left"><b>RG:</b></td>
                                    <td width="157" align="left"><input title="RG" name="rg" id="rg" type="text" class="INPUT01" size="12" maxlength="12" value="<?php echo $rowPessoa['RG_PESSOA_FISICA']; ?>" onblur="verificaRG()"/></td>
                                    <td width="97" align="left"><b>Org&atilde;o Expedidor:</b></td>
                                    <td width="83" align="left"><input title="Org&atilde;o Expedidor" name="orgaoExpedidor" id="orgaoExpedidor" type="text" class="INPUT01" size="10" maxlength="180" value="<?php echo $rowPessoa['RG_ORGAO_PESSOA_FISICA']; ?>"/></td>
                                    <td width="76" align="left"><b>Data Emiss&atilde;o:</b></td>
                                    <td width="142" align="left"><input title="Data Emiss&atilde;o" name="dataEmissao" id="dataEmissao" type="text" class="INPUT03" size="10" maxlength="10" value="<?php echo $rowPessoa['DT_EMISSAO_RG_PESSOA_FISICA']; ?>"/></td>
                                  </tr>
                                  <tr>
                                    <td><b>Sexo:</b></td>
                                    <td align="left">
                                    <select title="Sexo" name="sexo" id="sexo" class="SELECT01">
                                        <option value="M" <?php if($rowPessoa['TP_SEXO_PESSOA_FISICA'] == "M"){echo "selected='selected'";}?>>Masculino</option>
                                        <option value="F" <?php if($rowPessoa['TP_SEXO_PESSOA_FISICA'] == "F"){echo "selected='selected'";}?>>Feminino</option>
                                    </select>
                                    </td>
                                    <td align="left"><b>Data Nascimento:</b></td>
                                    <td align="left"><input title="Data Nascimento" name="dataNascimento" id="dataNascimento" type="text" class="INPUT03" size="8" maxlength="180" value="<?php echo $rowPessoa['DT_NASCIMENTO_PESSOA_FISICA']; ?>"/></td>
                                    <td align="left"><b>Estado Civil:</b></td>
                                    <td colspan="3" align="left">
                                      <select title="Estado Civil" name="estadoCivilAlterar" id="estadoCivilAlterar" class="SELECT01" style="width:180px">
                                        <?php
                                        while($rowEstadoCivil=mysql_fetch_array($sqlEstadoCivil)){
											if($rowEstadoCivil['CO_ESTADO_CIVIL'] == $rowPessoa['CO_ESTADO_CIVIL']){
											    echo "<option value='".$rowEstadoCivil['CO_ESTADO_CIVIL']."' selected='selected'>".$rowEstadoCivil['NO_ESTADO_CIVIL']."</option>";
										    }else{
											    echo "<option value='".$rowEstadoCivil['CO_ESTADO_CIVIL']."'>".$rowEstadoCivil['NO_ESTADO_CIVIL']."</option>";
										    }
                                        }	
                                    ?>
                                        </select>
                                    </td>
                                    </tr>
                                  <tr>
                                    <td><b>Nacionalidade:</b></td>
                                    <td align="left"><select title="Nacionalidade" name="nacionalidade" id="nacionalidade" class="SELECT01">
                                      <?php
                                        while($rowNacionalidade=mysql_fetch_array($sqlNacionalidade)){
											if($rowNacionalidade['CO_NACIONALIDADE'] == $rowPessoa['CO_NACIONALIDADE']){
											    echo "<option value='".$rowNacionalidade['CO_NACIONALIDADE']."' selected='selected'>".$rowNacionalidade['NO_NACIONALIDADE']."</option>";
										    }else{
											    echo "<option value='".$rowNacionalidade['CO_NACIONALIDADE']."'>".$rowNacionalidade['NO_NACIONALIDADE']."</option>";
										    }
                                        }	
                                    ?>
                                      </select></td>
                                    <td align="left"><b>N&iacute;vel Forma&ccedil;&atilde;o:</b></td>
                                    <td colspan="5" align="left"><select title="N&iacute;vel Forma&ccedil;&atilde;o" name="nivelFormacao" id="nivelFormacao" class="SELECT01">
                                      <?php
                                        while($rowNivelFormacao=mysql_fetch_array($sqlNivelFormacao)){
											if($rowNivelFormacao['CO_NIVEL_FORMACAO'] == $rowPessoa['CO_NIVEL_FORMACAO']){
											    echo "<option value='".$rowNivelFormacao['CO_NIVEL_FORMACAO']."' selected='selected'>".$rowNivelFormacao['NO_NIVEL_FORMACAO']."</option>";
										    }else{
											    echo "<option value='".$rowNivelFormacao['CO_NIVEL_FORMACAO']."'>".$rowNivelFormacao['NO_NIVEL_FORMACAO']."</option>";
										    }
                                        }	
                                    ?>
                                    </select></td>
                                    </tr>
                                  <tr>
                                    <td><b>Naturalidade:</b></td>
                                    <td colspan="7" align="left">
                                      <select name="codigoEstado" id="codigoEstado" class="SELECT01" onchange="BuscaCidade(this.value);" >
                                        <option value="<?php echo $rowPessoa['CO_UF']; ?>"><?php echo $rowPessoa['DS_UF']; ?></option>
                                        <option value="0">--Selecione o estado &gt;&gt;</option>
                                        <?php for($i=0; $i<$rowEstado; $i++) { ?>
                                        <option value="<? echo mysql_result($sqlEstado, $i, "CO_UF"); ?>"> <?php echo mysql_result($sqlEstado, $i, "DS_UF"); ?></option>
                                        <?php } ?>
                                        </select>
                                      &nbsp;&nbsp;
                                      <select name="codigoCidade" id="codigoCidade" class="SELECT01">
                                        <option id="opcoes" value="<?php echo $rowPessoa['CO_MUNICIPIO']; ?>"><?php echo $rowPessoa['NO_MUNICIPIO']; ?></option>
                                        <option id="opcoes" value="0">--Primeiro selecione o estado--</option>
                                        </select>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td><b>Profiss&atilde;o:</b></td>
                                    <td colspan="7" align="left">
                                      <select title="Profiss&atilde;o" name="profissao" id="profissao" class="SELECT01" style="width:385px">
                                        <?php
                                        while($rowProfissao=mysql_fetch_array($sqlProfissao)){
											if($rowProfissao['CO_PROFISSAO'] == $rowPessoa['CO_PROFISSAO']){
											    echo "<option value='".$rowProfissao['CO_PROFISSAO']."' selected='selected'>".$rowProfissao['NO_PROFISSAO']."</option>";
										    }else{
											    echo "<option value='".$rowProfissao['CO_PROFISSAO']."'>".$rowProfissao['NO_PROFISSAO']."</option>";
										    }
                                        }	
                                    ?>
                                        </select>
                                      </td>
                                  </tr>
                                  <tr>
                                    <td colspan="8"><hr style="color:#A1A3A0; background-color:#A1A3A0; height: 1px; border: 0px "/></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;<font class="FONT04"><b>Nome Pai:</b></font></td>
                                    <td colspan="7" align="left"><input title="Nome Pai" name="nomePai" id="nomePai" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowPessoa['NO_PAI']; ?>"/></td>
                                    </tr>
                                  <tr>
                                    <td>&nbsp;<font class="FONT04"><b>Nome M&atilde;e:</b></font></td>
                                    <td colspan="7" align="left"><input title="Nome M&atilde;e" name="nomeMae" id="nomeMae" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowPessoa['NO_MAE']; ?>"/></td>
                                    </tr>
                                  </table>
                                  </div>
                                  
                                  </div>
                                  </td>
	                              </tr>		                        
                                <tr>
		                          <td colspan="4" align="left">
                                      <div id="botaoSalvar">
                                      <button type="button" id="adicionarPessoa" title="Salvar">Salvar</button>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <button type="button" id="voltarPagina" title="Cancelar">Cancelar</button>
                                      </div>
                                  </td>
	                            </tr>
	                          </table>
		                      </form>
                              </td>
	                      </tr>
		                  </table></td>
	                  </tr>
		              <tr>
		                <td align="center" bgcolor="#F7F7F7"><img src="img/space.gif" width="8" height="8" /></td>
	                  </tr>
	                </table></td>
	            </tr>
                <tr>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td>
                
                <ul class="tabs">
                <li><a title="Endere&ccedil;os" href="#tab1">Endere&ccedil;os</a></li>
                <li><a title="Contatos" href="#tab2">Contatos</a></li>
                <li><a title="Telefones" href="#tab3">Telefones</a></li>
                <li><a title="E-mails" href="#tab4">E-mails</a></li>
    			</ul>
                
                <div class="tab_container">
                    
                    <div id="tab1" class="tab_content">
                    	<div id="formularioEndereco">
                            <form id="formularioEndereco" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td colspan="6" align="left">
                                  <div id="status"></div>
                                  </td>
	                            </tr>
		                        <tr>
		                          <td width="97" align="left"><font class="FONT04"><b>CEP:</b></font></td>
		                          <td colspan="5" align="left">
                                      <input title="CEP" name="numeroCep" id="numeroCep" size="10" maxlength="9" class="INPUT03" autocomplete="off"/>
                                      <input type="hidden" name="codigoCep" id="codigoCep" />
                                      <input type="hidden" name="codigoPessoa" id="codigoPessoa" value="<?php echo $rowPessoa['CO_PESSOA']; ?>" />
                                  </td>
	                            </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Logradouro:</b></font></td>
		                          <td colspan="5">
                                      <input title="Logradouro" name="logradouro" id="logradouro" class="INPUT01" size="50" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>N&uacute;mero:</b></font></td>
		                          <td colspan="5">
                                      <input title="N&uacute;mero" name="numeroLogradouro" id="numeroLogradouro" type="text" class="INPUT03" size="10" maxlength="180" />
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Complemento:</b></font></td>
		                          <td colspan="5">
                                      <input title="Complemento" name="complementoLogradouro" id="complementoLogradouro" type="text" class="INPUT01" size="50" maxlength="180" />
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Bairro:</b></font></td>
		                          <td colspan="5">
                                      <input title="Bairro" name="bairroLogradouro" id="bairroLogradouro" class="INPUT01" size="30" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Estado:</b></font></td>
		                          <td colspan="5">
                                      <input title="Estado" name="estadoLogradouro" id="estadoLogradouro" size="2" maxlength="2" class="INPUT01" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Cidade:</b></font></td>
		                          <td colspan="5">
                                      <input title="Cidade" name="cidadeLogradouro" id="cidadeLogradouro" class="INPUT01" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Principal:</b></font></td>
		                          <td width="127" align="left"><input title="Principal" type="checkbox" name="principalLogradouro" id="principalLogradouro" value="S" /></td>
		                          <td width="70" align="right"><font class="FONT04"><b>Cobran&ccedil;a:</b></font></td>
		                          <td width="112" align="left"><input title="Cobran&ccedil;a" type="checkbox" name="cobrancaLogradouro" id="cobrancaLogradouro" value="S" /></td>
		                          <td width="129" align="right"><font class="FONT04"><b>Correspond&ecirc;ncia:</b></font></td>
		                          <td width="418" align="left"><input title="Correspond&ecirc;ncia" type="checkbox" name="correspondenciaLogradouro" id="correspondenciaLogradouro" value="S" /></td>
  </tr>
	                          </table>
		                    </form>
                        </div>
                        <div id="botaoAdicionarEndereco">
                        <button title="Adicionar novo Endere&ccedil;o" id="adicionarEndereco">Adicionar novo Endere&ccedil;o</button>
                        <br /><br />
                        </div>
                        <div id="gridEndereco"></div>                            
            		</div>
        			
                    <div id="tab2" class="tab_content">
                        <div id="formularioContato">
                            <form id="formularioContato" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="5%" align="left"><font class="FONT04"><b>Nome:</b></font></td>
		                          <td width="95%" colspan="7" align="left">
                                      <input title="Nome" name="nomeContato" id="nomeContato" type="text" class="INPUT02" size="40" maxlength="80" />
                                      <input type="hidden" name="codigoPessoa" id="codigoPessoa" value="<?php echo $rowPessoa['CO_PESSOA']; ?>" />
                                  </td>
  								</tr>
	                          </table>
		                    </form>
                        </div>
            			<div id="botaoAdicionarContato"><button title="Adicionar novo Contato" id="adicionarContato">Adicionar novo Contato</button></div>
                        <br />
                        <div id="gridContato"></div>     
					</div>
        			                    
                    <div id="tab3" class="tab_content">
                        <div id="formularioTelefone">
                            <form id="formularioTelefone" action="javascript:func()" method="post">
		                    <table width="420" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="85" align="left"><font class="FONT04"><b>Contato:</b></font></td>
		                          <td align="left">
                                  <input type="hidden" name="codigoPessoa" id="codigoPessoa" value="<?php echo $rowPessoa['CO_PESSOA']; ?>"/>
                                  <select title="Contato" name="codigoContatoTelefone" id="codigoContatoTelefone" class="SELECT01" style="width:320px">
		                              <option value="0">Selecione...</option>
									  <?php
                                          while($rowContatoTelefone=mysql_fetch_array($sqlContatoTelefone)){ 	
                                              echo "<option value='".$rowContatoTelefone['CO_CONTATO']."'>".$rowContatoTelefone['NO_CONTATO']."</option>";
                                          }	
                                      ?>
	                              </select></td>
	                            </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo Telefone:</b></font></td>
		                          <td align="left"><select title="Tipo Telefone" name="tipoTelefoneContato" id="tipoTelefoneContato" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                          while($rowTipoTelefone=mysql_fetch_array($sqlTipoTelefone)){ 	
                                              echo "<option value='".$rowTipoTelefone['CO_TIPO_TELEFONE']."'>".$rowTipoTelefone['NO_TIPO_TELEFONE']."</option>";
                                          }	
                                      ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Telefone:</b></font></td>
		                          <td align="left"><input title="Telefone" name="telefoneContato" id="telefoneContato" type="text" class="INPUT03" size="15" maxlength="14" /></td>
	                          </tr>
	                          </table>
		                    </form>
                        </div>
            			<div id="botaoAdicionarTelefone"><button title="Adicionar novo Telefone" id="adicionarTelefone">Adicionar novo Telefone</button></div>
                        <br />
                        <div id="gridTelefone"></div>     
					</div>
                    
                    <div id="tab4" class="tab_content">
                        <div id="formularioEmail">
                            <form id="formularioEmail" action="javascript:func()" method="post">
		                    <table width="420" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="85" align="left"><font class="FONT04"><b>Contato:</b></font></td>
		                          <td align="left">
                                  <input type="hidden" name="codigoPessoa" id="codigoPessoa" value="<?php echo $rowPessoa['CO_PESSOA']; ?>"/>
                                  <select title="Contato" name="codigoContatoEmail" id="codigoContatoEmail" class="SELECT01" style="width:320px">
		                              <option value="0">Selecione...</option>
									  <?php
                                          while($rowContatoEmail=mysql_fetch_array($sqlContatoEmail)){ 	
                                              echo "<option value='".$rowContatoEmail['CO_CONTATO']."'>".$rowContatoEmail['NO_CONTATO']."</option>";
                                          }	
                                      ?>
	                              </select></td>
	                            </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo E-mail:</b></font></td>
		                          <td align="left"><select title="Tipo E-mail" name="tipoEmailContato" id="tipoEmailContato" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                          while($rowTipoEmail=mysql_fetch_array($sqlTipoEmail)){ 	
                                              echo "<option value='".$rowTipoEmail['CO_TIPO_EMAIL']."'>".$rowTipoEmail['NO_TIPO_EMAIL']."</option>";
                                          }	
                                      ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>E-mail:</b></font></td>
		                          <td align="left"><input title="E-mail" name="emailContato" id="emailContato" type="text" class="INPUT01" size="50" maxlength="40" /></td>
	                          </tr>
	                          </table>
		                    </form>
                        </div>
            			<div id="botaoAdicionarEmail"><button title="Adicionar novo E-mail" id="adicionarEmail">Adicionar novo E-mail</button></div>
                        <br />
                        <div id="gridEmail"></div>     
					</div>
                    
    			</div>
                
                </td>
                </tr>
	        </table>
        </td>
    </tr>
</table>
</div>
</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php require("inc/footer.php"); ?>
<!--FINAL FOOTER-->