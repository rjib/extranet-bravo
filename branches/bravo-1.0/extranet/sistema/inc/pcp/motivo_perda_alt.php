<?php

    require("../../setup.php");
	
	$codigoMotivoPerda           = $_POST["codigoMotivoPerda"];
	$nomeMotivoPerdaAlterar      = $_POST["nomeMotivoPerdaAlterar"];
	$descricaoMotivoPerdaAlterar = $_POST["descricaoMotivoPerdaAlterar"];
	$statusMotivoPerdaAlterar    = $_POST["statusMotivoPerdaAlterar"];
	
	if(empty($nomeMotivoPerdaAlterar)){
		echo "Informe o Nome";
	}elseif(empty($descricaoMotivoPerdaAlterar)){
		echo "Informe a Descrição";
	}elseif(strlen($descricaoMotivoPerda) > 244){
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else{
		
		$query = mysql_query("UPDATE tb_pcp_motivo_perda SET
							      NO_MOTIVO_PERDA   = '".$nomeMotivoPerdaAlterar."'
							      , DS_MOTIVO_PERDA = '".$descricaoMotivoPerdaAlterar."'
								  , ST_MOTIVO_PERDA = '".$statusMotivoPerdaAlterar."'
							  WHERE CO_PCP_MOTIVO_PERDA = '".$codigoMotivoPerda."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar o Motivo de Perda no momento.";
		}
		
	}
	
?>