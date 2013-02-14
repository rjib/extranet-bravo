<?php

    require("../../setup.php");
	
	$codigoApontamento = $_GET["codigoApontamento"];
	
	$query = mysql_query("UPDATE tb_pcp_apontamento SET FL_DELET = '*' WHERE CO_PCP_APONTAMENTO = '".$codigoApontamento."'");
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível excluir o Apontamento no momento.";
	}
	
?>