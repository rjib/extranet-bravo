<?php

	header('Content-type: text/html; charset=UTF-8');

	require("../setup.php");

	if(isset( $_REQUEST['query'] ) && $_REQUEST['query'] != ""){
    	$q = mysql_real_escape_string( $_REQUEST['query'] );
    	if(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "colaborador"){
			$sqlColaborador = mysql_query("SELECT COLABORADOR.CO_COLABORADOR
									           , PESSOA.NO_PESSOA
										       , PESSOA_FISICA.CPF_PESSOA_FISICA
									       FROM tb_colaborador COLABORADOR
									           INNER JOIN tb_pessoa PESSOA
										           ON COLABORADOR.CO_PESSOA = PESSOA.CO_PESSOA
									           INNER JOIN tb_pessoa_fisica PESSOA_FISICA
										           ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
									       WHERE locate('".$q."',NO_PESSOA) > 0 ORDER BY locate('".$q."',NO_PESSOA) LIMIT 10");
			if(mysql_num_rows($sqlColaborador) > 0){
	    		echo '<ul>'."\n";
	    		while($rowColaborador = mysql_fetch_array($sqlColaborador) ){
					$p = $rowColaborador['NO_PESSOA'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowColaborador['CO_COLABORADOR'].'" rel="encontrou**'.$rowColaborador['CO_COLABORADOR'].'**' . $rowColaborador['CPF_PESSOA_FISICA'] . '">'.$p.'</li>'."\n";
	    		}
	    		echo '</ul>';
			}else{
				echo "<ul>\n";
				echo "\t<li id='autocomplete' rel='naoEcontrou'>".utf8_encode("<font class='FONT05'><b>Não encontrado!</b></font>")."</li>\n";
	    		echo "</ul>";
			}
    	}elseif(isset( $_REQUEST['identifier'] ) && $_REQUEST['identifier'] == "colaboradorUsuario"){
			$sqlColaborador = mysql_query("SELECT COLABORADOR.CO_COLABORADOR
									           , PESSOA.NO_PESSOA
										       , PESSOA_FISICA.CPF_PESSOA_FISICA
									       FROM tb_colaborador COLABORADOR
									           INNER JOIN tb_pessoa PESSOA
										           ON COLABORADOR.CO_PESSOA = PESSOA.CO_PESSOA
									           INNER JOIN tb_pessoa_fisica PESSOA_FISICA
										           ON PESSOA.CO_PESSOA = PESSOA_FISICA.CO_PESSOA
									       WHERE NOT EXISTS (SELECT null FROM tb_usuario USUARIO WHERE USUARIO.CO_COLABORADOR = COLABORADOR.CO_COLABORADOR)
										   AND locate('".$q."',NO_PESSOA) > 0 ORDER BY locate('".$q."',NO_PESSOA) LIMIT 10");
			if(mysql_num_rows($sqlColaborador) > 0){
	    		echo '<ul>'."\n";
	    		while($rowColaborador = mysql_fetch_array($sqlColaborador) ){
					$p = $rowColaborador['NO_PESSOA'];
					$p = preg_replace('/('.$q.')/i', '<span style="font-weight:bold; color: #990000;">$1</span>', $p);
					echo "\t".'<li id="autocomplete_'.$rowColaborador['CO_COLABORADOR'].'" rel="encontrou**'.$rowColaborador['CO_COLABORADOR'].'**' . $rowColaborador['CPF_PESSOA_FISICA'] . '">'.$p.'</li>'."\n";
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