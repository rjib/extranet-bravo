<?php

    require("../setup.php");
	
	$codigoCidade = $_POST["codigoCidade"];
	$nomeBairro   = $_POST["nomeBairro"];
	
	if($codigoCidade == "0"){
		echo "Informe a Cidade";
	}elseif (empty($nomeBairro)){
		echo "Informe o nome do Bairro";
	}else {
		
		$query = mysql_query("INSERT INTO tb_bairro (CO_MUNICIPIO, NO_BAIRRO) VALUES ('".$codigoCidade."' ,'".$nomeBairro."')");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir o Bairro no momento.";
		}
		
	}
	
?>