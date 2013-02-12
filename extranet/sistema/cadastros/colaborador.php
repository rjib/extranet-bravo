<?php
require_once 'models/tb_modulos.php';


$co_papel = $_SESSION['codigoPapel'];
$modulos = new tb_modulos($conexaoERP);
$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, CADASTROS, CADASTROS_COLABORADORES);

if($acoes['NO_MODULO'] == CADASTROS_COLABORADORES){

	/**
	 * Script respons�vel por listar todos os Calaboradores cadastrados.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */

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
<script type="text/javascript" src="js/paging.js"></script>
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
	              <td><img src="img/title/title_colaborador.jpg" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioColaborador">
                            <form id="formularioColaborador" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="229" align="left"><font class="FONT04"><b>Pessoa:</b></font></td>
		                          <td width="756" align="left">
                                  <input type="text" id="nomePessoa" name="nomePessoa" autocomplete="off" class="INPUT01" size="60" maxlength="80"/>
                                  <input type="hidden" id="codigoPessoa" name="codigoPessoa"/>
                                  </td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>CPF:</b></font></td>
		                          <td align="left"><input type="text" name="cpfPessoa" id="cpfPessoa" class="INPUT01" size="12" disabled /></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Cargo:</b></font></td>
		                          <td align="left"><select title="Cargo" name="cargo" id="cargo" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowCargo=mysql_fetch_array($sqlCargo)){ 	
                                            echo "<option value='".$rowCargo['CO_CARGO']."'>".$rowCargo['NO_CARGO']."</option>";
                                        }	
                                    ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Setor:</b></font></td>
		                          <td align="left"><select title="Setor" name="setor" id="setor" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowSetor=mysql_fetch_array($sqlSetor)){ 	
                                            echo "<option value='".$rowSetor['CO_SETOR']."'>".$rowSetor['NO_SETOR']."</option>";
                                        }	
                                    ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Tipo Sanguineo:</b></font></td>
		                          <td align="left"><select title="Tipo Sanguineo" name="tipoSanguineo" id="tipoSanguineo" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowTipoSanguineo=mysql_fetch_array($sqlTipoSanguineo)){ 	
                                            echo "<option value='".$rowTipoSanguineo['CO_TIPO_SANGUINEO']."'>".$rowTipoSanguineo['NO_TIPO_SANGUINEO']."</option>";
                                        }	
                                    ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Observa&ccedil;&atilde;o:</b></font></td>
		                          <td align="left"><textarea title="Descri&ccedil;&atilde;o" name="descricaoColaborador" id="descricaoColaborador" cols="60" rows="10" class="TEXTAREA01"></textarea></td>
	                          </tr>
	                          </table>
		                    </form>
                  </div>
                   <?php if($acoes['FL_ADICIONAR']==1){?>
                  <button type="button" id="adicionarColaborador" title="Adicionar Colaborador">Adicionar Colaborador</button>
                  <?php }?>
                  </td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
	            <tr>
	              <td> 
                  <table width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA" >
	                <tr>
	                  <th align="left"><b>Pesquisar:&nbsp;&nbsp;</b><input type="text" class="INPUT02" id="searching" value="Pesquisar..." size="60" maxlength="80" /></td>
                    </tr>
                  </table>
                  </td>
              </tr>
	            <tr> 
		            <td valign="top">
                    <div id="grid" class="grid"></div>
                    <div class="controls"></div>
                    <div id="console"></div>     
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
<?php require("inc/footer.php");
}else{
	header('location:inicio.php');

}
?>
<!--FINAL FOOTER-->