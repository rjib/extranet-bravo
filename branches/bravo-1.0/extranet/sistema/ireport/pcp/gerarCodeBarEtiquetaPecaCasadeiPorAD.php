<?php 
date_default_timezone_set('America/Sao_Paulo');
require_once('../GerarCodigoDeBarra128.class.php');
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';


$_etiqueta = new tb_pcp_etiqueta($conexaoERP);
$_barcode128 = new GerarCodigoDeBarra128();

/**
 * Metodo para criar e salvar o codigo de barra no diretorio
 * @author Ricardo S. Alvarenga
 * @since 09/01/2013
 * @param int $co_pcp_ac codigo do ac
 *
 */
$data=false;

function gerar($co_pcp_ad){
	date_default_timezone_set('America/Sao_Paulo');
	require_once('../GerarCodigoDeBarra128.class.php');
	require_once('../../setup.php');
	require_once '../../models/tb_pcp_etiqueta.php';
	require_once '../../models/tb_pcp_pecas.php';
	require_once '../../models/tb_pcp_ad_peca.php';
	
	$_adPeca = new tb_pcp_ad_peca(CONEXAOERP);
	
	$_barCasaDei = new GerarCodigoDeBarra128();
	
	$result = $_adPeca->getOPbyAD($co_pcp_ad);
	while ($dados = mysql_fetch_array($result)){
		$nu_op = $dados[0];
		try {
			$_barCasaDei->gerar($nu_op, APP_PATH.'barcodes'.DS.'pcp_casadei_'.$nu_op.'.gif',10,0,75,40,20,1,180,150,50,300,300);
			
		}catch (Exception $e){
			$data=false;
			echo json_encode($data);
			exit;
	
		}
	}
	$data=true;
}

$co_pcp_ad = $_POST['co_pcp_ad'];
gerar($co_pcp_ad);
$data=true;
//echo json_encode($data);
?>