<?php

    require("../../setup.php");
	
	$codigoColaborador = $_POST["codigoColaborador"];
	$papelUsuario      = $_POST["papelUsuario"];
	$loginUsuario      = $_POST["loginUsuario"];
	$senhaUsuario      = $_POST["senhaUsuario"];
	$statusUsuario     = $_POST["statusUsuario"];
	
	if(empty($codigoColaborador)){
		echo "Informe o Colaborador";
	}elseif($papelUsuario == "0") {
		echo "Informe o Papel";
	}elseif(empty($loginUsuario)){
		echo "Informe o Login";
	}elseif(empty($senhaUsuario)){
		echo "Informe o Senha";
	}elseif(empty($statusUsuario)){
		echo "Informe o Status";
	}elseif (strlen($senhaUsuario) < 3) {
		echo "A Senha deve ter no minimo 3 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_usuario (CO_COLABORADOR
							      , CO_PAPEL
								  , LG_USUARIO
								  , PASS_USUARIO
								  , ST_USUARIO) 
							  VALUES ('".$codigoColaborador."'
							      , '".$papelUsuario."'
								  , '".$loginUsuario."'
								  , '".crypt($senhaUsuario)."'
								  , '".$statusUsuario."')");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir o Usuario no momento.";
		}
		
	}
	
?>