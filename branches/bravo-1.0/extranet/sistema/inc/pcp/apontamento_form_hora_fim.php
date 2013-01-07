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
									   , PCP_APONTAMENTO.FL_APONTAMENTO
									   , PCP_MOTIVO_PARADA.NO_MOTIVO_PARADA
									   , PCP_MOTIVO_PARADA.DS_MOTIVO_PARADA
									   , CONCAT(PCP_OP.CO_NUM,PCP_OP.CO_ITEM,PCP_OP.CO_SEQUENCIA) AS NU_OP
									   , TRIM(PCP_PRODUTO.DS_PRODUTO) AS DS_PRODUTO
									   , PCP_OP.NU_LOTE
									   , DATE_FORMAT(PCP_OP.DT_EMISSAO, '%d/%m/%Y') AS DT_EMISSAO
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
<script>$("#ordemProducaoValida").focus();</script>
<form id="formularioInserirHoraFimApontamento" action="javascript:func()" method="post">
  <table width="700" border="0" cellspacing="2" cellpadding="3">
    <tr>
      <td align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
      <td colspan="3" align="left"><input title="Código" name="codigoApontamento02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowApontamento['CO_PCP_APONTAMENTO']; ?>" disabled="disabled"/>
      <input name="codigoApontamento" id="codigoApontamento" type="hidden" value="<?php echo $rowApontamento['CO_PCP_APONTAMENTO']; ?>"/></td>
    </tr>
    <tr>
      <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
      <td colspan="3" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowApontamento['DT_CADAS']; ?>" disabled="disabled"/></td>
    </tr>
    <tr>
      <td align="left"><font class="FONT04"><b>Data Apontamento:</b></font></td>
      <td align="left"><input title="Data" name="dataApontamento02" id="dataApontamento02" type="text" class="INPUT03" size="8" maxlength="10" value="<?php echo date("d-m-Y"); ?>" disabled="disabled"/>
        <input type="hidden" id="dataApontamento" name="dataApontamento" value="<?php echo date("Y-m-d"); ?>"/></td>
      <td align="left"><font class="FONT04"><b>Usuário:</b></font></td>
      <td align="left"><input title="Usuário" type="text" name="usuario" id="usuario" class="INPUT01" size="50" value="<?php echo $_SESSION['codigoUsuario']." - ".$_SESSION['nomePessoa']." [".$_SESSION['loginUsuario']."]"; ?>" disabled="disabled" /></td>
    </tr>
    <tr>
      <td width="106" align="left"><font class="FONT04"><b>Recurso:</b></font></td>
      <td colspan="3" align="left">
      <select title="Recurso" name="codigoRecurso" id="codigoRecurso" class="SELECT01" style="width:250px" disabled="disabled">
        <option value="0"><?php echo $rowApontamento['NO_RECURSO']; ?></option>
      </select>
      </td>
    </tr>
    <tr>
      <td align="left"><font class="FONT04"><b>Hora Início:</b></font></td>
      <td width="124" align="left">
      <input title="Hora Início" type="text" name="horaInicio2" id="horaInicio2" class="INPUT03" size="4" maxlength="4" value="<?php echo $rowApontamento['HR_INICIO']; ?>" disabled="disabled" />
      <input name="horaInicio" id="horaInicio" type="hidden" value="<?php echo $rowApontamento['HR_INICIO']; ?>"/>
      </td>
      <td width="106" align="left"><font class="FONT04"><b>Tipo Apontamento:</b></font></td>
      <td width="330" align="left">
      <input title="Tipo Apontamento" type="radio" name="flagApontamentoParada" id="flagApontamento2" value="1" <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "checked='checked'"; } ?> disabled="disabled"/>
        Parada de Máquina
        <input title="Tipo Apontamento" type="radio" name="flagApontamentoProducao" id="flagApontamento2" value="2" <?php if($rowApontamento['FL_APONTAMENTO'] == "2"){echo "checked='checked'"; } ?> disabled="disabled"/>
        Produção
        </td>
    </tr>
    <tr id="apontamentoParada" <?php if($rowApontamento['FL_APONTAMENTO'] == "2"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>Motivo:</b></font></td>
      <td align="left"><input title="Motivo" name="nomeMotivo" id="nomeMotivo" type="text" class="INPUT03" size="3" maxlength="5" value="<?php echo $rowApontamento['NO_MOTIVO_PARADA']; ?>" disabled="disabled"/></td>
      <td align="left"><font class="FONT04"><b>Descrição:</b></font></td>
      <td align="left"><input title="Descrição" type="text" name="descricaoMotivo" id="descricaoMotivo" class="INPUT01" size="50" value="<?php echo $rowApontamento['DS_MOTIVO_PARADA']; ?>" disabled="disabled" /></td>
    </tr>
    <tr id="apontamentoProducao01" <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>OP:</b></font></td>
      <td align="left"><input title="OP" name="ordemProducao" id="ordemProducao" type="text" class="INPUT03" size="9" maxlength="11" value="<?php echo $rowApontamento['NU_OP']; ?>" disabled="disabled"/></td>
      <td align="left"><font class="FONT04"><b>Produto:</b></font></td>
      <td align="left"><input title="Produto" type="text" name="descricaoProduto" id="descricaoProduto" class="INPUT01" size="50" value="<?php echo $rowApontamento['DS_PRODUTO']; ?>" disabled="disabled" /></td>
    </tr>
    <tr id="apontamentoProducao02" <?php if($rowApontamento['FL_APONTAMENTO'] == "1"){echo "style='display:none'"; } ?>>
      <td align="left"><font class="FONT04"><b>Lote:</b></font></td>
      <td align="left"><input title="Lote" type="text" name="loteOp" id="loteOp" class="INPUT03" size="10" maxlength="10" value="<?php echo $rowApontamento['NU_LOTE']; ?>" disabled="disabled"/></td>
      <td align="left"><font class="FONT04"><b>Data Emissão:</b></font></td>
      <td align="left"><input title="Data Emissão" name="dataEmissaoOp" id="dataEmissaoOp" type="text" class="INPUT03" size="8" maxlength="10" value="<?php echo $rowApontamento['DT_EMISSAO']; ?>" disabled="disabled"/></td>
    </tr>
    <tr>
      <td align="left"><input name="flagApontamentoHoraFim" id="flagApontamentoHoraFim" type="hidden" value="<?php echo $rowApontamento['FL_APONTAMENTO']; ?>"/></td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
      <td align="left">&nbsp;</td>
    </tr>
    <tr>
		                          <td colspan="4" align="left" style="border: 2px solid rgb(255, 204, 0); padding: 7px;">
		                            <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                              <tr>                                        
		                                <?php
										    if($rowApontamento['FL_APONTAMENTO'] == "2"){
												echo "<td width='5%' rowspan='2'>";
												echo "<font class='FONT05'><b>OP:</b></font>";
												echo "</td>";
		                                        echo "<td width='45%' rowspan='2'>";
												echo "<input title='OP' name='ordemProducaoValida' id='ordemProducaoValida' type='text' class='INPUT03' size='9' maxlength='11' onblur='getValidaOrdemProducao(".$rowApontamento['NU_OP'].")'/>";
                                                echo "</td>";
												echo "<td id='colunaQuantidade01' style='display:none'><font class='FONT05'><b>Quantidade:</b></font></td>";
												echo "<td id='colunaQuantidade02' style='display:none'><input title='Quantidade' type='text' name='quantidadeProduto' id='quantidadeProduto' class='INPUT03' size='5' maxlength='10'/></td>";
											}
										?>
	                                  </tr>
		                              <tr>
		                                <td id="colunaHoraFim01" width="13%" <?php if($rowApontamento['FL_APONTAMENTO'] == "2"){echo "style='display:none'";} ?>><font class="FONT05"><b>Hora Fim:&nbsp;&nbsp;</b></font></td>
		                                <td id="colunaHoraFim02" width="37%" <?php if($rowApontamento['FL_APONTAMENTO'] == "2"){echo "style='display:none'";} ?>>
                                        <input title="Hora Fim" type="text" name="horaFimInserir" id="horaFimInserir" class="INPUT03" size="4" maxlength="4"/>
                                        <input name="flagOrdemProducao" id="flagOrdemProducao" type="hidden" value="1"/>
                                        </td>
	                                  </tr>
</table></td>
	                            </tr>
  </table>
</form>