<?php

    require("../../setup.php");
	
	$codigoUsuario       = $_POST["codigoUsuario"];
	$senhaUsuarioAlterar = $_POST["senhaUsuarioAlterar"];
		
	if(empty($senhaUsuarioAlterar)){
		echo "Informe a Senha";
	}elseif (strlen($senhaUsuarioAlterar) < 3) {
		echo "A Senha deve ter no minimo 3 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_usuario SET
							      PASS_USUARIO   = '".crypt($senhaUsuarioAlterar)."'
							  WHERE CO_USUARIO = '".$codigoUsuario."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar a Senha do Usuario no momento.";
		}
		
	}
	
?>