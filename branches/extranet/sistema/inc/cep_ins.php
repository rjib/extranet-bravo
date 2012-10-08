<?php

    require("../setup.php");
	
	$codigoBairro   = $_POST["codigoBairro"];
	$numeroCep      = $_POST["numeroCep"];
	$nomeLogradouro = $_POST["nomeLogradouro"];
	
	if($codigoBairro == "0"){
		echo "Informe a Bairro";
	}elseif (empty($numeroCep)){
		echo "Informe o numero do CEP";
	}elseif (empty($nomeLogradouro)){
		echo "Informe o nome do Logradouro";
	}else {
		
		$query = mysql_query("INSERT INTO tb_cep (CO_BAIRRO, NU_CEP, NO_LOGRADOURO) VALUES ('".$codigoBairro."', '".$numeroCep."', '".$nomeLogradouro."')");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir o CEP no momento.";
		}
		
	}
	
?>