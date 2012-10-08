<?php

    require("../../setup.php");
	
	$codigoConsultor = $_GET["codigoConsultor"];
	
	$query = mysql_query("DELETE FROM tb_consultor WHERE CO_CONSULTOR = '".$codigoConsultor."'");
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível excluir o Consultor no momento.";
	}
	
?>