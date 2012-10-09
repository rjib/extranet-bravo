<?php

    require("../../../setup.php");
	
	$codigoAcessoVisitante = $_GET['codigoAcessoVisitante'];
	
	$sqlAcessoVisitante = mysql_query("SELECT ACESSO_VISITANTE.CO_ACESSO_VISITANTE
									       , DATE_FORMAT(ACESSO_VISITANTE.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
										   , CONCAT(PESSOA_FISICA.CPF_PESSOA_FISICA,' - ',PESSOA.NO_PESSOA) AS NOME_PESSOA
									       , DATE_FORMAT(ACESSO_VISITANTE.DT_ACESSO_VISITANTE, '%d/%m/%Y %H:%i:%S') AS DT_ACESSO_VISITANTE
									       , ACESSO_VISITANTE.HR_ENTRADA
									       , ACESSO_VISITANTE.HR_SAIDA
									       , ACESSO_VISITANTE.CO_TIPO_VEICULO
									       , ACESSO_VISITANTE.PL_VEICULO
									       , ACESSO_VISITANTE.CO_CARTAO_IDENTIFICACAO
									       , USUARIO_ENTRADA.LG_USUARIO AS LG_USUARIO_ENTRADA
									       , USUARIO_SAIDA.LG_USUARIO AS LG_USUARIO_SAIDA					    
									   FROM tb_acesso_visitante ACESSO_VISITANTE
										   INNER JOIN tb_pessoa PESSOA
										       ON ACESSO_VISITANTE.CO_PESSOA = PESSOA.CO_PESSOA
										   LEFT JOIN tb_pessoa_fisica PESSOA_FISICA
										       ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
										   LEFT JOIN tb_pessoa_juridica PESSOA_JURIDICA
										       ON PESSOA.CO_PESSOA = PESSOA_JURIDICA.CO_PESSOA
										   INNER JOIN tb_usuario USUARIO_ENTRADA
										       ON ACESSO_VISITANTE.CO_USUARIO_ENTRADA = USUARIO_ENTRADA.CO_USUARIO
										   LEFT JOIN tb_usuario USUARIO_SAIDA
										       ON ACESSO_VISITANTE.CO_USUARIO_SAIDA = USUARIO_SAIDA.CO_USUARIO
									   WHERE ACESSO_VISITANTE.CO_ACESSO_VISITANTE = '".$codigoAcessoVisitante."'")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowAcessoVisitante=mysql_fetch_array($sqlAcessoVisitante);
	
	$sqlTipoVeiculo = mysql_query("SELECT CO_TIPO_VEICULO, NO_TIPO_VEICULO FROM tb_tipo_veiculo ORDER BY NO_TIPO_VEICULO")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlTipoVeiculo) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Tipo Veiculo cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
				      modal: true,
				      resizable: false,
				      title: 'Aten&ccedil;&atilde;o',
				      buttons: {
				      Ok: function() {
				          $( this ).dialog( 'close' );
				          $(window.document.location).attr('href','inicio.php');
				      }
				  }
			  }); });
			  </script>";
	}
	
	$sqlCartaoIdentificacao = mysql_query("SELECT CO_CARTAO_IDENTIFICACAO, NU_CARTAO_IDENTIFICACAO FROM tb_cartao_identificacao ORDER BY NU_CARTAO_IDENTIFICACAO")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlCartaoIdentificacao) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Cart&atilde;o de Identifica&ccedil;&atilde;o cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
				      modal: true,
				      resizable: false,
				      title: 'Aten&ccedil;&atilde;o',
				      buttons: {
				      Ok: function() {
				          $( this ).dialog( 'close' );
				          $(window.document.location).attr('href','inicio.php');
				      }
				  }
			  }); });
			  </script>";
	}
	
