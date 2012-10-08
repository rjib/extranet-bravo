<?php

    require("../../setup.php");
	
	$codigoConsultor            = $_POST["codigoConsultor"];
	$setorAlterar           	= $_POST["setorAlterar"];
	$tipoSanguineoAlterar   	= $_POST["tipoSanguineoAlterar"];
	$descricaoConsultorAlterar  = $_POST["descricaoConsultorAlterar"];
	
	if(strlen($descricaoConsultorAlterar) > 244){
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else{
		$query = mysql_query("UPDATE tb_consultor SET
							      CO_SETOR          = '".$setorAlterar."'
								  , CO_TIPO_SANGUINEO = '".$tipoSanguineoAlterar."'
								  , OBS_CONSULTOR   = '".$descricaoConsultorAlterar."'
							  WHERE CO_CONSULTOR = '".$codigoConsultor."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar o Consultor no momento.";
		}
	}
	
?>