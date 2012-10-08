<?php

	header('Content-type: text/html; charset=UTF-8');

	require("../setup.php");

	if(isset( $_REQUEST['query'] ) && $_REQUEST['query'] != ""){
    	$q = mysql_real_escape_string( $_REQUEST['query'] );
    	if(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "cliente"){
			$sqlCliente = mysql_query("SELECT CLIENTE.CO_CLIENTE
								              , CASE WHEN PESSOA.TP_PESSOA = 'F' THEN PESSOA_FISICA.CPF_PESSOA_FISICA
					       					         WHEN PESSOA.TP_PESSOA = 'J' THEN PESSOA_JURIDICA.CNPJ_PESSOA_JURIDICA
					       					         ELSE 'Erro'
				      					        END AS CPF_CNPJ_PESSOA
								              , PESSOA.NO_PESSOA
								  	   FROM tb_cliente CLIENTE
								           INNER JOIN tb_pessoa PESSOA
								  	           ON CLIENTE.CO_PESSOA = PESSOA.CO_PESSOA
								  	       LEFT JOIN tb_pessoa_fisica PESSOA_FISICA
							                   ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
								           LEFT JOIN tb_pessoa_juridica PESSOA_JURIDICA
								               ON PESSOA.CO_PESSOA = PESSOA_JURIDICA.CO_PESSOA
									   WHERE locate('".$q."',PESSOA.NO_PESSOA) > 0 ORDER BY locate('".$q."',PESSOA.NO_PESSOA) LIMIT 10");
			if(mysql_num_rows($sqlCliente) > 0){
	    		echo '<ul>'."\n";
	    		while($rowCliente=mysql_fetch_array($sqlCliente) ){
					$p = $rowCliente['NO_PESSOA'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowCliente['CO_CLIENTE'].'" rel="encontrou**'.$rowCliente['CO_CLIENTE'].'**' . $rowCliente['CPF_CNPJ_PESSOA'] . '">'.$p.'</li>'."\n";
	    		}
	    		echo '</ul>';
			}else{
				echo "<ul>\n";
				echo "\t<li id='autocomplete' rel='naoEcontrou'>".utf8_encode("<font class='FONT05'><b>Não encontrado!</b></font>")."</li>\n";
	    		echo "</ul>";
			}
    	}
	}

?>