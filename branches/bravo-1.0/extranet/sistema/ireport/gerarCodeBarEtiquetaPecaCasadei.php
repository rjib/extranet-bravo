<?php 
date_default_timezone_set('America/Sao_Paulo');
require_once('GerarCodigoDeBarra128.class.php');
require_once('../setup.php');
require_once '../models/tb_pcp_etiqueta.php';


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

function gerar($nu_op){
	date_default_timezone_set('America/Sao_Paulo');
	require_once('GerarCodigoDeBarra128.class.php');
	require_once('../setup.php');
	require_once '../models/tb_pcp_etiqueta.php';
	require_once '../models/tb_pcp_pecas.php';
	
	$_barCasaDei = new GerarCodigoDeBarra128();

	try {
		$_barCasaDei->gerar($nu_op, APP_PATH.'barcodes'.DS.'casadei_'.$nu_op.'.gif',10,0,75,40,20,1,180,150,50,300,300);
		
	}catch (Exception $e){
		$data=false;
		echo json_encode($data);
		exit;

	}
	$data=true;
}

$co_pcp_apontamento = $_POST['co_pcp_apontamento'];
$row = $_etiqueta->getOPFind($co_pcp_apontamento);
$nu_op = $row[0];
gerar($nu_op);
$data=true;
//echo json_encode($data);
?>