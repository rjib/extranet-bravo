<?php

    require("../../setup.php");
	
	$codigoTipoVeiculo = $_GET["codigoTipoVeiculo"];
	
	$query = mysql_query("DELETE FROM tb_tipo_veiculo WHERE CO_TIPO_VEICULO = '".$codigoTipoVeiculo."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o tipo veiculo no momento.";
	}
	
?>