<?php

    require("../../setup.php");
	
	$codigoEstadoCivil = $_GET["codigoEstadoCivil"];
	
	$query = mysql_query("DELETE FROM tb_estado_civil WHERE CO_ESTADO_CIVIL = '".$codigoEstadoCivil."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o estado civil no momento.";
	}
	
?>