<?php

	//CONECTA COM O BANCO DE DADOS LOCAL
	$conexaoBravo = mysql_connect("localhost","root","")
	or die (mysql_error());
	
	//SELECIONA O BANCO DE DADOS LOCAL
	$dbBravo = mysql_select_db("inventario")
	or die ("<script>
			     alert('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.close()';
			 </script>");
	
?>