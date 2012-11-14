<?php
require_once '../../setup.php';
require_once '../../models/tb_modulos.php';
require_once '../../helper.class.php';

if(!empty($_POST['co_modulo_alt'])|| !empty($_POST['no_modulo_alt']) || !empty($_POST['fl_ativo_alt']) || !empty($_POST['fl_acoes_alt'])){

	if(trim($_POST['no_modulo_alt'])!=""){

		$modModulo = new tb_modulos($conexaoERP);
		$data 	   = array();
		$co_modulo = (int)trim(addslashes($_POST['co_modulo_alt']));
		$no_modulo = trim(addslashes($_POST['no_modulo_alt']));
		$fl_ativo  = (int)trim($_POST['fl_ativo_alt']);
		$fl_acoes  = (int)trim($_POST['fl_acoes_alt']);
		$ds_modulo = trim($_POST['ds_modulo_alt']);

		try {
			$modModulo->editar($co_modulo, $no_modulo, $fl_acoes, $fl_ativo,$ds_modulo);
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
echo json_encode($data['erro']);