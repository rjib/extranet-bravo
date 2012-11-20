<?php

	/**
	 * Script respons�vel por listar todos os Papel cadastrados.
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 01/08/2012 08:00
	 * 
	 */
	 
require_once 'models/tb_modulos.php';


$co_papel = $_SESSION['codigoPapel'];
$_modModel = new tb_modulos($conexaoERP);
$acoes = $_modModel->possuiPermissaoParaEstaArea($co_papel, CONFIGURACOES, CONFIGURACOES_PAPEIS);

if($acoes['NO_MODULO'] == CONFIGURACOES_PAPEIS){
?>
<script type="text/javascript" src="js/cadastros/papel.js"></script>
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
	              <td><img src="img/title/title_papel.jpg" width="1003" height="40" /></td>
              </tr>
              <tr>
	              <td>&nbsp;</td>
              </tr>
              <tr>
	              <td>
                  <div id="formularioPapel" style="display: none;">
                            <form id="formularioPapel" action="javascript:func()" method="post">
		                    <table width="100%" border="0" cellspacing="2" cellpadding="3">
		                        <tr>
		                          <td width="76" align="left"><font class="FONT04"><b>Nome:</b></font></td>
		                          <td width="909" colspan="4" align="left"><input title="Nome" name="nomePapel" id="nomePapel" type="text" class="INPUT01" size="80" maxlength="80" /></td>
	                          </tr>
		                        <tr>
		                          <td align="left" valign="top"><font class="FONT04"><b>Descri&ccedil;&atilde;o:</b></font></td>
		                          <td colspan="4" align="left"><textarea title="Descri&ccedil;&atilde;o" name="descricaoPapel" id="descricaoPapel" cols="77" rows="10" class="TEXTAREA01"></textarea></td>
	                          </tr>
	                          </table>
		                    </form>
                  </div>
                  <?php if($acoes['FL_ADICIONAR']==1){?>
                  <button type="button" id="adicionarPapel" title="Adicionar Papel">Adicionar Papel</button>
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

<!-- BOX EDITAR MODULOS -->
<div id="boxEditarModulos"></div>

<!-- BOX ATRIBUIR REGRAS -->
<div id="boxEditarRegras"></div>

<!-- BOX MENSAGEM -->
<div id="boxMensagem"></div>

<div id="boxLoading" style="display: none;"> <p align="center">
        <span><img src="img/loader.gif"/></span><br>
       Os dados estão sendo enviados, por favor aguarde...
    </p>
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