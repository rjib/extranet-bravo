<?php

    require("../../setup.php");
	
	$nomeMotivoPerda      = $_POST["nomeMotivoPerda"];
	$descricaoMotivoPerda = $_POST["descricaoMotivoPerda"];
	$statusMotivoPerda    = $_POST["statusMotivoPerda"];
	
	if(empty($nomeMotivoPerda)){
		echo "Informe o Nome";
	}elseif(empty($descricaoMotivoPerda)){
		echo "Informe a Descrição";
	}elseif(empty($statusMotivoPerda)){
		echo "Informe o Status";
	}elseif(strlen($descricaoMotivoPerda) > 244){
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else{
		
		$query = mysql_query("INSERT INTO tb_pcp_motivo_perda (NO_MOTIVO_PERDA, DS_MOTIVO_PERDA, ST_MOTIVO_PERDA) VALUES ('".$nomeMotivoPerda."' ,'".$descricaoMotivoPerda."','".$statusMotivoPerda."')");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir o Motivo de Perda no momento.";
		}
		
	}
	
?>