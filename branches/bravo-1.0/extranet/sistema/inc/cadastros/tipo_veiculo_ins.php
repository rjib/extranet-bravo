<?php

    require("../../setup.php");
	
	$nomeTipoVeiculo      = $_POST["nomeTipoVeiculo"];
	$descricaoTipoVeiculo = $_POST["descricaoTipoVeiculo"];
	$exigePlaca 		  = $_POST["exigePlaca"];
	
	if (empty($nomeTipoVeiculo)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoVeiculo) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		$query = mysql_query("INSERT INTO tb_tipo_veiculo (NO_TIPO_VEICULO
							      , DS_TIPO_VEICULO, FL_EXIGE_PLACA) 
							  VALUES ('".$nomeTipoVeiculo."' 
								  ,'".$descricaoTipoVeiculo."'
								  ,'".$exigePlaca."')");
		
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o tipo veiculo no momento.";
		}
		
	}
	
?>