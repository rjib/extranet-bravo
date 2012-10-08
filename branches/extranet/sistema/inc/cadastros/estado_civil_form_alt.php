<?php

    require("../../setup.php");
	
	$codigoEstadoCivil = $_GET['codigoEstadoCivil'];
	
	$sqlEstadoCivil = mysql_query("SELECT CO_ESTADO_CIVIL                           
	                                   , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
									   , NO_ESTADO_CIVIL
								       , DS_ESTADO_CIVIL
 							       FROM tb_estado_civil 
								   WHERE CO_ESTADO_CIVIL = '".$codigoEstadoCivil."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowEstadoCivil=mysql_fetch_array($sqlEstadoCivil);
	
?>
<script type="text/javascript" src="js/cadastros/estado_civil.js"></script>
<form id="formularioAlterarEstadoCivil" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoEstadoCivil02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowEstadoCivil['CO_ESTADO_CIVIL']; ?>" disabled="disabled"/>
    <input name="codigoEstadoCivil" id="codigoEstadoCivil" type="hidden" value="<?php echo $rowEstadoCivil['CO_ESTADO_CIVIL']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowEstadoCivil['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeEstadoCivilAlterar" id="nomeEstadoCivilAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowEstadoCivil['NO_ESTADO_CIVIL']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoEstadoCivilAlterar" id="descricaoEstadoCivilAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowEstadoCivil['DS_ESTADO_CIVIL']; ?></textarea></td>
</tr>
</table>
</form>