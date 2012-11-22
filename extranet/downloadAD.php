<?php
/**
 * Arquivo responsavel em enviar para cliente o arquivo AD
 * @author Ricardo S. Alvarenga
 * @since 25/11/2012
 * */
session_start();

require_once 'sistema/setup.php';
require_once APP_PATH.'sistema/helper.class.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad.php';


require_once 'sistema/models/tb_modulos.php';


$co_papel = $_SESSION['codigoPapel'];
$modulos = new tb_modulos($conexaoERP);
$acoes = $modulos->possuiPermissaoParaEstaArea($co_papel, PCP, PCP_IMPORTAR_PLANO_DE_CORTE_OPTISAVE);

if($acoes['NO_MODULO'] == PCP_IMPORTAR_PLANO_DE_CORTE_OPTISAVE){

$nome = (int)$_GET['arquivo'];
$ano = (int)$_GET['ano'];
$link = 'http://localhost/extranet-bravo/extranet/arquivosAD/'.$ano.DS.$nome.'.ad';

	header ("Content-Disposition: attachment; filename=".$nome.".ad");
	header ("Content-Type: txt/plain");
	readfile($link);
	

}else{
	header('location:index.php');

}
?>