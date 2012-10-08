<?php
	
	session_start();
	
    require("../setup.php");
	
	$rg = $_GET["rg"];
	
	$verificaRG = mysql_query("SELECT CO_PESSOA
						        FROM tb_pessoa_fisica
						        WHERE RG_PESSOA_FISICA = '".$rg."'",$conexaoERP)
	or die(mysql_error());
	
	if(mysql_num_rows($verificaRG) != 0){
	    $rowVerificaRG=mysql_fetch_array($verificaRG);
		$resposta = array(
			'codigoPessoa' => $rowVerificaRG['CO_PESSOA'],
		);
		echo json_encode($resposta);
	}
		
?>