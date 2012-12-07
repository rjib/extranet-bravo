<?php

    require("../../setup.php");
	
	$codigoPessoa = $_GET["codigoPessoa"];
	$codigoPessoaJuridica = $_GET['codigoPessoaJuridica'];
	
	$query = mysql_query("DELETE FROM tb_prestador_servico WHERE CO_PESSOA = '".$codigoPessoa."' AND CO_PESSOA_JURIDICA = ".$codigoPessoaJuridica);
	if ($query) {
		echo false;
	}else {
		echo "[Erro] - Não foi possível excluir a empresa no momento.";
	}
	
?>