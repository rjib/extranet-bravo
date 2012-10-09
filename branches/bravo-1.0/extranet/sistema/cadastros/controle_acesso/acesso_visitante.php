<?php

	/**
	 * Script responsável por listar todos os acessos de visitantes.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 24/09/2011 08:00
	 * 
	 */

    $sqlTipoVeiculo = mysql_query("SELECT CO_TIPO_VEICULO, NO_TIPO_VEICULO FROM tb_tipo_veiculo ORDER BY NO_TIPO_VEICULO")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlTipoVeiculo) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Tipo Veiculo cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
	
	$sqlCartaoIdentificacao = mysql_query("SELECT CO_CARTAO_IDENTIFICACAO, NU_CARTAO_IDENTIFICACAO FROM tb_cartao_identificacao ORDER BY NU_CARTAO_IDENTIFICACAO")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlCartaoIdentificacao) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Cart&atilde;o de Identifica&ccedil;&atilde;o cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
	 
?>
<script type="text/javascript" src="js/cadastros/controle_acesso/acesso_visitante.js"></script>
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
	              <td><img src="img/title/cadastros/controle_acesso/title_acesso_visitante.jpg" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioAcessoVisitante">
                            <form id="formularioAcessoVisitante" action="javascript:func()" method="post">
		                    <table width="700" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="142" align="left"><font class="FONT04"><b>Visitante:</b></font></td>
		                          <td colspan="3" align="left">
                                  <input title="Visitante" name="nomeVisitante" id="nomeVisitante" type="text" class="INPUT01" size="55" maxlength="80" autocomplete="off"/>
                                  <input type="hidden" id="codigoVisitante" name="codigoVisitante"/>
                                  </td>
	                          </tr>
                              <tr>
		                          <td align="left"><font class="FONT04"><b>CPF:</b></font></td>
		                          <td colspan="3" align="left"><input type="text" name="cpfVisitante" id="cpfVisitante" class="INPUT01" size="12" disabled /></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Hora Entrada:</b></font></td>
		                          <td colspan="3" align="left">
                                  <input title="Hora Entrada" type="text" name="horaEntrada" id="horaEntrada" class="INPUT03" size="4" maxlength="4" /></td>
	                          </tr>                              
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo Veiculo:</b></font></td>
		                          <td width="149" align="left">
                                  <select title="Tipo Veiculo" name="tipoVeiculo" id="tipoVeiculo" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowTipoVeiculo=mysql_fetch_array($sqlTipoVeiculo)){ 	
                                            echo "<option value='".$rowTipoVeiculo['CO_TIPO_VEICULO']."'>".$rowTipoVeiculo['NO_TIPO_VEICULO']."</option>";
                                        }	
                                    ?>
	                              </select>
                                  </td>
		                          <td width="112" align="left"><font class="FONT04"><b>Placa Veiculo:</b></font></td>
		                          <td width="263" align="left"><input title="Placa Veiculo" type="text" name="placaVeiculo" id="placaVeiculo" class="INPUT03" size="8" maxlength="8"/></td>
                              </tr>
                              </div>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>N&uacute;mero Cart&atilde;o:</b></font></td>
		                          <td colspan="3" align="left">
                                  <select title="N&uacute;mero Cart&atilde;o" name="numeroCartao" id="numeroCartao" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowCartaoIdentificacao=mysql_fetch_array($sqlCartaoIdentificacao)){ 	
                                            echo "<option value='".$rowCartaoIdentificacao['CO_CARTAO_IDENTIFICACAO']."'>".$rowCartaoIdentificacao['NU_CARTAO_IDENTIFICACAO']."</option>";
                                        }	
                                    ?>
	                              </select>
                                  </td>
	                          </tr>
	                          </table>
                    </form>
                  </div>
                  <button type="button" id="adicionarAcessoVisitante" title="Adicionar Acesso Visitante">Adicionar Acesso Visitante</button>
                  </td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
	            <tr>
	              <td> 
                  <table width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" >
	                <tr>
	                  <td align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></td>
                    </tr>
                  </table>
                  </td>
              </tr>
	            <tr> 
		            <td valign="top">
                    <div id="grid" class="grid"></div>
                    <div class="controls"></div>
                    <div id="console"></div>     
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