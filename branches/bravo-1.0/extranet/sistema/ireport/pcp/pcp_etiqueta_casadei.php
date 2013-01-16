<?php 
$data=false;
require_once('../class/tcpdf/tcpdf.php');
require_once("../class/PHPJasperXML.inc.php");
//require_once("class/PHPJasperXMLSubReport.inc.php");
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
require_once APP_PATH.'sistema/models/tb_pcp_ad_peca.php';

date_default_timezone_set('America/Sao_Paulo');

$_peca 	           = new tb_pcp_pecas($conexaoERP);
$co_pcp_ad= $_GET['co_pcp_ad'];
$onde			= $_GET['onde']; //de onde esta vindo



error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$server="localhost";
$db="extranet";
$user="root";
$pass="";
$version="0.8b";
$pgport=5432;
$pchartfolder="../class/pchart2";
$timestamp = date("dmY").date("his");

$_etiqueta = new tb_pcp_etiqueta($conexaoERP);
$_adPeca = new tb_pcp_ad_peca($conexaoERP);
$_etiqueta->proc_etiqueta_casadei_pcp($co_pcp_ad);


$xml =  simplexml_load_file("pcp_etiqueta_casadei.jrxml");
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("co_pcp_ad"=>$co_pcp_ad, "PATH"=>APP_PATH.'barcodes'.DS);
$PHPJasperXML->xml_dismantle($xml);

//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db); * use this line if you want to connect with mysql

//if you want to use universal odbc connection, please create a dsn connection in odbc first
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

//$PHPJasperXML->outpage("F",APP_PATH.'barcodes'.DS.date("dmYhis").".pdf");    //page output method I:standard output  D:Download file
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file

$_etiqueta->limparTemporaria();
$result = $_adPeca->getOPbyAD($co_pcp_ad);
while($dados = mysql_fetch_array($result)){
//APP_PATH.'barcodes'.DS.'casadei_'.$nu_op.'.gif'
	unlink(APP_PATH.'barcodes'.DS.'pcp_casadei_'.$dados[0].'.gif');
}

$data=true;

?>