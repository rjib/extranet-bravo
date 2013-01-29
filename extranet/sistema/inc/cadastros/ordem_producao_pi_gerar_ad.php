<?php
/**
 * Arquivo responsavel pela geração do arquivo AD
 * @author Ricardo S. Alvarenga
 * @since 23/10/2012
 * */

require_once '../../setup.php';
require('../../models/tb_pcp_op.php');
require ('../../models/tb_pcp_ad.php');
require ('../../models/tb_pcp_ad_peca.php');
require ('../../helper.class.php');

//constantes de parametros
$_DIMENSAOMINIMA = DIMENSAO_MINIMA; //dimensao minima
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
$_ano			 = date('Y');
$_PATH			 = APP_PATH.'arquivosAD'.DS.$_ano.DS;


$piModel 	 = new tb_pcp_op($conexaoERP);
$adModel	 = new tb_pcp_ad($conexaoERP);
$adpecaModel = new tb_pcp_ad_peca($conexaoERP);
$_helper 	 = new helper();

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
	$mesmoLote 				= $piModel->getMesmoLote($co_pcp_op);
	$tockstok				= $_POST['tockstok'];
	
}else{
	$_helper->alertError('Não existe dados enviados, favor entrar em contato com o suporte!');
	exit;
}

$ordem = 2; //ordem dos PIs de acordo com a quantidade selecionada
$nQuantidade = 0;
$veio = 0;
$dadosArquivo = array();
if($espessura =='18/37'){$espessura = "'18','37'";}
if($mesmoLote==false){ //passa somete se for do mesmo lote
	//$_helper->alertError('Não se pode gerar o arquivo com lotes diferentes, favor selecionar produtos do mesmo lote.');
	$resposta = "<img src='img/atencao.png' hspace='3' /> N&atilde;o &eacute; poss&iacute;vel gerar o arquivo AD com produtos de lotes diferentes, favor selecionar apenas produtos do mesmo lote.";
	echo json_encode($resposta);
	exit;
}

