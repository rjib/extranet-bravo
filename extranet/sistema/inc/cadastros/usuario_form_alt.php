<?php

    require("../../setup.php");
	
	$codigoUsuario = $_GET['codigoUsuario'];
	
	$sqlUsuario = mysql_query("SELECT USUARIO.CO_USUARIO
							       , DATE_FORMAT(USUARIO.DT_CADAS, '%d/%m/%Y %H:%i:%S') AS DT_CADAS
								   , CONCAT(PESSOA_FISICA.CPF_PESSOA_FISICA,' - ',PESSOA.NO_PESSOA) AS NOME_PESSOA
								   , USUARIO.CO_PAPEL
								   , USUARIO.LG_USUARIO
								   , USUARIO.QT_ACESSO_USUARIO
								   , USUARIO.ST_USUARIO								   
							   FROM tb_usuario USUARIO
							       INNER JOIN tb_colaborador COLABORADOR
								       ON USUARIO.CO_COLABORADOR = COLABORADOR.CO_COLABORADOR
							       INNER JOIN tb_pessoa PESSOA
							           ON COLABORADOR.CO_PESSOA = PESSOA.CO_PESSOA
							       INNER JOIN tb_pessoa_fisica PESSOA_FISICA
							           ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
							   WHERE USUARIO.CO_USUARIO = '".$codigoUsuario."'
							   AND USUARIO.ST_USUARIO IN(0,1)",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowUsuario=mysql_fetch_array($sqlUsuario);
	
	$sqlPapel = mysql_query("SELECT CO_PAPEL, NO_PAPEL FROM tb_papel ORDER BY NO_PAPEL",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlPapel) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro] - N&atilde;o existe Papel cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
<script type="text/javascript" src="js/cadastros/usuario.js"></script>
<form id="formularioAlterarUsuario" action="javascript:func()" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>C&oacute;digo:</b></font></td>
		                          <td align="left"><input title="Código" name="codigoUsuario02" type="text" class="INPUT01" size="10" maxlength="10" value="<?php echo $rowUsuario['CO_USUARIO']; ?>" disabled="disabled"/>
                                  <input name="codigoUsuario" id="codigoUsuario" type="hidden" value="<?php echo $rowUsuario['CO_USUARIO']; ?>"/></td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Data Cadastro:</b></font></td>
		                          <td align="left"><input title="Data/Hora" name="dataCadastro" type="text" class="INPUT01" size="20" value="<?php echo $rowUsuario['DT_CADAS']; ?>" disabled="disabled"/></td>
    </tr>
		                        <tr>
		                          <td width="478" align="left"><font class="FONT04"><b>Pessoa:</b></font></td>
		                          <td align="left"><input title="Nome" name="nomeUsuarioAlterar" id="nomeUsuarioAlterar" type="text" class="INPUT01" size="80" maxlength="80" value="<?php echo $rowUsuario['NOME_PESSOA']; ?>" disabled="disabled"/></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Papel:</b></font></td>
		                          <td align="left">
                                  <select title="Papel" name="papelUsuarioAlterar" id="papelUsuarioAlterar" class="SELECT01">
		                            <?php
                                        while($rowPapel=mysql_fetch_array($sqlPapel)){
											if($rowPapel['CO_PAPEL'] == $rowUsuario['CO_PAPEL']){
											    echo "<option value='".$rowPapel['CO_PAPEL']."' selected='selected'>".$rowPapel['NO_PAPEL']."</option>";
										    }else{
											    echo "<option value='".$rowPapel['CO_PAPEL']."'>".$rowPapel['NO_PAPEL']."</option>";
										    }
                                        }	
                                    ?>
	                              </select>
                                  </td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Login:</b></font></td>
		                          <td width="105" align="left"><input title="Login" name="loginUsuarioAlterar" id="loginUsuarioAlterar" type="text" class="INPUT01" size="20" maxlength="20" value="<?php echo $rowUsuario['LG_USUARIO']; ?>"/></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Status:</b></font></td>
		                          <td align="left">
                                  <select title="Status" name="statusUsuarioAlterar" id="statusUsuarioAlterar" class="SELECT01">
                                      <?php
									      if($rowUsuario['ST_USUARIO'] == 0){
										      echo "<option value='".$rowUsuario['ST_USUARIO']."'>Inativo</option>";
										      echo "<option value='1'>Ativo</option>";
										  }else{
										     echo "<option value='".$rowUsuario['ST_USUARIO']."'>Ativo</option>";
										     echo "<option value='0'>Inativo</option>";
										  }
									  ?>
	                              </select>
                                  </td>
    </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Qtd. Acesso:</b></font></td>
		                          <td align="left"><input title="Qtd. Acesso" name="quantidadeAcessoUsuario" type="text" class="INPUT01" size="20" value="<?php echo $rowUsuario['QT_ACESSO_USUARIO']; ?>" disabled="disabled"/></td>
    </tr>
	                          </table>
</form>