<?php

    require("../../setup.php");
	
	$codigoUsuario = $_GET["codigoUsuario"];
	
	$query = mysql_query("DELETE FROM tb_usuario WHERE CO_USUARIO = '".$codigoUsuario."'");
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível excluir o Usuario no momento.";
	}
	
?>