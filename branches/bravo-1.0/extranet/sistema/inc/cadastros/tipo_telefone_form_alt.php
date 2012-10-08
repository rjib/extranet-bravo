<?php

    require("../../setup.php");
	
	$codigoTipoTelefone = $_GET['codigoTipoTelefone'];
	
	$sqlTipoTelefone = mysql_query("SELECT CO_TIPO_TELEFONE                            
	                                    , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
									    , NO_TIPO_TELEFONE
									    , DS_TIPO_TELEFONE
 							        FROM tb_tipo_telefone 
								    WHERE CO_TIPO_TELEFONE = '".$codigoTipoTelefone."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowTipoTelefone=mysql_fetch_array($sqlTipoTelefone);
	
?>
<script type="text/javascript" src="js/cadastros/tipo_telefone.js"></script>
<form id="formularioAlterarTipoTelefone" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoTipoTelefone02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowTipoTelefone['CO_TIPO_TELEFONE']; ?>" disabled="disabled"/>
    <input name="codigoTipoTelefone" id="codigoTipoTelefone" type="hidden" value="<?php echo $rowTipoTelefone['CO_TIPO_TELEFONE']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowTipoTelefone['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeTipoTelefoneAlterar" id="nomeTipoTelefoneAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowTipoTelefone['NO_TIPO_TELEFONE']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoTipoTelefoneAlterar" id="descricaoTipoTelefoneAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowTipoTelefone['DS_TIPO_TELEFONE']; ?></textarea></td>
</tr>
</table>
</form>