<?php
require_once 'models/tb_modulos.php';


$co_papel = $_SESSION['codigoPapel'];
$modulos = new tb_modulos($conexaoERP);
$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, CADASTROS, CADASTROS_USUARIOS);

if($acoes['NO_MODULO'] == CADASTROS_USUARIOS){
	/**
	 * Script respons�vel por listar todos os Usuarios cadastrados.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */

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
	              <td><img src="img/title/title_usuario.jpg" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioUsuario">
                            <form id="formularioUsuario" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="76" align="left"><font class="FONT04"><b>Colaborador:</b></font></td>
		                          <td width="909" colspan="4" align="left">
                                  <input title="Colaborador" name="nomeColaborador" id="nomeColaborador" type="text" class="INPUT01" size="80" maxlength="80" autocomplete="off"/>
                                  <input type="hidden" id="codigoColaborador" name="codigoColaborador"/>
                                  </td>
	                          </tr>
                              <tr>
		                          <td align="left"><font class="FONT04"><b>CPF:</b></font></td>
		                          <td colspan="4" align="left"><input type="text" name="cpfColaborador" id="cpfColaborador" class="INPUT01" size="12" disabled /></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Papel:</b></font></td>
		                          <td colspan="4" align="left">
                                  <select title="Papel" name="papelUsuario" id="papelUsuario" class="SELECT01">
		                            <option value="0">Selecione...</option>
		                            <?php
                                        while($rowPapel=mysql_fetch_array($sqlPapel)){ 	
                                            echo "<option value='".$rowPapel['CO_PAPEL']."'>".$rowPapel['NO_PAPEL']."</option>";
                                        }	
                                    ?>
	                              </select></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Login:</b></font></td>
		                          <td colspan="4" align="left"><input title="Login" name="loginUsuario" id="loginUsuario" type="text" class="INPUT01" size="20" maxlength="20" /></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Senha:</b></font></td>
		                          <td colspan="4" align="left"><input title="Senha" name="senhaUsuario" id="senhaUsuario" type="password" class="INPUT01" size="20" maxlength="20" /></td>
	                          </tr>
		                        <tr>
		                          <td align="left"><font class="FONT04"><b>Status:</b></font></td>
		                          <td colspan="4" align="left">
                                  <select title="Status" name="statusUsuario" id="statusUsuario" class="SELECT01">
		                              <option value="">Selecione...</option>
                                      <option value="1">Ativo</option>
                                      <option value="0">Inativo</option>
	                              </select>
                                  </td>
	                          </tr>
	                          </table>
		                    </form>
                  </div>
                   <?php if($acoes['FL_ADICIONAR']==1){?>
                  <button type="button" id="adicionarUsuario" title="Adicionar Usuario">Adicionar Usuario</button>
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