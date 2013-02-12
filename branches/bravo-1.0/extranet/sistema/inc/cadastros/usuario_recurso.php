<?php

    require("../../setup.php");
	
	$codigoUsuario = $_POST["codigoUsuario"];
	$codigoRecurso = $_POST["codigoRecurso"];
	
	mysql_query("DELETE FROM tb_pcp_usuario_recurso WHERE CO_USUARIO = '".$codigoUsuario."'");
	
	for($i=0;$i<count($codigoRecurso);$i++){							  
	    $query = mysql_query("INSERT INTO tb_pcp_usuario_recurso (CO_PCP_RECURSO, CO_USUARIO) VALUES ('".$codigoRecurso[$i]."', '".$codigoUsuario."')");
	}
	
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível vincular o usuario ao recurso no momento.";
	}
	
?>