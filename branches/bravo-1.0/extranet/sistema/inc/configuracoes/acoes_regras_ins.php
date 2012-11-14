<?php

require_once '../../setup.php';
require_once '../../models/tb_acoes.php';
require_once '../../models/tb_papel_modulo.php';
require_once '../../models/tb_modulos.php';
require_once '../../helper.class.php';

$data = array();
$_acaoModel 	= new tb_acoes($conexaoERP);
$_moduloModel	= new tb_modulos($conexaoERP);


if(!empty($_POST['co_papel_regra'])){
	$co_papel = $_POST['co_papel_regra'];
	if(!empty($_POST['acao_editar']) || !empty($_POST['acao_excluir']) || !empty($_POST['acao_incluir'])){
	
			$co_acao_editar  = $_POST['acao_editar'];
			$co_acao_excluir = $_POST['acao_excluir'];
			$co_acao_incluir = $_POST['acao_incluir']; //ADICIONAR
						
			
			//UPDATE EDITAR
			if(count($co_acao_editar)>0){//SE MAIOR ATIVA EDICAO				
				for($i = 0; $i<count($co_acao_editar); $i++){
					$_acaoModel->updateEditar($co_acao_editar[$i], 1);						
				}
			}else{//REMOVE EDICAO				
					$result = $_moduloModel->listaModulosPorPapel($co_papel);
					while($dados = mysql_fetch_array($result)){
						$_acaoModel->updateEditar($dados['CO_ACAO'], 0);
					}
			}

			//UPDATE ADICIONAR
			if(count($co_acao_incluir)>0){//SE MAIOR ATIVA ADICIONAR
				for($i = 0; $i<count($co_acao_incluir); $i++){
					$_acaoModel->updateIncluir($co_acao_incluir[$i], 1);
				}
			}else{//REMOVE ADICIONAR
				$result = $_moduloModel->listaModulosPorPapel($co_papel);
				while($dados = mysql_fetch_array($result)){
					$_acaoModel->updateIncluir($dados['CO_ACAO'], 0);
				}
			}
			
			//UPDATE EXCLUIR
			if(count($co_acao_excluir)>0){//SE MAIOR ATIVA EXCLUIR
				for($i = 0; $i<count($co_acao_excluir); $i++){
					$_acaoModel->updateExcluir($co_acao_excluir[$i], 1);
				}
			}else{//REMOVE EXCLUIR
				$result = $_moduloModel->listaModulosPorPapel($co_papel);
				while($dados = mysql_fetch_array($result)){
					$_acaoModel->updateExcluir($dados['CO_ACAO'], 0);
				}
			}				
			
			$data['erro'] = 0;
			
	}else{
		//REMOVER TODAS PERMISSÕES DE ACOES A UM PAPEL NO CASO DE NENHUM BOX SELECIONADO
		$result = $_moduloModel->listaModulosPorPapel($co_papel);
		while($dados = mysql_fetch_array($result)){
			$_acaoModel->updateAll('0', '0', '0', $dados['CO_ACAO']);			
		}
		$data['erro'] = 0;
	}
}else{
	$data['erro'] = 1;
}
echo json_encode($data['erro']);

