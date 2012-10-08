<?php

    require("../../setup.php");
	
	$codigoPapel = $_GET["codigoPapel"];
	
	$query = mysql_query("DELETE FROM tb_papel WHERE CO_PAPEL = '".$codigoPapel."'");
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível excluir o Papel no momento.";
	}
	
?>