<?php

    require("../../setup.php");
	
	$codigoPessoa         = $_POST["codigoPessoa"];
	$setor 				  = $_POST["setor"];
	$tipoSanguineo 		  = $_POST["tipoSanguineo"];
	$descricaoConsultor   = $_POST["descricaoConsultor"];
	
	if(empty($codigoPessoa)) {
		echo "Informe a Pessoa";
	}elseif($setor == "0") {
		echo "Informe o Setor";
	}elseif($tipoSanguineo == "0") {
		echo "Informe o Tipo Sanguineo";
	}elseif(strlen($descricaoConsultor) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_consultor (CO_PESSOA
							      , CO_SETOR
							      , CO_TIPO_SANGUINEO
							      , OBS_CONSULTOR) 
							  VALUES ('".$codigoPessoa."' 
								  ,'".$setor."'
								  ,'".$tipoSanguineo."'
								  ,'".$descricaoConsultor."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o Consultor no momento.";
		}
		
	}
	
?>