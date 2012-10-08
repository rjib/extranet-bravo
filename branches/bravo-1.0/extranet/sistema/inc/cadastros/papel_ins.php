<?php

    require("../../setup.php");
	
	$nomePapel      = $_POST["nomePapel"];
	$descricaoPapel = $_POST["descricaoPapel"];
	
	if(empty($nomePapel)){
		echo "Informe o Nome";
	}elseif (strlen($descricaoPapel) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("INSERT INTO tb_papel (NO_PAPEL, DS_PAPEL) VALUES ('".$nomePapel."' ,'".$descricaoPapel."')");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir o Papel no momento.";
		}
		
	}
	
?>