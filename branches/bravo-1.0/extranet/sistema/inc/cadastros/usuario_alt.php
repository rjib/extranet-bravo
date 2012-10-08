<?php

    require("../../setup.php");
	
	$codigoUsuario            = $_POST["codigoUsuario"];
	$papelUsuarioAlterar      = $_POST["papelUsuarioAlterar"];
	$loginUsuarioAlterar      = $_POST["loginUsuarioAlterar"];
	$statusUsuarioAlterar     = $_POST["statusUsuarioAlterar"];
		
	if($papelUsuarioAlterar == "0") {
		echo "Informe o Papel";
	}elseif(empty($loginUsuarioAlterar)){
		echo "Informe o Login";
	}else {
		
		$query = mysql_query("UPDATE tb_usuario SET
							      CO_PAPEL     = '".$papelUsuarioAlterar."'
								  , LG_USUARIO   = '".$loginUsuarioAlterar."'
								  , ST_USUARIO   = '".$statusUsuarioAlterar."'
							  WHERE CO_USUARIO = '".$codigoUsuario."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar o Usuario no momento.";
		}
		
	}
	
?>