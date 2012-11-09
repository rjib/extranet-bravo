<?php 

require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_ac.php';
require_once APP_PATH.'sistema/models/tb_pcp_cor.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';

if(isset($_POST['nomeAD'])){
	
	$co_pcp_ad  = $_POST['nomeAD'];
	
	$_helper 	 = new helper();
	$_pecasModel = new tb_pcp_pecas($conexaoERP);
	$_acModel 	 = new tb_pcp_ac($conexaoERP);
	$_corModel 	 = new tb_pcp_cor($conexaoERP);
	$_opModel	 = new tb_pcp_op($conexaoERP);

	$nomeTemporario = $_helper->getNomeTempArquivo('arquivo_ac');
	$data['divergencia']=false;

	if($nomeTemporario!=false && isset($co_pcp_ad)){

		$matrizDados = $_helper->gerarMatrizDeDadosDoArquivo($nomeTemporario);
		$novoNomeArquivo = strtolower($_helper->getNomeArquivo('arquivo_ac'));
		$extensao = substr($novoNomeArquivo,(strrpos($novoNomeArquivo, '.')),3);
		$type = $_helper->getTypeArquivo('arquivo_ac');


		if($type !='application/octet-stream' || $extensao != '.ac'){
			$data['msg'] = 'Tipo de arquivo inválido!';
		}else{
			$data['sucesso'] = false;
			$statusImport = $_helper->importarArquivo(APP_PATH.'arquivosAC'.DS, $novoNomeArquivo, $nomeTemporario);
			if($statusImport==false){
				$data['msg'] = 'Não foi possível importar arquivo, pois este ja se encontra no servidor!';
				echo json_encode($data);
				exit;
			}
			try {
				$co_pcp_ac = $_acModel->insertReturnId($co_pcp_ad);
			
			}catch (Exception $e){
				//DELETA O ARQUIVO EM CASO DE ERRO NO BANCO
				unlink($novoNomeArquivo);
				$data['msg'] = 'Não foi possível importar arquivo, pois este ja se encontra no servidor!';
				echo json_encode($data);
				exit;
			}
			
			$schema = $_helper->separaSchemas($matrizDados);
			//vetor de codigos internos para evitar repeticoes na hora de realizar o merge
			$tempProdutos = array();
			$temp = 0;
			for($i=0; $i<=count($schema)+1;$i++)
			{
				for($j=0; $j<count($schema[$i]); $j++)
				{
					if($schema[$i][$temp+1]!='VAZIO'){
						if(isset($schema[$i][$temp+1])){
							//PERSISTENCIA DOS DADOS
							//BR/BR          15002200002033501743010021PR006 -      1,17    0,018
							//echo $schema[$i][$temp].'<br>';
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
							//$co_int_produto  = trim(substr($schema[$i][$temp+1],40,7));
							try{
								array_push($tempProdutos,$co_int_produto);	
								$tempProdutos = array_unique($tempProdutos);						
								$_pecasModel->insert($co_cor, $nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $qtd_pecas, $co_int_produto, $co_pcp_ac);
								
							}catch(Exception $e){
								//EM CASO DE ERRO ROLLBACK
								unlink(APP_PATH.'arquivosAC'.DS.$novoNomeArquivo);
								$_acModel->delete($co_pcp_ad);
								$_pecasModel->delete($co_pcp_ac);
								$data['msg'] = $e;
								echo json_encode($data);
								exit;
								
							}

						}

					}
					$temp++;
				}

			}
			//realizando o merge
			$coditos_internos_arquivo_ad = array();
			sort($tempProdutos);
			$divergencias = array();
			$row = $_opModel->listarTodosPisDeUmPlanoDeCorte($co_pcp_ad, $co_cor);
			
			while($dados=mysql_fetch_array($row)){
				array_push($coditos_internos_arquivo_ad,$dados['CO_INT_PRODUTO']);//separa todos os cod_interno dos produtos no arquivo original ad	
				$nu_lote = $dados['NU_LOTE'];		
			}
			
			for ($i=0; $i<count($tempProdutos); $i++)
			{
				if(array_search($tempProdutos[$i],$coditos_internos_arquivo_ad)===FALSE) //verifica se o produto nao esta no arquivo .ad antes do optisave
				{
					//caso nao esteja seta como processado na tabela tb_pcp_op
					$co_pcp_op = $_opModel->getCoPcpOPPisDeUmPlanoDeCorte($tempProdutos[$i], $co_cor, $nu_lote);
					array_push($divergencias, $co_pcp_op[0]);//lista os produtos divergentes
					$_opModel->atualizaProcessado( $co_pcp_op[0], $co_pcp_ad);
					
					
				}
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