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
require_once '../models/tb_papel_modulo.php';

$_modModel 		= new tb_modulos($conexaoERP);
$_papelModel	= new tb_papel($conexaoERP);
$_pmoduloModel  = new tb_papel_modulo($conexaoERP);

$_helper	= new helper();

if(!empty($_POST['co_papel'])){
	$co_papel = $_POST['co_papel'];
	
	$modulos  = $_modModel->listaModulosAtivosComAcoes();
	$papeis   = $_papelModel->getPapel($co_papel);
	?>
	<!-- BOX EDITAR/ATRIBUIR REGRAS -->
	<div id="boxFormEditarModulos">
	<h3><img src="../img/login_user_image.jpg" /> Papel {<?php echo $papeis['NO_PAPEL']?>}</h3>
		<table class="LISTA tablesorte" width="700" border="0" align="center" cellpadding="1" cellspacing="1">
			<thead>
				<tr>
					<th width="3%"><input type="checkbox" id="btSelecionarTodosModulos" onclick="marcarTodosModuloSelecao();"/><input type="hidden" id="co_papel" value="<?php echo $co_papel;?>" /></th>
					<th width="30%">Módulos</th>
				</tr>
			</thead>
			<?php 
			$i = 1;
			
			while($dados = mysql_fetch_array($modulos)){

				$campTmp = $_modModel->getCaminho($dados['CO_MODULO']);
				$tamanho = strlen(trim($dados['NO_MODULO']))+1;
				$caminho = substr($campTmp,0,(strlen($campTmp)-$tamanho));
				
				$result = $_pmoduloModel->verificaExistencia($dados['CO_MODULO'], $co_papel);
				
				$result>0? $checked = "checked='checked'":$checked = "";
				
				$html.=	"<tr>";
				$html.=	"<td align='center'><input type='checkbox' ".$checked." name='modulo_selecao[]' id='modulo_selecao' value='".$dados['CO_MODULO']."' /></td>";
				$html.=	"<td><div title='".$dados['DS_MODULO']."' id='".$dados['CO_MODULO']."'>".$caminho."<strong>".$dados['NO_MODULO']."</strong></div></td>";
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