<?php
/**
 * Lista e cadastro de modulos e submodulos
 * @author Ricardo S. Alvarenga
 * @since 11/11/2012
 *
 */ 

require_once 'models/tb_modulos.php';
require_once 'helper.class.php';


$co_papel = $_SESSION['codigoPapel'];
$_modModel = new tb_modulos($conexaoERP);
$acoes = $_modModel->possuiPermissaoParaEstaArea($co_papel, CONFIGURACOES, CONFIGURACOES_MODULOS);

if($acoes['NO_MODULO'] == CONFIGURACOES_MODULOS){



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
	              <td>
	               <?php if($acoes['FL_ADICIONAR']==1){?>
	              	<button type="button" id="adicionarModulo" onclick="javascript:addModulo();"  title="Adicionar Módulo">Adicionar Módulo</button><img onclick="" />
	              	<?php }?>
	              </td>
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
				while($dados = mysql_fetch_array($moduloPai)){
					$html.= $_modModel->getHtml();
					$_modModel->setHtml('');
					$dados['FL_ATIVO']==0? $class="class='INATIVO'":$class="class='modulo_pai'";
					$html.=	"<tr ".$class.">";
					$html.=	"<td>".$dados['CO_MODULO']."</td>";
					$html.=	"<td><div title='".$dados['DS_MODULO']."' id='".$dados['CO_MODULO']."'><strong>".$i.' '.$dados['NO_MODULO']."</strong></div></td>";
					$html.= '<td align="center">';
					
					if($acoes['FL_ADICIONAR']==1){
						$html.='<a href="javascript:addSub('.$dados["CO_MODULO"].');"><img title="Adicionar Sub-módulo" src="img/btn/btn_mais.gif" /></a>';
					}if($acoes['FL_EDITAR']==1){ 
						$html.='<a href="javascript:editar('.$dados["CO_MODULO"].');"><img title="Editar" src="img/btn/btn_editar.gif" /></a>';
					}if($acoes['FL_EXCLUIR']==1){
						$html.='<a href="javascript:excluir('.$dados["CO_MODULO"].');"><img title="Excluír" src="img/btn/btn_excluir.gif" /></a>';
					}
					$html.=	"</td></tr>";
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
<div id="boxAdicionarModulo" style="display: none;">
	<table>
		<tr>
			<td><font class="FONT04"><b>Nome:</b></font></td>
			<td><input class="INPUT01" type="text" id="no_modulo" size="45" /></td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Descrição:</b></font></td>
			<td><textarea id="ds_modulo" cols="46" rows="5" class="TEXTAREA01"></textarea></td>
		</tr>		
		<tr>
			<td><font class="FONT04"><b>Ativo:</b></font></td>
			<td><input type="radio" id="fl_ativo" name="fl_ativo" value="1" checked="checked" />Sim <input type="radio" id="fl_ativo" name="fl_ativo" value="0" />Não</td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Módulo possui ações?</b></font></td>
			<td><input type="radio" id="fl_acoes" name="fl_acoes" value="1" />Sim <input  checked="checked" type="radio" id="fl_acoes" name="fl_acoes" value="0" />Não</td>
		</tr>
	</table>
</div>

<!-- BOX ADICIONAR SUB-MODULO -->
<div id="boxAdicionarSub" style="display: none;">
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
			<td><font class="FONT04"><b>Descrição:</b></font></td>
			<td><textarea id="ds_modulo_add_sub" cols="46" rows="5" class="TEXTAREA01"></textarea></td>
		</tr>			
		<tr>
			<td><font class="FONT04"><b>Ativo:</b></font></td>
			<td><input type="radio" id="fl_ativo_add_sub" name="fl_ativo_add_sub" value="1" checked="checked" />Sim <input type="radio" id="fl_ativo_add_sub" name="fl_ativo_add_sub" value="0" />Não</td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Módulo possui ações?</b></font></td>
			<td><input type="radio" id="fl_acoes_add_sub" name="fl_acoes_add_sub" value="1" />Sim <input  checked="checked" type="radio" id="fl_acoes_add_sub" name="fl_acoes_add_sub" value="0" />Não</td>
		</tr>		
	</table>
</div>

<!-- BOX EXCLUÍR MODULO -->
<div id="boxExcluir" style="display: none;">
    <p><span> <img src="img/atencao.png" hspace="3" /></span>Caso este módulo possua filhos, eles também serão removidos permanentemente do sistema. Tem certeza que deseja realizar esta operação?</p>
</div>


</div>

<!-- BOX MENSAGEM -->
<div id="boxMensagem"></div>


<!-- BOX ALTERAR MODULO -->
<div id="boxAlterar"></div>


</div>
<!--FINAL CONTEUDO-->

<!--INICIO FOOTER-->
<?php 
require("inc/footer.php"); 
}else{
	header('location:inicio.php');

}
?>
<!--FINAL FOOTER-->