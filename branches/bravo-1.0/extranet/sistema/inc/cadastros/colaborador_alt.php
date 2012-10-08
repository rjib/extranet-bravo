<?php

    require("../../setup.php");
	
	$codigoColaborador            = $_POST["codigoColaborador"];
	$cargoAlterar           	  = $_POST["cargoAlterar"];
	$setorAlterar           	  = $_POST["setorAlterar"];
	$tipoSanguineoAlterar   	  = $_POST["tipoSanguineoAlterar"];
	$descricaoColaboradorAlterar  = $_POST["descricaoColaboradorAlterar"];
	
	if(strlen($descricaoColaboradorAlterar) > 244){
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else{
		$query = mysql_query("UPDATE tb_colaborador SET								 
								    CO_SETOR          = '".$setorAlterar."'
								  , CO_TIPO_SANGUINEO = '".$tipoSanguineoAlterar."'
								  , OBS_COLABORADOR   = '".$descricaoColaboradorAlterar."'
							  WHERE CO_COLABORADOR = '".$codigoColaborador."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar o colaborador no momento.";
		}
	}
	
?>