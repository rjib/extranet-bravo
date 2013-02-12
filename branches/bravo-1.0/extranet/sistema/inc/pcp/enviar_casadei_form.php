<?php
require_once '../../setup.php';
require_once APP_PATH.'sistema/models/tb_pcp_op.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad_peca.php';


$_opModel = new tb_pcp_op($conexaoERP);
$_pecaAd	 = new tb_pcp_ad_peca($conexaoERP);

$loopTr = '';
$dialog = '';
$co_pcp_ad = $_POST['co_pcp_ad'];
$no_pcp_ad  = $_POST['no_pcp_ad'];

$ops    = $_pecaAd->getCodigoOP($co_pcp_ad);
while ($rows = mysql_fetch_array($ops)){ //lista de ordens de producao
	
	$result1   = $_opModel->getCoProduto($rows['CO_PCP_OP']);
	$dados     = $_opModel->getParametrosCasadei($rows['CO_PCP_OP'], $result1['CO_PRODUTO']);
	
	$dif = $dados['QTD_PRODUTO'] - $dados['QTD_PROCESSADA'];
	
	$loopTr.= "<tr>";
	$loopTr.= "<td>".$dados['CO_INT_PRODUTO']."</td>";
	$loopTr.= "<td>".$dados['DS_PRODUTO']."</td>";
	$loopTr.= "<td>".$dados['QTD_PRODUTO']."</td>";
	$loopTr.= "<td>".$dados['QTD_PROCESSADA']."</td>";
	$loopTr.= "<td><input class='bg_yellow' id=".$dados['CO_PCP_OP']." name='quantidadeCasadei[]' type='text' value='".$dif."' size='5' maxlength='5' /></td>";
	$loopTr.= "<td>".$dados['QTD_PRODUZIDA']."</td>";
	$loopTr.= "<td>".$dados['NU_LOTE']."</td>";
	$loopTr.= "</tr>";
}
?>
<script type="text/javascript">
//input[type=checkbox][name='pi_selecionado[]']:checked
//$("#qtd_processar").keyup(function() {
	 //var valor = $("#qtd_processar").val().replace(/[^0-9]+/g,'');
	// $("#qtd_processar").val(valor);
//});
</script>

<div id='boxQuantidadeCasadei'>
	<span style="text-align: center;"><b style='color: red;'>Atenção!</b> Favor informar quantidade a produzir na CasaDei, uma vez confirmada a operação, o processo não poderá ser desfeito.</span>
	<div id='gridInternoDivergencia' style='margin-top: 10px'>
		<table align='center' class="LISTA tablesorter" style='margin-bottom: 5px; width: 750px;'>
			<thead align='left' >
				<tr>
					<th width='15%'>Cód. Interno</th>
					<th width='50%'>Desc. Prod.</th>
					<th width='4%'>Qtd. Necessária</th>
					<th width='4%'>Qtd. Processada</th>
					<th width='4%'>Qtd. á Produzir</th>
					<th width='4%'>Qtd. Produzida</th>
					<th width='22%'>Lote</th>
				</tr>
			</thead>
			<tbody align='left'><?php echo $loopTr ?></tbody>
		</table>
		<input type="hidden" id="co_ad" value="<?php echo $co_pcp_ad; ?>" />
		<input type="hidden" id="no_ad" value="<?php echo $no_pcp_ad; ?>" />
	</div>
</div>
