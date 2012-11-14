<?php

require_once '../../setup.php';
require_once '../../models/tb_modulos.php';
require_once '../../helper.class.php';

if(!empty($_POST['no_modulo'])){
	
	if(trim($_POST['no_modulo'])!=""){

		$modModulo = new tb_modulos($conexaoERP);
		$data 	 = array();

		$no_modulo	 = trim($_POST['no_modulo']);
		$co_pai		 = $_POST['co_pai'];
		$fl_acoes	 = $_POST['fl_acoes'];
		$fl_ativo 	 = $_POST['fl_ativo'];
		$ds_modulo	 = $_POST['ds_modulo'];

		try {
			$modModulo->inserirModulo($co_pai, $no_modulo,$fl_ativo, $fl_acoes, $ds_modulo);
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

