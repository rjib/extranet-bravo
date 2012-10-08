<?php
	
	//ARQUIVO DE CONEXAO E SELECAO DO BANCO DE DADOS
	require("../setup.php"); 
	
	//RECEBE PARAMETRO                     
	$pEstado = $_POST["estado"];           
	
	//QUERY  
	$sql = mysql_query("SELECT CO_MUNICIPIO, NO_MUNICIPIO
						FROM tb_municipio
						WHERE CO_UF = ".$pEstado."  
						ORDER BY NO_MUNICIPIO")
		   or die ("<script>
			            alert('[Erro] - Consulta SQL.');
			            window.location = 'inicio.php';
			        </script>");       
	$row = mysql_num_rows($sql);    
	
	//VERIFICA SE VOLTOU ALGO 
	if($row) {                
	   //XML
	   $xml  = "<?xml version=\"1.0\"?>\n";
	   $xml .= "<cidades_lista>\n";               
   
   //PERCORRE ARRAY            
   for($i=0; $i<$row; $i++) {  
      $codigo    = mysql_result($sql, $i, "CO_MUNICIPIO"); 
	  $descricao = mysql_result($sql, $i, "NO_MUNICIPIO");
      $xml .= "<cidade>\n";     
      $xml .= "<codigo>".$codigo."</codigo>\n";                  
      $xml .= "<descricao>".ucfirst(strtolower($descricao))."</descricao>\n";         
      $xml .= "</cidade>\n";    
   }//FECHA FOR                 
   
   $xml.= "</cidades_lista>\n";
   
   //CABEÇALHO
   Header("Content-type: application/xml;"); 
}//FECHA IF (row)                                               

//PRINTA O RESULTADO  
echo $xml;            
?>