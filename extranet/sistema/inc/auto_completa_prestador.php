<?php

	header('Content-type: text/html; charset=UTF-8');

	require("../setup.php");

	if(isset( $_REQUEST['query'] ) && $_REQUEST['query'] != ""){
    	$q = mysql_real_escape_string( $_REQUEST['query'] );
    	if(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "consultor"){
			$sqlConsultor = mysql_query("SELECT
										  PRESTADOR.CO_PRESTADOR
										  , CONCAT (PESSOA.no_pessoa,' [',(SELECT no_pessoa FROM tb_pessoa WHERE co_pessoa = JURIDICA.co_pessoa),'] ') NO_PESSOA
										  , FISICA.CPF_PESSOA_FISICA
										FROM tb_pessoa PESSOA
										INNER JOIN tb_prestador_servico PRESTADOR ON
										PRESTADOR.co_pessoa = PESSOA.co_pessoa
										INNER JOIN tb_pessoa_juridica JURIDICA ON
										JURIDICA.co_pessoa_juridica = PRESTADOR.co_pessoa_juridica
										INNER JOIN tb_pessoa_fisica FISICA ON
										FISICA.co_pessoa = PESSOA.co_pessoa
					WHERE locate('".$q."',PESSOA.NO_PESSOA) > 0 ORDER BY locate('".$q."',PESSOA.NO_PESSOA) LIMIT 4");
			if(mysql_num_rows($sqlConsultor) > 0){
	    		echo '<ul>'."\n";
	    		while($rowConsultor = mysql_fetch_array($sqlConsultor) ){
					$p = $rowConsultor['NO_PESSOA'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowConsultor['CO_PRESTADOR'].'" rel="encontrou**'.$rowConsultor['CO_PRESTADOR'].'**' . $rowConsultor['CPF_PESSOA_FISICA'] . '">'.$p.'</li>'."\n";
	    		}
	    		echo '</ul>';
			}else{
				echo "<ul>\n";
				echo "\t<li id='autocomplete' rel='naoEcontrou'>".utf8_encode("<font class='FONT05'><b>N&atilde;o encontrado!</b></font>")."</li>\n";
	    		echo "</ul>";
			}
    	}
	}

?>