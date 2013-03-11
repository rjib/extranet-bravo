<?php
	
	session_start();
	
	/**
	 * Script responsavel por inserir apontamentos de perda.
	 * 
	 * @author Euripedes B. Silva Junior <ejunior@bravomoveis.com>
	 * @version 1.0 - 04/03/2013 09:00
	 * 
	 */
	 
	require_once 'setup.php';
	require_once 'models/tb_modulos.php';
	
	$co_papel = $_SESSION['codigoPapel'];
	$modulos = new tb_modulos($conexaoERP);
	$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, PCP, PCP_APONTAMENTO_PERDA);

	if($acoes['NO_MODULO'] == PCP_APONTAMENTO_PERDA){
		
		if($_GET['op'] == "excluir"){
	    	$excluir = $_GET['check'];
	    	$indice = $excluir;
	    	unset($_SESSION['perdaOrdemProducaoImporta'][$indice]);
    	} 

		$sqlRecurso = mysql_query("SELECT PCP_RECURSO.CO_PCP_RECURSO, PCP_RECURSO.NO_RECURSO 
		                           FROM tb_pcp_recurso PCP_RECURSO
								   WHERE PCP_RECURSO.FL_DELET IS NULL
								   AND EXISTS(SELECT null 
								              FROM tb_pcp_usuario_recurso PCP_USUARIO_RECURSO
											  WHERE PCP_USUARIO_RECURSO.CO_PCP_RECURSO = PCP_RECURSO.CO_PCP_RECURSO
											  AND PCP_USUARIO_RECURSO.CO_USUARIO = '".$_SESSION['codigoUsuario']."')
								   AND NOT EXISTS(SELECT null
												  FROM tb_pcp_apontamento PCP_APONTAMENTO
												  WHERE PCP_APONTAMENTO.CO_RECURSO = PCP_RECURSO.CO_PCP_RECURSO
												  AND PCP_APONTAMENTO.HR_FIM IS NULL
												  AND PCP_APONTAMENTO.FL_DELET IS NULL)
								   ORDER BY PCP_RECURSO.NO_RECURSO")
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
			
?>

<script type="text/javascript" language="javascript">

$(function($) {  
	
	$("#horaInicioInserir").mask("99:99");
			
	$("#formularioApontamentoPerda").submit(function() {
		
		var dataApontamento   = $("#dataApontamento").val();
		var codigoRecurso     = $("#codigoRecurso").val();
		var horaInicioInserir = $("#horaInicioInserir").val();
		var flagApontamento   = $("#flagApontamento").val();
					
		if($("input[name='flagApontamentoPerda']").is(':checked')){
		    flagApontamento = "3";
		}		
		
		var codigoOperacao = new Array();
					
		$("select[name='codigoOperacao[]']").each(function(){
		    codigoOperacao.push($(this).val());
		});						
		
		$.post('inc/pcp/apontamento_ins.php', {dataApontamento: dataApontamento, codigoRecurso: codigoRecurso, horaInicioInserir: horaInicioInserir, flagApontamento: flagApontamento, codigoOperacao: codigoOperacao}, function(resposta) {
		
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
								$(window.document.location).attr('href','inicio.php?pg=apontamento');
							}
						}
					});				
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
		$('#gridApontamento').load('inc/pcp/apontamento_perda_grid_produtos.php');
		
	});
	
	$("#adicionarApontamento")
	    .button()
		.click(function() {
		$("#formularioApontamentoJob").submit();
	});	
	
	$("#voltarPagina")
	    .button()
		.click(function() {
		$(window.document.location).attr('href','inicio.php?pg=apontamento');	
	});	
		
});

function getOrdemProducao() {
	if($.trim($("#ordemProducao").val()) != ""){
		if($("#ordemProducao").val() != null && $("#ordemProducao").val() != ""){
		  $.get('inc/pcp/pesquisa_ordem_producao_perda.php', {'ordemProducao': $("#ordemProducao").val()}, function(resposta){
			if(resposta){			  			  
			    $("#gridApontamento").load("inc/pcp/apontamento_perda_grid_produtos.php");
				$("#ordemProducao").val();
				$("#adicionarApontamento").show('fast');				
			}else{
		        alert("OP não encontrada!");		
			}
		  }, 'json');  
		}
	}			
}

