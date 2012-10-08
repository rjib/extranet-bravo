<?php

    require("../../setup.php");
	
	$codigoNacionalidade = $_GET["codigoNacionalidade"];
	
	$query = mysql_query("DELETE FROM tb_nacionalidade WHERE CO_NACIONALIDADE = '".$codigoNacionalidade."'");
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir a Nacionalidade no momento.";
	}
	
?>