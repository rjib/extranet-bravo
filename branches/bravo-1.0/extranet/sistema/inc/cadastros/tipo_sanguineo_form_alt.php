<?php

    require("../../setup.php");
	
	$codigoTipoSanguineo = $_GET['codigoTipoSanguineo'];
	
	$sqlTipoSanguineo = mysql_query("SELECT CO_TIPO_SANGUINEO                            
	                                     , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
									     , NO_TIPO_SANGUINEO
									     , DS_TIPO_SANGUINEO
 							         FROM tb_tipo_sanguineo 
								     WHERE CO_TIPO_SANGUINEO = '".$codigoTipoSanguineo."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowTipoSanguineo=mysql_fetch_array($sqlTipoSanguineo);
	
?>
<script type="text/javascript" src="js/cadastros/tipo_sanguineo.js"></script>
<form id="formularioAlterarTipoSanguineo" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoTipoSanguineo02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowTipoSanguineo['CO_TIPO_SANGUINEO']; ?>" disabled="disabled"/>
    <input name="codigoTipoSanguineo" id="codigoTipoSanguineo" type="hidden" value="<?php echo $rowTipoSanguineo['CO_TIPO_SANGUINEO']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowTipoSanguineo['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeTipoSanguineoAlterar" id="nomeTipoSanguineoAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowTipoSanguineo['NO_TIPO_SANGUINEO']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoTipoSanguineoAlterar" id="descricaoTipoSanguineoAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowTipoSanguineo['DS_TIPO_SANGUINEO']; ?></textarea></td>
</tr>
</table>
</form>