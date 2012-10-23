<?php
require('ordem_producao_pi_dao.php');

//constantes de parametros 
$_COR			 = array('numCaracter'=>15,'posPrimeiroCaracterer'=>1,'multiplicadorAtivo'=>0,'dadoNumerico'=>0);
$_ESPESSURA 	 = array('numCaracter'=>3,'posPrimeiroCaracterer'=>16,'multiplicadorAtivo'=>10,'dadoNumerico'=>1);
$_ORDEM 		 = array('numCaracter'=>2,'posPrimeiroCaracterer'=>28,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_COMPRIMENTO    = array('numCaracter'=>4,'posPrimeiroCaracterer'=>30,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_LARGURA    	 = array('numCaracter'=>4,'posPrimeiroCaracterer'=>35,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_QUANTIDADE     = array('numCaracter'=>6,'posPrimeiroCaracterer'=>39,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_GRAIN  		 = array('numCaracter'=>1,'posPrimeiroCaracterer'=>45,'multiplicadorAtivo'=>0,'dadoNumerico'=>1); //(veio = BR, BF, PF)? 1:0)
$_DESCRICAO  	 = array('numCaracter'=>150,'posPrimeiroCaracterer'=>46,'multiplicadorAtivo'=>0,'dadoNumerico'=>0);
$_PAINEL		 ='4012750018400001001PAINEL';
$_PATH			 = 'c:\\';



$dataInicial 		= '20121001';
$dataFinal 			= '20121023';
$cor				= '000300';
$espessura 			= 10;
$ordem				= 1; //loop
$flag				= 'N';
$co_pcp_op  		= array('1362','1495'); //loop
$nomeArquivo		= 'nomeArquivo';

$piModel = new ordemProducaoPi();//modelPi

$ordem = 2; //ordem dos PIs de acordo com a quantidade selecionada

for($i=0;$i< count($co_pcp_op); $i++){//varre os valores co_pcp_op selecionados
	
	$row = mysql_fetch_assoc($piModel->listaPi($cor,$espessura,$dataInicial,$dataFinal,$co_pcp_op[$i],$conexaoERP)); 
	strlen($row['DS_COR'])>15 ? $row['DS_COR']=substr($row['DS_COR'],0,14): $row['DS_COR']=str_pad($row['DS_COR'], $_COR['numCaracter'] , " ");
	$row['NU_ESPESSURA']= floatval($row['NU_ESPESSURA']*$_ESPESSURA['multiplicadorAtivo']); 
	strlen($row['NU_ESPESSURA'])>3 ? $row['NU_ESPESSURA']=substr($row['NU_ESPESSURA'],0,2): $row['NU_ESPESSURA']=str_pad($row['NU_ESPESSURA'],$_ESPESSURA['numCaracter'],0,STR_PAD_LEFT);
	var_dump($row);
	$ordem++; 
}//fim for

//cria o arquivo (caso ele exista sera sobreescrito)
$handle = fopen($_PATH."\\arquivosAD\\".$nomeArquivo.".ad", "w+");

fwrite($handle,'BR/BR          180        20'."\n");
fwrite($handle,'BR/BR          180        4012750018400001001PAINEL'."\n");

//fecha o arquivo
fclose($handle);

?>