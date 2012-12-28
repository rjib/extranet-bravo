<?php 
$data=false;
require_once('class/tcpdf/tcpdf.php');
require_once("class/PHPJasperXML.inc.php");
require_once('../setup.php');
require_once '../models/tb_pcp_etiqueta.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';

date_default_timezone_set('America/Sao_Paulo');

$_peca 	   = new tb_pcp_pecas($conexaoERP);
isset($_GET['co_pcp_ad'])? $co_pcp_ad = $_GET['co_pcp_ad']:$co_pcp_ad = $_POST['co_pcp_ad'];

try{
	$result    	   = $_peca->findPecasByAD($co_pcp_ad);
	$dados 		   = mysql_fetch_array($result);
	$co_pcp_ac 	   = $dados['CO_PCP_AC'];
}catch (Exception $e){
	$data=false;
	echo json_encode($data);
	exit;

}

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$server="localhost";
$db="extranet";
$user="root";
$pass="";
$version="0.8b";
$pgport=5432;
$pchartfolder="class/pchart2";
$timestamp = date("d/m/Y")."  ".date("h:i:s");

$_etiqueta = new tb_pcp_etiqueta($conexaoERP);

$xml =  simplexml_load_file("etiqueta.jrxml");
$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("CO_PCP_AC"=>$co_pcp_ac, "CODIGO_BARRA"=>APP_PATH.'barcodes'.DS, "TIMESTAMP"=>$timestamp);
$PHPJasperXML->xml_dismantle($xml);

//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db); * use this line if you want to connect with mysql

//if you want to use universal odbc connection, please create a dsn connection in odbc first
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);

//$PHPJasperXML->outpage("F",APP_PATH.'barcodes'.DS.date("dmYhis").".pdf");    //page output method I:standard output  D:Download file
$PHPJasperXML->outpage("I",date("dmYhis"));    //page output method I:standard output  D:Download file

$result = $_etiqueta->listaCodigoBarra($co_pcp_ac);
while ($dados = mysql_fetch_array($result)){
	unlink(APP_PATH.'barcodes'.DS.$dados['NU_PCP_OP'].'.gif');
}

$data=true;

?>