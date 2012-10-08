<?php

    require("../../setup.php");
	
	$codigoCargo           = $_POST["codigoCargo"];
	$nomeCargoAlterar      = $_POST["nomeCargoAlterar"];
	$descricaoCargoAlterar = $_POST["descricaoCargoAlterar"];
	
	if (empty($nomeCargoAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoCargoAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_cargo SET
							      NO_CARGO   = '".$nomeCargoAlterar."'
							      , DS_CARGO = '".$descricaoCargoAlterar."'
							  WHERE CO_CARGO = '".$codigoCargo."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o cargo no momento.";
		}
		
	}
	
?>