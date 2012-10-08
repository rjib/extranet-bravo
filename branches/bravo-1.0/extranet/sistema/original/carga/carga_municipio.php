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
	
	$execute = odbc_exec($conexao,"SELECT * from Cidade");
	
	while($coluna = odbc_fetch_array($execute)){
		
		$sqlUF = mysql_query("SELECT CO_UF FROM tb_uf WHERE SG_UF = '".addslashes(trim($coluna["UF"]))."'",$conexaoERP)
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
		$rowUF=mysql_fetch_array($sqlUF);
		
		mysql_query("INSERT INTO tb_municipio (CO_MUNICIPIO, CO_UF, NO_MUNICIPIO) 
			         VALUES ('".addslashes(trim($coluna["Seq"]))."','".addslashes(trim($rowUF['CO_UF']))."' ,'".addslashes(trim($coluna["Nome"]))."')");
		
    }
	
?>