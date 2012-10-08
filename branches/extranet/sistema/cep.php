<?php

	/**
	 * Script responsável por listar todas CEPs cadastrados.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */
	 
	$sqlEstado = mysql_query("SELECT CO_UF, DS_UF FROM tb_uf ORDER BY DS_UF")
	or die ("<script>
			     alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			     history.back(-1);
			 </script>"); 		               
	$rowEstado = mysql_num_rows($sqlEstado);
	 
?>
<script type="text/javascript" src="js/cep.js"></script>
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
	              <td><img src="img/title/title_ceps.jpg" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioCep">
                            <form id="formularioCep" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="72" align="left"><font class="FONT04"><b>Estado:</b></font></td>
		                          <td width="913" colspan="4" align="left">
                                  <select name="codigoEstado" id="codigoEstado" class="SELECT01" onchange="BuscaCidade(this.value);" style="width:269px">
                                      <option value="0">--Selecione o estado &gt;&gt;</option>
                                      <?php for($i=0; $i<$rowEstado; $i++) { ?>
                                      <option value="<?php echo mysql_result($sqlEstado, $i, "CO_UF"); ?>"> <?php echo mysql_result($sqlEstado, $i, "DS_UF"); ?></option>
                                      <?php } ?>
                                    </select></td>
	                          </tr>
                              <tr>
		                          <td width="72" align="left"><font class="FONT04"><b>Munic&iacute;pio:</b></font></td>
		                          <td width="913" colspan="4" align="left">
                                  <select name="codigoCidade" id="codigoCidade" class="SELECT01" onchange="BuscaBairro(this.value);" style="width:269px">
                                        <option id="opcoes" value="0">--Primeiro selecione o estado--</option>
                                    </select>
                                  </td>
	                          </tr>
                              <tr>
		                          <td width="72" align="left"><font class="FONT04"><b>Bairro:</b></font></td>
		                          <td width="913" colspan="4" align="left">
                                  <select name="codigoBairro" id="codigoBairro" class="SELECT01" style="width:269px">
                                        <option id="opcoes" value="0">--Primeiro selecione o munic&iacute;pio--</option>
                                    </select>
                                  </td>
	                          </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>CEP:</b></font></td>
		                          <td colspan="4" align="left"><input title="CEP" name="numeroCep" id="numeroCep" type="text" class="INPUT03" size="10" maxlength="8" /></td>
	                          </tr>
                              <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Logradouro:</b></font></td>
		                          <td colspan="4" align="left"><input title="Nome Logradouro" name="nomeLogradouro" id="nomeLogradouro" type="text" class="INPUT01" size="50" maxlength="80" /></td>
	                          </tr>
	                          </table>
		                    </form>
                  </div>
                  <button type="button" id="adicionarCep" title="Adicionar CEP">Adicionar CEP</button>
                  </td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
	            <tr>
	              <td> 
                  <table width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" >
	                <tr>
	                  <th align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></td>
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