<?php 

require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_ac.php';
require_once APP_PATH.'sistema/models/tb_pcp_cor.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad_peca.php';
$logRollback = array();

if(isset($_POST['co_pcp_ad'])){
	
	$co_pcp_ad  = $_POST['co_pcp_ad'];
	$no_pcp_ad  = $_POST['nomeAD'];
	$ano		= date("Y");
	$divergencias = array();
	$arrayDadosCorte = array();
	
	$_helper 	 = new helper();
	$_pecasModel = new tb_pcp_pecas($conexaoERP);
	$_acModel 	 = new tb_pcp_ac($conexaoERP);
	$_corModel 	 = new tb_pcp_cor($conexaoERP);
	$_opModel	 = new tb_pcp_op($conexaoERP);
	$_adModel    = new tb_pcp_ad($conexaoERP);
	$_adPecaModel= new tb_pcp_ad_peca($conexaoERP);

	$nomeTemporario = $_helper->getNomeTempArquivo('arquivo_ac');
	$data['divergencia']=false;

	if($nomeTemporario!=false && isset($co_pcp_ad)){

		$matrizDados = $_helper->gerarMatrizDeDadosDoArquivo($nomeTemporario);
		$novoNomeArquivo = strtolower($_helper->getNomeArquivo('arquivo_ac'));
		$extensao = substr($novoNomeArquivo,(strrpos($novoNomeArquivo, '.')),3);
		$type = $_helper->getTypeArquivo('arquivo_ac');

		$lote = $_adModel->findByLote($co_pcp_ad);
		
		
		if($type !='application/octet-stream' || $extensao != '.ac'){
			$data['msg'] = 'Tipo de arquivo inválido!';
		}else{
			$data['sucesso'] = false;
			$statusImport = $_helper->importarArquivo(APP_PATH.'arquivosAC'.DS.$ano.DS, $novoNomeArquivo, $nomeTemporario);
			if($statusImport==false){
				$data['msg'] = 'Não foi possível importar arquivo, pois este ja se encontra no servidor!';
				echo json_encode($data);
				exit;
			}
			try {
				$co_pcp_ac = $_acModel->insertReturnId($co_pcp_ad);
			
			}catch (Exception $e){
				## DELETA O ARQUIVO EM CASO DE ERRO NO BANCO
				unlink($novoNomeArquivo);
				$data['msg'] = 'Não foi possível importar arquivo, favor entre em contato com o suporte!';
				echo json_encode($data);
				exit;
			}
			
			$schema = $_helper->separaSchemas($matrizDados);
			//sort($schema);			
			$temp = 0;
			for($i=0; $i<count($schema);$i++)
			{
				//sort($schema[$i]);
				
				for($j=0; $j<count($schema[$i]); $j++)
				{
					if($j!=0){
					if($schema[$i][$j]!='VAZIO'){
						if(isset($schema[$i][$j])){
							## PERSISTENCIA DOS DADOS
							//BR/BR          15002200002033501743010021PR006 -      1,17    0,018
							//BR/BR          1800120000921500060600002E1039 - 2    11,73    0,211
							$nu_schema 		 = $i;
							$ds_cor			 = trim(substr($schema[$i][$j],0,14));
							$nu_espessura	 = substr($schema[$i][$j],14,3);
							$qtd_pecas		 = substr($schema[$i][$j],21,5);
							$nu_comprimento  = substr($schema[$i][$j],26,4);
							$nu_largura  	 = substr($schema[$i][$j],31,4);
							$corteTemp 		 = substr($schema[$i][$j],40,8);
							$pos 			 = strpos($corteTemp, ' '); 
							$co_int_produto  = trim(substr($schema[$i][$j],40,$pos));
							$arrayDadosCorteCapture = array("nu_schema"=>$nu_schema, "ds_cor"=>$ds_cor, "nu_espessura"=>$nu_espessura, "qtd_pecas"=>$qtd_pecas, "nu_comprimento"=>$nu_comprimento, "nu_largura"=>$nu_largura, "co_int_produto"=>$co_int_produto);
							array_push($arrayDadosCorte, $arrayDadosCorteCapture);
							$co_cor 		 = $_corModel->buscarCodCor($ds_cor);
							$co_cor			 = $co_cor['co_cor'];
							$lote			 = $_adModel->findByLote($co_pcp_ad);
			
							try{
								$co_pcp_op = $_opModel->getCoPcpOPPisDeUmPlanoDeCorteExistente($co_int_produto, $co_cor, $lote, $co_pcp_ad); //produtos dentro do arquivo AD
								
								$processadas=0;
								
								if($co_pcp_op!=false){
									$vet_temp = array();
											if(count($logRollback)>0){
												for($ix=0;$ix<count($logRollback);$ix++){
													array_push($vet_temp, $logRollback[$ix]['co_pcp_op']);													
													
												}
												if(array_search($co_pcp_op[0], $vet_temp) ===false){
													array_push($logRollback,array('co_pcp_op'=>$co_pcp_op[0],'qtd_processada_anterior'=>$co_pcp_op[2]));													
										}
									}else{
										array_push($logRollback,array('co_pcp_op'=>$co_pcp_op[0],'qtd_processada_anterior'=>$co_pcp_op[2]));
									}
									
								$total = $co_pcp_op[1];
									
								## CONTABILIZAR VALOR PEÇA COM LARGURA OU ESPESSURA ABAIXO NO VALOR MINIMO
									
								if($co_pcp_op[5]>=56 && $co_pcp_op[5]<100){ //largura
									$processadas += floor($qtd_pecas/4);
								}elseif($co_pcp_op[5]<56){
									$processadas += floor($qtd_pecas/8);									
								}elseif($co_pcp_op[5]>=100 && $co_pcp_op[5]<240){									
									$processadas += floor($qtd_pecas/2);
								}	

								if($co_pcp_op[4]>=56 && $co_pcp_op[4]<100){ //comprimento
									$processadas += floor($qtd_pecas/4);
								}elseif($co_pcp_op[4]<56){
									$processadas += floor($qtd_pecas/8);
								}elseif($co_pcp_op[4]>=100 && $co_pcp_op[4]<240){
									$processadas += floor($qtd_pecas/2);
								}
								if($processadas==0){
									$processadas+= floor($qtd_pecas*1);
								}	
								
								if($co_pcp_op[4]< DIMENSAO_MINIMA && $co_pcp_op[5]< DIMENSAO_MINIMA){
									unlink(APP_PATH.'arquivosAC'.DS.$ano.DS.$novoNomeArquivo);
									$_acModel->delete($co_pcp_ac);
									for($di = 0; $di<count($divergencias);$di++){
										$_adPecaModel->delete($divergencias[$di], $co_pcp_ad);
									}
									for($ix=0;$ix<count($logRollback);$ix++){
										$_opModel->atualizaProcessadoComQuantidade($logRollback[$ix]['co_pcp_op'], $logRollback[$ix]['qtd_processada_anterior']);
									}
									$data['sucesso']= false;
									$data['msg'] = "<p><span> <img src='img/atencao.png' hspace='3' /></span>Não é possivel concluir a operação, pois este arquivo contém produto com as duas dimensões abaixo da dimensão minima permitida.</p>";
									echo json_encode($data);
									exit;
								
								}

								$qtPeca = $processadas;
								$processadas = $processadas+$co_pcp_op[2];
								$dif2 		 = $co_pcp_op[1]-$co_pcp_op[2];
									
															
									## FIM CONTABILIZAR
									
									if($total >= $processadas){																					
										$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $qtPeca, $co_int_produto, $co_pcp_ac);										
										$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $processadas);
										
									}else{
										
										$diferenca = $processadas-$total;
										
										$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $dif2, $co_int_produto, $co_pcp_ac);
										$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $dif2+$co_pcp_op[2]);
										
										
										$result = $_opModel->getCoPcpOPPisDeUmPlanoDeCorte($co_int_produto, $co_cor, $lote); //produtos fora do arquivo AD ou com outra op + produtos
										$co_pcp_op = mysql_fetch_array($result);
											
											if($co_pcp_op!=false){
												
												if($diferenca<=$co_pcp_op[1]){
													array_push($divergencias, $co_pcp_op[0]);//lista os produtos divergentes
													$divergencias = array_unique($divergencias);
													$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $diferenca, $co_int_produto, $co_pcp_ac);
													$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $diferenca);
													$_adPecaModel->insert($co_pcp_ad, $co_pcp_op[0]);
												}else{
													unlink(APP_PATH.'arquivosAC'.DS.$ano.DS.$novoNomeArquivo);//producao a mais para nova op aberta processo nao permitido
													$_acModel->delete($co_pcp_ac);
													for($di = 0; $di<count($divergencias);$di++){
														$_adPecaModel->delete($divergencias[$di], $co_pcp_ad);
													}
													for($ix=0;$ix<count($logRollback);$ix++){
														$_opModel->atualizaProcessadoComQuantidade($logRollback[$ix]['co_pcp_op'], $logRollback[$ix]['qtd_processada_anterior']);
													}
													$data['sucesso']= false;
													$data['msg'] = "<p><span> <img src='img/atencao.png' hspace='3' /></span>Não é possivel concluir a operação, pois a OP: ".$co_pcp_op[2]." permite apenas a inclusão de <strong>".$co_pcp_op[1]."</strong> peça(s) e você esta tentando incluir <strong style='color:red;'>".$diferenca."</strong> peça(s)</p>";
													echo json_encode($data);
													exit;
												}
												
											}else{//erro nao possui op cadastrado para os produtos adicionados a mais 											
												unlink(APP_PATH.'arquivosAC'.DS.$ano.DS.$novoNomeArquivo);
												$_acModel->delete($co_pcp_ac);
												for($di = 0; $di<count($divergencias);$di++){
													$_adPecaModel->delete($divergencias[$di], $co_pcp_ad);
												}
												for($ix=0;$ix<count($logRollback);$ix++){
													$_opModel->atualizaProcessadoComQuantidade($logRollback[$ix]['co_pcp_op'], $logRollback[$ix]['qtd_processada_anterior']);
												}
												$data['sucesso']= false;										
												$data['msg'] = "<p><span> <img src='img/atencao.png' hspace='3' /></span>Não é possivel concluir a operação, pois não foi aberta OP para produção de <strong style='color:red;'>".$diferenca."</strong> peça(s) a mais para o produto ".$co_int_produto."</p>";
												echo json_encode($data);
												exit;
											}
										}
								}else{
									
									$result = $_opModel->getCoPcpOPPisDeUmPlanoDeCorte($co_int_produto, $co_cor, $lote); //produtos fora do arquivo AD
									
									
									$temp = 0;

									
									
									$result = mysql_fetch_array($result);
									if($result!=false){
										$result = $_opModel->getCoPcpOPPisDeUmPlanoDeCorte($co_int_produto, $co_cor, $lote); //produtos fora do arquivo AD
										while($co_pcp_op = mysql_fetch_array($result)){
											$vet_temp = array();
											if(count($logRollback)>0){
												for($ix=0;$ix<count($logRollback);$ix++){
													array_push($vet_temp, $logRollback[$ix]['co_pcp_op']);													
													
												}
												if(array_search($co_pcp_op[0], $vet_temp) ===false){
													array_push($logRollback,array('co_pcp_op'=>$co_pcp_op[0],'qtd_processada_anterior'=>$co_pcp_op[3]));													
												}
											}else{
												array_push($logRollback,array('co_pcp_op'=>$co_pcp_op[0],'qtd_processada_anterior'=>$co_pcp_op[3]));
											}
										}
										$result = $_opModel->getCoPcpOPPisDeUmPlanoDeCorte($co_int_produto, $co_cor, $lote); //produtos fora do arquivo AD
										$continue = true;
										while($co_pcp_op = mysql_fetch_array($result)){
											if($continue == true){ //somente continue se ainda tiver produtos a serem processados										
												if($temp==0){//se ja estiver feito os calculos nao precisa calcular novamente																					
													if($co_pcp_op[6]>=56 && $co_pcp_op[6]<100){ //largura
														$processadas += floor($qtd_pecas/4);
													}elseif($co_pcp_op[6]<56){
														$processadas += floor($qtd_pecas/8);									
													}elseif($co_pcp_op[6]>=100 && $co_pcp_op[6]<240){									
														$processadas += floor($qtd_pecas/2);
													}	
					
													if($co_pcp_op[5]>=56 && $co_pcp_op[5]<100){ //comprimento
														$processadas += floor($qtd_pecas/4);
													}elseif($co_pcp_op[5]<56){
														$processadas += floor($qtd_pecas/8);
													}elseif($co_pcp_op[5]>=100 && $co_pcp_op[5]<240){
														$processadas += floor($qtd_pecas/2);
													}
													if($processadas==0){
														$processadas+= $qtd_pecas*1;
													}
												}else{
													$processadas = $temp;
												}
												array_push($divergencias, $co_pcp_op[0]);	//lista os produtos divergentes
												$divergencias = array_unique($divergencias);
												if(($processadas+$co_pcp_op[3]) > $co_pcp_op[1]){
													
													$temp = $processadas - ($co_pcp_op[1]-$co_pcp_op[3]);
													$processadas = $processadas - $temp;
													$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $processadas+$co_pcp_op[3], $co_int_produto, $co_pcp_ac);
													$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $processadas+$co_pcp_op[3]);
													$_adPecaModel->insert($co_pcp_ad, $co_pcp_op[0]);
													$continue = true;
													
												}elseif (($processadas+$co_pcp_op[3]) <$co_pcp_op[1]){
													$processadas = $processadas+$co_pcp_op[3];
													$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $processadas, $co_int_produto, $co_pcp_ac);													
													$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $processadas+$co_pcp_op[3]);
													$_adPecaModel->insert($co_pcp_ad, $co_pcp_op[0]);
													$continue = false;
												}elseif(($processadas+$co_pcp_op[3]) == $co_pcp_op[1]){
													$processadas = $processadas+$co_pcp_op[3];
													$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $processadas, $co_int_produto, $co_pcp_ac);
													$_adPecaModel->insert($co_pcp_ad, $co_pcp_op[0]);
													$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $processadas+$co_pcp_op[3]);
													$continue = false;
												}
											
											}
										}
									}else{
											$co_pcp_op = $_opModel->getCoPcpOPPisDeUmPlanoDeCorteExistenteAD($co_int_produto, $co_cor, $lote); //se nao existir nenhuma nova op, procura op pendente
											
											
											
											$temp = 0;
											
											if($co_pcp_op !=false){
												
													$vet_temp = array();
														if(count($logRollback)>0){
															for($ix=0;$ix<count($logRollback);$ix++){
																array_push($vet_temp, $logRollback[$ix]['co_pcp_op']);													
																
															}
															if(array_search($co_pcp_op[0], $vet_temp) ===false){
																array_push($logRollback,array('co_pcp_op'=>$co_pcp_op[0],'qtd_processada_anterior'=>$co_pcp_op[3]));													
															}
													}else{
														array_push($logRollback,array('co_pcp_op'=>$co_pcp_op[0],'qtd_processada_anterior'=>$co_pcp_op[3]));
													}
												
												$co_pcp_op = $_opModel->getCoPcpOPPisDeUmPlanoDeCorteExistenteAD($co_int_produto, $co_cor, $lote); //se nao existir nenhuma nova op, procura op pendente
												$continue = true;
												
													if($continue == true){ //somente continue se ainda tiver produtos a serem processados
														if($temp==0){//se ja estiver feito os calculos nao precisa calcular novamente
															
															if($co_pcp_op[6]>=56 && $co_pcp_op[6]<100){ //largura
																$processadas += floor($qtd_pecas/4);
															}elseif($co_pcp_op[6]<56){
																$processadas += floor($qtd_pecas/8);
															}elseif($co_pcp_op[6]>=100 && $co_pcp_op[6]<240){
																$processadas += floor($qtd_pecas/2);
															}
															
															if($co_pcp_op[5]>=56 && $co_pcp_op[5]<100){ //comprimento
																$processadas += floor($qtd_pecas/4);
															}elseif($co_pcp_op[5]<56){
																$processadas += floor($qtd_pecas/8);
															}elseif($co_pcp_op[5]>=100 && $co_pcp_op[5]<240){
																$processadas += floor($qtd_pecas/2);
															}
															if($processadas==0){
																$processadas+= $qtd_pecas*1;
															}
														}else{
														$processadas = $temp;
														}
														array_push($divergencias, $co_pcp_op[0]);	//lista os produtos divergentes
														$divergencias = array_unique($divergencias);
													if(($processadas+$co_pcp_op[3]) > $co_pcp_op[1]){
														
														$temp = $processadas - ($co_pcp_op[1]-$co_pcp_op[3]);
														$processadas = $processadas - $temp;
														$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $processadas+$co_pcp_op[3], $co_int_produto, $co_pcp_ac);
														$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $processadas+$co_pcp_op[3]);
														$_adPecaModel->insert($co_pcp_ad, $co_pcp_op[0]);
														$continue = true;
														
													}elseif (($processadas+$co_pcp_op[3]) <$co_pcp_op[1]){
														$processadas = $processadas+$co_pcp_op[3];
														$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $processadas, $co_int_produto, $co_pcp_ac);													
														$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $processadas+$co_pcp_op[3]);
														$_adPecaModel->insert($co_pcp_ad, $co_pcp_op[0]);
														$continue = false;
													}elseif(($processadas+$co_pcp_op[3]) == $co_pcp_op[1]){
														$processadas = $processadas+$co_pcp_op[3];
														$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $processadas, $co_int_produto, $co_pcp_ac);
														$_adPecaModel->insert($co_pcp_ad, $co_pcp_op[0]);
														$_opModel->atualizaProcessadoComQuantidade($co_pcp_op[0], $processadas+$co_pcp_op[3]);
														$continue = false;
													}
												}
											
											}else{
											unlink(APP_PATH.'arquivosAC'.DS.$ano.DS.$novoNomeArquivo);
											$_acModel->delete($co_pcp_ac);
											for($di = 0; $di<count($divergencias);$di++){
												$_adPecaModel->delete($divergencias[$di], $co_pcp_ad);
											}
											for($ix=0;$ix<count($logRollback);$ix++){
												$_opModel->atualizaProcessadoComQuantidade($logRollback[$ix]['co_pcp_op'], $logRollback[$ix]['qtd_processada_anterior']);												
											}
											
											$data['sucesso']= false;
											$data['msg'] = "<p><span> <img src='img/atencao.png' hspace='3' /></span>Não é possivel concluir a operação, pois este arquivo contém produto de lote diferente do arquivo <strong> ".$no_pcp_ad.".ad </strong>original. Ou o produto ".$co_int_produto." possui uma quantidade maior que a permitida. </p>";
											echo json_encode($data);
											exit;	
										}									
									}								
									
								}
							}catch(Exception $e){
								## EM CASO DE ERRO ROLLBACK
								unlink(APP_PATH.'arquivosAC'.DS.$ano.DS.$novoNomeArquivo);
								$_acModel->delete($co_pcp_ac);
								for($di = 0; $di<count($divergencias);$di++){
									$_adPecaModel->delete($divergencias[$di], $co_pcp_ad);
								}
								for($ix=0;$ix<count($logRollback);$ix++){
									$_opModel->atualizaProcessadoComQuantidade($logRollback[$ix]['co_pcp_op'], $logRollback[$ix]['qtd_processada_anterior']);
								}
								$data['msg'] = $e;
								echo json_encode($data);
								exit;
								
							}

						}

					}
					$temp++;
				}
			}

			}
			
			$divergencias = array_unique($divergencias);
			sort($divergencias);
			$co_ops = array();//codigo das ops
			/* $result = $_pecasModel->findByPecas($co_pcp_ac);
			while ($peca = mysql_fetch_array($result)){
				$op = $_opModel->getQtdProduto($peca['co_pcp_op']);
				$ordem_producao = $_opModel->getTotalProduto($op['co_int_produto'], $op['lote'], $op['co_produto']);
				$aprocessar  = $op[1]+$peca['qtd_processada'];
				$nu_op 		 = $op[2];
				 if($aprocessar<=$ordem_producao['QTD_PRODUTO']){//se quantidade processadas for menor ou igual ao total de pecas
					if($op[0]>$op[1]){//quantidade produto é menor que a quantidade processada?
						array_push($co_ops, $peca['co_pcp_op'].'.'.$peca['qtd_processada']);
						$qtd_processada = $op[1]+$peca['qtd_processada'];
						$_opModel->atualizaProcessadoComQuantidade($peca['co_pcp_op'], $qtd_processada);
						$_adPecaModel->insert($co_pcp_ad, $peca['co_pcp_op']);
						
					}
				 }else{
				 	## EM CASO DE ERRO ROLLBACK
				 	unlink(APP_PATH.'arquivosAC'.DS.$ano.DS.$novoNomeArquivo);
				 	$_acModel->delete($co_pcp_ac);
				 	$data['msg'] = "<p><span> <img src='img/atencao.png' hspace='3' /></span>Não é possivel concluir a operação, pois a OP permite apenas a inclusão de <strong>".$op[0]."</strong> peça(s) e você esta tentando incluir <strong style='color:red;'>".$aprocessar."</strong> peça(s)</p>";
				 	echo json_encode($data);
				 	exit;
				 	
				 }
				
			} */
			
			## DIVERGENCIA
			
			if(count($divergencias)>0){
				$data['divergencia']=true;
				$data['dadosDivergencia'] = $divergencias;
			}else{
				$data['divergencia']=false;
			}
			
			
			## CASO TENHA QUE SE CALCULAR A QTD DOS PRODUTOS GERADOS NO .AC FAÇA ISSO AQUI...
			$data['sucesso'] = true;
		}
	}else{
		$data['msg'] = 'Nenhum arquivo selecionado!';
	}

	echo json_encode($data);
}
//var_dump($schema);
?>