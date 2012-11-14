<?php
/**
 * Lista de modulos e submodulos que existam ações
 * @author Ricardo S. Alvarenga
 * @since 13/11/2012
 *
 */

require_once '../setup.php';
require_once '../models/tb_modulos.php';
require_once '../helper.class.php';
require_once '../models/tb_papel.php';

$_modModel 	= new tb_modulos($conexaoERP);
$_papelModel= new tb_papel($conexaoERP);
$_helper	= new helper();

if(!empty($_POST['co_papel'])){
	$co_papel = $_POST['co_papel'];
	
	$modulos  = $_modModel->listaModulosAtivosComAcoes();
	$papeis   = $_papelModel->getPapel($co_papel);
	?>
	<!-- BOX EDITAR/ATRIBUIR REGRAS -->
	<div id="boxFormEditarRules">
	<h3><img src="../img/login_user_image.jpg" /> Papel {<?php echo $papeis['NO_PAPEL']?>}</h3>
		<table class="LISTA tablesorte" width="700" border="0" align="center" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th width="3%"><input type="checkbox" id="btSelecionarTodosModulos" onclick="marcarTodosModuloSelecao();"/></th>
					<th width="30%">Módulos</th>
					<th width="3%" align="center"><input type="checkbox" onclick="marcarTodosIncluir();" />Incluir</th>
					<th width="3%" align="center"><input type="checkbox" onclick="marcarTodosEditar();" />Editar</th>
					<th width="3%" align="center"><input type="checkbox" onclick="marcarTodosExcluir();" />Excluír</th>
				</tr>
			</thead>
			<?php 
			$i = 1;
			while($dados = mysql_fetch_array($modulos)){
				$campTmp = $_modModel->getCaminho($dados['CO_MODULO']);
				$tamanho = strlen(trim($dados['NO_MODULO']))+1;
				$caminho = substr($campTmp,0,(strlen($campTmp)-$tamanho));
				$html.=	"<tr>";
				$html.=	"<td align='center'><input type='checkbox' name='modulo_selecao[]' id='modulo_selecao' value='".$dados['CO_MODULO']."' /></td>";
				$html.=	"<td><div title='".$dados['DS_MODULO']."' id='".$dados['CO_MODULO']."'>".$caminho."<strong>".$dados['NO_MODULO']."</strong></div></td>";
				//$html.= "<td align='center'><a href='javascript:addSub('".$dados[CO_MODULO]."');'><img title='Adicionar Sub-módulo' src='img/btn/btn_mais.gif' /></a> <a href='javascript:editar('".$dados[CO_MODULO]."');'><img title='Editar' src='img/btn/btn_editar.gif' /></a> <a href='javascript:excluir('".$dados[CO_MODULO]."');'><img title='Excluír' src='img/btn/btn_excluir.gif' /></a></td>";
				$html.= "<td><input type='checkbox' name='modulo_incluir[]' id='modulo_incluir' /></td>";
				$html.= "<td><input type='checkbox' name='modulo_editar[]' id='modulo_editar' /></td>";
				$html.= "<td><input type='checkbox' name='modulo_excluir[]' id='modulo_excluir' /></td>";
				$html.=	"</tr>";
				$_modModel->setCaminho('');
	
			}
	
			echo $html;
			?>
		</table>
	</div>
<?php 
}else{
	echo 'Nenhum papel selecionado!';
}?>