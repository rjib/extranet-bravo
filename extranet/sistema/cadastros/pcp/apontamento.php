<?php

    /**
	 * Script responsavel por listar todos os apontamentos.
	 * 
	 * @author Euripedes B. Silva Junior <ejunior@bravomoveis.com>
	 * @version 1.0 - 04/01/2013 09:00
	 * 
	 */
	 
	require_once 'setup.php';
	require_once 'models/tb_modulos.php';
	
	$co_papel = $_SESSION['codigoPapel'];
	$modulos = new tb_modulos($conexaoERP);
	$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, PCP, PCP_APONTAMENTO);

	if($acoes['NO_MODULO'] == PCP_APONTAMENTO){

		$sqlRecurso = mysql_query("SELECT CO_PCP_RECURSO, NO_RECURSO FROM tb_pcp_recurso WHERE fl_delet is null ORDER BY NO_RECURSO")
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
		
		if(mysql_num_rows($sqlRecurso) == 0){
			echo "<script type='text/javascript' language='javascript'>
				  $(function($) {
					  $('<p>[Erro] - N&atilde;o existe Recurso cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
						  modal: true,
						  resizable: false,
						  title: 'Aten&ccedil;&atilde;o',
						  buttons: {
						  Ok: function() {
							  $( this ).dialog( 'close' );
							  $(window.document.location).attr('href','inicio.php');
						  }
					  }
				  }); });
				  </script>";
		}
		
		$sqlVerificaApontamentoAberto = mysql_query("SELECT COUNT(*) QTD_APONTAMENTO_ABERTO
													 FROM tb_pcp_apontamento
													 WHERE HR_FIM IS NULL 
													 AND CO_USUARIO_INICIO = ".$_SESSION['codigoUsuario']."")
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
		$rowVerificaApontamentoAberto=mysql_fetch_array($sqlVerificaApontamentoAberto);		
		 
?>
<script type="text/javascript" src="js/pcp/apontamento.js"> </script>
<script type="text/javascript">
function gerarEtiquetaPeca(co_pcp_apontamento){ //casadei
	$("#boxLoadingEtiqueta").dialog("open");
	$("#temp").load('ireport/gerarCodeBarEtiquetaPecaCasaDei.php',{co_pcp_apontamento:co_pcp_apontamento}, function(data,status){
		if (status == "success") {
			$("#boxLoadingEtiqueta").dialog("close");
			//$(window.document.location).attr('href','ireport/pcp_etiqueta_casadei.php?co_pcp_apontamento='+co_pcp_apontamento);
			window.open("ireport/pcp_etiqueta_casadei.php?co_pcp_apontamento="+co_pcp_apontamento,"Etiqueta Peça (Casadei)","menubar=0,resizable=1,width=410,height=500,location=0");
		}
	});		
}

function gerarEtiquetaPeca2(co_pcp_apontamento){ //peca
	//$("#boxLoadingEtiqueta").dialog("open");
	//$(window.document.location).attr('href','ireport/apontamento/etiqueta_peca.php?co_pcp_apontamento='+co_pcp_apontamento);
	window.open('ireport/apontamento/etiqueta_peca.php?co_pcp_apontamento='+co_pcp_apontamento,"Etiqueta Peça (Casadei)","menubar=0,resizable=1,width=410,height=500,location=0");

}
 
 </script>

<script type="text/javascript" src="js/paging.js"></script>
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
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioApontamento">
                            <form id="formularioApontamento" action="javascript:func()" method="post">
		                    <table width="640" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Data:</b></font></td>
		                          <td align="left">
                                  <input title="Data" name="dataApontamento02" id="dataApontamento02" type="text" class="INPUT03" size="8" maxlength="10" value="<?php echo date("d-m-Y"); ?>" disabled="disabled"/>
                                  <input type="hidden" id="dataApontamento" name="dataApontamento" value="<?php echo date("Y-m-d"); ?>"/>
                                  </td>
		                          <td align="left"><font class="FONT04"><b>Usuário:</b></font></td>
		                          <td align="left"><input title="Usuário" type="text" name="usuario" id="usuario" class="INPUT01" size="50" value="<?php echo $_SESSION['codigoUsuario']." - ".$_SESSION['nomePessoa']." [".$_SESSION['loginUsuario']."]"; ?>" disabled="disabled" /></td>
                              </tr>
		                        <tr>
		                          <td width="82" align="left"><font class="FONT04"><b>Recurso:</b></font></td>
		                          <td colspan="3" align="left">
                                  <select title="Recurso" name="codigoRecurso" id="codigoRecurso" class="SELECT01" style="width:250px">
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
		                          <td width="99" align="left">
                                  <input title="Hora Início" type="text" name="horaInicioInserir" id="horaInicioInserir" class="INPUT03" size="4" maxlength="4" /></td>
		                          <td width="125" align="left"><font class="FONT04"><b>Tipo Apontamento:</b></font></td>
		                          <td width="300" align="left">
                                  <input title="Tipo Apontamento" type="radio" name="flagApontamentoParada" id="flagApontamento" value="1" onclick="verificaApontamento(1);"/>
	                              Parada de Máquina
	                                <input title="Tipo Apontamento" type="radio" name="flagApontamentoProducao" id="flagApontamento" value="2" onclick="verificaApontamento(2);"/>
	                              Produção</td>
                              </tr>                         
							  
                              <tr id="apontamentoParada" style="display:none">
		                          <td align="left"><font class="FONT04"><b>Motivo:</b></font></td>
		                          <td align="left"><input title="Motivo" name="nomeMotivo" id="nomeMotivo" type="text" class="INPUT03" size="3" maxlength="5" onblur="getMotivoParada()"/>
                                  <input type="hidden" id="codigoMotivo" name="codigoMotivo"/></td>
		                          <td align="left"><font class="FONT04"><b>Descrição:</b></font></td>
		                          <td align="left"><input title="Descrição" type="text" name="descricaoMotivo" id="descricaoMotivo" class="INPUT01" size="50" disabled="disabled" /></td>
	                          </tr>
                             
							  <tr id="apontamentoProducao01" style="display:none">
							    <td align="left"><font class="FONT04"><b>OP:</b></font></td>
							    <td align="left"><input title="OP" name="ordemProducao" id="ordemProducao" type="text" class="INPUT03" size="9" maxlength="11" onblur="getOrdemProducao()"/>
                                <input type="hidden" id="codigoPcpOp" name="codigoPcpOp"/></td>
							    <td align="left"><font class="FONT04"><b>Produto:</b></font></td>
							    <td align="left"><input title="Produto" type="text" name="descricaoProduto" id="descricaoProduto" class="INPUT01" size="50" disabled="disabled" /></td>
						      </tr>
							  <tr id="apontamentoProducao02" style="display:none">
							    <td align="left"><font class="FONT04"><b>Lote:</b></font></td>
							    <td align="left"><input title="Lote" type="text" name="loteOp" id="loteOp" class="INPUT03" size="10" maxlength="10" disabled="disabled"/></td>
							    <td align="left"><font class="FONT04"><b>Data Emissão:</b></font></td>
							    <td align="left"><input title="Data Emissão" name="dataEmissaoOp" id="dataEmissaoOp" type="text" class="INPUT03" size="8" maxlength="10" disabled="disabled"/></td>
						      </tr>
                              
							  </table>
                    </form>
                  </div>
                  <?php 
				      if($acoes['FL_ADICIONAR']==1){
						  if($acoes['FL_EXCLUIR'] == 1 && $acoes['FL_EDITAR'] == 1 && $acoes['FL_ADICIONAR'] == 1){
							  echo "<button type='button' id='adicionarApontamento' title='Adicionar Apontamento'>Adicionar Apontamento</button>";
						  }else{
						      if($rowVerificaApontamentoAberto['QTD_APONTAMENTO_ABERTO'] <= "0"){
						          echo "<button type='button' id='adicionarApontamento' title='Adicionar Apontamento'>Adicionar Apontamento</button>";
					          }
						  }						  
					  }
				  ?>
                  </td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
	            <tr>
	              <td> 
                  <table width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" >
	                <tr>
	                  <th align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></th>
                    </tr>
                  </table>
                  </td>
              </tr>
	            <tr> 
		            <td valign="top">
                    <div id="grid" class="grid"></div>
                    <div class="controls"></div>
                    <div id="console"></div>
                    <div id="temp" style="display: none;"></div>  
                     <div id="boxLoadingEtiqueta" style="display: none;"> <p align="center">
       						 <span><img src="img/ajax-loader.gif"/></span><br>
       							Etiqueta esta sendo gerada, por favor aguarde...
   							 </p>
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
<?php require("inc/footer.php");
}else{
 header('location:inicio.php');	

} ?>
<!--FINAL FOOTER-->