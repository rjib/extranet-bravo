<?php
session_start();
include_once '../../../setup.php';
require_once '../../../models/tb_pcp_etiqueta.php';

if(isset($_POST["numeroJob"])){
	$job = $_POST["numeroJob"];

	$query = "SELECT 
				    AC_PECA.CO_INT_PRODUTO, PRODUTO.DS_PRODUTO, AC_PECA.QTD_PECAS, ORDEM_PRODUCAO.NU_LOTE, CONCAT (ORDEM_PRODUCAO.CO_NUM, ORDEM_PRODUCAO.CO_ITEM, ORDEM_PRODUCAO.CO_SEQUENCIA) OP
				FROM
				    TB_PCP_APONTAMENTO APONTAMENTO
				        INNER JOIN
				    TB_PCP_AC_PECA AC_PECA ON APONTAMENTO.CO_PCP_OP = AC_PECA.CO_PCP_OP
				        INNER JOIN
				    TB_PCP_OP ORDEM_PRODUCAO ON ORDEM_PRODUCAO.CO_PCP_OP = APONTAMENTO.CO_PCP_OP
				        INNER JOIN
				    TB_PCP_PRODUTO PRODUTO ON PRODUTO.CO_PRODUTO = ORDEM_PRODUCAO.CO_PRODUTO
				WHERE
				    AC_PECA.CO_PCP_AC = (SELECT 
				            AC.CO_PCP_AC
				        FROM
				            TB_PCP_AD AD
				                INNER JOIN
				            TB_PCP_AC AC ON AC.CO_PCP_AD = AD.CO_PCP_AD
				        WHERE
				            AD.NO_PCP_AD = ".$job.")
				        AND APONTAMENTO.HR_FIM IS NULL
				        AND APONTAMENTO.FL_APONTAMENTO = 2 
				        AND APONTAMENTO.FL_DELET IS NULL";

	$sqlJob = mysql_query($query, CONEXAOERP);

	if(mysql_num_rows($sqlJob) != 0){

		while($dados = mysql_fetch_array($sqlJob)){
			$loopTr.= "<tr>";
			$loopTr.= "<td>".$dados['CO_INT_PRODUTO']."</td>";
			$loopTr.= "<td>".$dados['DS_PRODUTO']."</td>";
			$loopTr.= "<td>".$dados['QTD_PECAS']."</td>";
			$loopTr.= "<td>".$dados['NU_LOTE']."</td>";
			$loopTr.= "</tr>";
		}
		?>
				
		<table class='LISTA' align='center' style='margin-bottom: 5px; width: 550px;'>
			<thead align='left' style='background-color: #E8E8E8;'>
				<tr>
					<th width='18%'>COD. INTERNO</th>
					<th width='65%'>PRODUTO</th>
					<th width='4%'>QTD.</th>
					<th width='22%'>LOTE</th>
				</tr>
			</thead>
			<tbody align='left'><?php echo $loopTr ?></tbody>
		</table>
		<input type="hidden" id="numeroJob" value="<?php echo $job;?>" />
		<?php 
	}else{
		?>
		<script>alert('Número de Job inválido!');</script>
		<?php 
	}
}
?>
