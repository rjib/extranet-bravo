<?php

require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';
require_once APP_PATH.'sistema/models/tb_pcp_etiqueta.php';

$co_pcp_ad = $_POST['co_pcp_ad'];
$no_pcp_ad = $_POST['no_pcp_ad'];
//$TOKEN   = md5(SHA1(date('Ymd')));

$_peca 	   = new tb_pcp_pecas($conexaoERP);
$_op       = new tb_pcp_op($conexaoERP);
$_etiqueta = new tb_pcp_etiqueta($conexaoERP);

$result    	   = $_peca->findPecasByAD($co_pcp_ad);
$dados 		   = mysql_fetch_array($result);
$row    	   = $_peca->findPecasByAD($co_pcp_ad);
$gerouEtiqueta = $_etiqueta->findByAc($dados['CO_PCP_AC']);
$co_pcp_ac 	   = $dados['CO_PCP_AC'];
$data=false;

if($gerouEtiqueta == 0){//se nao tiver gerado etiqueta
	
	while($PECA = mysql_fetch_array($row)){		
		$ORDEM_PRODUCAO     = $_op->getProduto($PECA['CO_PCP_OP']);	
		$qtd_peca_por_pilha = floor(MAX_PILHA/$ORDEM_PRODUCAO['NU_ESPESSURA']);
		$qtd_etiqueta = 1;
		
		if($PECA['QTD_PECAS'] <= $qtd_peca_por_pilha){
			try {
				$_etiqueta->insert(
						$ORDEM_PRODUCAO['NUM_OP']
						, $PECA['QTD_PECAS']
						, $ORDEM_PRODUCAO['QTD_PRODUTO']
						, $ORDEM_PRODUCAO['DT_EMISSAO']
						, $ORDEM_PRODUCAO['DS_PRODUTO']
						, $PECA['CO_INT_PRODUTO']
						, $ORDEM_PRODUCAO['NU_LOTE']
						, $ORDEM_PRODUCAO['NU_COMPRIMENTO']
						, $ORDEM_PRODUCAO['NU_LARGURA']
						, $ORDEM_PRODUCAO['NU_ESPESSURA']
						, $PECA['CO_PCP_AC']
						, $ORDEM_PRODUCAO['TP_PRODUTO']
						, $ORDEM_PRODUCAO['NO_COR']);
				
			}catch (Exception $e){
				$_etiqueta->delete($co_pcp_ac);
				$data=false;
				echo json_encode($data);
				exit;
			}
			
		}else{		
			$qtd_etiqueta       = floor($PECA['QTD_PECAS']/$qtd_peca_por_pilha);			
			$resto              = $PECA['QTD_PECAS'] - ($qtd_peca_por_pilha * $qtd_etiqueta);
			if($resto == 0){
				$qtd_etiqueta=$qtd_etiqueta;
			}else{
				$qtd_etiqueta++;
			}
			
			for($i=1;$i<=$qtd_etiqueta; $i++){			
				try {
					if($i == $qtd_etiqueta){
						if($resto!=0){
							$_etiqueta->insert(
									$ORDEM_PRODUCAO['NUM_OP']
									, $resto
									, $ORDEM_PRODUCAO['QTD_PRODUTO']
									, $ORDEM_PRODUCAO['DT_EMISSAO']
									, $ORDEM_PRODUCAO['DS_PRODUTO']
									, $PECA['CO_INT_PRODUTO']
									, $ORDEM_PRODUCAO['NU_LOTE']
									, $ORDEM_PRODUCAO['NU_COMPRIMENTO']
									, $ORDEM_PRODUCAO['NU_LARGURA']
									, $ORDEM_PRODUCAO['NU_ESPESSURA']
									, $PECA['CO_PCP_AC']
									, $ORDEM_PRODUCAO['TP_PRODUTO']
									, $ORDEM_PRODUCAO['NO_COR']);
						}else{
							$_etiqueta->insert(
									$ORDEM_PRODUCAO['NUM_OP']
									, $qtd_peca_por_pilha
									, $ORDEM_PRODUCAO['QTD_PRODUTO']
									, $ORDEM_PRODUCAO['DT_EMISSAO']
									, $ORDEM_PRODUCAO['DS_PRODUTO']
									, $PECA['CO_INT_PRODUTO']
									, $ORDEM_PRODUCAO['NU_LOTE']
									, $ORDEM_PRODUCAO['NU_COMPRIMENTO']
									, $ORDEM_PRODUCAO['NU_LARGURA']
									, $ORDEM_PRODUCAO['NU_ESPESSURA']
									, $PECA['CO_PCP_AC']
									, $ORDEM_PRODUCAO['TP_PRODUTO']
									, $ORDEM_PRODUCAO['NO_COR']);
						}
					}else{
						$_etiqueta->insert(
								$ORDEM_PRODUCAO['NUM_OP']
								, $qtd_peca_por_pilha
								, $ORDEM_PRODUCAO['QTD_PRODUTO']
								, $ORDEM_PRODUCAO['DT_EMISSAO']
								, $ORDEM_PRODUCAO['DS_PRODUTO']
								, $PECA['CO_INT_PRODUTO']
								, $ORDEM_PRODUCAO['NU_LOTE']
								, $ORDEM_PRODUCAO['NU_COMPRIMENTO']
								, $ORDEM_PRODUCAO['NU_LARGURA']
								, $ORDEM_PRODUCAO['NU_ESPESSURA']
								, $PECA['CO_PCP_AC']
								, $ORDEM_PRODUCAO['TP_PRODUTO']
								, $ORDEM_PRODUCAO['NO_COR']);
					}
					
				}catch (Exception $e){
					$_etiqueta->delete($co_pcp_ac);
					$data=false;
					echo json_encode($data);
					exit;
				}
			}
		
		}
	}
	$data=true;
}else{	
	$data=true;
}

echo json_encode($data);





