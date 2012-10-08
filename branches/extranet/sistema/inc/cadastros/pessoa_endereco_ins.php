<?php
	
	session_start();
	
    require("../../setup.php");
	
	if(empty($_POST["codigoPessoa"])){
		$codigoPessoa = $_SESSION['codigoPessoa'];
	}else{
		$codigoPessoa = $_POST["codigoPessoa"];
	}
	
	$codigoCep                 = $_POST["codigoCep"];
	$numeroCep                 = $_POST["numeroCep"]; 
	$logradouro                = $_POST["logradouro"];
	$numeroLogradouro          = $_POST["numeroLogradouro"];
	$complementoLogradouro     = $_POST["complementoLogradouro"];
	$bairroLogradouro          = $_POST["bairroLogradouro"];
	$estadoLogradouro          = $_POST["estadoLogradouro"];
	$cidadeLogradouro          = $_POST["cidadeLogradouro"];
	$principalLogradouro       = $_POST["principalLogradouro"];
	$cobrancaLogradouro        = $_POST["cobrancaLogradouro"]; 
	$correspondenciaLogradouro = $_POST["correspondenciaLogradouro"];	
	
	if(empty($codigoCep)){
		echo "Informe o CEP";
	}elseif(empty($numeroLogradouro)){
		echo "Informe o número do logradouro";
	}else{
		
		$query = mysql_query("INSERT INTO tb_endereco (CO_PESSOA
							      , CO_CEP
							      , NU_ENDERECO
							      , COMP_ENDERECO
							      , TP_PRINCIPAL
							      , TP_COBRANCA
							      , TP_CORRESPONDENCIA) 
							  VALUES ('".$codigoPessoa."'
							      , '".$codigoCep."' 
							      , '".$numeroLogradouro."'
							      , '".$complementoLogradouro."'
							      , '".$principalLogradouro."'
							      , '".$cobrancaLogradouro."'
							      , '".$correspondenciaLogradouro."')");
		
		if($query){
			echo false;
		}else {
			echo "[Erro] - Não foi possível inserir o endereço no momento.";
		}
		
	}
	
?>