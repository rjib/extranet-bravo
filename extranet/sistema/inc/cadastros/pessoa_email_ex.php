<?php

    require("../../setup.php");
	
	$codigoPessoa = $_GET["codigoEmail"];

	$sql3 = "delete from tb_email where co_email = $codigoPessoa";
	
	$queryPessoa = mysql_query($sql3,$conexaoERP);
	
	if ($queryPessoa) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o e-mail no momento.";
	}
	
?>