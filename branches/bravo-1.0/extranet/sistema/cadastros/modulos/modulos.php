<?php
/**
 * Lista e cadastro de modulos e submodulos
 * @author Ricardo S. Alvarenga
 * @since 11/11/2012
 *
 */ 

require_once 'models/tb_modulos.php';
require_once 'helper.class.php';

$_modModel = new tb_modulos($conexaoERP);
$_helper = new helper();

$moduloPai = $_modModel->getPai(0);

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
	              <td><img src="img/title/title_modulos.png" width="1003" height="40" /></td>
              </tr>
	        </table>
        </td>
    </tr>
</table>
</div>

<table width="1003" border="0" align="center" cellpadding="0" cellspacing="0">
<tr>
	<td width="8%">Código</td><td>Módulo</td>
</tr>
<?php 
$i = 1;
while($dados = mysql_fetch_array($moduloPai)){
	$html.= $_modModel->getHtml();
	$_modModel->setHtml('');
	$html.=	"<tr>";
	$html.=	"<td>".$dados['CO_MODULO']."</td>";
	$html.=	"<td><strong>".$i.' '.$dados['NO_MODULO']."</strong></td>";
	$html.=	"</tr>";
	$i++;
	
	$_modModel->recursivaSubcaterorias(TRUE, $dados['CO_MODULO'],$i-1);
	$html.= $_modModel->getHtml();
	$_modModel->setHtml('');
	
}

echo $html; 


?>
</table>
</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php require("inc/footer.php"); ?>
<!--FINAL FOOTER-->