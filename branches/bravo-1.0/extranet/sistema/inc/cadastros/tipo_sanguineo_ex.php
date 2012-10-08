<?php

    require("../../setup.php");
	
	$codigoTipoSanguineo = $_GET["codigoTipoSanguineo"];
	
	$query = mysql_query("DELETE FROM tb_tipo_sanguineo WHERE CO_TIPO_SANGUINEO = '".$codigoTipoSanguineo."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o tipo sanguineo no momento.";
	}
	
?>