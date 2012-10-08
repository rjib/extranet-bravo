<?php

    require("../../setup.php");
	
	$codigoTipoVeiculo = $_GET['codigoTipoVeiculo'];
	
	$sqlTipoVeiculo = mysql_query("SELECT CO_TIPO_VEICULO                            
	                                   , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
									   , NO_TIPO_VEICULO
									   , DS_TIPO_VEICULO
 							       FROM tb_tipo_veiculo 
								   WHERE CO_TIPO_VEICULO = '".$codigoTipoVeiculo."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowTipoVeiculo=mysql_fetch_array($sqlTipoVeiculo);
	
?>
<script type="text/javascript" src="js/cadastros/tipo_veiculo.js"></script>
<form id="formularioAlterarTipoVeiculo" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoTipoVeiculo02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowTipoVeiculo['CO_TIPO_VEICULO']; ?>" disabled="disabled"/>
    <input name="codigoTipoVeiculo" id="codigoTipoVeiculo" type="hidden" value="<?php echo $rowTipoVeiculo['CO_TIPO_VEICULO']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowTipoVeiculo['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeTipoVeiculoAlterar" id="nomeTipoVeiculoAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowTipoVeiculo['NO_TIPO_VEICULO']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoTipoVeiculoAlterar" id="descricaoTipoVeiculoAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowTipoVeiculo['DS_TIPO_VEICULO']; ?></textarea></td>
</tr>
</table>
</form>