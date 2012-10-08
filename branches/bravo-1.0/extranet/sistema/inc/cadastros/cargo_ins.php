<?php

    require("../../setup.php");
	
	$nomeCargo      = $_POST["nomeCargo"];
	$descricaoCargo = $_POST["descricaoCargo"];
	
	if (empty($nomeCargo)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoCargo) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_cargo (NO_CARGO, DS_CARGO) VALUES ('".$nomeCargo."' ,'".$descricaoCargo."')");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o Cargo no momento.";
		}
		
	}
	
?>