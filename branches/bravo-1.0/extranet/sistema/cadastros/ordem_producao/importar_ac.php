<?php 

require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_ac.php';
require_once APP_PATH.'sistema/models/tb_pcp_cor.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad.php';

if(isset($_POST['co_pcp_ad'])){
	
	$co_pcp_ad  = $_POST['co_pcp_ad'];
	$no_pcp_ad  = $_POST['nomeAD'];
	$ano		= date("Y");
	$divergencias = array();
	
	$_helper 	 = new helper();
	$_pecasModel = new tb_pcp_pecas($conexaoERP);
	$_acModel 	 = new tb_pcp_ac($conexaoERP);
	$_corModel 	 = new tb_pcp_cor($conexaoERP);
	$_opModel	 = new tb_pcp_op($conexaoERP);
	$_adModel    = new tb_pcp_ad($conexaoERP);

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
			$temp = 0;
			for($i=0; $i<=count($schema)+1;$i++)
			{
				for($j=0; $j<count($schema[$i]); $j++)
				{
					if($schema[$i][$temp+1]!='VAZIO'){
						if(isset($schema[$i][$temp+1])){
							## PERSISTENCIA DOS DADOS
							//BR/BR          15002200002033501743010021PR006 -      1,17    0,018							
							$nu_schema 		 = $i;
							$ds_cor			 = trim(substr($schema[$i][$temp+1],0,15));
							$nu_espessura	 = substr($schema[$i][$temp+1],15,3);
							$qtd_pecas		 = substr($schema[$i][$temp+1],21,5);
							$nu_comprimento  = substr($schema[$i][$temp+1],26,4);
							$nu_largura  	 = substr($schema[$i][$temp+1],31,4);
							$corteTemp 		 = substr($schema[$i][$temp+1],40,8);
							$pos 			 = strpos($corteTemp, ' '); 
							$co_int_produto  = trim(substr($schema[$i][$temp+1],40,$pos));
							$co_cor 		 = $_corModel->buscarCodCor($ds_cor);
							$co_cor			 = $co_cor['co_cor'];
							$lote			 = $_adModel->findByLote($co_pcp_ad);
			
							try{
								$co_pcp_op = $_opModel->getCoPcpOPPisDeUmPlanoDeCorteExistente($co_int_produto, $co_cor, $lote, $co_pcp_ad); //produtos dentro do arquivo AD
								
								if($co_pcp_op!=false){	
																					
									$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $qtd_pecas, $co_int_produto, $co_pcp_ac);
								}else{
									$co_pcp_op = $_opModel->getCoPcpOPPisDeUmPlanoDeCorte($co_int_produto, $co_cor, $lote); //produtos fora do arquivo AD
									if($co_pcp_op!=false){
										array_push($divergencias, $co_pcp_op[0]);//lista os produtos divergentes
										$divergencias = array_unique($divergencias);
										$_pecasModel->insert($co_pcp_op[0],$co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $qtd_pecas, $co_int_produto, $co_pcp_ac);
										
									}else{
											unlink($novoNomeArquivo);
											$_acModel->delete($co_pcp_ac);
											$data['sucesso']= false;
											$data['msg'] = 'Não é possivel concluir a operação, pois este arquivo contém produto de lote diferente do arquivo '.$no_pcp_ad.'.ad original, ou sua ordem de produção ainda não foi gerada. Importação será cancelada.';
											echo json_encode($data);
											exit;										
									}								
									
								}
								
							}catch(Exception $e){
								## EM CASO DE ERRO ROLLBACK
								unlink(APP_PATH.'arquivosAC'.DS.$novoNomeArquivo);
								$_acModel->delete($co_pcp_ac);
								$data['msg'] = $e;
								echo json_encode($data);
								exit;
								
							}

						}

					}
					$temp++;
				}

			}
			
			$result = $_pecasModel->findByPecas($co_pcp_ac);
			while ($dados = mysql_fetch_array($result)){
				$row = $_opModel->getQtdProduto($dados['co_pcp_op']);
				$qtd_produto    = $dados['qtd_produto'];
				$qtd_processada = 
				$_opModel->atualizaProcessadoComQuantidade($co_pcp_op, $co_pcp_ad, $qtd_processada);
				
			}
			
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