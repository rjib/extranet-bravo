<?php

    require("../../setup.php");
	
	$nomeMotivoParada      = $_POST["nomeMotivoParada"];
	$descricaoMotivoParada = $_POST["descricaoMotivoParada"];
	$statusMotivoParada    = $_POST["statusMotivoParada"];
	
	if(empty($nomeMotivoParada)){
		echo "Informe o Nome";
	}elseif(empty($descricaoMotivoParada)){
		echo "Informe a Descrição";
	}elseif(empty($statusMotivoParada)){
		echo "Informe o Status";
	}elseif(strlen($descricaoMotivoParada) > 244){
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else{
		
		$query = mysql_query("INSERT INTO tb_pcp_motivo_parada (NO_MOTIVO_PARADA, DS_MOTIVO_PARADA, ST_MOTIVO_PARADA) VALUES ('".$nomeMotivoParada."' ,'".$descricaoMotivoParada."','".$statusMotivoParada."')");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir o Motivo de Parada no momento.";
		}
		
	}
	
?>