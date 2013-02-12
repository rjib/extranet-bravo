<?php

    require("../../setup.php");
	
	$codigoColaborador = $_GET['codigoColaborador'];
	
	$sqlColaborador = mysql_query("SELECT COLABORADOR.CO_COLABORADOR
								       , DATE_FORMAT(COLABORADOR.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
								       , CONCAT(PESSOA_FISICA.CPF_PESSOA_FISICA,' - ',PESSOA.NO_PESSOA) AS NOME_PESSOA
								      
									  
									   , COLABORADOR.CO_CARGO
									   , COLABORADOR.CO_SETOR
									   , COLABORADOR.CO_TIPO_SANGUINEO								   
									   , COLABORADOR.OBS_COLABORADOR
								   FROM tb_colaborador COLABORADOR
								       INNER JOIN tb_pessoa PESSOA
								           ON COLABORADOR.CO_PESSOA = PESSOA.CO_PESSOA
								       INNER JOIN tb_pessoa_fisica PESSOA_FISICA
								           ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
								   WHERE COLABORADOR.CO_COLABORADOR = '".$codigoColaborador."'",$conexaoERP)
	or die("<script>
			    alert('[Erro1] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowColaborador=mysql_fetch_array($sqlColaborador);
	
	$sqlNivelFormacao = mysql_query("SELECT CO_NIVEL_FORMACAO, NO_NIVEL_FORMACAO FROM tb_nivel_formacao ORDER BY NO_NIVEL_FORMACAO",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlNivelFormacao) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Nivel Forma&ccedil;&atilde;o cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
	
	$sqlCargo = mysql_query("SELECT CO_CARGO, NO_CARGO FROM tb_cargo ORDER BY NO_CARGO",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlCargo) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Cargo cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
<script type="text/javascript" src="js/cadastros/colaborador.js"></script>
<form id="formularioAlterarColaborador" action="javascript:func()" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
		                          <td width="1011" align="left"><input title="Código" name="codigoColaborador02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowColaborador['CO_COLABORADOR']; ?>" disabled="disabled"/>
                                  <input name="codigoColaborador" id="codigoColaborador" type="hidden" value="<?php echo $rowColaborador['CO_COLABORADOR']; ?>"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
		                          <td align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowColaborador['DT_CADAS']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td width="301" align="left"><font class="FONT04"><b>Pessoa:</b></font></td>
		                          <td align="left"><input title="Nome" name="nomeColaboradorAlterar" id="nomeColaboradorAlterar" type="text" class="INPUT01" size="60" maxlength="80" value="<?php echo $rowColaborador['NOME_PESSOA']; ?>" disabled="disabled"/></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Setor:</b></font></td>
		                          <td align="left"><select title="Setor" name="setorAlterar" id="setorAlterar" class="SELECT01">
		                            <?php
                                        while($rowSetor=mysql_fetch_array($sqlSetor)){
											if($rowSetor['CO_SETOR'] == $rowColaborador['CO_SETOR']){
											    echo "<option value='".$rowSetor['CO_SETOR']."' selected='selected'>".$rowSetor['NO_SETOR']."</option>";
										    }else{
											    echo "<option value='".$rowSetor['CO_SETOR']."'>".$rowSetor['NO_SETOR']."</option>";
										    }
                                        }	
                                    ?>
	                              </select></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo Sanguineo:</b></font></td>
		                          <td align="left"><select title="Tipo Sanguineo" name="tipoSanguineoAlterar" id="tipoSanguineoAlterar" class="SELECT01">
		                            <?php
                                        while($rowTipoSanguineo=mysql_fetch_array($sqlTipoSanguineo)){
											if($rowTipoSanguineo['CO_TIPO_SANGUINEO'] == $rowColaborador['CO_TIPO_SANGUINEO']){
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
		                          <td align="left"><textarea title="Descrição" name="descricaoColaboradorAlterar" id="descricaoColaboradorAlterar" cols="55" rows="10" class="TEXTAREA01"><?php echo $rowColaborador['OBS_COLABORADOR']; ?></textarea></td>
	                          </tr>
	                          </table>
</form>