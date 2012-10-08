<?php

    require("../../setup.php");
	
	$codigoNacionalidade = $_GET['codigoNacionalidade'];
	
	$sqlNacionalidade = mysql_query("SELECT CO_NACIONALIDADE                          
	                                     , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
									     , NO_NACIONALIDADE
								         , DS_NACIONALIDADE
 							         FROM tb_nacionalidade 
								     WHERE CO_NACIONALIDADE = '".$codigoNacionalidade."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowNacionalidade=mysql_fetch_array($sqlNacionalidade);
	
?>
<script type="text/javascript" src="js/cadastros/nacionalidade.js"></script>
<form id="formularioAlterarNacionalidade" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoNacionalidade02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowNacionalidade['CO_NACIONALIDADE']; ?>" disabled="disabled"/>
    <input name="codigoNacionalidade" id="codigoNacionalidade" type="hidden" value="<?php echo $rowNacionalidade['CO_NACIONALIDADE']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowNacionalidade['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeNacionalidadeAlterar" id="nomeNacionalidadeAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowNacionalidade['NO_NACIONALIDADE']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoNacionalidadeAlterar" id="descricaoNacionalidadeAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowNacionalidade['DS_NACIONALIDADE']; ?></textarea></td>
</tr>
</table>
</form>