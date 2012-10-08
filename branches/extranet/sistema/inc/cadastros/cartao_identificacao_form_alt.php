<?php

    require("../../setup.php");
	
	$sqlCartaoIdentificacao = mysql_query("SELECT CO_CARTAO_IDENTIFICACAO                            
											   , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
											   , NU_CARTAO_IDENTIFICACAO
										       , DS_CARTAO_IDENTIFICACAO
										   FROM tb_cartao_identificacao
										   WHERE CO_CARTAO_IDENTIFICACAO = '".$_GET['codigoCartaoIdentificacao']."'")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowCartaoIdentificacao=mysql_fetch_array($sqlCartaoIdentificacao);
	
?>
<script type="text/javascript" src="js/cadastros/cartao_identificacao.js"></script>
<form id="formularioAlterarCargo" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoCargo02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowCartaoIdentificacao['CO_CARTAO_IDENTIFICACAO']; ?>" disabled="disabled"/>
    <input name="codigoCartaoIdentificacao" id="codigoCartaoIdentificacao" type="hidden" value="<?php echo $rowCartaoIdentificacao['CO_CARTAO_IDENTIFICACAO']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowCartaoIdentificacao['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>N&uacute;mero:</b></font></td>
  <td colspan="4" align="left"><input title="NN&uacute;merome" name="numeroCartaoIdentificacaoAlterar" id="numeroCartaoIdentificacaoAlterar" type="text" class="INPUT01" size="3" maxlength="3" value="<?php echo $rowCartaoIdentificacao['NU_CARTAO_IDENTIFICACAO']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoCartaoIdentificacaoAlterar" id="descricaoCartaoIdentificacaoAlterar" cols="60" rows="10" class="TEXTAREA01"><?php echo $rowCartaoIdentificacao['DS_CARTAO_IDENTIFICACAO']; ?></textarea></td>
</tr>
</table>
</form>