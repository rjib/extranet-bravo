<?php

require_once '../../setup.php';
require_once '../../models/tb_acoes.php';
require_once '../../models/tb_papel_modulo.php';
require_once '../../helper.class.php';


if(!empty($_POST['co_papel'])){	

		$co_papel	 = $_POST['co_papel'];
		$co_modulo	 = $_POST['co_modulo'];
		$_acoesModel = new tb_acoes($conexaoERP);
		$_pmodulo    = new tb_papel_modulo($conexaoERP);
		$data = array();
		
		if(!empty($_POST['co_modulo'])){
			
			//verificando remoçao de modulos		
			$objSQL = $_pmodulo->listaModuloPorPapel($co_papel);
	
			while($dados = mysql_fetch_array($objSQL)){
					if(array_search($dados['CO_MODULO'], $co_modulo)===false){//se nao existir modulo selecionado, entao exclui-lo
						$co_papel_modulo = $dados['CO_PAPEL_MODULO'];
						//$_acoesModel->delete($co_papel_modulo);
						$_pmodulo->delete($co_papel_modulo);	
						$data['erro'] = 0;
					}
			}
			
			//verificando atualizacao e inclusao de modulos
			for($i=0; $i<count($co_modulo); $i++){
				$return = $_pmodulo->verificaExistencia($co_modulo[$i], $co_papel); 
				if($return >0){//se maior quer dizer que existe
					//entao faça o update
					$data['erro'] = 0;
					
				}else{//entao faça o insert
					$co_papel_modulo = $_pmodulo->inserir($co_papel, $co_modulo[$i]);
					$_acoesModel->inserir($co_papel_modulo);
					$data['erro'] = 0;
				}
			}
		}else{//REMOVER TODOS
			$_pmodulo->deleteModuloByPapel($co_papel);
			
		}
}else{
	$data['erro'] = 1;
}
echo json_encode($data['erro']);

//echo $co_papel."</br>";
//echo var_dump($co_modulo);

