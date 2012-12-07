
<?php
session_start();

	/**
	 * Formulario insercao de pessoa.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */

    $sqlEstadoCivil = mysql_query("SELECT CO_ESTADO_CIVIL, NO_ESTADO_CIVIL FROM tb_estado_civil ORDER BY NO_ESTADO_CIVIL",$conexaoERP)
	or die("<script>
			    alert('[Erro 1] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlEstadoCivil) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro 2] - N&atilde;o existe Estado Civil cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
	
	$sqlNacionalidade = mysql_query("SELECT CO_NACIONALIDADE, NO_NACIONALIDADE FROM tb_nacionalidade ORDER BY NO_NACIONALIDADE",$conexaoERP)
	or die("<script>
			    alert('[Erro 3] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlNacionalidade) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro 4] - N&atilde;o existe Nacionalidade cadastrada, por favor entre em contato com o Suporte.</p>').dialog({
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
	
	$sqlNivelFormacao = mysql_query("SELECT CO_NIVEL_FORMACAO, NO_NIVEL_FORMACAO FROM tb_nivel_formacao ORDER BY NO_NIVEL_FORMACAO",$conexaoERP)
	or die("<script>
			    alert('[Erro 5] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlNivelFormacao) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro 6] - N&atilde;o existe Nivel Formacao cadastrado, por favor entre em contato com o Suporte.</p>').dialog({
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
	
	$sqlEstado = mysql_query("SELECT CO_UF, DS_UF FROM tb_uf ORDER BY DS_UF")
	or die ("<script>
			     alert('[Erro 7] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			     history.back(-1);
			 </script>"); 		               
	$rowEstado = mysql_num_rows($sqlEstado);
	
	$sqlProfissao = mysql_query("SELECT CO_PROFISSAO, NO_PROFISSAO FROM tb_profissao ORDER BY NO_PROFISSAO",$conexaoERP)
	or die("<script>
			    alert('[Erro 8] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	if(mysql_num_rows($sqlProfissao) == 0){
	    echo "<script type='text/javascript' language='javascript'>
		      $(function($) {
			      $('<p>[Erro 9] - N&atilde;o existe Profiss�o cadastrada, por favor entre em contato com o Suporte.</p>').dialog({
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
		
	$sqlTipoTelefone = mysql_query("SELECT CO_TIPO_TELEFONE, NO_TIPO_TELEFONE FROM tb_tipo_telefone ORDER BY NO_TIPO_TELEFONE",$conexaoERP)
	or die("<script>
			    alert('[Erro 15] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
	$sqlTipoEmail = mysql_query("SELECT CO_TIPO_EMAIL, NO_TIPO_EMAIL FROM tb_tipo_email ORDER BY NO_TIPO_EMAIL",$conexaoERP)
	or die("<script>
			    alert('[Erro 16] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
			    history.back(-1);
			</script>");
	
?>
<script type="text/javascript" src="js/cadastros/pessoa.js"></script>
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
        <td>
	        <table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr>
	              <td><img src="img/title/title_pessoa.jpg" width="1003" height="40" /></td>
              </tr>
	            <tr>
	              <td valign="top">&nbsp;</td>
              </tr>
	            <tr> 
		            <td valign="top">
                    <table width="1003" border="0" cellspacing="0" cellpadding="0" class="TABLE_FULL01">
		              <tr>
		                <td align="center" bgcolor="#F7F7F7"><img src="img/space.gif" width="8" height="8" /></td>
	                  </tr>
		              <tr>
		                <td align="center" bgcolor="#F7F7F7"><table width="986" border="0" cellspacing="0" cellpadding="0">
		                  <tr>
		                    <td align="center" bgcolor="#FFFFFF">
                            <form name="formularioPessoa" id="formularioPessoa" method="post" action="javascript:func()">
		                      <table width="970" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td height="40" colspan="4" align="left" valign="bottom"><font class="FONT03"><b>Pessoa:</b></font></td>
	                            </tr>
		                        <tr>
		                          <td colspan="4" align="left"><hr style="color:#A1A3A0; background-color:#A1A3A0; height: 1px; border: 0px "/></td>
	                            </tr>
		                        <tr>
		                          <td colspan="4" align="left" style="border: 2px solid rgb(255, 204, 0); padding: 7px;">
		                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
		                              <tr>
		                                <td width="11%"><b>Tipo de Pessoa:</b></td>
		                                <td width="7%"><input type="radio" name="pessoaTipoFisica" id="pessoaTipoFisica" value="F" checked="checked" />F&iacute;sica</td>
		                                <td width="82%"><input type="radio" name="pessoaTipoJuridica" id="pessoaTipoJuridica" value="J" />Juridica</td>
	                                  </tr>
                                  </table></td>
	                            </tr>
		                        <tr>
		                          <td width="87" align="left">&nbsp;<font class="FONT04"><b>Nome:</b></font></td>
		                          <td colspan="3" align="left"><input title="Nome" name="nome" id="nome" type="text" class="INPUT01" size="80" maxlength="80" /></td>
	                            </tr>
		                        <tr>
		                          <td align="left">&nbsp;<font class="FONT04"><b>E-mail:</b></font></td>
		                          <td width="249" align="left"><input title="E-mail" name="email" id="email" type="text" class="INPUT01" size="40" maxlength="80" /></td>
		                          <td width="34" align="left"><font class="FONT04"><b>Site:</b></font></td>
		                          <td width="576" align="left"><input title="Site" name="site" id="site" type="text" class="INPUT01" size="60" maxlength="80" /></td>
	                            </tr>
		                        <tr>
		                          <td colspan="4" align="left">
                                  <div id="palco">
                                  
                                  <div id="J" style="display:none">
                                  <table width="970" border="0" cellspacing="2" cellpadding="3">
                                  <tr>
                                    <td width="77"><b>CNPJ:</b></td>
                                    <td width="154" align="left"><input title="CNPJ" name="cnpj" id="cnpj" type="text" class="INPUT03" size="15" maxlength="18" /></td>
                                    <td width="115" align="left"><b>Inscri&ccedil;&atilde;o Estadual:</b></td>
                                    <td width="590" align="left"><input title="Inscri&ccedil;&atilde;o Estadual" name="ie" type="text" class="INPUT01" size="30" maxlength="30" /></td>
                                  </tr>
                                  </table>
                                  </div>
                                  
                                  <div id="F">
                                  <table width="970" border="0" cellspacing="2" cellpadding="3">
                                  <tr>
                                    <td width="80"><b>CPF:</b></td>
                                    <td width="120" align="left"><input title="CPF" name="cpf" id="cpf" type="text" class="INPUT01" size="20" maxlength="14" onblur="verificaCPF()"/></td>
                                    <td width="118" align="left"><b>RG:</b></td>
                                    <td width="119" align="left"><input title="RG" name="rg" id="rg" type="text" class="INPUT01" size="10" maxlength="12" onblur="verificaRG()"/></td>
                                    <td width="100" align="left"><b>Org&atilde;o Expedidor:</b></td>
                                    <td width="146" align="left"><input title="Org&atilde;o Expedidor" name="orgaoExpedidor" id="orgaoExpedidor" type="text" class="INPUT01" size="8" maxlength="10" /></td>
                                    <td width="97" align="left"><b>Data Emiss&atilde;o:</b></td>
                                    <td width="104" align="left"><input title="Data Emiss&atilde;o" name="dataEmissao" id="dataEmissao" type="text" class="INPUT03" size="10" maxlength="10" /></td>
                                  </tr>
                                  <tr>
                                    <td><b>Sexo:</b></td>
                                    <td align="left">
                                    <select title="Sexo" name="sexo" id="sexo" class="SELECT01">
                                        <option value="0">Selecione...</option>
                                        <option value="M">Masculino</option>
                                        <option value="F">Feminino</option>
                                    </select>
                                    </td>
                                    <td align="left"><b>Data Nascimento:</b></td>
                                    <td align="left"><input title="Data Nascimento" name="dataNascimento" id="dataNascimento" type="text" class="INPUT03" size="8" maxlength="180" /></td>
                                    <td align="left"><b>Estado Civil:</b></td>
                                    <td colspan="3" align="left">
                                      <select title="Estado Civil" name="estadoCivil" id="estadoCivil" class="SELECT01" style="width:180px">
                                        <option value="0">Selecione...</option>
                                        <?php
                                            while($rowEstadoCivil=mysql_fetch_array($sqlEstadoCivil)){ 	
                                                echo "<option value='".$rowEstadoCivil['CO_ESTADO_CIVIL']."'>".$rowEstadoCivil['NO_ESTADO_CIVIL']."</option>";
                                            }	
                                        ?>
                                        </select>
                                    </td>
                                    </tr>
                                  <tr>
                                    <td><b>Nacionalidade:</b></td>
                                    <td align="left"><select title="Nacionalidade" name="nacionalidade" id="nacionalidade" class="SELECT01">
                                      <option value="0">Selecione...</option>
                                      <?php
                                            while($rowNacionalidade=mysql_fetch_array($sqlNacionalidade)){ 	
                                                echo "<option value='".$rowNacionalidade['CO_NACIONALIDADE']."'>".$rowNacionalidade['NO_NACIONALIDADE']."</option>";
                                            }	
                                        ?>
                                      </select></td>
                                    <td align="left"><b>N&iacute;vel Forma&ccedil;&atilde;o:</b></td>
                                    <td colspan="5" align="left"><select title="N&iacute;vel Forma&ccedil;&atilde;o" name="nivelFormacao" id="nivelFormacao" class="SELECT01">
                                      <option value="0">Selecione...</option>
                                      <?php
                                            while($rowNivelFormacao=mysql_fetch_array($sqlNivelFormacao)){ 	
                                                echo "<option value='".$rowNivelFormacao['CO_NIVEL_FORMACAO']."'>".$rowNivelFormacao['NO_NIVEL_FORMACAO']."</option>";
                                            }	
                                        ?>
                                    </select></td>
                                    </tr>
                                  <tr>
                                    <td><b>Naturalidade:</b></td>
                                    <td colspan="5" align="left">
                                      <select name="codigoEstado" id="codigoEstado" class="SELECT01" onchange="BuscaCidade(this.value);" >
                                        <option value="0">--Selecione o estado &gt;&gt;</option>
                                        <?php for($i=0; $i<$rowEstado; $i++) { ?>
                                        <option value="<?php echo mysql_result($sqlEstado, $i, "CO_UF"); ?>"> <?php echo mysql_result($sqlEstado, $i, "DS_UF"); ?></option>
                                        <?php } ?>
                                        </select>
                                      &nbsp;&nbsp;
                                      <select name="codigoCidade" id="codigoCidade" class="SELECT01" style="width:220px">
                                        <option id="opcoes" value="0">--Primeiro selecione o estado--</option>
                                        </select></td>
                                    <td align="left">&nbsp;</td>
                                    <td align="left">&nbsp;</td>
                                  </tr>
                                  <tr>
                                    <td><b>Profiss&atilde;o:</b></td>
                                    <td colspan="7" align="left">
                                      <select title="Profiss&atilde;o" name="profissao" id="profissao" class="SELECT01" style="width:385px">
                                        <option value="0">Selecione...</option>
                                        <?php
                                            while($rowProfissao=mysql_fetch_array($sqlProfissao)){ 	
                                                echo "<option value='".$rowProfissao['CO_PROFISSAO']."'>".$rowProfissao['NO_PROFISSAO']."</option>";
                                            }	
                                        ?>
                                        </select>
                                      </td>
                                  </tr>
                                 
                                  <tr>
                                    <td colspan="8"><hr style="color:#A1A3A0; background-color:#A1A3A0; height: 1px; border: 0px "/></td>
                                  </tr>
                                  <tr>
                                    <td>&nbsp;<font class="FONT04"><b>Nome Pai:</b></font></td>
                                    <td colspan="7" align="left"><input title="Nome Pai" name="nomePai" id="nomePai" type="text" class="INPUT01" size="80" maxlength="80" /></td>
                                    </tr>
                                  <tr>
                                    <td>&nbsp;<font class="FONT04"><b>Nome M&atilde;e:</b></font></td>
                                    <td colspan="7" align="left"><input title="Nome M&atilde;e" name="nomeMae" id="nomeMae" type="text" class="INPUT01" size="80" maxlength="80" /></td>
                                    </tr>
                                  </table>
                                  </div>
                                  
                                  </div>
                                  </td>
	                              </tr>		                        
                                <tr>
		                          <td colspan="4" align="left">
                                      <div id="botaoSalvar">
                                      <button type="button" id="adicionarPessoa" title="Salvar">Salvar</button>
                                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                      <button type="button" id="voltarPagina" title="Cancelar">Cancelar</button>
                                      </div>
                                  </td>
	                            </tr>
	                          </table>
		                      </form>
                              </td>
	                      </tr>
		                  </table></td>
	                  </tr>
		              <tr>
		                <td align="center" bgcolor="#F7F7F7"><img src="img/space.gif" width="8" height="8" /></td>
	                  </tr>
	                </table></td>
	            </tr>
                <tr>
                <td>&nbsp;</td>
                </tr>
                <tr>
                <td>
                
                <ul class="tabs">
                <li><a title="Endere&ccedil;os" href="#tab1">Endere&ccedil;os</a></li>
                <li><a title="Contatos" href="#tab2">Contatos</a></li>
                <li><a title="Telefones" href="#tab4">Telefones</a></li>
                <li><a title="E-mails" href="#tab5">E-mails</a></li>
                 <li><a title="Empresa" href="#tab6">Empresa</a></li>
    			</ul>
                
                <div class="tab_container">
                    
                    <div id="tab1" class="tab_content">
                    	<div id="formularioEndereco">
                            <form id="formularioEndereco" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td colspan="6" align="left">
                                  <div id="status"></div>
                                  </td>
	                            </tr>
		                        <tr>
		                          <td width="97" align="left"><font class="FONT04"><b>CEP:</b></font></td>
		                          <td colspan="5" align="left">
                                      <input title="CEP" name="numeroCep" id="numeroCep" size="10" maxlength="8" class="INPUT03" autocomplete="off"/>
                                      <input type="hidden" name="codigoCep" id="codigoCep" />
                                  </td>
	                            </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Logradouro:</b></font></td>
		                          <td colspan="5">
                                      <input title="Logradouro" name="logradouro" id="logradouro" class="INPUT01" size="50" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>N&uacute;mero:</b></font></td>
		                          <td colspan="5">
                                      <input title="N&uacute;mero" name="numeroLogradouro" id="numeroLogradouro" type="text" class="INPUT03" size="10" maxlength="180" />
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Complemento:</b></font></td>
		                          <td colspan="5">
                                      <input title="Complemento" name="complementoLogradouro" id="complementoLogradouro" type="text" class="INPUT01" size="50" maxlength="180" />
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Bairro:</b></font></td>
		                          <td colspan="5">
                                      <input title="Bairro" name="bairroLogradouro" id="bairroLogradouro" class="INPUT01" size="30" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Estado:</b></font></td>
		                          <td colspan="5">
                                      <input title="Estado" name="estadoLogradouro" id="estadoLogradouro" size="2" maxlength="2" class="INPUT01" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Cidade:</b></font></td>
		                          <td colspan="5">
                                      <input title="Cidade" name="cidadeLogradouro" id="cidadeLogradouro" class="INPUT01" disabled="disabled"/>
                                  </td>
  								</tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Principal:</b></font></td>
		                          <td width="131"><input title="Principal" type="checkbox" name="principalLogradouro" id="principalLogradouro" value="S" /></td>
		                          <td width="71"><font class="FONT04"><b>Cobran&ccedil;a:</b></font></td>
		                          <td width="81"><input title="Cobran&ccedil;a" type="checkbox" name="cobrancaLogradouro" id="cobrancaLogradouro" value="S" /></td>
		                          <td width="118"><font class="FONT04"><b>Correspond&ecirc;ncia:</b></font></td>
		                          <td width="492"><input title="Correspond�ncia" type="checkbox" name="correspondenciaLogradouro" id="correspondenciaLogradouro" value="S" /></td>
  </tr>
	                          </table>
		                    </form>
                        </div>
                        <div id="botaoAdicionarEndereco" style="display:none">
                        <button title="Adicionar novo Endere&ccedil;o" id="adicionarEndereco">Adicionar novo Endere&ccedil;o</button>
                        <br /><br />
                        </div>
                        <div id="gridEndereco"></div>                            
            		</div>
        			
                    <div id="tab2" class="tab_content">
                        <div id="formularioContato">
                            <form id="formularioContato" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="5%" align="left"><font class="FONT04"><b>Nome:</b></font></td>
		                          <td width="95%" colspan="7" align="left">
                                      <input title="Nome" name="nomeContato" id="nomeContato" type="text" class="INPUT02" size="40" maxlength="80" />
                                  </td>
  								</tr>
	                          </table>
		                    </form>
                        </div>
            			<div id="botaoAdicionarContato" style="display:none"><button title="Adicionar novo Contato" id="adicionarContato">Adicionar novo Contato</button></div>
                        <br />
                        <div id="gridContato"></div>     
					</div>                    
                    <div id="tab4" class="tab_content">
                        <div id="formularioTelefone">
                            <form id="formularioTelefone" action="javascript:func()" method="post">
		                    <table width="450" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="83" align="left"><font class="FONT04"><b>Contato:</b></font></td>
		                          <td colspan="3" align="left">
                                  <input type="text" id="nomeContatoTelefone" name="nomeContatoTelefone" autocomplete="off" class="INPUT01" size="50" maxlength="80"/>
                                  <input type="hidden" id="codigoContatoTelefone" name="codigoContatoTelefone"/>
                                  </td>
	                            </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo Telefone:</b></font></td>
		                          <td width="123" align="left"><select title="Tipo Telefone" name="tipoTelefoneContato" id="tipoTelefoneContato" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                          while($rowTipoTelefone=mysql_fetch_array($sqlTipoTelefone)){ 	
                                              echo "<option value='".$rowTipoTelefone['CO_TIPO_TELEFONE']."'>".$rowTipoTelefone['NO_TIPO_TELEFONE']."</option>";
                                          }	
                                      ?>
	                              </select></td>
		                          
                              </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Telefone:</b></font></td>
		                          <td colspan="3" align="left"><input title="Telefone" name="telefoneContato" id="telefoneContato" type="text" class="INPUT03" size="15" maxlength="14" /></td>
	                          </tr>
	                          </table>
		                    </form>
                        </div>
            			<div id="botaoAdicionarTelefone" style="display:none"><button title="Adicionar novo Telefone" id="adicionarTelefone">Adicionar novo Telefone</button></div>
                        <br />
                        <div id="gridTelefone"></div>     
					</div>
                    
                    <div id="tab5" class="tab_content">
                        <div id="formularioEmail">
                            <form id="formularioEmail" action="javascript:func()" method="post">
		                    <table width="420" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="85" align="left"><font class="FONT04"><b>Contato:</b></font></td>
		                          <td align="left">
                                  <input type="text" id="nomeContatoEmail" name="nomeContatoEmail" autocomplete="off" class="INPUT01" size="50" maxlength="80"/>
                                  <input type="hidden" id="codigoContatoEmail" name="codigoContatoEmail"/>
                                  </td>
	                            </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo E-mail:</b></font></td>
		                          <td align="left"><select title="Tipo E-mail" name="tipoEmailContato" id="tipoEmailContato" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                          while($rowTipoEmail=mysql_fetch_array($sqlTipoEmail)){ 	
                                              echo "<option value='".$rowTipoEmail['CO_TIPO_EMAIL']."'>".$rowTipoEmail['NO_TIPO_EMAIL']."</option>";
                                          }	
                                      ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>E-mail:</b></font></td>
		                          <td align="left"><input title="E-mail" name="emailContato" id="emailContato" type="text" class="INPUT01" size="57" maxlength="40" /></td>
	                          </tr>
	                          </table>
		                    </form>
                        </div>
            			<div id="botaoAdicionarEmail" style="display:none"><button title="Adicionar novo E-mail" id="adicionarEmail">Adicionar novo E-mail</button></div>
                        <br />
                        <div id="gridEmail"></div>     
					</div>
					
					<!--  TAB EMPRESA -->
                      <div id="tab6" class="tab_content">
                    	 <div id="formularioEmpresa">
                           <form id="formularioEmpresa" action="javascript:func()" method="post">
		                    <table width="420" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="10" align="left"><font class="FONT04"><b>Empresa:</b></font>
		                          <td align="left"><input type="text" id="nomeEmpresa" name="nomeEmpresa" autocomplete="off" class="INPUT01" size="50" maxlength="80"/>
                                  <input type="hidden" id="codigoEmpresa" name="codigoEmpresa"/>                                 
                                  </td>
	                            </tr>
	                          </table>
		                    </form>
                        </div>
                    	
                    	<div id="botaoAdicionarEmpresa" style="display: none;"><button title="Adicionar Empresa" id="adicionarEmpresa">Adicionar Empresa</button></div>
                    	<div id="gridEmpresa"></div>
                    </div>
    			</div>
                
                </td>
                </tr>
	        </table>
        </td>
    </tr>
</table>
</div>
</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php require("inc/footer.php"); ?>
<!--FINAL FOOTER-->