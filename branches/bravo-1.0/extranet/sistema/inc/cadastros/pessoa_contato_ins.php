<?php
	
	session_start();
	
    require("../../setup.php");
	
	if(empty($_POST["codigoPessoa"])){
		$codigoPessoa = $_SESSION['codigoPessoa'];
	}else{
		$codigoPessoa = $_POST["codigoPessoa"];
	}
	
	$nomeContato = $_POST["nomeContato"]; 

	if(empty($nomeContato)){
		echo "Informe o Nome";
	}elseif(strlen($nomeContato) < 3) {
		echo "O nome deve ter no minimo 3 caracteres";
	}else{
		$query = mysql_query("INSERT INTO tb_contato (CO_PESSOA, NO_CONTATO) VALUES ('".$codigoPessoa."', '".$nomeContato."')",$conexaoERP)
		or die(mysql_error());
		
		if($query){
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o contato no momento.";
		}
		
	}
	
?>