<?php
require_once('../class/fpdf/fpdf.php');
session_start();
ini_set("max_execution_time",3600);
ini_set("memory_limit","50M");
set_time_limit(0);
$data=false;
require_once('../../setup.php');
require_once '../../models/tb_pcp_etiqueta.php';
require_once APP_PATH.'sistema/models/tb_pcp_pecas.php';
date_default_timezone_set('America/Sao_Paulo');
$_peca 	   = new tb_pcp_pecas($conexaoERP);

class PDF extends FPDF
{
	// Load data
	function LoadData($file)
	{
		
		//$lines = file($file);
		$data = array();
		//foreach($lines as $line)
			//$data[] = explode(';',trim($line));
		for($i=0;$i<count($file);$i++){
			$data[] = explode(';', trim($file[$i]));
		}
		return $data;
	}


	// Colored table
	function FancyTable($header, $data)
	{
		// Colors, line width and bold font
		$this->SetFillColor(255,255,254); //cor cabeçalho
		$this->SetTextColor(0);
		$this->SetDrawColor(0,0,0);//borda
		$this->SetLineWidth(.3);
		$this->SetFont('','B');
		// Header
		$w = array(15,35,42, 126,15, 15, 15,15);
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],10,$header[$i],1,0,'C',true);
		$this->Ln();
		// Color and font restoration
		//$this->SetFillColor(224,235,255);
		$this->SetFillColor(232,232,232);
		$this->SetTextColor(0);
		$this->SetFont('');
		// Data
		$fill = false;
		$sec = 1;
		foreach($data as $row)
		{
			 
			$this->Cell($w[0],6,$sec,'LR',0,'C',$fill);
			$this->Cell($w[1],6,$row[0],'LR',0,'C',$fill);
			$this->Cell($w[2],6,$row[2],'LR',0,'L',$fill);
			$this->SetFont('Arial','',8);
			$this->Cell($w[3],6,$row[1],'LR',0,'L',$fill);
			$this->SetFont('Arial','',0);
			//$this->Cell($w[2],6,number_format($row[2]),'LR',0,'R',$fill);
			//$this->Cell($w[3],6,number_format($row[3]),'LR',0,'R',$fill);
			$this->Cell($w[4],6,$row[3],'LR',0,'C',$fill);
			//$this->Cell(10,10,'Desenvolvedor',1,1,'C');
			$this->Cell($w[5],6,$row[4],'LR',0,'C',$fill);
			$this->Cell($w[6],6,$row[5],'LR',0,'C',$fill);
			$this->Cell($w[7],6,$row[6],'LR',0,'C',$fill);
			$sec=$sec+1;
			$this->Ln();
			$fill = !$fill;

		}
		// Closing line
		$this->Cell(array_sum($w),0,'','T');

	}
}

$nu_lote = '';
$ds_cor = '';
$nu_espessura='';
$data = array();
$nome_arquivo = "lista_".date("dmY").date("his");

if(isset($_GET['ad']) && isset($_GET['job'])){
	$co_pcp_ad = $_GET['ad'];
	$no_pcp_ad = $_GET['job'];
	$result = $_peca->getListaPi($co_pcp_ad);
	while ($dados = mysql_fetch_array($result)){
		$data[] = $dados['CO_INT_PRODUTO'].';'.$dados['DS_PRODUTO'].';'.$dados['NO_COR'].';'.$dados['QTD_PECAS'].';'.$dados['NU_COMPRIMENTO'].';'.$dados['NU_LARGURA'].';'.$dados['NU_ESPESSURA'];
		$nu_lote = $dados['NU_LOTE'];
		$ds_cor = $dados['DS_COR'];
		$nu_espessura = $dados['NU_ESPESSURA'];
	}

	$pdf = new PDF();

	$header = array('SEQ.',utf8_decode('CÓD. INT'),'COR', utf8_decode('DESCRIÇÃO'),'QTD.', 'X', 'Y','Z');

	$data = $pdf->LoadData($data);

	$pdf->AddPage('L');
	//$pdf->BasicTable($header,$data);
	//$pdf->AddPage();
	//$pdf->ImprovedTable($header,$data);
	//$pdf->AddPage();

	$pdf->SetFont('Arial','B',14);
	$pdf->Write(0, "LISTA ".$nu_lote." ".$ds_cor."-".$nu_espessura);
	$pdf->SetX(260);
	$pdf->Write(0, date("d/m/Y"));

	$pdf->Ln(3);

	$pdf->SetFont('Arial','',9);
	$pdf->FancyTable($header,$data);
	$pdf->Ln(3);
	$pdf->Write(0, 'Job: '.$no_pcp_ad);
	$pdf->Output($nome_arquivo,'I');
}else{
	echo "<h1>Nenhum job foi selecionado!</h1>";
}
?>