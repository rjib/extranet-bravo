<?php

    require("../../setup.php");
	
	$codigoEstadoCivil           = $_POST["codigoEstadoCivil"];
	$nomeEstadoCivilAlterar      = $_POST["nomeEstadoCivilAlterar"];
	$descricaoEstadoCivilAlterar = $_POST["descricaoEstadoCivilAlterar"];
	
	if (empty($nomeEstadoCivilAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoAtividadeAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_estado_civil SET
							      NO_ESTADO_CIVIL   = '".$nomeEstadoCivilAlterar."'
							      , DS_ESTADO_CIVIL = '".$descricaoEstadoCivilAlterar."'
							  WHERE CO_ESTADO_CIVIL = '".$codigoEstadoCivil."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o estado civil no momento.";
		}
		
	}
	
?>