for($i=0;$i< count($co_pcp_op); $i++){//varre os valores co_pcp_op selecionados

	$row = mysql_fetch_assoc($piModel->listaPi($cor,$espessura,$dataInicial,$dataFinal,$co_pcp_op[$i]));
	$tempComprimento = $row['NU_COMPRIMENTO'];
	$tempLargura	 = $row['NU_LARGURA'];
	$tempEspessura   = $row['NU_ESPESSURA'];
	$row['DS_COR'] = trim($row['DS_COR']);//removendo espacos em branco caso exista
	strlen($row['DS_COR'])>15 ? $row['DS_COR']=substr($row['DS_COR'],0,15): $row['DS_COR']=str_pad($row['DS_COR'], $_COR['numCaracter'] , " ");
	$row['NU_ESPESSURA']= str_replace(',','.',$row['NU_ESPESSURA']);
	$row['NU_ESPESSURA']= floatval($row['NU_ESPESSURA']*$_ESPESSURA['multiplicadorAtivo']);
	if(strlen($row['NU_ESPESSURA'])>3){
		$row['NU_ESPESSURA']=substr($row['NU_ESPESSURA'],0,2);
	}else{
		$row['NU_ESPESSURA']=str_pad($row['NU_ESPESSURA'],$_ESPESSURA['numCaracter'],0,STR_PAD_LEFT);
	}
	$ordemProducao = $ordem; //sequencia

	if(strlen($ordem)>1 ){
		$ordemProducao = '2'.substr($ordemProducao,(strlen($ordemProducao)-strlen($ordemProducao)-2),strlen($ordemProducao));
	}else{
		$ordemProducao = '2'.str_pad(substr($ordemProducao,(strlen($ordemProducao)-strlen($ordemProducao)-1),strlen($ordemProducao)),$_ORDEM['numCaracter'],'0',STR_PAD_LEFT);
	}

	$row['NU_LARGURA'] =  str_replace(',','.',$row['NU_LARGURA']);
	if($row['NU_LARGURA']<$_DIMENSAOMINIMA){

		if ($row['NU_LARGURA']>=56 && $row['NU_LARGURA']<100){
			$n1 = 4;
		}elseif($row['NU_LARGURA']<56){
			$n1 = 8;
		}elseif($row['NU_LARGURA']>=100 && $row['NU_LARGURA']<240){
			$n1 = 2;
		}
		
		if($nQuantidade==0){
			$nQuantidade = ($row['QTD_PRODUTO']-$row['QTD_PROCESSADA']);
		}
		$nQuantidade = ($nQuantidade/$n1);
		$row['NU_LARGURA'] = $row['NU_LARGURA']*$n1+(($n1-1)* $_MM_ENTRE_PECA);

	}

	$row['NU_LARGURA'] = $row['NU_LARGURA']+$unidadeComplementar;

	//LARGURA
	$_LARGURA['multiplicadorAtivo']==0? $_LARGURA['multiplicadorAtivo']=1:$_LARGURA['multiplicadorAtivo']=$_LARGURA['multiplicadorAtivo'];
	$row['NU_LARGURA'] = $row['NU_LARGURA']*$_LARGURA['multiplicadorAtivo'];
	$row['NU_LARGURA'] = str_pad($row['NU_LARGURA'],$_LARGURA['numCaracter'],0,STR_PAD_LEFT);

	$row['NU_COMPRIMENTO'] =  str_replace(',','.',$row['NU_COMPRIMENTO']);
	if($row['NU_COMPRIMENTO']<$_DIMENSAOMINIMA){
		if ($row['NU_COMPRIMENTO']>=56 && $row['NU_COMPRIMENTO']<100){
			$n1 = 4; 
		}elseif($row['NU_COMPRIMENTO']<56){
			$n1 = 8;			
		}elseif($row['NU_COMPRIMENTO']>=100 && $row['NU_COMPRIMENTO']<240){
			$n1 = 2;			
		}

		if($nQuantidade==0){
			$nQuantidade = ($row['QTD_PRODUTO']-$row['QTD_PROCESSADA']);
		}
		$nQuantidade = ($nQuantidade/$n1);
		$row['NU_COMPRIMENTO'] = $row['NU_COMPRIMENTO']*$n1+(($n1-1)* $_MM_ENTRE_PECA);

	}

	$row['NU_COMPRIMENTO'] = $row['NU_COMPRIMENTO']+$unidadeComplementar;
	if($nQuantidade!=0){
		$row['QTD_PRODUTO'] = $nQuantidade;
		//$nQuantidade = 0; //zerando o temp quantidade
	}else{
		$row['QTD_PRODUTO'] = ($row['QTD_PRODUTO']-$row['QTD_PROCESSADA']);
		$nQuantidade=0;
	}

	if($tockstok == 1){
		if($row['NU_ESPESSURA'] == 370){
			$row['QTD_PRODUTO'] = $row['QTD_PRODUTO'] *2;
	
		}
	
	}
	$row['QTD_PRODUTO'] = ceil($row['QTD_PRODUTO']);
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
	//retornando a virgula

	$row['NU_ESPESSURA'] =  str_replace('.',',',$row['NU_ESPESSURA']);
	$row['NU_COMPRIMENTO'] =  str_replace('.',',',$row['NU_COMPRIMENTO']);
	$row['NU_LARGURA'] =  str_replace('.',',',$row['NU_LARGURA']);
	
	//removendo casas decimais
	if(strstr($row['NU_COMPRIMENTO'],',')){
		$row['NU_COMPRIMENTO'] =  substr($row['NU_COMPRIMENTO'], 0,strpos($row['NU_COMPRIMENTO'], ','));
			
		
	}
	if(strstr($row['NU_LARGURA'],',')){
		$row['NU_LARGURA'] =  substr($row['NU_LARGURA'], 0,strpos($row['NU_LARGURA'], ','));
		$row['NU_LARGURA'] = str_pad($row['NU_LARGURA'],$_LARGURA['numCaracter'],0,STR_PAD_LEFT);
		
	}
	

	array_push($dadosArquivo, $row['DS_COR'].$row['NU_ESPESSURA'].'        '.$ordemProducao.$row['NU_COMPRIMENTO'].' '.$row['NU_LARGURA'].$row['QTD_PRODUTO'].$veio.trim($row['CO_INT_PRODUTO']).' - '.$tempComprimento.'X'.$tempLargura.'X'.$tempEspessura);
	$ordem++;
	$nQuantidade=0;
}//fim for

//cria o arquivo (caso ele exista sera sobreescrito)
$dir = $_PATH;
if (!file_exists($dir))
{
	mkdir($dir, 0755);
}
if(file_exists($_PATH.$nomeArquivo.".ad")){
	$resposta = "<img src='img/atencao.png' hspace='3' /> N&atilde;o &eacute; poss&iacute;vel gerar o arquivo AD pois ja existe um arquivo com este nome.";
	echo json_encode($resposta);
	exit;
}

$handle = fopen($_PATH.$nomeArquivo.".ad", "w+");

fwrite($handle,$row['DS_COR'].$row['NU_ESPESSURA'].'        20'."\r\n");
fwrite($handle,$row['DS_COR'].$row['NU_ESPESSURA'].'        4012750018400001001PAINEL'."\r\n");


//Escrevendo no arquivo
for($i=0; $i<count($dadosArquivo);$i++){
	fwrite($handle,$dadosArquivo[$i]."\r\n");
}

//fecha o arquivo
fclose($handle);

//Atualizando status pi como processado (gerado arquivo AD) caso o arquivo tenha sido gravado com sucesso
if($handle){
	try {
		
		$adModel->insert($nomeArquivo, $unidadeComplementar, $tockstok);
		$co_pcp_ad = mysql_insert_id();
	}catch (Exception $e){
		unlink($_PATH.$nomeArquivo.".ad");
		$_helper->alertErrorBackParam($e->getMessage(), 'ordem_producao');
	}
	for($i=0; $i<count($co_pcp_op);$i++){
		$adpecaModel->insert($co_pcp_ad,$co_pcp_op[$i]);
	}

}

?>