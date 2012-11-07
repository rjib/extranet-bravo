<?php 
require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_ac.php';

if(isset($_POST['nomeAD'])){
	
	$cod_pcp_ad  = $_POST['nomeAD'];
	
	$_helper 	 = new helper();
	$_pecasModel = new tb_pcp_pecas($conexaoERP);
	$_acModel 	 = new tb_pcp_ac($conexaoERP);

	$nomeTemporario = $_helper->getNomeTempArquivo('arquivo_ac');

	if($nomeTemporario!=false){

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
				$co_pcp_ac = $_acModel->insertReturnId($cod_pcp_ad);
			
			}catch (Exception $e){
				//DELETAR O ARQUIVO AQUI EM CASO DE ERRO NO BANCO
				$data['msg'] = 'Não foi possível importar arquivo, pois este ja se encontra no servidor!';
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
							//PERSISTENCIA DOS DADOS
							//BR/BR          15002200002033501743010021PR006 -      1,17    0,018
							//echo $schema[$i][$temp].'<br>';
							//$nu_schema 		 = $i;
							//$nu_comprimento  = substr($schema[$i][$temp+1],26);
							//$_pecasModel->insert($nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $qtd_pecas, $co_pcp_ac);
													

						}

					}
					$temp++;

				}

			}
			$data['sucesso'] = true;
		}
	}else{
		$data['msg'] = 'Nenhum arquivo selecionado!';
	}

	echo json_encode($data);
}
//var_dump($schema);
?>
