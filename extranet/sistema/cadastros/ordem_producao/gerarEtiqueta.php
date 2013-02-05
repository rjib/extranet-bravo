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
		$comprimento_menor 					  = false;
		$ORDEM_PRODUCAO     				  = $_op->getProduto($PECA['CO_PCP_OP']);	
		$qtd_peca_por_pilha 				  = floor(MAX_PILHA/$ORDEM_PRODUCAO['NU_ESPESSURA']);
		$tmp_empilhamento_maximo_diferenciado = $qtd_peca_por_pilha;
		$qtd_etiqueta 						  = 1;
		if($ORDEM_PRODUCAO['NU_COMPRIMENTO']<=300){
			$tmp_empilhamento_maximo_diferenciado = $qtd_peca_por_pilha*4;
			$comprimento_menor = true;
			
		}elseif($ORDEM_PRODUCAO['NU_COMPRIMENTO']>300 && $ORDEM_PRODUCAO['NU_COMPRIMENTO']<=600){
			$tmp_empilhamento_maximo_diferenciado = $qtd_peca_por_pilha*2;
			$comprimento_menor = true;
			
		}
		
		if($ORDEM_PRODUCAO['NU_LARGURA']<=300 && $comprimento_menor ==false){
			$tmp_empilhamento_maximo_diferenciado = $qtd_peca_por_pilha*4;
			$comprimento_menor = false;
				
		}elseif($ORDEM_PRODUCAO['NU_LARGURA']>300 && $ORDEM_PRODUCAO['NU_LARGURA']<=600 && $comprimento_menor ==false){
			$tmp_empilhamento_maximo_diferenciado = $qtd_peca_por_pilha*2;
			$comprimento_menor = false;
				
		}
		
		
		if($PECA['QTD_PECAS'] <= $tmp_empilhamento_maximo_diferenciado){ // se a quantidade total de peças for inferior ao empilhamento maximo insere apenas uma etiqueta
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
			$qtd_etiqueta       = floor($PECA['QTD_PECAS']/$tmp_empilhamento_maximo_diferenciado);			
			$resto              = $PECA['QTD_PECAS'] - ($tmp_empilhamento_maximo_diferenciado * $qtd_etiqueta);
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
									, $tmp_empilhamento_maximo_diferenciado
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
								, $tmp_empilhamento_maximo_diferenciado
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





