<?php

    require("../../setup.php");
	
	$codigoNivelFormacao = $_GET['codigoNivelFormacao'];
	
	$sqlNivelFormacao = mysql_query("SELECT CO_NIVEL_FORMACAO                            
	                                     , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
							             , NO_NIVEL_FORMACAO
							             , DS_NIVEL_FORMACAO
 							 		 FROM tb_nivel_formacao
							         WHERE CO_NIVEL_FORMACAO = '".$codigoNivelFormacao."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowNivelFormacao=mysql_fetch_array($sqlNivelFormacao);
	
?>
<script type="text/javascript" src="js/cadastros/nivel_formacao.js"></script>
<form id="formularioAlterarNivelFormacao" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoNivelFormacao02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowNivelFormacao['CO_NIVEL_FORMACAO']; ?>" disabled="disabled"/>
    <input name="codigoNivelFormacao" id="codigoNivelFormacao" type="hidden" value="<?php echo $rowNivelFormacao['CO_NIVEL_FORMACAO']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowNivelFormacao['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeNivelFormacaoAlterar" id="nomeNivelFormacaoAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowNivelFormacao['NO_NIVEL_FORMACAO']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoNivelFormacaoAlterar" id="descricaoNivelFormacaoAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowNivelFormacao['DS_NIVEL_FORMACAO']; ?></textarea></td>
</tr>
</table>
</form>