<?php
	
	session_start();
	
    require("../../setup.php");
    require_once '../../models/tb_prestador_servico.php';
	
	if(empty($_POST["codigoPessoa"])){
		$codigoPessoa = $_SESSION['codigoPessoa'];
	}else{
		$codigoPessoa = $_POST["codigoPessoa"];
	}
	
	$codigoJuridica = $_POST["codigoEmpresa"]; 
	$_prestador = new tb_prestador_servico($conexaoERP);
	$row = $_prestador->findEmpresaByCodJuridica($codigoJuridica);
	
	$query = $_prestador->inserirEmpresa($codigoPessoa, $row[0]);
	 
		if($query){
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o a empresa no momento.";
		}
	
?>