<?php 
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once('../GerarCodigoDeBarra128.class.php');
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';


$_etiqueta = new tb_pcp_etiqueta($conexaoERP);
$_barcode128 = new GerarCodigoDeBarra128();


$data=false;

function gerar($nu_op,$co_usuario){
	date_default_timezone_set('America/Sao_Paulo');
	require_once('../GerarCodigoDeBarra128.class.php');
	require_once('../../setup.php');
	require_once '../../models/tb_pcp_etiqueta.php';
	require_once '../../models/tb_pcp_pecas.php';
	
	$_barCasaDei = new GerarCodigoDeBarra128();

	try {
		$_barCasaDei->gerar($nu_op, APP_PATH.'barcodes'.DS.$co_usuario.'_relatorio_casadei_'.$nu_op.'.gif',10,0,75,40,20,1,180,150,50,300,300);
		
	}catch (Exception $e){
		$data=false;
		echo json_encode($data);
		exit;

	}
	$data=true;
}
$co_usuario = $_SESSION['codigoUsuario'];
$nu_op = $_POST['nu_op'];
gerar($nu_op,$co_usuario);
$data=true;
//echo json_encode($data);
?>