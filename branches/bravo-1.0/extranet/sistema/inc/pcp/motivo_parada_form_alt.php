<?php

    require("../../setup.php");
	
	$codigoMotivoParada = $_GET['codigoMotivoParada'];
	
	$sqlMotivoParada = mysql_query("SELECT CO_PCP_MOTIVO_PARADA                            
	                                    , DATE_FORMAT(DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
							            , NO_MOTIVO_PARADA
							            , DS_MOTIVO_PARADA
										, ST_MOTIVO_PARADA
 							        FROM tb_pcp_motivo_parada
							 		WHERE CO_PCP_MOTIVO_PARADA = '".$_GET['codigoMotivoParada']."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowMotivoParada=mysql_fetch_array($sqlMotivoParada);
	
?>
<script type="text/javascript" src="js/pcp/motivo_parada.js"></script>
<form id="formularioAlterarMotivoParada" action="javascript:func()" method="post">
<table width="100%" border="0" cellspacing="2" cellpadding="3">
<tr>
  <td width="97" align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
  <td width="1135" colspan="4" align="left"><input title="Código" name="codigoMotivoParada02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowMotivoParada['CO_PCP_MOTIVO_PARADA']; ?>" disabled="disabled"/>
    <input name="codigoMotivoParada" id="codigoMotivoParada" type="hidden" value="<?php echo $rowMotivoParada['CO_PCP_MOTIVO_PARADA']; ?>"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
  <td colspan="4" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowMotivoParada['DT_CADAS']; ?>" disabled="disabled"/></td>
</tr>
<tr>
  <td align="left"><font class="FONT04"><b>Nome:</b></font></td>
  <td colspan="4" align="left"><input title="Nome" name="nomeMotivoParadaAlterar" id="nomeMotivoParadaAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowMotivoParada['NO_MOTIVO_PARADA']; ?>"/></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
  <td colspan="4" align="left"><textarea title="Descrição" name="descricaoMotivoParadaAlterar" id="descricaoMotivoParadaAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowMotivoParada['DS_MOTIVO_PARADA']; ?></textarea></td>
</tr>
<tr>
  <td align="left" valign="top"><font class="FONT04"><b>Status:</b></font></td>
  <td colspan="4" align="left">
  <select title="Status" name="statusMotivoParadaAlterar" id="statusMotivoParadaAlterar" class="SELECT01">
  <?php
      if($rowMotivoParada['ST_MOTIVO_PARADA'] == 1){
	      echo "<option value='".$rowMotivoParada['ST_MOTIVO_PARADA']."'>Ativo</option>";
		  echo "<option value='0'>Inativo</option>";
	  }else{
	      echo "<option value='".$rowMotivoParada['ST_MOTIVO_PARADA']."'>Inativo</option>";
	      echo "<option value='1'>Ativo</option>";
	  }
  ?>
  </select>
  </td>
</tr>
</table>
</form>