<?php 
include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('../setup.php');
//error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

$server="localhost";
$db="extranet";
$user="root";
$pass="";
$version="0.8b";
$pgport=5432;
$pchartfolder="class/pchart2";


$xml =  simplexml_load_file("etiqueta.jrxml");

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=true;
$PHPJasperXML->arrayParameter=array("CO_PCP_AC"=>62);
$PHPJasperXML->xml_dismantle($xml);

//$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db); * use this line if you want to connect with mysql

//if you want to use universal odbc connection, please create a dsn connection in odbc first
$PHPJasperXML->transferDBtoArray($server,$user,$pass,$db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file