<?php

    require("../../setup.php");
	
	$codigoUsuario = $_GET['codigoUsuario'];
	
	$sqlUsuario = mysql_query("SELECT CO_USUARIO						   
							   FROM tb_usuario
							   WHERE CO_USUARIO = '".$codigoUsuario."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowUsuario=mysql_fetch_array($sqlUsuario);
		
?>
<script type="text/javascript" src="js/cadastros/usuario.js"></script>
<form id="formularioAlterarSenhaUsuario" action="javascript:func()" method="post">
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="31%" align="left"><font class="FONT04"><b>Nova Senha:</b></font></td>
		                          <td width="69%" align="left">
                                  <input name="codigoUsuario" id="codigoUsuario" type="hidden" value="<?php echo $rowUsuario['CO_USUARIO']; ?>"/>
                                  <input title="Senha" name="senhaUsuarioAlterar" id="senhaUsuarioAlterar" type="password" class="INPUT01" size="20" maxlength="20" />
                                  </td>
	                          </tr>
	                          </table>
</form>