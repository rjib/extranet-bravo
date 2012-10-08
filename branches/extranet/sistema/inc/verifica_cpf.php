<?php
	
	session_start();
	
    require("../setup.php");
	
	$cpf = $_GET["cpf"];
	
	$verificaCPF = mysql_query("SELECT CO_PESSOA
						        FROM tb_pessoa_fisica
						        WHERE CPF_PESSOA_FISICA = '".$cpf."'",$conexaoERP)
	or die(mysql_error());
	
	if(mysql_num_rows($verificaCPF) != 0){
	    $rowVerificaCPF=mysql_fetch_array($verificaCPF);
		$resposta = array(
			'codigoPessoa' => $rowVerificaCPF['CO_PESSOA'],
		);
		echo json_encode($resposta);
	}
		
?>