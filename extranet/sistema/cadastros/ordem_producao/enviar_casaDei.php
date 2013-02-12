<?php
require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_ac.php';
require_once APP_PATH.'sistema/models/tb_pcp_cor.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad_peca.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad.php';

$data = false;
if(isset($_POST['co_pcp_ad'])){
	
	$co_pcp_ad  = $_POST['co_pcp_ad'];
	$no_pcp_ad  = $_POST['no_pcp_ad'];
	$co_pcp_op  = $_POST['co_pcp_op'];
	$ano		= date("Y");
	
	$_helper 	 = new helper();
	$_pecasModel = new tb_pcp_pecas($conexaoERP);
	$_pecaAd	 = new tb_pcp_ad_peca($conexaoERP);
	$_acModel 	 = new tb_pcp_ac($conexaoERP);
	$_corModel 	 = new tb_pcp_cor($conexaoERP);
	$_opModel	 = new tb_pcp_op($conexaoERP);
	$_adPeca     = new tb_pcp_ad($conexaoERP);
	$co_pcp_ac = $_acModel->insertReturnId($co_pcp_ad);
	
	$ops = array();
	for($i=0; $i<count($co_pcp_op); $i++){
		$a = explode("-", $co_pcp_op[$i]);
		array_push($ops, $a);
	}

	
	for($i=0; $i<count($ops); $i++){ //lista de ordens de producao
		//$ops[indice][op][valor]
		$result1   = $_opModel->getCoProduto($ops[$i][0]);
	
		$quantidade_final = $result1['QTD_PROCESSADA'] +$ops[$i][1];
	
		if($quantidade_final >$result1['QTD_PRODUTO']){ //interrompe execução caso alguma quantidade ultrapasse o limite
			echo json_encode($data);
			exit;
		}
	}
	
	for($i=0; $i<count($ops); $i++){ //lista de ordens de producao
		//$ops[indice][op][valor]		
		$result1   = $_opModel->getCoProduto($ops[$i][0]);
		
		$quantidade_final = $result1['QTD_PROCESSADA'] +$ops[$i][1];
		
		$result2   = $_opModel->getParametrosCasadei($ops[$i][0], $result1['CO_PRODUTO']);		
		$_pecasModel->insert($ops[$i][0],$result2['CO_COR'], 1, $result2['NU_COMPRIMENTO'], $result2['NU_LARGURA'], $result2['NU_ESPESSURA'], $quantidade_final, $result2['CO_INT_PRODUTO'], $co_pcp_ac);
		$_opModel->atualizaProcessadoComQuantidade($ops[$i][0],$quantidade_final);
		
	}
	
	$_adPeca->setCasaDei($co_pcp_ad);
	
	$data = true;	
	
}
echo json_encode($data);
?>