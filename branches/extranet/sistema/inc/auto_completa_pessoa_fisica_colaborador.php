<?php

	header('Content-type: text/html; charset=UTF-8');

	require("../setup.php");

	if(isset( $_REQUEST['query'] ) && $_REQUEST['query'] != ""){
    	$q = mysql_real_escape_string( $_REQUEST['query'] );
    	if(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "pessoa"){
			$sqlPessoa = mysql_query("SELECT PESSOA.CO_PESSOA
									      , PESSOA.NO_PESSOA
										  , PESSOA_FISICA.CPF_PESSOA_FISICA
									  FROM tb_pessoa PESSOA
									      INNER JOIN tb_pessoa_fisica PESSOA_FISICA
										      ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
									  WHERE NOT EXISTS(SELECT null FROM tb_colaborador COLABORADOR WHERE PESSOA.CO_PESSOA = COLABORADOR.CO_PESSOA) 
									  AND locate('".$q."',NO_PESSOA) > 0 ORDER BY locate('".$q."',NO_PESSOA) LIMIT 10");
			if(mysql_num_rows($sqlPessoa) > 0){
	    		echo '<ul>'."\n";
	    		while($rowPessoa = mysql_fetch_array($sqlPessoa) ){
					$p = $rowPessoa['NO_PESSOA'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowPessoa['CO_PESSOA'].'" rel="encontrou**'.$rowPessoa['CO_PESSOA'].'**' . $rowPessoa['CPF_PESSOA_FISICA'] . '">'.$p.'</li>'."\n";
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