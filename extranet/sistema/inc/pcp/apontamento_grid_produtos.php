<?php
	
	session_start();

    require("../../setup.php");	
	
	echo "<table width='960' border='0' cellpadding='3' cellspacing='2' class='LISTA'>";                        
	echo "<thead>";
	echo "<tr>";
	echo "<th width='30'>Seq.</th>";
	echo "<th width='70' align='left'>OP</th>";
	echo "<th width='50' align='left'>Cód. Int.</th>";
	echo "<th width='90' align='left'>Código</th>";
	echo "<th align='left'>Produto</th>";
	echo "<th width='140' align='left'>Operação</th>";
	echo "<th width='80' align='left'>Data Emissão</th>";
	echo "<th width='60' align='left'>Lote</th>";
	echo "<th width='40' align='center'>Ação</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	if($_SESSION['jobOrdemProducaoImporta']){
		
		$chave = @array_keys($_SESSION['jobOrdemProducaoImporta']);
		for($i = 0; $i < sizeof($chave); $i++){ 
		
			$indice = $chave[$i];	
			$seq = $i+1;
					 
			$sqlOperacao = mysql_query("SELECT CO_PCP_OPERACAO
										    , CO_OPERACAO
										    , DS_OPERACAO
										FROM tb_pcp_operacao
										WHERE CO_PRODUTO = '".$_SESSION['jobOrdemProducaoImporta'][$indice]['CO_PRODUTO']."'
										AND FL_DELET IS NULL
										ORDER BY CO_OPERACAO")
			or die("<script>
						alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
						history.back(-1);
					</script>"); 
			 
			echo "<tr>";
			echo "<td>".$seq."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['NUM_OP']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['CO_INT_PRODUTO']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['CO_PRODUTO']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['DS_PRODUTO']."</td>";
			echo "<td>";
			
			echo "<select title='Operação' name='codigoOperacao[]' id='codigoOperacao[]' class='SELECT01' style='width:140px'>";
		    echo "<option value='0'>Selecione...</option>";
		    while($rowOperacao=mysql_fetch_array($sqlOperacao)){ 	
                echo "<option value='".$rowOperacao['CO_PCP_OPERACAO']."'>".$rowOperacao['CO_OPERACAO']." - ".$rowOperacao['DS_OPERACAO']."</option>";
            }	
            echo "</select>";
				  
			echo "</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['DT_EMISSAO']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['NU_LOTE']."</td>";
			echo "<td align='center'><a title='Excluir' href='inicio.php?pg=apontamento_job&op=excluir&check=".$indice."'><img src='img/btn/btn_excluir.gif' width='25' height='19' border='0' /></a></td>";
			echo "</tr>";     
		}
		
	}else{
	    echo "<tr>";
		echo "<th align='center' colspan='9'><font class='FONT05'><b>Por favor informe um Job!</b></font></td>";
		echo "</tr>";     
	}
	echo "</tbody>";
	echo "</table>";

?>			