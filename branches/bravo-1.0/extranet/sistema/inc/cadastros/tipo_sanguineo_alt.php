<?php

    require("../../setup.php");
	
	$codigoTipoSanguineo           = $_POST["codigoTipoSanguineo"];
	$nomeTipoSanguineoAlterar      = $_POST["nomeTipoSanguineoAlterar"];
	$descricaoTipoSanguineoAlterar = $_POST["descricaoTipoSanguineoAlterar"];
	
	if (empty($nomeTipoSanguineoAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoTipoSanguineoAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_tipo_sanguineo SET
							      NO_TIPO_SANGUINEO   = '".$nomeTipoSanguineoAlterar."'
							      , DS_TIPO_SANGUINEO = '".$descricaoTipoSanguineoAlterar."'
							  WHERE CO_TIPO_SANGUINEO = '".$codigoTipoSanguineo."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o tipo sanguineo no momento.";
		}
		
	}
	
?>