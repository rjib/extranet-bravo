<?php

    require("../../setup.php");
	
	$codigoMotivoParada           = $_POST["codigoMotivoParada"];
	$nomeMotivoParadaAlterar      = $_POST["nomeMotivoParadaAlterar"];
	$descricaoMotivoParadaAlterar = $_POST["descricaoMotivoParadaAlterar"];
	$statusMotivoParadaAlterar    = $_POST["statusMotivoParadaAlterar"];
	
	if(empty($nomeMotivoParadaAlterar)){
		echo "Informe o Nome";
	}elseif(empty($descricaoMotivoParadaAlterar)){
		echo "Informe a Descrição";
	}elseif(strlen($descricaoMotivoParada) > 244){
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else{
		
		$query = mysql_query("UPDATE tb_pcp_motivo_parada SET
							      NO_MOTIVO_PARADA   = '".$nomeMotivoParadaAlterar."'
							      , DS_MOTIVO_PARADA = '".$descricaoMotivoParadaAlterar."'
								  , ST_MOTIVO_PARADA = '".$statusMotivoParadaAlterar."'
							  WHERE CO_PCP_MOTIVO_PARADA = '".$codigoMotivoParada."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar o Motivo de Parada no momento.";
		}
		
	}
	
?>