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
			$modModulo->excluir($co_modulo);
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

