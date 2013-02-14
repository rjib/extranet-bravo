<?php

    /**
	 * Script responsavel por listar a pagina principal do sistema com seus indicadores maters.
	 * 
	 * @author Euripedes B. Silva Junior <ejunior@bravomoveis.com>
	 * @version 1.0 - 05/01/2013 22:00
	 * 
	 */
	 
	//CONTROLE DE ACESSO ACOES
	
	require_once 'models/tb_modulos.php';
			
	$co_papel = $_SESSION['codigoPapel'];
	$modulos = new tb_modulos(CONEXAOERP);
	$acoesApontamento = $modulos->possuiPermissaoParaEstaArea($co_papel, PCP, PCP_APONTAMENTO);
			
	//FIM CONTROLE DE ACESSO 
	
	if($acoesApontamento['FL_EXCLUIR'] == 1 && $acoesApontamento['FL_EDITAR'] == 1 && $acoesApontamento['FL_ADICIONAR'] == 1){
	
        $sqlApontamento = mysql_query("SELECT PCP_APONTAMENTO.CO_PCP_APONTAMENTO 
		                                   , PCP_RECURSO.NO_RECURSO
										   , PCP_APONTAMENTO.HR_INICIO
										   , CASE WHEN FL_APONTAMENTO = '1' THEN 'Parada de Maquina'
												  WHEN FL_APONTAMENTO = '2' THEN 'Produção'
											 END AS FL_APONTAMENTO
										   , CASE WHEN FL_APONTAMENTO = '1' THEN '-----'
												  WHEN FL_APONTAMENTO = '2' THEN CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA)
											 END AS NU_OP
									   FROM tb_pcp_apontamento PCP_APONTAMENTO
										   INNER JOIN tb_pcp_recurso PCP_RECURSO
											   ON PCP_APONTAMENTO.CO_RECURSO = PCP_RECURSO.CO_PCP_RECURSO
										   LEFT JOIN tb_pcp_op PCP_OP
											   ON PCP_APONTAMENTO.CO_PCP_OP = PCP_OP.CO_PCP_OP
									   WHERE PCP_APONTAMENTO.HR_FIM IS NULL
									   AND PCP_APONTAMENTO.FL_APONTAMENTO IN('1','2')
									   AND PCP_APONTAMENTO.FL_DELET IS NULL
									   LIMIT 10")
	    or die("<script>
			        alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			        history.back(-1);
			    </script>");
	
	}else{
		
		$sqlApontamento = mysql_query("SELECT PCP_APONTAMENTO.CO_PCP_APONTAMENTO 
		                                   , PCP_RECURSO.NO_RECURSO
								           , PCP_APONTAMENTO.HR_INICIO
										   , CASE WHEN FL_APONTAMENTO = '1' THEN 'Parada de Maquina'
												  WHEN FL_APONTAMENTO = '2' THEN 'Produção'
											 END AS FL_APONTAMENTO
										   , CASE WHEN FL_APONTAMENTO = '1' THEN '-----'
												  WHEN FL_APONTAMENTO = '2' THEN CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA)
											 END AS NU_OP
									   FROM tb_pcp_apontamento PCP_APONTAMENTO
										   INNER JOIN tb_pcp_recurso PCP_RECURSO
											   ON PCP_APONTAMENTO.CO_RECURSO = PCP_RECURSO.CO_PCP_RECURSO
										   LEFT JOIN tb_pcp_op PCP_OP
											   ON PCP_APONTAMENTO.CO_PCP_OP = PCP_OP.CO_PCP_OP
									   WHERE PCP_APONTAMENTO.HR_FIM IS NULL
									   AND PCP_APONTAMENTO.CO_USUARIO_INICIO = '".$_SESSION['codigoUsuario']."'
									   AND PCP_APONTAMENTO.FL_APONTAMENTO IN('1','2')
									   AND PCP_APONTAMENTO.FL_DELET IS NULL
									   LIMIT 10")
	    or die("<script>
			        alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			        history.back(-1);
			    </script>");
		
	}
		 
?>
<script type="text/javascript" src="js/pcp/apontamento.js"></script>

<div id="formularioDetalhesApontamento"></div>
<div id="header-wrap">
<table width="100%"  border="0" cellpadding="0" cellspacing="0" background="img/bg_header.jpg">
    <tr>
    <td>
	<!--INICIO HEADER-->
	<?php require("inc/header.php"); ?>
	<!--FINAL HEADER-->
	</td>
    </tr>
</table>
</div>

<!--INICIO CONTEUDO-->
<div id="ie6-container-wrap">
<div id="container">
<table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
    <tr>
        <td align="center"><table width="1003" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="583" rowspan="3" align="center" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td>&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellspacing="0" cellpadding="0" class="TABLE_FULL01">
                  <tr>
                    <td align="center" bgcolor="#F7F7F7"><img src="img/space.gif" width="8" height="8" /></td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#F7F7F7"><table width="565" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td align="center" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="2" cellpadding="3">
                          <tr>
                            <td height="40" colspan="2" align="left"><font class="FONT03"><b>Últimos 10 Apontamento Abertos:</b></font></td>
                          </tr>
                          <tr>
                            <td colspan="2"><img src="img/linha01.jpg" width="555" height="1" /></td>
                          </tr>
                          <tr>
                            <td colspan="2" align="center"><table width="560" border="0" cellpadding="3" cellspacing="2" class="LISTA">
                              <tr>
                                <th width="60" height="25" align="center"><font class="FONT05"><b>OP</b></font></td>
                                <th width="244" align="center"><font class="FONT05"><b>Recurso</b></font></td>
                                <th width="100" align="center"><font class="FONT05"><b>Hora de Início</b></font></td>
                                <th width="120" align="center"><font class="FONT05"><b>Tipo</b></font></td>
                              </tr>
                              <?php
							      if(mysql_num_rows($sqlApontamento) == 0){
								      echo "<tr>";
									  echo "<td colspan='4' align='center'><font class='FONT06'><b>N&atilde;o h&aacute; apontamentos abertos no momento!</b></font></td>";
									  echo "</tr>";
								  }else{
								      while($rowApontamento=mysql_fetch_array($sqlApontamento)){ 
									      echo "<tr>";
										  echo "<td align='center'>".$rowApontamento['NU_OP']."</td>";
										  echo "<td align='center'>".$rowApontamento['NO_RECURSO']."</td>";
										  echo "<td align='center'>".$rowApontamento['HR_INICIO']."</td>";
										  echo "<td align='center'>";
										  echo "<a title='Detalhes' href='#' name='detalhesApontamento' id='".$rowApontamento['CO_PCP_APONTAMENTO']."' style='font-family: Arial, Tahoma, Helvetica, sans-serif;font-size:11px;text-decoration: none; font-weight: bold; color: #990000;'>".$rowApontamento['FL_APONTAMENTO']."</a>";
										  echo "</td>";
									      echo "</tr>";
									  }
								  }  	 
							  ?>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                    </table></td>
                  </tr>
                  <tr>
                    <td align="center" bgcolor="#F7F7F7"><img src="img/space.gif" width="8" height="8" /></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
            <td>&nbsp;</td>
            <td width="314" rowspan="3" align="center" valign="top">
              <table width="314" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td><a title="Apontamentos" href="inicio.php?pg=apontamento"><img src="img/btn/btn_inicial_apontamentos.jpg" width="314" height="129" border="0" /></a></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
              </table>
              </td>
            <td width="60">&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table></td>
    </tr>
</table>
</div>
</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php require("inc/footer.php"); ?>
<!--FINAL FOOTER-->