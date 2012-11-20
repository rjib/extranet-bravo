<?php
require_once 'models/tb_modulos.php';


$co_papel = $_SESSION['codigoPapel'];
$modulos = new tb_modulos($conexaoERP);
$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, CADASTROS, CADASTROS_NACIONALIDADE);

if($acoes['NO_MODULO'] == CADASTROS_NACIONALIDADE){

	/**
	 * Script respons�vel por listar todas as nacionalidades cadastradas.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */
	 
?>
<script type="text/javascript" src="js/cadastros/nacionalidade.js"></script>
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
	              <td><img src="img/title/title_nacionalidade.jpg" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioNacionalidade">
                            <form id="formularioNacionalidade" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="76" align="left"><font class="FONT04"><b>Nome:</b></font></td>
		                          <td width="909" colspan="4" align="left"><input title="Nome" name="nomeNacionalidade" id="nomeNacionalidade" type="text" class="INPUT01" size="80" maxlength="80" /></td>
	                          </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
		                          <td colspan="4" align="left"><textarea title="Descri&ccedil;&atilde;o" name="descricaoNacionalidade" id="descricaoNacionalidade" cols="77" rows="10" class="TEXTAREA01"></textarea></td>
	                          </tr>
	                          </table>
		                    </form>
                  </div>
                  <?php if($acoes['FL_ADICIONAR']==1){?>
                  <button type="button" id="adicionarNacionalidade" title="Adicionar Nacionalidade">Adicionar Nacionalidade</button>
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