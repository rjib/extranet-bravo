<?php

	//for($i = 0; $i <=5; $i++){
	    //$data = date('Y-m-d', strtotime(2 . 'month'));
		//echo "Data: ".$data."<br>";
	//}
	
	echo "<br>";
	
	$dataPrimeiroVencimentoDia = "16";
	$dataPrimeiroVencimentoMes = "11";
	$dataPrimeiroVencimentoAno = "2011";
	$intervalo = 30;
	$quantidadeParcela = 5;
		
	echo "Data Primeiro Vencimento: ".$dataPrimeiroVencimentoAno."-".$dataPrimeiroVencimentoMes."-".$dataPrimeiroVencimentoDia."<br>";
	echo "Quantidade de Parcelas: ".$quantidadeParcela."<br>";
	echo "Intervalo: ".$intervalo." dias<br>";
	
	$arrayDataParcelas[] .= $dataPrimeiroVencimentoAno."-".$dataPrimeiroVencimentoMes."-".$dataPrimeiroVencimentoDia;
	
	for($i=0; $i<$quantidadeParcela-1; $i++){
				
		if($i >= 1){
			$dataProximaParcela = $arrayDataParcelas[$i];
			list ($dataProximaParcelaAno, $dataProximaParcelaMes, $dataProximaParcelaDia) = split ('[-]', $dataProximaParcela);
			$arrayDataParcelas[] .= date('Y-m-d',mktime(24*$intervalo, 0, 0, $dataProximaParcelaMes, $dataProximaParcelaDia, $dataProximaParcelaAno));
		}else{
			$arrayDataParcelas[] .= date('Y-m-d',mktime(24*$intervalo, 0, 0, $dataPrimeiroVencimentoMes, $dataPrimeiroVencimentoDia, $dataPrimeiroVencimentoAno));
		}
		
	}
	
	echo "<br>";
	
	print_r ($arrayDataParcelas);
	
	echo "<br>";
	
	for($i = 0; $i < count($arrayDataParcelas); $i++){
		echo "Data Parcelas: ".$arrayDataParcelas[$i]."<br>";
	    
	}
	
?>