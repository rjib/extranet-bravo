<?php

    require("../../setup.php");
	
	$codigoNacionalidade           = $_POST["codigoNacionalidade"];
	$nomeNacionalidadeAlterar      = $_POST["nomeNacionalidadeAlterar"];
	$descricaoNacionalidadeAlterar = $_POST["descricaoNacionalidadeAlterar"];
	
	if (empty($nomeNacionalidadeAlterar)) {
		echo "Informe o Nome";
	}elseif (strlen($descricaoNacionalidadeAlterar) > 244) {
		echo "A Descrição deve ter no máximo 244 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_nacionalidade SET
							      NO_NACIONALIDADE   = '".$nomeNacionalidadeAlterar."'
							      , DS_NACIONALIDADE = '".$descricaoNacionalidadeAlterar."'
							  WHERE CO_NACIONALIDADE = '".$codigoNacionalidade."'");
		if ($query) {
			echo false;
		}else {
			echo "[Erro] - Não foi possível alterar o Nacionalidade no momento.";
		}
		
	}
	
?>