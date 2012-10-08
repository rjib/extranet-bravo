<?php

    require("../../setup.php");
	
	$codigoColaborador = $_GET["codigoColaborador"];
	
	$query = mysql_query("DELETE FROM tb_colaborador WHERE CO_COLABORADOR = '".$codigoColaborador."'");
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível excluir o Colaborador no momento.";
	}
	
?>