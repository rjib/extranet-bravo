<?php
	
	session_start();

    require("../../setup.php");	
	
	echo "<table width='960' border='0' cellpadding='3' cellspacing='2' class='LISTA'>";                        
	echo "<thead>";
	echo "<tr>";
	echo "<th width='30'>Seq.</th>";
	echo "<th width='100' align='left'>OP</th>";
	echo "<th width='60' align='left'>Cód. Int.</th>";
	echo "<th width='100' align='left'>Código</th>";
	echo "<th align='left'>Produto</th>";
	echo "<th width='80' align='left'>Data Emissão</th>";
	echo "<th width='60' align='left'>Lote</th>";
	echo "<th width='50' align='center'>Ação</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";
	
	if($_SESSION['jobOrdemProducaoImporta']){
		
		$chave = @array_keys($_SESSION['jobOrdemProducaoImporta']);
		for($i = 0; $i < sizeof($chave); $i++){ 
		
			$indice = $chave[$i];	
			$seq = $i+1;
			
			echo "<tr>";
			echo "<td>".$seq."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['NUM_OP']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['CO_INT_PRODUTO']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['CO_PRODUTO']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['DS_PRODUTO']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['DT_EMISSAO']."</td>";
			echo "<td>".$_SESSION['jobOrdemProducaoImporta'][$indice]['NU_LOTE']."</td>";
			echo "<td align='center'><a title='Excluir' href='inicio.php?pg=apontamento_job&op=excluir&check=".$indice."'><img src='img/btn/btn_excluir.gif' width='25' height='19' border='0' /></a></td>";
			echo "</tr>";     
		}
	}else{
	    echo "<tr>";
		echo "<th align='center' colspan='8'><font class='FONT05'><b>Por favor informe um Job!</b></font></td>";
		echo "</tr>";     
	}
	echo "</tbody>";
	echo "</table>";

?>			