<?php
require_once '../../setup.php';
require_once '../../models/tb_modulos.php';
require_once '../../helper.class.php';

if(!empty($_POST['co_pai'])){
	
	if(trim($_POST['co_pai'])!=""){

		$modModulo = new tb_modulos($conexaoERP);
		$data 	   = array();
		$co_modulo = (int)trim(addslashes($_POST['co_pai']));

		try {
			$row = $modModulo->getModulo($co_modulo);
			$data['erro'] = 0; //sucesso na operacao
		}catch (Exception $e){
			$data['erro'] = 2; // erro na persistencia

		}
	}else{
		$data['erro'] = 1; //campo em branco

	}

}else{

	$data['erro'] = 1; //campo em branco
}
//echo json_encode($data['erro']);
?>

<!-- BOX EDITAR MODULO -->
<div id="boxEditarModulo">
	<table>
		<tr>
			<td><font class="FONT04"><b>Nome:</b></font></td>
			<td><input class="INPUT01" type="text" id="no_modulo_alt" size="45" value="<?php echo $row['no_modulo']; ?>" /> <input id="co_modulo_alt" type="hidden" value="<?php echo $row['co_modulo'];?>"/></td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Descrição:</b></font></td>
			<td><textarea id="ds_modulo_alt" cols="46" rows="5" class="TEXTAREA01"><?php echo $row['ds_modulo']; ?></textarea></td>
		</tr>		
		<tr>
			<td><font class="FONT04"><b>Ativo:</b></font></td>
			<td><input type="radio" id="fl_ativo_alt" name="fl_ativo_alt" value="1" <?php if($row['fl_ativo']=='1'){echo 'checked=checked';} ?> />Sim <input <?php if($row['fl_ativo']=='0'){echo 'checked=checked';} ?> type="radio" id="fl_ativo_alt" name="fl_ativo_alt" value="0" />Não</td>
		</tr>
		<tr>
			<td><font class="FONT04"><b>Módulo possui ações?</b></font></td>
			<td><input type="radio" id="fl_acoes_alt" name="fl_acoes_alt" value="1" <?php if($row['fl_acoes']=='1'){echo 'checked=checked';} ?> />Sim <input  <?php if($row['fl_acoes']=='0'){echo 'checked=checked';} ?> type="radio" id="fl_acoes_alt" name="fl_acoes_alt" value="0" />Não</td>
		</tr>			
	</table>
</div>