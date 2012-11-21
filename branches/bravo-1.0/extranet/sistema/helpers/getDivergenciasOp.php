<?php
require_once '../setup.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';
require_once APP_PATH.'sistema/models/tb_pcp_cor.php';
require_once APP_PATH.'sistema/helper.class.php';


$divergencias = $_POST['divergencias'];

$_opModel = new tb_pcp_op($conexaoERP);

$loopTr = '';
$dialog = '';
$co_pcp_ad = $_POST['nomeArquivo'].'.ad';
$row = $_opModel->getDivergencias($divergencias);
while ($dados = mysql_fetch_array($row)){
$loopTr.= "<tr>";
	$loopTr.= "<td>".$dados['co_int_produto']."</td>";
					$loopTr.= "<td>".$dados['ds_produto']."</td>";
					$loopTr.= "<td>".$dados['qtd_produto']."</td>";
					$loopTr.= "<td>".$dados['nu_lote']."</td>";
					$loopTr.= "</tr>";
}
?>
<div id='boxDivergencia'>
	<b style='color: red;'>Atenção!</b> Os produtos abaixo não foram
	encontrados no plano de corte <strong style="text-decoration: underline;"><?php echo $co_pcp_ad?></strong> o sistema
	automáticamente ira marcar estes produtos como processados na lista de
	PIs.
	<div id='gridInternoDivergencia' style='margin-top: 10px'>
		<table align='center' style='margin-bottom: 5px; width: 600px;'>
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
	</div>
</div>