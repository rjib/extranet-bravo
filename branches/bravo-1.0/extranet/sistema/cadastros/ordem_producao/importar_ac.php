<?php 
require_once '../../setup.php';
require_once APP_PATH.'sistema/helper.class.php';
$_helper = new helper();

$nomeTemporario = $_helper->getNomeTempArquivo('arquivo_ad');
$matrizDados = $_helper->gerarMatrizDeDadosDoArquivo($nomeTemporario);

//var_dump($matrizDados);
$schema = array(array());
$numEsquema = 1;

for($i=0; $i<count($matrizDados);$i++){
	$findme   = 'PAINEL';
	$pos = strpos($matrizDados[$i][0], $findme);	
	if ($pos === false) { // nao encontrou o schema
		//echo "A string '$findme' não foi encontrada na string '$mystring'";
	} else { // encontrou o schema
		//BR/BR          1800110011127500184000001PAINEL      561,66   10,11000039
		$numEsquema = (int)substr($matrizDados[$i][0], 18,2);		
	//echo "A string '$findme' foi encontrada na string '$mystring'";
	//echo " e existe na posição $pos";
	}
	$schema[$numEsquema][$i] = $matrizDados[$i][0];
	
	
}
var_dump($schema);

?>
