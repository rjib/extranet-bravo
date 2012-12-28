<?php
require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_ac.php';
require_once APP_PATH.'sistema/models/tb_pcp_cor.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad_peca.php';

$data = false;
if(isset($_POST['co_pcp_ad'])){
	
	$co_pcp_ad  = $_POST['co_pcp_ad'];
	$no_pcp_ad  = $_POST['no_pcp_ad'];
	$ano		= date("Y");
	
	$_helper 	 = new helper();
	$_pecasModel = new tb_pcp_pecas($conexaoERP);
	$_pecaAd	 = new tb_pcp_ad_peca($conexaoERP);
	$_acModel 	 = new tb_pcp_ac($conexaoERP);
	$_corModel 	 = new tb_pcp_cor($conexaoERP);
	$_opModel	 = new tb_pcp_op($conexaoERP);
	
	$co_pcp_ac = $_acModel->insertReturnId($co_pcp_ad);
	
	$ops    = $_pecaAd->getCodigoOP($co_pcp_ad);
	while ($rows = mysql_fetch_array($ops)){ //lista de ordens de producao
		
		$result1   = $_opModel->getCoProduto($rows['CO_PCP_OP']);
		$result2   = $_opModel->getParametrosCasadei($rows['CO_PCP_OP'], $result1['CO_PRODUTO']);		
		$_pecasModel->insert($rows['CO_PCP_OP'],$result2['CO_COR'], 1, $result2['NU_COMPRIMENTO'], $result2['NU_LARGURA'], $result2['NU_ESPESSURA'], $result1['QTD_PROCESSADA'], $result2['CO_INT_PRODUTO'], $co_pcp_ac);
		$_opModel->atualizaProcessadoComQuantidade($rows['CO_PCP_OP'], $result1['QTD_PROCESSADA']);
		
	}
	
	$data = true;	
	
}
echo json_encode($data);
?>