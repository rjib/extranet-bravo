<?php

    require("../../setup.php");
	
	$codigoCargo = $_GET['codigoCargo'];
	
	$sqlCargo = mysql_query("SELECT CO_CARGO                            
	                             , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
							     , NO_CARGO
							     , DS_CARGO
 							 FROM tb_cargo
							 WHERE CO_CARGO = '".$_GET['codigoCargo']."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowCargo=mysql_fetch_array($sqlCargo);
	
?>
<script type="text/javascript" src="js/cadastros/cargo.js"></script>
<form id="formularioAlterarCargo" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoCargo02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowCargo['CO_CARGO']; ?>" disabled="disabled"/>
    <input name="codigoCargo" id="codigoCargo" type="hidden" value="<?php echo $rowCargo['CO_CARGO']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowCargo['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeCargoAlterar" id="nomeCargoAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowCargo['NO_CARGO']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoCargoAlterar" id="descricaoCargoAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowCargo['DS_CARGO']; ?></textarea></td>
</tr>
</table>
</form>