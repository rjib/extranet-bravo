<?php
    
	/**
	 * Script respons�vel por listar todos os recursos cadastrados
	 * 
	 * @author Euripedes B. Silva Junior <euripedes.junior@yahoo.com.br>
	 * @version 1.0 - 05/01/2013 17:00
	 * 
	 */
	 
	require_once 'models/tb_modulos.php';
	
	$co_papel = $_SESSION['codigoPapel'];
	$modulos = new tb_modulos($conexaoERP);
	$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, PCP, PCP_RECURSO);
	
	if($acoes['NO_MODULO'] == PCP_RECURSO){
	 
?>
<script type="text/javascript" src="js/pcp/recurso.js"></script>
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
	              <td><img src="img/title/pcp/title_recursos.jpg" width="1003" height="40" /></td>
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