?>
<script type="text/javascript" src="js/cadastros/controle_acesso/acesso_visitante.js"></script>
<form id="formularioAlterarAcessoVisitante" action="javascript:func()" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
		                          <td colspan="3" align="left"><input title="Código" name="codigoAcessoVisitante02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowAcessoVisitante['CO_ACESSO_VISITANTE']; ?>" disabled="disabled"/>
                                  <input name="codigoAcessoVisitante" id="codigoAcessoVisitante" type="hidden" value="<?php echo $rowAcessoVisitante['CO_ACESSO_VISITANTE']; ?>"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
		                          <td colspan="3" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowAcessoVisitante['DT_CADAS']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td width="231" align="left"><font class="FONT04"><b>Visitante:</b></font></td>
		                          <td colspan="3" align="left"><input title="Visitante" name="nomeVisitanteAlterar" id="nomeVisitanteAlterar" type="text" class="INPUT01" size="60" maxlength="80" value="<?php echo $rowAcessoVisitante['NOME_PESSOA']; ?>" disabled="disabled"/></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Hora Entrada:</b></font></td>
		                          <td width="155" align="left"><input title="Hora Entrada" type="text" name="horaEntradaAlterar" id="horaEntradaAlterar" class="INPUT03" size="4" maxlength="5" value="<?php echo $rowAcessoVisitante['HR_ENTRADA']; ?>" /></td>
		                          <td width="142" align="left"><font class="FONT04"><b>Hora Saída:</b></font></td>
		                          <td width="768" align="left"><input title="Hora Saída" type="text" name="horaSaidaAlterar" id="horaSaidaAlterar" class="INPUT03" size="4" maxlength="5" value="<?php echo $rowAcessoVisitante['HR_SAIDA']; ?>" disabled="disabled"/></td>
    </tr> 
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo Veiculo:</b></font></td>
		                          <td align="left">
                                  <select title="Tipo Veiculo" name="tipoVeiculoAlterar" id="tipoVeiculoAlterar" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowTipoVeiculo=mysql_fetch_array($sqlTipoVeiculo)){ 	
										    if($rowTipoVeiculo['CO_TIPO_VEICULO'] == $rowAcessoVisitante['CO_TIPO_VEICULO']){
											    echo "<option value='".$rowTipoVeiculo['CO_TIPO_VEICULO']."' selected='selected'>".$rowTipoVeiculo['NO_TIPO_VEICULO']."</option>";
										    }else{
											    echo "<option value='".$rowTipoVeiculo['CO_TIPO_VEICULO']."'>".$rowTipoVeiculo['NO_TIPO_VEICULO']."</option>";
										    }
                                        }	
                                    ?>
	                              </select>
                                  </td>
		                          <td align="left"><font class="FONT04"><b>Placa Veiculo:</b></font></td>
		                          <td align="left"><input title="Placa Veiculo" type="text" name="placaVeiculoAlterar" id="placaVeiculoAlterar" class="INPUT03" size="8" maxlength="8" value="<?php echo $rowAcessoVisitante['PL_VEICULO']; ?>"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>N&uacute;mero Cart&atilde;o:</b></font></td>
		                          <td colspan="3" align="left">
                                  <select title="Número Cartão" name="numeroCartaoAlterar" id="numeroCartaoAlterar" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowCartaoIdentificacao=mysql_fetch_array($sqlCartaoIdentificacao)){ 	
                                            if($rowCartaoIdentificacao['CO_CARTAO_IDENTIFICACAO'] == $rowAcessoVisitante['CO_CARTAO_IDENTIFICACAO']){
											    echo "<option value='".$rowCartaoIdentificacao['CO_CARTAO_IDENTIFICACAO']."' selected='selected'>".$rowCartaoIdentificacao['NU_CARTAO_IDENTIFICACAO']."</option>";
										    }else{
											    echo "<option value='".$rowCartaoIdentificacao['CO_CARTAO_IDENTIFICACAO']."'>".$rowCartaoIdentificacao['NU_CARTAO_IDENTIFICACAO']."</option>";
										    }
                                        }	
                                    ?>
	                              </select>
                                  </td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Usuario Entrada:</b></font></td>
		                          <td colspan="3" align="left"><input title="Usuario Entrada" name="usuarioEntrada" type="text" class="INPUT01" size="40" value="<?php echo $rowAcessoVisitante['LG_USUARIO_ENTRADA']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Usuario Saída:</b></font></td>
		                          <td colspan="3" align="left"><input title="Usuario Saída" name="usuarioSaida" type="text" class="INPUT01" size="40" value="<?php echo $rowAcessoVisitante['LG_USUARIO_SAIDA']; ?>" disabled="disabled"/></td>
    </tr>
	                          </table>
</form>