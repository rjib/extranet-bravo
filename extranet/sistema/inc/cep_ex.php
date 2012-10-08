<?php

    require("../setup.php");
	
	$codigoCep = $_GET["codigoCep"];
	
	$query = mysql_query("DELETE FROM tb_cep WHERE CO_CEP = '".$codigoCep."'");
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível excluir o CEP no momento.";
	}
	
?>