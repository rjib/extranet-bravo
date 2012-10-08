<?php

	header('Content-type: text/html; charset=UTF-8');
	
	session_start();
	
	require("../setup.php");

	if(isset( $_REQUEST['query'] ) && $_REQUEST['query'] != ""){
    	$q = mysql_real_escape_string( $_REQUEST['query'] );
    	if(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "numeroCep"){
			$sqlCep = mysql_query("SELECT CEP.CO_CEP 
								       , CEP.NU_CEP
								       , CEP.NO_LOGRADOURO
								       , BAIRRO.NO_BAIRRO
								       , MUNICIPIO.NO_MUNICIPIO
								       , UF.SG_UF
								   FROM tb_cep CEP
								       INNER JOIN tb_bairro BAIRRO
								           ON CEP.CO_BAIRRO = BAIRRO.CO_BAIRRO
								       INNER JOIN tb_municipio MUNICIPIO
								           ON BAIRRO.CO_MUNICIPIO = MUNICIPIO.CO_MUNICIPIO
								       INNER JOIN tb_uf UF
								           ON MUNICIPIO.CO_UF = UF.CO_UF
								   WHERE locate('".$q."',CEP.NU_CEP) > 0 ORDER BY locate('".$q."',CEP.NU_CEP) LIMIT 10");
			if(mysql_num_rows($sqlCep) > 0){
	    		echo '<ul>'."\n";
	    		while($rowCep = mysql_fetch_array($sqlCep) ){
					$p = $rowCep['NU_CEP']." - ".$rowCep['NO_LOGRADOURO']." - ".$rowCep['NO_MUNICIPIO']." - ".$rowCep['SG_UF'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowCep['CO_CEP'].'" rel="encontrou**'.$rowCep['CO_CEP'].'**'.$rowCep['NU_CEP'].'**'.$rowCep['NO_LOGRADOURO'].'**'.$rowCep['NO_BAIRRO'].'**'.$rowCep['SG_UF'].'**'.$rowCep['NO_MUNICIPIO']. '">'.$p.'</li>'."\n";
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