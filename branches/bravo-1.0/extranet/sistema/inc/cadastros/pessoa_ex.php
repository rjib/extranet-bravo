<?php

session_start();

require("../../setup.php");

$codigoPessoa = $_GET["codigoPessoa"];
$sql1 = "delete from tb_contato where co_pessoa = $codigoPessoa";
$sql2 = "delete from tb_telefone where co_pessoa = $codigoPessoa";
$sql3 = "delete from tb_colaborador where co_pessoa = $codigoPessoa";

$sql4 = "delete from tb_endereco where co_pessoa = $codigoPessoa";
$sql5 = "delete from tb_prestador_servico where co_pessoa = $codigoPessoa";
$sql6 = "delete from tb_pessoa where co_pessoa = $codigoPessoa";
		

$queryPessoa = mysql_query($sql1,$conexaoERP);
$queryPessoa = mysql_query($sql2,$conexaoERP);
$queryPessoa = mysql_query($sql3,$conexaoERP);
$queryPessoa = mysql_query($sql4,$conexaoERP);
$queryPessoa = mysql_query($sql5,$conexaoERP);
$queryPessoa = mysql_query($sql6,$conexaoERP);

if($queryPessoa){
	echo false;
}else{
	echo "[Erro] - Não foi possível excluir a Pessoa no momento.";
}
	
?>