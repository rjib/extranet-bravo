<?php
	
	//ARQUIVO DE CONEXAO E SELECAO DO BANCO DE DADOS
	require("../setup.php"); 
	
	//RECEBE PARAMETRO                     
	$pCidade = $_POST["cidade"];           
	
	//QUERY  
	$sql = mysql_query("SELECT CO_BAIRRO, NO_BAIRRO
						FROM tb_bairro
						WHERE CO_MUNICIPIO = ".$pCidade."  
						ORDER BY NO_BAIRRO")
		   or die ("<script>
			            alert('[Erro] - Consulta SQL.');
			            window.location = 'inicio.php';
			        </script>");       
	$row = mysql_num_rows($sql);    
	
	//VERIFICA SE VOLTOU ALGO 
	if($row) {                
	   //XML
	   $xml  = "<?xml version=\"1.0\"?>\n";
	   $xml .= "<bairros_lista>\n";               
   
   //PERCORRE ARRAY            
   for($i=0; $i<$row; $i++) {  
      $codigo    = mysql_result($sql, $i, "CO_BAIRRO"); 
	  $descricao = mysql_result($sql, $i, "NO_BAIRRO");
      $xml .= "<bairro>\n";     
      $xml .= "<codigo>".$codigo."</codigo>\n";                  
      $xml .= "<descricao>".ucfirst(strtolower($descricao))."</descricao>\n";         
      $xml .= "</bairro>\n";    
   }//FECHA FOR                 
   
   $xml.= "</bairros_lista>\n";
   
   //CABEÇALHO
   Header("Content-type: application/xml;"); 
}//FECHA IF (row)                                               

//PRINTA O RESULTADO  
echo $xml;            
?>