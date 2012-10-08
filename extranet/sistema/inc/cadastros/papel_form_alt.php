<?php

    require("../../setup.php");
	
	$codigoPapel = $_GET['codigoPapel'];
	
	$sqlPapel = mysql_query("SELECT CO_PAPEL                            
	                             , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
							     , NO_PAPEL
							     , DS_PAPEL
 							 FROM tb_papel
							 WHERE CO_PAPEL = '".$codigoPapel."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowPapel=mysql_fetch_array($sqlPapel);
	
?>
<script type="text/javascript" src="js/cadastros/papel.js"></script>
<form id="formularioAlterarPapel" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoPapel02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowPapel['CO_PAPEL']; ?>" disabled="disabled"/>
    <input name="codigoPapel" id="codigoPapel" type="hidden" value="<?php echo $rowPapel['CO_PAPEL']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowPapel['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomePapelAlterar" id="nomePapelAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowPapel['NO_PAPEL']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoPapelAlterar" id="descricaoPapelAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowPapel['DS_PAPEL']; ?></textarea></td>
</tr>
</table>
</form>