<?php
 
$data=false;
require_once('../class/tcpdf/tcpdf.php');
require_once("../class/PHPJasperXML.inc.php");
//require_once("class/PHPJasperXMLSubReport.inc.php");
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';

date_default_timezone_set('America/Sao_Paulo');

$co_pcp_ad= $_GET['co_pcp_ad'];

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$server=DSN;
$db="extranet";
$user=USER;
$pass=PASS;
$version="0.8b";
$pgport=5432;
$pchartfolder="../class/pchart2";


$_etiqueta = new tb_pcp_etiqueta($conexaoERP);
$_etiqueta->proc_etiqueta_peca_pi($co_pcp_ad);

$xml =  simplexml_load_file("pcp_etiqueta_peca_pi.jrxml");
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("CO_PCP_AD"=>$co_pcp_ad);
$PHPJasperXML->xml_dismantle($xml);

//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db); * use this line if you want to connect with mysql

//if you want to use universal odbc connection, please create a dsn connection in odbc first
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

//$PHPJasperXML->outpage("F",APP_PATH.'barcodes'.DS.date("dmYhis").".pdf");    //page output method I:standard output  D:Download file
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file

$_etiqueta->limparTemporariaPiPcp();

$data=true;

?>
