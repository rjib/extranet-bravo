<?php

	/**
	 * Script responsável por listar todos os consultores cadastrados.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */
	
	$sqlSetor = mysql_query("SELECT CO_SETOR, NO_SETOR FROM tb_setor ORDER BY NO_SETOR",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlSetor) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Setor cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
	
	$sqlTipoSanguineo = mysql_query("SELECT CO_TIPO_SANGUINEO, NO_TIPO_SANGUINEO FROM tb_tipo_sanguineo ORDER BY NO_TIPO_SANGUINEO",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlTipoSanguineo) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Tipo Sanguineo, por favor entre em contato com o Suporte.</p>').dialog({
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
<script type="text/javascript" src="js/cadastros/consultor.js"></script>
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
	              <td><img src="img/title/cadastros/title_consultor.jpg" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioConsultor">
                            <form id="formularioConsultor" action="javascript:func()" method="post">
		                    <table width="600" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="104" align="left"><font class="FONT04"><b>Pessoa:</b></font></td>
		                          <td width="508" align="left">
                                  <input type="text" id="nomePessoa" name="nomePessoa" autocomplete="off" class="INPUT01" size="70" maxlength="80"/>
                                  <input type="hidden" id="codigoPessoa" name="codigoPessoa"/>
                                  </td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>CPF:</b></font></td>
		                          <td align="left"><input type="text" name="cpfPessoa" id="cpfPessoa" class="INPUT01" size="12" disabled /></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Setor:</b></font></td>
		                          <td align="left">
                                  <select title="Setor" name="setor" id="setor" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowSetor=mysql_fetch_array($sqlSetor)){ 	
                                            echo "<option value='".$rowSetor['CO_SETOR']."'>".$rowSetor['NO_SETOR']."</option>";
                                        }	
                                    ?>
	                              </select>
                                  </td>
	                          </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Tipo Sanguineo:</b></font></td>
		                          <td align="left"><select title="Tipo Sanguineo" name="tipoSanguineo" id="tipoSanguineo" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowTipoSanguineo=mysql_fetch_array($sqlTipoSanguineo)){ 	
                                            echo "<option value='".$rowTipoSanguineo['CO_TIPO_SANGUINEO']."'>".$rowTipoSanguineo['NO_TIPO_SANGUINEO']."</option>";
                                        }	
                                    ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Observa&ccedil;&atilde;o:</b></font></td>
		                          <td align="left"><textarea title="Descri&ccedil;&atilde;o" name="descricaoConsultor" id="descricaoConsultor" cols="60" rows="10" class="TEXTAREA01"></textarea></td>
	                          </tr>
	                          </table>
		                    </form>
                  </div>
                  <button type="button" id="adicionarConsultor" title="Adicionar Consultor">Adicionar Consultor</button>
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