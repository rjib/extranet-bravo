<?php

	header('Content-type: text/html; charset=UTF-8');
	
	session_start();
	
	require("../setup.php");
	
	if(empty($_POST["codigoPessoa"])){
		$codigoPessoa = $_SESSION['codigoPessoa'];
	}else{
		$codigoPessoa = $_POST["codigoPessoa"];
	}

	if(isset( $_REQUEST['query'] ) && $_REQUEST['query'] != ""){
    	$q = mysql_real_escape_string( $_REQUEST['query'] );
    	if(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "contato"){
			$sqlContato = mysql_query("SELECT CO_CONTATO
									      , NO_CONTATO
									  FROM tb_contato
									  WHERE CO_PESSOA = '".$codigoPessoa."' AND locate('".$q."',NO_CONTATO) > 0 ORDER BY locate('".$q."',NO_CONTATO) LIMIT 10");
			if(mysql_num_rows($sqlContato) > 0){
	    		echo '<ul>'."\n";
	    		while($rowContato = mysql_fetch_array($sqlContato) ){
					$p = $rowContato['NO_CONTATO'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowContato['CO_CONTATO'].'" rel="encontrou**'.$rowContato['CO_CONTATO'].'">'.$p.'</li>'."\n";
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