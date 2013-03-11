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
	$codigoOperacao     = $_POST["codigoOperacao"];
			
	if(empty($dataApontamento)){
		echo "Informe a Data do Apontamento";
	}elseif(empty($horaInicioInserir)){
		echo "Informe a hora inicial do Apontamento";
	}elseif(empty($flagApontamento)){
			echo "Informe o Tipo Apontamento";
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
				
				$totalProduto = sizeof($chave);
				$totalOperacao = 0;
				
				for($i=0;$i<count($codigoOperacao);$i++){
					
					if($codigoOperacao[$i] <> "0"){
					    $totalOperacao++;
					}
					
				}
				
				if($totalOperacao == $totalProduto){
				    for($i = 0; $i < sizeof($chave); $i++){ 
		
						$indice = $chave[$i];	
				
						$sqlApontamento = mysql_query("INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
														   , CO_RECURSO
														   , HR_INICIO
														   , FL_APONTAMENTO
														   , CO_PCP_OP
														   , CO_USUARIO_INICIO
														   , CO_PCP_OPERACAO) 
													   VALUES ('".$dataApontamento."'
														   , '".$codigoRecurso."'
														   , '".$horaInicioInserir."'
														   , '".$flagApontamento."'
														   , '".$_SESSION['jobOrdemProducaoImporta'][$indice]['CO_PCP_OP']."'
														   , '".$_SESSION['codigoUsuario']."'
														   , '".$codigoOperacao[$i]."')");
					
					}
				}
								
			}else{
				
			    $sqlApontamento = mysql_query("INSERT INTO tb_pcp_apontamento (DT_APONTAMENTO
							           		       , CO_RECURSO
											       , HR_INICIO
											       , FL_APONTAMENTO
											       , CO_PCP_OP
												   , CO_PCP_OPERACAO
											       , CO_USUARIO_INICIO) 
										       VALUES ('".$dataApontamento."'
											       , '".$codigoRecurso."'
											       , '".$horaInicioInserir."'
											       , '".$flagApontamento."'
											       , '".$codigoPcpOp."'
												   , '".$codigoOperacao."'
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