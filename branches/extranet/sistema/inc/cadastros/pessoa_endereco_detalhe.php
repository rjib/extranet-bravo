<?php

    require("../../setup.php");
	
	$sqlEndereco = mysql_query("SELECT ENDERECO.CO_ENDERECO 
								    , CEP.NU_CEP
									, CEP.NO_LOGRADOURO
									, ENDERECO.NU_ENDERECO
									, ENDERECO.COMP_ENDERECO
									, BAIRRO.NO_BAIRRO
									, UF.SG_UF
									, MUNICIPIO.NO_MUNICIPIO
									, ENDERECO.TP_PRINCIPAL
									, ENDERECO.TP_COBRANCA
									, ENDERECO.TP_CORRESPONDENCIA
								FROM tb_endereco ENDERECO
									INNER JOIN tb_cep CEP
									    ON ENDERECO.CO_CEP = CEP.CO_CEP
									INNER JOIN tb_bairro BAIRRO
									    ON CEP.CO_BAIRRO = BAIRRO.CO_BAIRRO
									INNER JOIN tb_municipio MUNICIPIO
									    ON BAIRRO.CO_MUNICIPIO = MUNICIPIO.CO_MUNICIPIO
									INNER JOIN tb_uf UF
									    ON MUNICIPIO.CO_UF = UF.CO_UF
								WHERE ENDERECO.CO_ENDERECO = '".$_GET['codigoEndereco']."'",$conexaoERP)
    or die(mysql_error());
	$rowEndereco=mysql_fetch_array($sqlEndereco);
	
?>
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
<td width="97" align="left"><font class="FONT04"><b>CEP:</b></font></td>
<td colspan="5" align="left">
<input title="CEP" name="cep" id="cep" size="10" maxlength="8" class="INPUT03" disabled="disabled" value="<?php echo $rowEndereco['NU_CEP']; ?>"/>
</td>
</tr>
<tr>
<td align="left" valign="top"><font class="FONT04"><b>Logradouro:</b></font></td>
<td colspan="5">
<input title="Logradouro" name="logradouro" id="logradouro" class="INPUT01" size="50" disabled="disabled" value="<?php echo $rowEndereco['NO_LOGRADOURO']; ?>"/>
</td>
</tr>
<tr>
<td align="left" valign="top"><font class="FONT04"><b>N&uacute;mero:</b></font></td>
<td colspan="5">
<input title="N&uacute;mero" name="numeroLogradouro" id="numeroLogradouro" type="text" class="INPUT03" size="10" maxlength="180" value="<?php echo $rowEndereco['NU_ENDERECO']; ?>"/>
</td>
</tr>
<tr>
<td align="left" valign="top"><font class="FONT04"><b>Complemento:</b></font></td>
<td colspan="5">
<input title="Complemento" name="complementoLogradouro" id="complementoLogradouro" type="text" class="INPUT01" size="50" maxlength="180" value="<?php echo $rowEndereco['COMP_ENDERECO']; ?>"/>
</td>
</tr>
<tr>
<td align="left" valign="top"><font class="FONT04"><b>Bairro:</b></font></td>
<td colspan="5">
<input title="Bairro" name="bairroLogradouro" id="bairroLogradouro" class="INPUT01" size="30" disabled="disabled" value="<?php echo $rowEndereco['NO_BAIRRO']; ?>"/>
</td>
</tr>
<tr>
<td align="left" valign="top"><font class="FONT04"><b>Estado:</b></font></td>
<td colspan="5">
<input title="Estado" name="estadoLogradouro" id="estadoLogradouro" size="2" maxlength="2" class="INPUT01" disabled="disabled" value="<?php echo $rowEndereco['SG_UF']; ?>"/>
</td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Cidade:</b></font></td>
  <td colspan="5">
  <input title="Cidade" name="cidadeLogradouro" id="cidadeLogradouro" class="INPUT01" disabled="disabled" value="<?php echo $rowEndereco['NO_MUNICIPIO']; ?>"/>
  </td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Principal:</b></font></td>
  <td width="131"><input title="Principal" type="checkbox" name="principalLogradouro" id="principalLogradouro" <?php if($rowEndereco['TP_PRINCIPAL'] == "S"){echo "checked='checked'";}?>/></td>
  <td width="71"><font class="FONT04"><b>Cobran&ccedil;a:</b></font></td>
  <td width="81"><input title="Cobran&ccedil;a" type="checkbox" name="cobrancaLogradouro" id="cobrancaLogradouro" <?php if($rowEndereco['TP_COBRANCA'] == "S"){echo "checked='checked'";}?>/></td>
  <td width="118"><font class="FONT04"><b>Correspond&ecirc;ncia:</b></font></td>
  <td width="492"><input title="Correspondência" type="checkbox" name="correspondenciaLogradouro" id="correspondenciaLogradouro" <?php if($rowEndereco['TP_CORRESPONDENCIA'] == "S"){echo "checked='checked'";}?>/></td>
</tr>
</table>