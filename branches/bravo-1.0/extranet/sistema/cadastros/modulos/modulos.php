<?php
/**
 * Lista e cadastro de modulos e submodulos
 * @author Ricardo S. Alvarenga
 * @since 11/11/2012
 *
 */ 

require_once 'models/tb_modulos.php';
require_once 'helper.class.php';

$_modModel 	= new tb_modulos($conexaoERP);
$_helper	= new helper();

$moduloPai  = $_modModel->getPai(0);
?>
<script type="text/javascript" src="js/cadastros/modulos.js"></script>
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
              <tr>
	              <td><button type="button" id="adicionarModulo" onclick="javascript:addModulo();"  title="Adicionar Módulo">Adicionar Módulo</button><img onclick="" /></td>
              </tr>
              <tr>
              <table class="LISTA tablesorte" width="1003" border="0" align="center" cellpadding="1" cellspacing="1">
				<thead>
				<tr>
					<th width="8%">Código</th><th>Módulos</th><th width="15%" align="center">Ações</th>
				</tr>
				</thead>
				<?php 
				$i = 1;
				$teste = 'labla';
				while($dados = mysql_fetch_array($moduloPai)){
					$html.= $_modModel->getHtml();
					$_modModel->setHtml('');
					$html.=	"<tr class='modulo_pai'>";
					$html.=	"<td>".$dados['CO_MODULO']."</td>";
					$html.=	"<td><div id='".$dados['CO_MODULO']."'><strong>".$i.' '.$dados['NO_MODULO']."</strong></div></td>";
					$html.= '<td align="center"><a href="javascript:addSub('.$dados[CO_MODULO].');"><img title="Adicionar Sub-módulo" src="img/btn/btn_mais.gif" /></a> <a href="javascript:editar('.$dados[CO_MODULO].');"><img title="Editar" src="img/btn/btn_editar.gif" /></a> <a href="javascript:excluir('.$dados[CO_MODULO].');"><img title="Excluír" src="img/btn/btn_excluir.gif" /></a></td>';
					$html.=	"</tr>";
					$i++;
					
					$_modModel->recursivaSubcaterorias(TRUE, $dados['CO_MODULO'],$i-1);
					$html.= $_modModel->getHtml();
					$_modModel->setHtml('');
					$_modModel->setJ($i);
					
				}
				
				echo $html; 
				
				
				?>
				</table>
              
              </tr>
	        </table>
        </td>
    </tr>
</table>

<!-- BOX ADICIONAR MODULO -->
<div id="boxAdicionarModulo">
<fieldset>
<legend><font class="FONT04">Adiconar novo módulo</font></legend>
	<table>
		<tr>
			<td><font class="FONT04"><b>Nome:</b></font></td>
			<td><input class="INPUT01" type="text" id="no_modulo" size="45" /></td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Status:</b></font></td>
			<td><input type="radio" id="fl_status" name="fl_status[]" value="1" checked="checked" />Sim <input type="radio" id="fl_status" name="fl_status[]" value="0" />Não</td>
		</tr>
	</table>
	</fieldset>
</div>

<!-- BOX ADICIONAR SUB-MODULO -->
<div id="boxAdicionarSub">
	<table>
		<tr>
			<td><font class="FONT04"><b>Módulo Pai:</b></font></td>
			<td><span style="color: red;" id="box_add_sub_mod_pai"></span></td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Nome:</b></font></td>
			<td><input class="INPUT01" type="text" id="no_modulo_add_sub" size="45" /></td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Status:</b></font></td>
			<td><input type="radio" id="fl_status_add_sub" name="fl_status_add_sub[]" value="1" checked="checked" />Sim <input type="radio" id="fl_status_add_sub" name="fl_status_add_sub[]" value="0" />Não</td>
		</tr>
	</table>
</div>

<!-- BOX EXCLUÍR MODULO -->
<div id="boxExcluir">
    <p><span> <img src="img/atencao.png" hspace="3" /></span>Caso este módulo possua filhos, eles também serão removidos permanentemente do sistema. Tem certeza que deseja realizar esta operação?</p>
</div>


</div>

<!-- BOX MENSAGEM -->
<div id="boxMensagem"></div>


<!-- BOX ALTERAR MODULO -->
<div id="boxAlterar">adasdfas</div>


</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php 
require("inc/footer.php"); ?>
<!--FINAL FOOTER-->