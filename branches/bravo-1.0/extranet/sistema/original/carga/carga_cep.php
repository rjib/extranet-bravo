<?php

	$cfg_dsn = "DRIVER=Microsoft Access Driver (*.mdb);DBQ=D:/www/xampp/htdocs/s2negocios/original/carga/codigo_postal_By_Abelha.mdb;
	UserCommitSync=Yes;
	Threads=3;
	SafeTransactions=0;
	PageTimeout=5;
	MaxScanRows=8;
	MaxBufferSize=2048;
	DriverId=281";
	
	$cfg_dsn_login = "";
	$cfg_dsn_mdp = "";
	
	$conexao=odbc_connect($cfg_dsn,$cfg_dsn_login,$cfg_dsn_mdp);
	
	$conexaoERP = mysql_connect("localhost","root","")
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.location = 'inicio.php';
			 </script>");
	
	$dbERP = mysql_select_db("s2negocios",$conexaoERP)
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.location = 'inicio.php';
			 </script>");
	
	ini_set("max_execution_time",3600);
	ini_set("memory_limit","50M");
    set_time_limit(0);
	
	$sqlUF = mysql_query("SELECT SG_UF FROM tb_uf WHERE SG_UF = 'MG'",$conexaoERP)
	or die(mysql_error());
	
	while($rowUF=mysql_fetch_array($sqlUF)){
		
		$execute = odbc_exec($conexao,"SELECT * from ".$rowUF['SG_UF']."");
		
		while($coluna = odbc_fetch_array($execute)){
			$sqlBairro = mysql_query("SELECT BAIRRO.CO_BAIRRO 
									  FROM tb_bairro BAIRRO
									      INNER JOIN tb_municipio MUNICIPIO
									          ON BAIRRO.CO_MUNICIPIO = MUNICIPIO.CO_MUNICIPIO
									          AND MUNICIPIO.NO_MUNICIPIO = '".addslashes(trim($coluna["Localidade"]))."'
									  WHERE BAIRRO.NO_BAIRRO = '".addslashes(trim($coluna["BAI_INI"]))."'",$conexaoERP)
			or die("Consulta bairro: ".$coluna["Seq"]. "ERRO MySQL: ".mysql_error());
			$rowBairro=mysql_fetch_array($sqlBairro);
			
			$logradouro = $coluna["LOGRADOURO"]." ".addslashes(trim($coluna["Nome"]));
			
			mysql_query("INSERT INTO tb_cep (CO_BAIRRO, NU_CEP, NO_LOGRADOURO) 
			             VALUES ('".$rowBairro['CO_BAIRRO']."','".$coluna["CEP"]."' ,'".$logradouro."')")
			or die("Insere cep: ".$coluna["CEP"]." ERRO MySQL: ".mysql_error());
			
		}
		
	}
		
?>