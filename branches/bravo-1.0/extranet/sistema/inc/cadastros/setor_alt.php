<?php

    require("../../setup.php");
	
	$codigoSetor           = $_POST["codigoSetor"];
	$nomeSetorAlterar      = $_POST["nomeSetorAlterar"];
	$descricaoSetorAlterar = $_POST["descricaoSetorAlterar"];
	
	if (empty($nomeSetorAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoSetorAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_setor SET
							      NO_SETOR   = '".$nomeSetorAlterar."'
							      , DS_SETOR = '".$descricaoSetorAlterar."'
							  WHERE CO_SETOR = '".$codigoSetor."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o setor no momento.";
		}
		
	}
	
?>