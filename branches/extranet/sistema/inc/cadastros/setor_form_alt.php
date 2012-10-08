<?php

    require("../../setup.php");
	
	$codigoSetor = $_GET['codigoSetor'];
	
	$sqlSetor = mysql_query("SELECT CO_SETOR                            
	                             , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
							     , NO_SETOR
							     , DS_SETOR
 							 FROM tb_setor 
							 WHERE CO_SETOR = '".$codigoSetor."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowSetor=mysql_fetch_array($sqlSetor);
	
?>
<script type="text/javascript" src="js/cadastros/setor.js"></script>
<form id="formularioAlterarSetor" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoSetor02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowSetor['CO_SETOR']; ?>" disabled="disabled"/>
    <input name="codigoSetor" id="codigoSetor" type="hidden" value="<?php echo $rowSetor['CO_SETOR']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowSetor['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeSetorAlterar" id="nomeSetorAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowSetor['NO_SETOR']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoSetorAlterar" id="descricaoSetorAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowSetor['DS_SETOR']; ?></textarea></td>
</tr>
</table>
</form>