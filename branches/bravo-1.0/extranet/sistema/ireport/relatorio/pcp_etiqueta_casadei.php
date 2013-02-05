<?php 
session_start();
ini_set("max_execution_time",3600);
ini_set("memory_limit","50M");
set_time_limit(0);
$data=false;
require_once('../class/tcpdf/tcpdf.php');
require_once("../class/PHPJasperXML.inc.php");
//require_once("class/PHPJasperXMLSubReport.inc.php");
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';

date_default_timezone_set('America/Sao_Paulo');

$_peca 	           = new tb_pcp_pecas($conexaoERP);
$nu_op			   = $_GET['nu_op'];

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$server="localhost";
$db="extranet";
$user="root";
$pass="";
$version="0.8b";
$pgport=5432;
$pchartfolder="../class/pchart2";
$timestamp = date("dmY").date("his");
$co_usuario = $_SESSION['codigoUsuario'];

$_etiqueta = new tb_pcp_etiqueta($conexaoERP);

$_etiqueta->proc_etiqueta_casadei_relatorio($nu_op,$co_usuario);


$xml =  simplexml_load_file("pcp_etiqueta_casadei.jrxml");
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("nu_op"=>$nu_op, "co_usuario"=>$co_usuario, "PATH"=>APP_PATH.'barcodes'.DS);
$PHPJasperXML->xml_dismantle($xml);

//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db); * use this line if you want to connect with mysql

//if you want to use universal odbc connection, please create a dsn connection in odbc first
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

//$PHPJasperXML->outpage("F",APP_PATH.'barcodes'.DS.date("dmYhis").".pdf");    //page output method I:standard output  D:Download file
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file

$_etiqueta->limparTemporaria($co_usuario);
//APP_PATH.'barcodes'.DS.'casadei_'.$nu_op.'.gif'
unlink(APP_PATH.'barcodes'.DS.$co_usuario.'_relatorio_casadei_'.$nu_op.'.gif');

$data=true;

?>