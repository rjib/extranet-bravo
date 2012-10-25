<?php
require('ordem_producao_pi_dao.php');
require ('../../helper.class.php');

//constantes de parametros 
$_DIMENSAOMINIMA = 240; //dimensao minima
$_MM_ENTRE_PECA  = 5; //milimetros entre peças
$_COR			 = array('numCaracter'=>15,'posPrimeiroCaracterer'=>1,'multiplicadorAtivo'=>0,'dadoNumerico'=>0);
$_ESPESSURA 	 = array('numCaracter'=>3,'posPrimeiroCaracterer'=>16,'multiplicadorAtivo'=>10,'dadoNumerico'=>1);
$_ORDEM 		 = array('numCaracter'=>2,'posPrimeiroCaracterer'=>28,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_COMPRIMENTO    = array('numCaracter'=>4,'posPrimeiroCaracterer'=>30,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_LARGURA    	 = array('numCaracter'=>4,'posPrimeiroCaracterer'=>35,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_QUANTIDADE     = array('numCaracter'=>6,'posPrimeiroCaracterer'=>39,'multiplicadorAtivo'=>0,'dadoNumerico'=>1);
$_GRAIN  		 = array('numCaracter'=>1,'posPrimeiroCaracterer'=>45,'multiplicadorAtivo'=>0,'dadoNumerico'=>1); //(veio = BR, BF, PF)? 1:0)
$_DESCRICAO  	 = array('numCaracter'=>150,'posPrimeiroCaracterer'=>46,'multiplicadorAtivo'=>0,'dadoNumerico'=>0);
DEFINE('$_PAINEL','4012750018400001001PAINEL');
$_PATH			 = 'c:\\';

$piModel = new ordemProducaoPi();
$_helper = new helper();

if(isset($_POST['dataInicial']) && isset($_POST['dataFinal']) && isset($_POST['cor']) && isset($_POST['espessura']) && isset($_POST['flag']) && isset($_POST['co_pi']) && isset($_POST['nomeArquivo']) && isset($_POST['unidadeComplementar']))
{
	$dataInicial 			= $_helper->ajustarDataYYYYmmdd($_POST['dataInicial']);
	$dataFinal 				= $_helper->ajustarDataYYYYmmdd($_POST['dataFinal']);
	$cor					= $_POST['cor'];
	$espessura 				= $_POST['espessura'];
	$flag					= $_POST['flag'];
	$co_pcp_op  			= $_POST['co_pi'];
	$nomeArquivo			= $_POST['nomeArquivo'];
	$unidadeComplementar	= $_POST['unidadeComplementar'];
}else{
	echo "<script>
			    alert('[Erro] - Não existe dados enviados, favor entrar em contato com o suporte!');
			    history.back(-1);
		  </script>";	
}


$ordem = 2; //ordem dos PIs de acordo com a quantidade selecionada
$nQuantidade = 0;
$veio = 0;
$dadosArquivo = array();


for($i=0;$i< count($co_pcp_op); $i++){//varre os valores co_pcp_op selecionados
	
	$row = mysql_fetch_assoc($piModel->listaPi($cor,$espessura,$dataInicial,$dataFinal,$co_pcp_op[$i],$conexaoERP));
	$tempComprimento = $row['NU_COMPRIMENTO'];
	$tempLargura	 = $row['NU_LARGURA'];
	$tempEspessura   = $row['NU_ESPESSURA'];
	$row['DS_COR'] = trim($row['DS_COR']);//removendo espacos em branco caso exista
	strlen($row['DS_COR'])>15 ? $row['DS_COR']=substr($row['DS_COR'],0,15): $row['DS_COR']=str_pad($row['DS_COR'], $_COR['numCaracter'] , " ");
	$row['NU_ESPESSURA']= floatval($row['NU_ESPESSURA']*$_ESPESSURA['multiplicadorAtivo']); 
	strlen($row['NU_ESPESSURA'])>3 ? $row['NU_ESPESSURA']=substr($row['NU_ESPESSURA'],0,2): $row['NU_ESPESSURA']=str_pad($row['NU_ESPESSURA'],$_ESPESSURA['numCaracter'],0,STR_PAD_LEFT);
	$ordemProducao = $ordem; //sequencia
	
	if(strlen($ordem)>1 ){
		$ordemProducao = '2'.substr($ordemProducao,(strlen($ordemProducao)-strlen($ordemProducao)-2),strlen($ordemProducao));
	}else{
		$ordemProducao = '2'.str_pad(substr($ordemProducao,(strlen($ordemProducao)-strlen($ordemProducao)-1),strlen($ordemProducao)),$_ORDEM['numCaracter'],'0',STR_PAD_LEFT);	
	}
	
	
	if($row['NU_LARGURA']<$_DIMENSAOMINIMA){
		
		$n1 = $_DIMENSAOMINIMA/$row['NU_LARGURA'];
		if((int)$n1<=$n1){
			$n1 = (int)$n1+1;
		 }
		
		if($n1%2!=0){
			$n1 = $n1+1;
		}
		if($nQuantidade==0){
			$nQuantidade = $row['QTD_PRODUTO'];
		}
		$nQuantidade = $nQuantidade/$n1;
		$row['NU_LARGURA'] = $row['NU_LARGURA']*$n1+(($n1-1)* $_MM_ENTRE_PECA);
		
	}
	
	$row['NU_LARGURA'] = $row['NU_LARGURA']+$unidadeComplementar;

	//LARGURA
	$_LARGURA['multiplicadorAtivo']==0? $_LARGURA['multiplicadorAtivo']=1:$_LARGURA['multiplicadorAtivo']=$_LARGURA['multiplicadorAtivo']; 
	$row['NU_LARGURA'] = $row['NU_LARGURA']*$_LARGURA['multiplicadorAtivo'];
	$row['NU_LARGURA'] = str_pad($row['NU_LARGURA'],$_LARGURA['numCaracter'],0,STR_PAD_LEFT);
	
	if($row['NU_COMPRIMENTO']<$_DIMENSAOMINIMA){
	
		$n1 = $_DIMENSAOMINIMA/$row['NU_COMPRIMENTO'];
		 if((int)$n1<=$n1){
			$n1 = (int)$n1+1;
		 }
	
		if($n1%2!=0){
			$n1 = $n1+1;
		}
		if($nQuantidade==0){
			$nQuantidade = $row['QTD_PRODUTO'];
		}
		$nQuantidade = $nQuantidade/$n1;
		$row['NU_COMPRIMENTO'] = $row['NU_COMPRIMENTO']*$n1+(($n1-1)* $_MM_ENTRE_PECA);
	
	}
	
	$row['NU_COMPRIMENTO'] = $row['NU_COMPRIMENTO']+$unidadeComplementar;
	if($nQuantidade!=0){
		$row['QTD_PRODUTO'] = $nQuantidade;
		//$nQuantidade = 0; //zerando o temp quantidade
	}
	$row['QTD_PRODUTO'] = intval($row['QTD_PRODUTO']);
	$nQuantidade=0;
	
	//COMPRIMENTO
 	$_COMPRIMENTO['multiplicadorAtivo']==0? $_COMPRIMENTO['multiplicadorAtivo']=1:$_COMPRIMENTO['multiplicadorAtivo']=$_COMPRIMENTO['multiplicadorAtivo'];
	$row['NU_COMPRIMENTO'] = $row['NU_COMPRIMENTO']*$_COMPRIMENTO['multiplicadorAtivo'];
	$row['NU_COMPRIMENTO'] = str_pad($row['NU_COMPRIMENTO'],$_COMPRIMENTO['numCaracter'],0,STR_PAD_LEFT); 
	
	//QUANTIDADE
	$row['QTD_PRODUTO'] = str_pad($row['QTD_PRODUTO'],$_QUANTIDADE['numCaracter'],0,STR_PAD_LEFT);
	
	if(trim(substr($row['DS_COR'],0,2))=="BR" || trim(substr($row['DS_COR'],0,2))=="PR" || trim(substr($row['DS_COR'],0,2))=="BF" ){
		$veio=1;
	}else{		
		$veio=0;
	}
	
	
	array_push($dadosArquivo, $row['DS_COR'].$row['NU_ESPESSURA'].'        '.$ordemProducao.$row['NU_COMPRIMENTO'].' '.$row['NU_LARGURA'].$row['QTD_PRODUTO'].$veio.trim($row['CO_INT_PRODUTO']).' - '.$tempComprimento.'X'.$tempLargura.'X'.$tempEspessura);
	$ordem++;
}//fim for

//cria o arquivo (caso ele exista sera sobreescrito)
$handle = fopen($_PATH."\\arquivosAD\\".$nomeArquivo.".ad", "w+");

fwrite($handle,$row['DS_COR'].$row['NU_ESPESSURA'].'        20'."\n");
fwrite($handle,$row['DS_COR'].$row['NU_ESPESSURA'].'        4012750018400001001PAINEL'."\n");


//Escrevendo no arquivo
for($i=0; $i<count($dadosArquivo);$i++){
	fwrite($handle,$dadosArquivo[$i]."\n");
}

//fecha o arquivo
fclose($handle);

//Atualizando status pi como processado (gerado arquivo AD)
for($i=0; $i<count($co_pcp_op);$i++){
	$piModel->atualizaSelecionados($co_pcp_op[$i],$conexaoERP);
}

?>