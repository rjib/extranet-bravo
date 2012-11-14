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
require_once '../models/tb_acoes.php';
require_once '../models/tb_papel_modulo.php';

$_modModel 		= new tb_modulos($conexaoERP);
$_papelModel	= new tb_papel($conexaoERP);
$_pmoduloModel  = new tb_papel_modulo($conexaoERP);
$_acoesModel	= new tb_acoes($conexaoERP);

$_helper	= new helper();

if(!empty($_POST['co_papel'])){
	$co_papel = $_POST['co_papel'];
	
	$modulos  = $_modModel->listaModulosPorPapel($co_papel);
	$papeis   = $_papelModel->getPapel($co_papel);
	?>
	<!-- BOX EDITAR/ATRIBUIR REGRAS -->
	<div id="boxFormEditarRegras">
	<h3><img src="../img/login_user_image.jpg" /> Papel {<?php echo $papeis['NO_PAPEL']?>}</h3>
	<input type="hidden" id="co_papel_regra" value="<?php echo $papeis['CO_PAPEL']; ?>" />
		<table class="LISTA tablesorte" width="700" border="0" align="center" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th align="left" width="8%">Código</th>
					<th align="left" width="30%">Módulos</th>
					<th width="7%">Editar</th>
					<th width="7%">Exculír</th>
					<th width="7%">Incluir</th>
				</tr>
			</thead>
			<?php 
			$i = 1;
			$checked="";
			while($dados = mysql_fetch_array($modulos)){

				$campTmp = $_modModel->getCaminho($dados['CO_MODULO']);
				$tamanho = strlen(trim($dados['NO_MODULO']))+1;
				$caminho = substr($campTmp,0,(strlen($campTmp)-$tamanho));
				
				$resultEditar = $_acoesModel->editarAtivo($dados['CO_ACAO']);				
				$resultEditar==true? $checkedEditar = "checked='checked'":$checkedEditar = "";
				
				$resultExcluir = $_acoesModel->excluirAtivo($dados['CO_ACAO']);
				$resultExcluir==true? $checkedExcluir = "checked='checked'":$checkedExcluir = "";
				
				$resultIncluir = $_acoesModel->incluirAtivo($dados['CO_ACAO']);
				$resultIncluir==true? $checkedIncluir = "checked='checked'":$checkedIncluir = "";
				
				$html.=	"<tr>";		
				$html.=	"<td>".$dados['CO_MODULO']."</td>";
				$html.=	"<td><div title='".$dados['DS_MODULO']."' id='".$dados['CO_MODULO']."'>".$caminho."<strong>".$dados['NO_MODULO']."</strong></div></td>";
				$html.=	"<td align='center'><input type='checkbox' ".$checkedEditar." name='acao_editar[]' id='acao_editar' value='".$dados['CO_ACAO']."' /></td>";
				$html.=	"<td align='center'><input type='checkbox' ".$checkedExcluir." name='acao_excluir[]' id='acao_excluir' value='".$dados['CO_ACAO']."' /></td>";
				$html.=	"<td align='center'><input type='checkbox' ".$checkedIncluir." name='acao_incluir[]' id='acao_incluir' value='".$dados['CO_ACAO']."' /></td>";
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