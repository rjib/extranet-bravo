<?php

    require("../setup.php");
	
	$codigoBairro = $_GET["codigoBairro"];
	
	$query = mysql_query("DELETE FROM tb_bairro WHERE CO_BAIRRO = '".$codigoBairro."'");
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível excluir o Bairro no momento.";
	}
	
?>