<?php

    require("../../setup.php");
	
	$codigoContato = $_GET["codigoContato"];
	
	

	$sql1 = "delete from tb_contato where co_contato = $codigoContato";
	

	$queryPessoa = mysql_query($sql1,$conexaoERP);
	
	if ($queryPessoa) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir o contato no momento.";
	}
	
?>