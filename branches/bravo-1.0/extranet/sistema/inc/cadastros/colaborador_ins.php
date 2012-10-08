<?php

    require("../../setup.php");
	
	$codigoPessoa         = $_POST["codigoPessoa"];
	$tipoColaborador	  = $_POST["tipoColaborador"];
	$nivelFormacao 		  = $_POST["nivelFormacao"];
	$cargo 				  = $_POST["cargo"];
	$setor 				  = $_POST["setor"];
	$tipoSanguineo 		  = $_POST["tipoSanguineo"];
	$descricaoColaborador = $_POST["descricaoColaborador"];
	
	if(empty($codigoPessoa)) {
		echo "Informe a Pessoa";
	}elseif($tipoColaborador == "0") {
		echo "Informe o Tipo Colaborador";
	}elseif($nivelFormacao == "0") {
		echo "Informe o Nivel Formação";
	}elseif($cargo == "0") {
		echo "Informe o Cargo";
	}elseif($setor == "0") {
		echo "Informe o Setor";
	}elseif($tipoSanguineo == "0") {
		echo "Informe o Tipo Sanguineo";
	}elseif(strlen($descricaoColaborador) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_colaborador (CO_PESSOA
							      , CO_CARGO
							      , CO_SETOR
							      , CO_TIPO_SANGUINEO
							      , OBS_COLABORADOR) 
							  VALUES ('".$codigoPessoa."' 								 
								  ,'".$cargo."'
								  ,'".$setor."'
								  ,'".$tipoSanguineo."'
								  ,'".$descricaoColaborador."')");
								  
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o Colaborador no momento.";
		}
		
	}
	
?>