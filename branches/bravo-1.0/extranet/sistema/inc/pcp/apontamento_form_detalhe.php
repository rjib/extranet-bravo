<?php

    /**
	 * Script responsavel por listar o apontamento selecionado para inserir hora fim.
	 * 
	 * @author Euripedes B. Silva Junior <ejunior@bravomoveis.com>
	 * @version 1.0 - 05/01/2013 13:00
	 * 
	 */
	
	session_start();
	
    require("../../setup.php");
	
	$codigoApontamento = $_GET['codigoApontamento'];
	
	$sqlApontamento = mysql_query("SELECT PCP_APONTAMENTO.CO_PCP_APONTAMENTO
	                                   , DATE_FORMAT(PCP_APONTAMENTO.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
								       , DATE_FORMAT(PCP_APONTAMENTO.DT_APONTAMENTO, '%d/%m/%Y') AS DT_APONTAMENTO
								       , PCP_RECURSO.NO_RECURSO
								       , PCP_APONTAMENTO.HR_INICIO
									   , PCP_APONTAMENTO.HR_FIM
									   , PCP_APONTAMENTO.FL_APONTAMENTO
									   , PCP_MOTIVO_PARADA.NO_MOTIVO_PARADA
									   , PCP_MOTIVO_PARADA.DS_MOTIVO_PARADA
									   , CONCAT(PCP_OP.CO_NUM,PCP_OP.CO_ITEM,PCP_OP.CO_SEQUENCIA) AS NU_OP
									   , TRIM(PCP_PRODUTO.DS_PRODUTO) AS DS_PRODUTO
									   , PCP_APONTAMENTO.QTD_PRODUTO
									   , PCP_OP.NU_LOTE
									   , DATE_FORMAT(PCP_OP.DT_EMISSAO, '%d/%m/%Y') AS DT_EMISSAO
			                     	   , PCP_PRODUTO.CO_PRODUTO
                     				   , PCP_PRODUTO.CO_INT_PRODUTO
								   FROM tb_pcp_apontamento PCP_APONTAMENTO
								       INNER JOIN tb_pcp_recurso PCP_RECURSO
									       ON PCP_APONTAMENTO.CO_RECURSO = PCP_RECURSO.CO_PCP_RECURSO
									   LEFT JOIN tb_pcp_motivo_parada PCP_MOTIVO_PARADA
									       ON PCP_APONTAMENTO.CO_MOTIVO = PCP_MOTIVO_PARADA.CO_PCP_MOTIVO_PARADA
									   LEFT JOIN tb_pcp_op PCP_OP
									       ON PCP_APONTAMENTO.CO_PCP_OP = PCP_OP.CO_PCP_OP
									   LEFT JOIN tb_pcp_produto PCP_PRODUTO
									       ON PCP_OP.CO_PRODUTO = PCP_PRODUTO.CO_PRODUTO
								   WHERE PCP_APONTAMENTO.CO_PCP_APONTAMENTO = '".$codigoApontamento."'")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowApontamento=mysql_fetch_array($sqlApontamento);
	
?>
<script type="text/javascript" src="js/pcp/apontamento.js"></script>
  <table width="700" border="0" cellspacing="2" cellpadding="3">
    <tr>
      <td align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
      <td colspan="5" align="left"><input title="Código" name="codigoApontamento02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowApontamento['CO_PCP_APONTAMENTO']; ?>" disabled="disabled"/>
        <input name="codigoApontamento" id="codigoApontamento" type="hidden" value="<?php echo $rowApontamento['CO_PCP_APONTAMENTO']; ?>"/></td>
    </tr>
    <tr>
      <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
      <td colspan="5" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowApontamento['DT_CADAS']; ?>" disabled="disabled"/></td>
    </tr>
    <tr>
      <td align="left"><font class="FONT04"><b>Data Apontamento:</b></font></td>
      <td align="left"><input title="Data" name="dataApontamento02" id="dataApontamento02" type="text" class="INPUT03" size="8" maxlength="10" value="<?php echo $rowApontamento['DT_APONTAMENTO']; ?>" disabled="disabled"/>
        <input type="hidden" id="dataApontamento" name="dataApontamento" value="<?php echo date("Y-m-d"); ?>"/></td>
      <td align="right">&nbsp;</td>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr>
      <td width="129" align="left"><font class="FONT04"><b>Recurso:</b></font></td>
      <td colspan="5" align="left"><select title="Recurso" name="codigoRecurso" id="codigoRecurso" class="SELECT01" style="width:250px" disabled="disabled">
        <option value="0"><?php echo $rowApontamento['NO_RECURSO']; ?></option>
      </select></td>
    </tr>
    <tr>
      <td align="left"><font class="FONT04"><b>Hora Início:</b></font></td>
      <td width="88" align="left"><input title="Hora Início" type="text" name="horaInicio" id="horaInicio" class="INPUT03" size="4" maxlength="4" value="<?php echo $rowApontamento['HR_INICIO']; ?>" disabled="disabled" /></td>
      <td width="125" rowspan="2" align="left"><font class="FONT04"><b>Tipo Apontamento:</b></font></td>
      <td colspan="3" rowspan="2" align="left"><input title="Tipo Apontamento" type="radio" name="flagApontamentoParada" id="flagApontamento2" value="1" <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "checked='checked'"; } ?> disabled="disabled"/>
        Parada de Máquina
        <input title="Tipo Apontamento" type="radio" name="flagApontamentoProducao" id="flagApontamento2" value="2" <?php if($rowApontamento['FL_APONTAMENTO'] == "2"){echo "checked='checked'"; } ?> disabled="disabled"/>
        Produção </td>
    </tr>
    <tr>
      <td align="left"><font class="FONT04"><b>Hora Fim:</b></font></td>
      <td align="left"><input title="Hora Fim" type="text" name="horaFim" id="horaFim" class="INPUT03" size="4" maxlength="4" value="<?php echo $rowApontamento['HR_FIM']; ?>" disabled="disabled" /></td>
    </tr>
    <tr id="apontamentoParada" <?php if($rowApontamento['FL_APONTAMENTO'] == "2"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>Motivo:</b></font></td>
      <td align="left"><input title="Motivo" name="nomeMotivo" id="nomeMotivo" type="text" class="INPUT03" size="3" maxlength="5" value="<?php echo $rowApontamento['NO_MOTIVO_PARADA']; ?>" disabled="disabled"/></td>
      <td align="left"><font class="FONT04"><b>Descrição:</b></font></td>
      <td colspan="3" align="left"><input title="Descrição" type="text" name="descricaoMotivo" id="descricaoMotivo" class="INPUT01" size="50" value="<?php echo $rowApontamento['DS_MOTIVO_PARADA']; ?>" disabled="disabled" /></td>
    </tr>
    <tr id="apontamentoProducao01" <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>OP:</b></font></td>
      <td align="left"><input title="OP" name="ordemProducao" id="ordemProducao" type="text" class="INPUT03" size="10" maxlength="11" value="<?php echo $rowApontamento['NU_OP']; ?>" disabled="disabled"/></td>
      <td align="left"><font class="FONT04"><b>Produto:</b></font></td>
      <td colspan="3" align="left"><input title="Produto" type="text" name="descricaoProduto" id="descricaoProduto" class="INPUT01" size="52" value="<?php echo $rowApontamento['DS_PRODUTO']; ?>" disabled="disabled" /></td>
    </tr>
    <tr id="apontamentoProducao02" <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>Lote:</b></font></td>
      <td align="left"><input title="Lote" type="text" name="loteOp" id="loteOp" class="INPUT03" size="10" maxlength="10" value="<?php echo $rowApontamento['NU_LOTE']; ?>" disabled="disabled"/></td>
      <td align="left"><font class="FONT04"><b>Código do Produto:</b></font></td>
      <td width="112" align="left"><input title="Quantidade" type="text" name="codigoInterno2" id="codigoInterno2" class="INPUT03" size="14" maxlength="15" value="<?php echo $rowApontamento['CO_PRODUTO'];?>" disabled="disabled" /></td>
      <td width="51" align="left"><font class="FONT04"><b>Cód. Int.:</b></font></td>
      <td width="145" align="left"><input title="Quantidade" type="text" name="codigoInterno3" id="codigoInterno3" class="INPUT03" size="8" maxlength="10" value="<?php echo $rowApontamento['CO_INT_PRODUTO']; ?>" disabled="disabled" /></td>
    </tr>
    <tr <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>Data Emissão:</b></font></td>
      <td align="left"><input title="Data Emissão" name="dataEmissaoOp" id="dataEmissaoOp" type="text" class="INPUT03" size="10" maxlength="10" value="<?php echo $rowApontamento['DT_EMISSAO']; ?>" disabled="disabled"/></td>
      <td align="left">&nbsp;</td>
      <td colspan="3" align="left">&nbsp;</td>
    </tr>
    <tr <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>Quantidade:</b></font></td>
      <td align="left"><input title="Quantidade" type="text" name="codigoInterno" id="codigoInterno" class="INPUT03" size="10" maxlength="10" value="<?php echo $rowApontamento['QTD_PRODUTO']; ?>" disabled="disabled" /></td>
      <td align="left">&nbsp;</td>
      <td colspan="3" align="left">&nbsp;</td>
      
    </tr>
  </table>