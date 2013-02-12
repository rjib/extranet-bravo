<?php

    require("../../setup.php");
	
	$codigoUsuario = $_GET['codigoUsuario'];
	
	$sqlUsuario = mysql_query("SELECT USUARIO.CO_USUARIO
								   , CONCAT(PESSOA_FISICA.CPF_PESSOA_FISICA,' - ',PESSOA.NO_PESSOA) AS NOME_PESSOA				   
							   FROM tb_usuario USUARIO
							       INNER JOIN tb_colaborador COLABORADOR
								       ON USUARIO.CO_COLABORADOR = COLABORADOR.CO_COLABORADOR
							       INNER JOIN tb_pessoa PESSOA
							           ON COLABORADOR.CO_PESSOA = PESSOA.CO_PESSOA
							       INNER JOIN tb_pessoa_fisica PESSOA_FISICA
							           ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
							   WHERE USUARIO.CO_USUARIO = '".$codigoUsuario."'",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	$rowUsuario=mysql_fetch_array($sqlUsuario);
	
	$sqlRecurso = mysql_query("SELECT CO_PCP_RECURSO
								   , NO_RECURSO		   
							   FROM tb_pcp_recurso RECURSO
							   WHERE FL_DELET IS NULL",$conexaoERP)
	or die("<script>
			    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
?>
<script type="text/javascript" src="js/cadastros/usuario.js"></script>
  <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="65" align="left"><font class="FONT04"><b>Usuário:</b></font></td>
		                          <td width="1247" align="left"><input title="Nome" name="nomeUsuarioAlterar" id="nomeUsuarioAlterar" type="text" class="INPUT01" size="60" maxlength="80" value="<?php echo $rowUsuario['NOME_PESSOA']; ?>" disabled="disabled"/></td>
	                          </tr>
	                          </table>
<form id="formularioVincularUsuarioRecurso" action="javascript:func()" method="post">
<input name="codigoUsuario" id="codigoUsuario" type="hidden" value="<?php echo $rowUsuario['CO_USUARIO']; ?>" />
    <table width="100%" border="0" cellspacing="2" cellpadding="3" class="LISTA">
    <tr>
    <th width="65" align="center"></td>
    <input type="checkbox" name="checkbox2" id="btSelecionarTodosRecursos" onclick="marcarTodosUsuarioRecursoSelecao();"/>
    <th width="1247" align="left"><font class="FONT04"><b>Recurso</b></font></td>
    </tr>
    <?php
	    if(mysql_num_rows($sqlRecurso) == 0){
		    echo "<tr>";
			echo "<th align='center' colspan='2'><font class='FONT05'><b>N&atilde;o h&aacute; Recurso registrado no momento!</b></font></td>";
			echo "</tr>";
		}else{
			while($rowRecurso=mysql_fetch_array($sqlRecurso)){ 	
			    $sqlUsuarioRecurso = mysql_query("SELECT null
												  FROM tb_pcp_usuario_recurso
												  WHERE CO_PCP_RECURSO = '".$rowRecurso['CO_PCP_RECURSO']."'
												  AND CO_USUARIO = '".$rowUsuario['CO_USUARIO']."'",$conexaoERP)
				or die("<script>
						    alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
						    history.back(-1);
						</script>"); 
											  
			    echo "<tr>";
			    echo "<td align='center'>";
				
				if(mysql_num_rows($sqlUsuarioRecurso) > 0){
			        echo "<input type='checkbox' name='codigoRecurso[]' id='codigoRecurso[]' value='".$rowRecurso['CO_PCP_RECURSO']."' checked='checked'/>";
				}else{
					echo "<input type='checkbox' name='codigoRecurso[]' id='codigoRecurso[]' value='".$rowRecurso['CO_PCP_RECURSO']."'/>";
				}			
				
				echo "</td>";
			    echo "<td align='left'>".$rowRecurso['CO_PCP_RECURSO']." - ".$rowRecurso['NO_RECURSO']."</td>";
			    echo "</tr>";
			}
		}
	?>    
    </table>
</form>