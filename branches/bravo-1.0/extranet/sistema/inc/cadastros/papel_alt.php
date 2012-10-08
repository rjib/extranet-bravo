<?php

    require("../../setup.php");
	
	$codigoPapel           = $_POST["codigoPapel"];
	$nomePapelAlterar      = $_POST["nomePapelAlterar"];
	$descricaoPapelAlterar = $_POST["descricaoPapelAlterar"];
	
	if (empty($nomePapelAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoPapelAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_papel SET
							      NO_PAPEL   = '".$nomePapelAlterar."'
							      , DS_PAPEL = '".$descricaoPapelAlterar."'
							  WHERE CO_PAPEL = '".$codigoPapel."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o Papel no momento.";
		}
		
	}
	
?>