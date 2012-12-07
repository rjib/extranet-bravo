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
    	if(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "empresa"){
			$sqlEmpresa = mysql_query("SELECT 
										    PESSOA.NO_PESSOA, 
											JURIDICA.CNPJ_PESSOA_JURIDICA,
											PESSOA.CO_PESSOA
										FROM
										    tb_pessoa PESSOA
										        INNER JOIN
										    tb_pessoa_juridica JURIDICA ON PESSOA.co_pessoa = JURIDICA.co_pessoa
										WHERE
										    PESSOA.tp_pessoa = 'J' AND PESSOA.NO_PESSOA LIKE '".$q."%' LIMIT 4");
			if(mysql_num_rows($sqlEmpresa) > 0){
	    		echo '<ul>'."\n";
	    		while($rowEmpresa = mysql_fetch_array($sqlEmpresa) ){
					$p = $rowEmpresa['NO_PESSOA'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowEmpresa['CO_PESSOA'].'" rel="encontrou**'.$rowEmpresa['CO_PESSOA'].'">'.$p.'</li>'."\n";
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