<?php

    require("../../../setup.php");
	
	$codigoAcessoConsultor = $_GET['codigoAcessoConsultor'];
	
	$sqlAcessoConsultor = mysql_query("SELECT ACESSO_CONSULTOR.CO_ACESSO_PRESTADOR
									       , DATE_FORMAT(ACESSO_CONSULTOR.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
										   , CONCAT(PESSOA_FISICA.CPF_PESSOA_FISICA,' - ',PESSOA.NO_PESSOA) AS NOME_PESSOA
									       , DATE_FORMAT(ACESSO_CONSULTOR.DT_ACESSO_PRESTADOR, '%d/%m/%Y %H:%i:%S') AS DT_ACESSO_PRESTADOR
									       , ACESSO_CONSULTOR.HR_ENTRADA
									       , ACESSO_CONSULTOR.HR_SAIDA
									       , ACESSO_CONSULTOR.CO_TIPO_VEICULO
									       , ACESSO_CONSULTOR.PL_VEICULO
									       , ACESSO_CONSULTOR.CO_CARTAO_IDENTIFICACAO
									       , USUARIO_ENTRADA.LG_USUARIO AS LG_USUARIO_ENTRADA
									       , USUARIO_SAIDA.LG_USUARIO AS LG_USUARIO_SAIDA					    
									   FROM tb_acesso_prestador ACESSO_CONSULTOR
									       INNER JOIN tb_prestador_servico CONSULTOR
										       ON ACESSO_CONSULTOR.CO_PRESTADOR = CONSULTOR.CO_PRESTADOR
										   INNER JOIN tb_pessoa PESSOA
										       ON CONSULTOR.CO_PESSOA = PESSOA.CO_PESSOA
										   INNER JOIN tb_pessoa_fisica PESSOA_FISICA
										       ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
										   INNER JOIN tb_usuario USUARIO_ENTRADA
										       ON ACESSO_CONSULTOR.CO_USUARIO_ENTRADA = USUARIO_ENTRADA.CO_USUARIO
										   LEFT JOIN tb_usuario USUARIO_SAIDA
										       ON ACESSO_CONSULTOR.CO_USUARIO_SAIDA = USUARIO_SAIDA.CO_USUARIO
									   WHERE ACESSO_CONSULTOR.CO_ACESSO_PRESTADOR = '".$codigoAcessoConsultor."'")
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowAcessoConsultor=mysql_fetch_array($sqlAcessoConsultor);
	
	$sqlTipoVeiculo = mysql_query("SELECT FL_EXIGE_PLACA, CO_TIPO_VEICULO, NO_TIPO_VEICULO FROM tb_tipo_veiculo ORDER BY NO_TIPO_VEICULO")
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
<script type="text/javascript" src="js/cadastros/controle_acesso/acesso_consultor.js"></script>
<script>$("#horaSaidaInserir").focus();</script>
<form id="formularioInserirHoraSaidaAcessoConsultor" action="javascript:func()" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
		                          <td colspan="3" align="left"><input title="Código" name="codigoAcessoConsultor02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowAcessoConsultor['CO_ACESSO_PRESTADOR']; ?>" disabled="disabled"/>
                                  <input name="codigoAcessoConsultor" id="codigoAcessoConsultor" type="hidden" value="<?php echo $rowAcessoConsultor['CO_ACESSO_PRESTADOR']; ?>"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
		                          <td colspan="3" align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowAcessoConsultor['DT_CADAS']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td width="231" align="left"><font class="FONT04"><b>Consultor:</b></font></td>
		                          <td colspan="3" align="left"><input title="Consultor" name="nomeConsultor" id="nomeConsultor" type="text" class="INPUT01" size="60" maxlength="80" value="<?php echo $rowAcessoConsultor['NOME_PESSOA']; ?>" disabled="disabled"/></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Hora Entrada:</b></font></td>
		                          <td width="155" align="left"><input title="Hora Entrada" type="text" name="horaEntrada" id="horaEntrada" class="INPUT03" size="4" maxlength="5" value="<?php echo $rowAcessoConsultor['HR_ENTRADA']; ?>" disabled="disabled" />
                                   <input type="hidden" name="horarioEntrada" id="horarioEntrada" value="<?php echo $rowAcessoConsultor['HR_ENTRADA']; ?>" /></td>
		                          <td width="142" align="left"><font class="FONT04"><b>Hora Saída:</b></font></td>
		                          <td width="768" align="left"><input title="Hora Saída" type="text" name="horaSaidaInserir" id="horaSaidaInserir" class="INPUT03" size="4" maxlength="5" /></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo Veiculo:</b></font></td>
		                          <td align="left">
                                  <select title="Tipo Veiculo" name="tipoVeiculo" id="tipoVeiculo" class="SELECT01" disabled="disabled">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowTipoVeiculo=mysql_fetch_array($sqlTipoVeiculo)){ 	
										    if($rowTipoVeiculo['CO_TIPO_VEICULO'] == $rowAcessoConsultor['CO_TIPO_VEICULO']){
											    echo "<option id='".$rowTipoVeiculo['FL_EXIGE_PLACA']."' value='".$rowTipoVeiculo['CO_TIPO_VEICULO']."' selected='selected'>".$rowTipoVeiculo['NO_TIPO_VEICULO']."</option>";
										    }else{
											    echo "<option id='".$rowTipoVeiculo['FL_EXIGE_PLACA']."' value='".$rowTipoVeiculo['CO_TIPO_VEICULO']."'>".$rowTipoVeiculo['NO_TIPO_VEICULO']."</option>";
										    }
                                        }	
                                    ?>
	                              </select>
                                  </td>
		                          <td align="left"><font class="FONT04"><b>Placa Veiculo:</b></font></td>
		                          <td align="left"><input title="Placa Veiculo" type="text" name="placaVeiculo" id="placaVeiculo" class="INPUT03" size="8" maxlength="8" value="<?php echo $rowAcessoConsultor['PL_VEICULO']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>N&uacute;mero Cart&atilde;o:</b></font></td>
		                          <td colspan="3" align="left">
                                  <select title="Número Cartão" name="numeroCartao" id="numeroCartao" class="SELECT01" disabled="disabled">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowCartaoIdentificacao=mysql_fetch_array($sqlCartaoIdentificacao)){ 	
                                            if($rowCartaoIdentificacao['CO_CARTAO_IDENTIFICACAO'] == $rowAcessoConsultor['CO_CARTAO_IDENTIFICACAO']){
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
		                          <td colspan="3" align="left"><input title="Usuario Entrada" name="usuarioEntrada" type="text" class="INPUT01" size="40" value="<?php echo $rowAcessoConsultor['LG_USUARIO_ENTRADA']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Usuario Saída:</b></font></td>
		                          <td colspan="3" align="left"><input title="Usuario Saída" name="usuarioSaida" type="text" class="INPUT01" size="40" value="<?php echo $rowAcessoConsultor['LG_USUARIO_SAIDA']; ?>" disabled="disabled"/></td>
    </tr>
	                          </table>
</form>