</script>
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
	              <td><img src="img/title/pcp/title_apontamento.jpg" width="1003" height="40" /></td>
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
                            <form name="formularioApontamentoPerda" id="formularioApontamentoPerda" method="post" action="javascript:func()">
		                      <table width="970" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td height="40" colspan="4" align="left" valign="bottom"><font class="FONT03"><b>Dados Apontamento:</b></font></td>
	                            </tr>
		                        <tr>
		                          <td colspan="4" align="left"><hr style="color:#A1A3A0; background-color:#A1A3A0; height: 1px; border: 0px "/></td>
	                            </tr>
		                        <tr>
		                          <td width="61" align="left"><font class="FONT04"><b>Data:</b></font></td>
		                          <td width="128" align="left"><input title="Data" name="dataApontamento02" id="dataApontamento02" type="text" class="INPUT03" size="8" maxlength="10" value="<?php echo date("d-m-Y"); ?>" disabled="disabled"/>
                                  <input type="hidden" id="dataApontamento" name="dataApontamento" value="<?php echo date("Y-m-d"); ?>"/></td>
		                          <td width="57" align="left"><font class="FONT04"><b>Usuário:</b></font></td>
		                          <td width="690" align="left"><input title="Usuário" type="text" name="usuario" id="usuario" class="INPUT01" size="50" value="<?php echo $_SESSION['codigoUsuario']." - ".$_SESSION['nomePessoa']." [".$_SESSION['loginUsuario']."]"; ?>" disabled="disabled" /></td>
	                            </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Recurso:</b></font></td>
		                          <td colspan="3" align="left"><select title="Recurso" name="codigoRecurso" id="codigoRecurso" class="SELECT01" style="width:250px">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowRecurso=mysql_fetch_array($sqlRecurso)){ 	
                                            echo "<option value='".$rowRecurso['CO_PCP_RECURSO']."'>".$rowRecurso['NO_RECURSO']."</option>";
                                        }	
                                    ?>
	                              </select></td>
	                            </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Hora Início:</b></font></td>
		                          <td align="left"><input title="Hora Início" type="text" name="horaInicioInserir" id="horaInicioInserir" class="INPUT03" size="4" maxlength="4" /></td>
		                          <td align="left"><font class="FONT04"><b>Tipo:</b></font></td>
		                          <td align="left"><input title="Tipo Apontamento" type="radio" name="flagApontamentoPerda" id="flagApontamento" value="3" checked="checked"/>
Perda</td>
	                            </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>OP:</b></font></td>
		                          <td colspan="3" align="left">
                                  <input title="OP" name="ordemProducao" id="ordemProducao" type="text" class="INPUT03" size="10" maxlength="11" onblur="getOrdemProducao()" <?php if($_SESSION['ordemProducao']){ echo "value='".$_SESSION['ordemProducao']."'"; } ?>/>
                                  <input type="hidden" id="codigoPcpOp" name="codigoPcpOp"/>
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
	                </table>
                    </td>
	            </tr>
                
                <tr>
                <td>&nbsp;</td>
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
		                      <table width="970" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td height="40" colspan="9" align="left" valign="bottom"><font class="FONT03"><b>Produtos:</b></font></td>
	                            </tr>
		                        <tr>
		                          <td colspan="9" align="left"><hr style="color:#A1A3A0; background-color:#A1A3A0; height: 1px; border: 0px "/></td>
	                            </tr>
		                        <tr>
		                          <td colspan="9" align="left">
                                  <div id="gridApontamento"></div>  
                                  </td>
	                            </tr>
		                        <tr>
		                          <td width="86" align="left">&nbsp;</td>
		                          <td width="836" colspan="8" align="left">&nbsp;</td>
	                            </tr>
		                        <tr>
		                          <td colspan="9" align="left">
                                  <?php 
								      if($_SESSION['perdaOrdemProducaoImporta']){
									      echo "<button type='button' id='adicionarApontamento' title='Salvar'>Salvar</button>";
                                  	      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
										  echo "<button type='button' id='voltarPagina' title='Cancelar'>Cancelar</button>";
									  }else{
										  echo "<button type='button' id='adicionarApontamento' title='Salvar' style='display:none;'>Salvar</button>";
                                  	      echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                                          echo "<button type='button' id='voltarPagina' title='Cancelar'>Cancelar</button>";
									  }
								  ?>
                                  </td>
	                            </tr>
	                          </table>
                            </td>
	                      </tr>
		                  </table></td>
	                  </tr>
		              <tr>
		                <td align="center" bgcolor="#F7F7F7"><img src="img/space.gif" width="8" height="8" /></td>
	                  </tr>
	                </table>
                    </td>
	            </tr>
                
                <tr>
                <td>&nbsp;</td>
                </tr>
                
	        </table>
        </td>
    </tr>
</table>
</div>
</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php require("inc/footer.php");
}else{
 header('location:inicio.php');	

} ?>
<!--FINAL FOOTER-->