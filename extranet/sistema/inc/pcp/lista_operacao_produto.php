<?php
	
	require("../../setup.php"); 

	$sql = mysql_query("SELECT CO_PCP_OPERACAO
						    , CO_OPERACAO
						    , DS_OPERACAO
						FROM tb_pcp_operacao
						WHERE CO_PRODUTO = '".$_POST['codigoProduto']."'
						AND FL_DELET IS NULL
						ORDER BY CO_OPERACAO")
	or die ("<script>
			     alert('[Erro] - Consulta SQL.');
			     window.location = 'inicio.php';
			 </script>");       
	$row = mysql_num_rows($sql);    
	
    if($row){                
	    
		$xml  = "<?xml version=\"1.0\"?>\n";
	    $xml .= "<contato_lista>\n";               
   
       for($i=0; $i<$row; $i++){  
           $codigo = mysql_result($sql, $i, "CO_PCP_OPERACAO"); 
	       $nome   = "[".mysql_result($sql, $i, "CO_OPERACAO")."] - ".mysql_result($sql, $i, "DS_OPERACAO");
           $xml .= "<contato>\n";     
           $xml .= "<codigo>".$codigo."</codigo>\n";                  
           $xml .= "<nome>".ucfirst($nome)."</nome>\n";         
           $xml .= "</contato>\n";    
       }
   
       $xml.= "</contato_lista>\n";
   
       Header("Content-type: application/xml;"); 

    } 

    echo $xml;            

?>