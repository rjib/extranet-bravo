<?php
require_once('../../setup.php');
require_once(APP_PATH.'sistema/ireport/class/tcpdf/tcpdf.php');
$filename = $_GET['arquivo'];
$filename = APP_PATH.'sistema'.DS.'desenhos_producao'.DS.$filename;
$fpdf = new TCPDF();

 
$fpdf->Output($filename,'I');

//echo header('Content-Type: application/pdf');