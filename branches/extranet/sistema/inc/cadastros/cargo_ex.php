<?php

    require("../../setup.php");
	
	$codigoCargo = $_GET["codigoCargo"];
	
	$query = mysql_query("DELETE FROM tb_cargo WHERE CO_CARGO = '".$codigoCargo."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o cargo no momento.";
	}
	
?>