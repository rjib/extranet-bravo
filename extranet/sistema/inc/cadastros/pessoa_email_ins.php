<?php
	
	session_start();
	
    require("../../setup.php");
	
	if(empty($_POST["codigoPessoa"])){
		$codigoPessoa = $_SESSION['codigoPessoa'];
	}else{
		$codigoPessoa = $_POST["codigoPessoa"];
	}
	
	$codigoContatoEmail = $_POST["codigoContatoEmail"]; 
	$tipoEmailContato   = $_POST["tipoEmailContato"]; 
	$emailContato       = $_POST["emailContato"]; 

	if(empty($codigoContatoEmail)){
		echo "Informe o Contato";
	}elseif(empty($tipoEmailContato)){
		echo "Informe o Tipo do E-mail";
	}elseif(empty($emailContato)) {
		echo "Informe o E-mail";
	}else{
			
		$query = mysql_query("INSERT INTO tb_email (CO_PESSOA
		                          , CO_CONTATO
								  , CO_TIPO_EMAIL
								  , NO_EMAIL) 
		                      VALUES ('".$codigoPessoa."'
							      , '".$codigoContatoEmail."'
								  , '".$tipoEmailContato."'
								  , '".$emailContato."')",$conexaoERP)
		or die(mysql_error());
		
		if($query){
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o e-mail no momento.";
		}
		
	}
	
?>