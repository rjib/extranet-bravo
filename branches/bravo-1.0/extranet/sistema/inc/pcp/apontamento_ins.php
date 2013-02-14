<?php
	
	session_start();
	
    require("../../setup.php");
	
	$dataApontamento    = $_POST["dataApontamento"];
	$codigoRecurso      = $_POST["codigoRecurso"];
	$horaInicioInserir  = $_POST["horaInicioInserir"];
	$flagApontamento    = $_POST["flagApontamento"];
	$codigoMotivoParada = $_POST["codigoMotivoParada"];
	$codigoPcpOp        = $_POST["codigoPcpOp"];
	$codigoPcpOpPerda   = $_POST["codigoPcpOpPerda"];
	$codigoMotivoPerda  = $_POST["codigoMotivoPerda"];
	$quantidadePerda    = $_POST["quantidadePerda"];
			
	if(empty($dataApontamento)){
		echo "Informe a Data do Apontamento";
	}elseif(empty($flagApontamento)){
		echo "Informe o Tipo Apontamebto";
	}else{	
	    
		if($flagApontamento == "1"){
			
			$sqlApontamento = mysql_query("INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
							                   , CO_RECURSO
										       , HR_INICIO
										       , FL_APONTAMENTO
										       , CO_MOTIVO_PARADA
										       , CO_USUARIO_INICIO) 
									   	   VALUES ('".$dataApontamento."'
										       , '".$codigoRecurso."'
										       , '".$horaInicioInserir."'
										       , '".$flagApontamento."'
										       , '".$codigoMotivoParada."'
										       , '".$_SESSION['codigoUsuario']."')");
								   
		}elseif($flagApontamento == "2"){
		    
			if($_SESSION['jobOrdemProducaoImporta']){
				
			    $chave = @array_keys($_SESSION['jobOrdemProducaoImporta']);
				
				for($i = 0; $i < sizeof($chave); $i++){ 
		
					$indice = $chave[$i];	
			
				    $sqlApontamento = mysql_query("INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
							               		       , CO_RECURSO
								       	           	   , HR_INICIO
												       , FL_APONTAMENTO
												       , CO_PCP_OP
												       , CO_USUARIO_INICIO) 
											   	   VALUES ('".$dataApontamento."'
												       , '".$codigoRecurso."'
												       , '".$horaInicioInserir."'
												       , '".$flagApontamento."'
												       , '".$_SESSION['jobOrdemProducaoImporta'][$indice]['CO_PCP_OP']."'
												       , '".$_SESSION['codigoUsuario']."')");
					
				}
								
			}else{
				
			    $sqlApontamento = mysql_query("INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
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
											       , '".$_SESSION['codigoUsuario']."')");
									   
			}
								   
		}elseif($flagApontamento == "3"){
		    
			$sqlApontamento = mysql_query("INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
							           	       , CO_RECURSO
										       , FL_APONTAMENTO
											   , CO_PCP_OP
											   , CO_MOTIVO_PERDA
											   , QTD_PRODUTO
										       , CO_USUARIO_INICIO) 
										   VALUES ('".$dataApontamento."'
										       , '".$codigoRecurso."'
										       , '".$flagApontamento."'
											   , '".$codigoPcpOpPerda."'
											   , '".$codigoMotivoPerda."'
											   , '".$quantidadePerda."'
										       , '".$_SESSION['codigoUsuario']."')");
									   
								   
		}else{
			echo "[Erro 01] - Não foi possível inserir o Apontamento no momento";
		}
		
		if($sqlApontamento){
		    echo false;
		}else{
		    echo "[Erro 02] - Não foi possível inserir o Apontamento no momento";
		}
				
	}
	
?>