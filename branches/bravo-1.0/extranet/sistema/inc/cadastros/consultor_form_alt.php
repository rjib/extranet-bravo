<?php

    require("../../setup.php");
	
	$codigoConsultor = $_GET['codigoConsultor'];
	
	$sqlConsultor = mysql_query("SELECT CONSULTOR.CO_CONSULTOR
								     , DATE_FORMAT(CONSULTOR.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
								     , CONCAT(PESSOA_FISICA.CPF_PESSOA_FISICA,' - ',PESSOA.NO_PESSOA) AS NOME_PESSOA
									 , CONSULTOR.CO_SETOR
									 , CONSULTOR.CO_TIPO_SANGUINEO								   
							         , CONSULTOR.OBS_CONSULTOR
								 FROM tb_consultor CONSULTOR
								     INNER JOIN tb_pessoa PESSOA
								         ON CONSULTOR.CO_PESSOA = PESSOA.CO_PESSOA
								     INNER JOIN tb_pessoa_fisica PESSOA_FISICA
								         ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
								 WHERE CONSULTOR.CO_CONSULTOR = '".$codigoConsultor."'",$conexaoERP)
	or die("<script>
			    alert('[Erro1] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowConsultor=mysql_fetch_array($sqlConsultor);
		
	$sqlSetor = mysql_query("SELECT CO_SETOR, NO_SETOR FROM tb_setor ORDER BY NO_SETOR",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlSetor) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Setor cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
	
	$sqlTipoSanguineo = mysql_query("SELECT CO_TIPO_SANGUINEO, NO_TIPO_SANGUINEO FROM tb_tipo_sanguineo ORDER BY NO_TIPO_SANGUINEO",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlTipoSanguineo) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Tipo Sanguineo, por favor entre em contato com o Suporte.</p>').dialog({
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
<script type="text/javascript" src="js/cadastros/consultor.js"></script>
<form id="formularioAlterarConsultor" action="javascript:func()" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
		                          <td align="left"><input title="Código" name="codigoConsultor02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowConsultor['CO_CONSULTOR']; ?>" disabled="disabled"/>
                                  <input name="codigoConsultor" id="codigoConsultor" type="hidden" value="<?php echo $rowConsultor['CO_CONSULTOR']; ?>"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
		                          <td align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowConsultor['DT_CADAS']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td width="478" align="left"><font class="FONT04"><b>Pessoa:</b></font></td>
		                          <td align="left"><input title="Nome" name="nomeConsultorAlterar" id="nomeConsultorAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowConsultor['NOME_PESSOA']; ?>" disabled="disabled"/></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Setor:</b></font></td>
		                          <td align="left">
                                  <select title="Setor" name="setorAlterar" id="setorAlterar" class="SELECT01">
		                            <?php
                                        while($rowSetor=mysql_fetch_array($sqlSetor)){
											if($rowSetor['CO_SETOR'] == $rowConsultor['CO_SETOR']){
											    echo "<option value='".$rowSetor['CO_SETOR']."' selected='selected'>".$rowSetor['NO_SETOR']."</option>";
										    }else{
											    echo "<option value='".$rowSetor['CO_SETOR']."'>".$rowSetor['NO_SETOR']."</option>";
										    }
                                        }	
                                    ?>
	                              </select>
                                  </td>
	                          </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Tipo Sanguineo:</b></font></td>
		                          <td align="left"><select title="Tipo Sanguineo" name="tipoSanguineoAlterar" id="tipoSanguineoAlterar" class="SELECT01">
		                            <?php
                                        while($rowTipoSanguineo=mysql_fetch_array($sqlTipoSanguineo)){
											if($rowTipoSanguineo['CO_TIPO_SANGUINEO'] == $rowConsultor['CO_TIPO_SANGUINEO']){
											    echo "<option value='".$rowTipoSanguineo['CO_TIPO_SANGUINEO']."' selected='selected'>".$rowTipoSanguineo['NO_TIPO_SANGUINEO']."</option>";
										    }else{
											    echo "<option value='".$rowTipoSanguineo['CO_TIPO_SANGUINEO']."'>".$rowTipoSanguineo['NO_TIPO_SANGUINEO']."</option>";
										    }
                                        }	
                                    ?>
	                              </select></td>
    </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Observa&ccedil;&atilde;o:</b></font></td>
		                          <td align="left"><textarea title="Descrição" name="descricaoConsultorAlterar" id="descricaoConsultorAlterar" cols="77" rows="10" class="TEXTAREA01"><?php echo $rowConsultor['OBS_CONSULTOR']; ?></textarea></td>
	                          </tr>
	                          </table>
</form>