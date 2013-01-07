<?php
	
	session_start();
	
    require("../../setup.php");
	
	$codigoApontamento      = $_POST["codigoApontamento"];
	$flagApontamentoHoraFim = $_POST["flagApontamentoHoraFim"];
	$flagOrdemProducao      = $_POST["flagOrdemProducao"];
	$quantidadeProduto      = $_POST["quantidadeProduto"];
	$horaFimInserir         = $_POST["horaFimInserir"];
	$horaInicio 	        = $_POST["horaInicio"];
	
	if($flagApontamentoHoraFim == "1"){
	
		if($horaInicio > $horaFimInserir){	
		    echo("O Horário de termino não deve ser menor que o horário de início!");
			exit;
	    }elseif($horaFimInserir == "00:00" or $horaFimInserir == "") {
		    echo "Informe a Hora Fim!";
			exit;
	    }else{
		    $sqlApontamento = "UPDATE tb_pcp_apontamento SET 
		                           HR_FIM           = '".$horaFimInserir."'
							       , CO_USUARIO_FIM = '".$_SESSION['codigoUsuario']."' 
							   WHERE CO_PCP_APONTAMENTO = '".$codigoApontamento."'";
		}
				
	}elseif($flagApontamentoHoraFim == "2"){
					
	    if($quantidadeProduto == "0" or $quantidadeProduto == ""){
		    echo "Informe a Quantidade!";
			exit; 
	    }elseif($horaInicio > $horaFimInserir){	
		    echo "O Horário de termino não deve ser menor que o horário de início!";
			exit;
	    }elseif($horaFimInserir == "00:00" or $horaFimInserir == "") {
		    echo "Informe a Hora Fim!";
			exit;
		}elseif($flagOrdemProducao == "1"){
		    echo "OP não validada!";
			exit;
		}else{
			$sqlApontamento = "UPDATE tb_pcp_apontamento SET 
		                           HR_FIM           = '".$horaFimInserir."'
							       , QTD_PRODUTO    = '".$quantidadeProduto."' 
						           , CO_USUARIO_FIM = '".$_SESSION['codigoUsuario']."' 
						       WHERE CO_PCP_APONTAMENTO = '".$codigoApontamento."'";
		}
		
	}else{
		echo "[Erro] - Não foi possível inserir o Apontamento no momento.";
		exit;
	}
		
	$query = mysql_query($sqlApontamento);
	if($query){
		echo false;
	}else{
		echo "[Erro] - Não foi possível inserir Hora Fim do Apontamento no momento.";
	}
	
?>