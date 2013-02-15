<?php 
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once('../GerarCodigoDeBarra128.class.php');
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';


$_etiqueta = new tb_pcp_etiqueta($conexaoERP);
$_barcode128 = new GerarCodigoDeBarra128();



$data=false;

function gerar($job,$co_usuario){
	date_default_timezone_set('America/Sao_Paulo');
	require_once('../GerarCodigoDeBarra128.class.php');
	require_once('../../setup.php');
	require_once '../../models/tb_pcp_etiqueta.php';
	require_once '../../models/tb_pcp_pecas.php';
	require_once '../../models/tb_pcp_ad_peca.php';
	
	
	$_barCasaDei = new GerarCodigoDeBarra128();
	$_adPeca 	 = new tb_pcp_ad_peca(CONEXAOERP);
	
	$result = $_adPeca->getOrdemProducaoPorJob($job);
	
	while ($dados = mysql_fetch_array($result)){
		$nu_op = $dados[4];
		try {
			$_barCasaDei->gerar($nu_op, APP_PATH.'barcodes'.DS.$co_usuario.'_relatorio_casadei_'.$nu_op.'.gif',10,0,75,40,20,1,180,150,50,300,300);

		}catch (Exception $e){
			$data=false;
			echo json_encode($data);
			exit;

		}
	}
	$data=true;
}
$co_usuario = $_SESSION['codigoUsuario'];
$job = $_POST['no_pcp_ad'];
gerar($job,$co_usuario);
$data=true;
?>