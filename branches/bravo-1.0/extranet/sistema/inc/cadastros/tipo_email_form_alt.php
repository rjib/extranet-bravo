<?php

    require("../../setup.php");
	
	$codigoTipoEmail = $_GET['codigoTipoEmail'];
	
	$sqlTipoEmail = mysql_query("SELECT CO_TIPO_EMAIL                            
	                                 , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
									 , NO_TIPO_EMAIL
									 , DS_TIPO_EMAIL
 							     FROM tb_tipo_email 
								 WHERE CO_TIPO_EMAIL = '".$codigoTipoEmail."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowTipoEmail=mysql_fetch_array($sqlTipoEmail);
	
?>
<script type="text/javascript" src="js/cadastros/tipo_email.js"></script>
<form id="formularioAlterarTipoEmail" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoTipoEmail02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowTipoEmail['CO_TIPO_EMAIL']; ?>" disabled="disabled"/>
    <input name="codigoTipoEmail" id="codigoTipoEmail" type="hidden" value="<?php echo $rowTipoEmail['CO_TIPO_EMAIL']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowTipoEmail['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeTipoEmailAlterar" id="nomeTipoEmailAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowTipoEmail['NO_TIPO_EMAIL']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoTipoEmailAlterar" id="descricaoTipoEmailAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowTipoEmail['DS_TIPO_EMAIL']; ?></textarea></td>
</tr>
</table>
</form>