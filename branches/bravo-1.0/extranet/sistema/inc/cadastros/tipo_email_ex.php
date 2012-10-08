<?php

    require("../../setup.php");
	
	$codigoTipoEmail = $_GET["codigoTipoEmail"];
	
	$query = mysql_query("DELETE FROM tb_tipo_email WHERE CO_TIPO_EMAIL = '".$codigoTipoEmail."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o tipo email no momento.";
	}
	
?>