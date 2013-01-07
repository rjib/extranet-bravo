<?php
	
	session_start();
	
    require("../../setup.php");
	
	$dataApontamento   = $_POST["dataApontamento"];
	$codigoRecurso     = $_POST["codigoRecurso"];
	$horaInicioInserir = $_POST["horaInicioInserir"];
	$flagApontamento   = $_POST["flagApontamento"];
	$codigoMotivo      = $_POST["codigoMotivo"];
	$codigoPcpOp       = $_POST["codigoPcpOp"];
			
	if(empty($dataApontamento)){
		echo "Informe a Data do Apontamento";
	}elseif($horaInicioInserir == "0" or $horaInicioInserir == ""){
		echo "Informe a Hora Inicio";
	}elseif(empty($flagApontamento)){
		echo "Informe o Tipo Apontamebto";
	}else{	
	    
		if($flagApontamento == "1"){
			
			$sqlApontamento = "INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
							       , CO_RECURSO
								   , HR_INICIO
								   , FL_APONTAMENTO
								   , CO_MOTIVO
								   , CO_USUARIO_INICIO) 
							   VALUES ('".$dataApontamento."'
							       , '".$codigoRecurso."'
								   , '".$horaInicioInserir."'
								   , '".$flagApontamento."'
								   , '".$codigoMotivo."'
								   , '".$_SESSION['codigoUsuario']."')";
								   
		}elseif($flagApontamento == "2"){
		    			
			$sqlApontamento = "INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
							       , CO_RECURSO
								   , HR_INICIO
								   , FL_APONTAMENTO
								   , CO_PCP_OP
								   , CO_USUARIO_INICIO) 
							   VALUES ('".$dataApontamento."'
							       , '".$codigoRecurso."'
								   , '".$horaInicioInserir."'
								   , '".$flagApontamento."'
								   , '".$codigoPcpOp."'
								   , '".$_SESSION['codigoUsuario']."')";
								   
		}else{
			echo "[Erro] - Não foi possível inserir o Apontamento no momento.";
		}
		
		$query = mysql_query($sqlApontamento);
		if($query){
		    echo false;
		}else{
		    echo "[Erro] - Não foi possível inserir o Apontamento no momento.";
		}
				
	}
	
?>