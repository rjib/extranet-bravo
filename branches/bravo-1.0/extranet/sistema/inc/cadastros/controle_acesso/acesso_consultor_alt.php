<?php

    require("../../../setup.php");
	
	$codigoAcessoConsultor = $_POST["codigoAcessoConsultor"];
	$horaEntradaAlterar    = $_POST["horaEntradaAlterar"];
	$tipoVeiculoAlterar    = $_POST["tipoVeiculoAlterar"];
	$placaVeiculoAlterar   = $_POST["placaVeiculoAlterar"];
	$numeroCartaoAlterar   = $_POST["numeroCartaoAlterar"];
		
	if($horaEntradaAlterar == "0" or $horaEntradaAlterar == "") {
		echo "Informe a Hora Entrada";
	}elseif(empty($tipoVeiculoAlterar)){
		echo "Informe o Tipo Veiculo";
	}elseif(empty($placaVeiculoAlterar)){
		echo "Informe a Placa do Veiculo";
	}elseif(empty($numeroCartaoAlterar)){
		echo "Informe o Número do Cartão";
	}elseif (strlen($placaVeiculoAlterar) < 8) {
		echo "A Placa do Veiculo deve ter 8 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_acesso_consultor SET
		                          HR_ENTRADA                = '".$horaEntradaAlterar."'
							      , CO_TIPO_VEICULO         = '".$tipoVeiculoAlterar."'
							      , PL_VEICULO              = '".$placaVeiculoAlterar."'
							      , CO_CARTAO_IDENTIFICACAO = '".$numeroCartaoAlterar."'
							  WHERE CO_ACESSO_CONSULTOR = '".$codigoAcessoConsultor."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar o Acesso Consultor no momento.";
		}
		
	}
	
?>