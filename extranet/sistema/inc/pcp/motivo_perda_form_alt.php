<?php

    require("../../setup.php");
	
	$codigoMotivoPerda = $_GET['codigoMotivoPerda'];
	
	$sqlMotivoPerda = mysql_query("SELECT CO_PCP_MOTIVO_PERDA                            
	                                    , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
							            , NO_MOTIVO_PERDA
							            , DS_MOTIVO_PERDA
										, ST_MOTIVO_PERDA
 							        FROM tb_pcp_motivo_perda
							 		WHERE CO_PCP_MOTIVO_PERDA = '".$_GET['codigoMotivoPerda']."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowMotivoPerda=mysql_fetch_array($sqlMotivoPerda);
	
?>
<script type="text/javascript" src="js/pcp/motivo_perda.js"></script>
<form id="formularioAlterarMotivoPerda" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoMotivoPerda02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowMotivoPerda['CO_PCP_MOTIVO_PERDA']; ?>" disabled="disabled"/>
    <input name="codigoMotivoPerda" id="codigoMotivoPerda" type="hidden" value="<?php echo $rowMotivoPerda['CO_PCP_MOTIVO_PERDA']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowMotivoPerda['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeMotivoPerdaAlterar" id="nomeMotivoPerdaAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowMotivoPerda['NO_MOTIVO_PERDA']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoMotivoPerdaAlterar" id="descricaoMotivoPerdaAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowMotivoPerda['DS_MOTIVO_PERDA']; ?></textarea></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Status:</b></font></td>
  <td colspan="4" align="left">
  <select title="Status" name="statusMotivoPerdaAlterar" id="statusMotivoPerdaAlterar" class="SELECT01">
  <?php
      if($rowMotivoPerda['ST_MOTIVO_PERDA'] == 1){
	      echo "<option value='".$rowMotivoPerda['ST_MOTIVO_PERDA']."'>Ativo</option>";
		  echo "<option value='0'>Inativo</option>";
	  }else{
	      echo "<option value='".$rowMotivoPerda['ST_MOTIVO_PERDA']."'>Inativo</option>";
	      echo "<option value='1'>Ativo</option>";
	  }
  ?>
  </select>
  </td>
</tr>
</table>
</form>