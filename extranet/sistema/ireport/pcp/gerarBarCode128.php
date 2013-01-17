<?php 
session_start();
date_default_timezone_set('America/Sao_Paulo');
require_once('../GerarCodigoDeBarra128.class.php');
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';
require_once '../../models/tb_pcp_pecas.php';

$_etiqueta = new tb_pcp_etiqueta($conexaoERP);
$_barcode128 = new GerarCodigoDeBarra128();
$_peca = new tb_pcp_pecas($conexaoERP);

/**
 * Metodo para criar e salvar o codigo de barra no diretorio
 * @author Ricardo S. Alvarenga
 * @since 19/12/2012
 * @param int $co_pcp_ac codigo do ac
 *
 */
$data=false;

function gerar($co_pcp_ac,$co_usuario){
	date_default_timezone_set('America/Sao_Paulo');
	require_once('../GerarCodigoDeBarra128.class.php');
	require_once('../../setup.php');
	require_once '../../models/tb_pcp_etiqueta.php';
	require_once '../../models/tb_pcp_pecas.php';
	
	$_etiqueta = new tb_pcp_etiqueta(CONEXAOERP);
	$_barcode128 = new GerarCodigoDeBarra128();
	$_peca = new tb_pcp_pecas(CONEXAOERP);

	$result = $_etiqueta->listaCodigoBarra($co_pcp_ac);
	try {
		while ($dados = mysql_fetch_array($result)){
			$_barcode128->gerar($dados["NU_PCP_OP"], APP_PATH.'barcodes'.DS.$co_usuario.'_'.$dados['NU_PCP_OP'].'.gif',10,10,125,275,30,2,180,300,300,300,300);
		}
	}catch (Exception $e){
		$data=false;
		echo json_encode($data);
		exit;

	}
	$data=true;
}

$co_pcp_ad = $_POST['co_pcp_ad'];

try {
	$result    	   = $_peca->findPecasByAD($co_pcp_ad);
	$dados 		   = mysql_fetch_array($result);
}catch (Exception $e){
	$data=false;
	echo json_encode($data);
	exit;
}

$co_pcp_ac	   = $dados['CO_PCP_AC'];
$co_usuario = $_SESSION['codigoUsuario'];

gerar($co_pcp_ac,$co_usuario);
$data=true;
//echo json_encode($data);
?>

