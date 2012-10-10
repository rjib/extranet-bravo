<?php

    require("../../setup.php");
	
	$codigoTipoVeiculo           = $_POST["codigoTipoVeiculo"];
	$nomeTipoVeiculoAlterar      = $_POST["nomeTipoVeiculoAlterar"];
	$descricaoTipoVeiculoAlterar = $_POST["descricaoTipoVeiculoAlterar"];
	$exigePlaca					 = $_POST["exigePlaca"];
	
	if (empty($nomeTipoVeiculoAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoVeiculoAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_tipo_veiculo SET
							      NO_TIPO_VEICULO   = '".$nomeTipoVeiculoAlterar."'
							      , DS_TIPO_VEICULO = '".$descricaoTipoVeiculoAlterar."'
								  , FL_EXIGE_PLACA = '".$exigePlaca."'
							  WHERE CO_TIPO_VEICULO = '".$codigoTipoVeiculo."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o tipo veiculo no momento.";
		}
		
	}
	
?>