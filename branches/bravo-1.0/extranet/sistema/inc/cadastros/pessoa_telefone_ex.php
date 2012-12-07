<?php

    require("../../setup.php");
	
	$codigoTelefone = $_GET["codigoTelefone"];

	$sql3 = "delete from tb_telefone where co_telefone = $codigoTelefone";
	
	$queryPessoa = mysql_query($sql3,$conexaoERP);
	
	if ($queryPessoa) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o telefone no momento.";
	}
	
?>