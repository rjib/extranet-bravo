<?php
	
	session_start();
	
    require("../../../setup.php");
	
	$codigoVisitante = $_POST["codigoVisitante"];
	$horaEntrada     = $_POST["horaEntrada"];
	$tipoVeiculo     = $_POST["tipoVeiculo"];
	$placaVeiculo    = $_POST["placaVeiculo"];
	$numeroCartao    = $_POST["numeroCartao"];
	
	$sqlTipoVeiculo= mysql_query("SELECT fl_exige_placa FROM tb_tipo_veiculo WHERE co_tipo_veiculo = '".$tipoVeiculo."'")
	or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
	$row= mysql_fetch_row($sqlTipoVeiculo);
			
	if(empty($codigoVisitante)){
		echo "Informe o Visitante";
	}elseif($horaEntrada == "0" or $horaEntrada == ""){
		echo "Informe a Hora Entrada";
	}elseif(empty($tipoVeiculo)){
		echo "Informe o Tipo Veiculo";
	}elseif($row[0]!="N" && empty($placaVeiculo)){
		echo "Informe a Placa do Veiculo!";
	}elseif(empty($numeroCartao)){
		echo "Informe o Número do Cartão";
	}elseif ($row[0]!="N" && strlen($placaVeiculo) < 8){
		echo "A Placa do Veiculo deve ter 8 caracteres";
	}else{
		
		$sqlAcessoVisitante= mysql_query("SELECT null FROM tb_acesso_visitante WHERE HR_SAIDA = '' AND CO_CARTAO_IDENTIFICACAO = '".$numeroCartao."'")
		or die("<script>
					alert('[Erro 1] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
				
		$sqlAcessoConsultor= mysql_query("SELECT null FROM tb_acesso_consultor ac WHERE HR_SAIDA = '' AND CO_CARTAO_IDENTIFICACAO = '".$numeroCartao."'")
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
						
		if(mysql_num_rows($sqlAcessoVisitante) > 0 || mysql_num_rows($sqlAcessoVisitante)>0){
			echo "[Erro] - Já existe um Acesso com este Número de Cartão de Identificação.";
		}else{
			$sqlAcessoVisitante= mysql_query("SELECT null FROM tb_acesso_visitante WHERE HR_SAIDA = '' AND CO_PESSOA = '".$codigoVisitante."'")
			or die("<script>
						alert('[Erro 2] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
						history.back(-1);
					</script>");
			
			$sqlAcessoConsultor = mysql_query("SELECT ac . * 
												FROM tb_acesso_consultor ac
												 WHERE ac.hr_saida = '' 
												 AND ac.co_consultor = (SELECT c.co_consultor 
												 						FROM tb_consultor c 
																		INNER JOIN tb_acesso_visitante av 
																		ON c.co_pessoa = av.co_pessoa
																		WHERE av.co_pessoa = '".$codigoVisitante."' LIMIT 1);")
			or die("<script>
						alert('[Erro 2] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
						history.back(-1);
					</script>");
					
			if(mysql_num_rows($sqlAcessoVisitante) > 0 || mysql_num_rows($sqlAcessoConsultor)>0){
				echo "[Erro] - Já existe um Acesso para este Visitante em aberto.";
			}else{
				$query = mysql_query("INSERT INTO tb_acesso_visitante (DT_ACESSO_VISITANTE
										  , CO_PESSOA
										  , HR_ENTRADA
										  , CO_TIPO_VEICULO
										  , PL_VEICULO
										  , CO_CARTAO_IDENTIFICACAO
										  , CO_USUARIO_ENTRADA) 
									  VALUES ('".date("Y-m-d")."'
										  , '".$codigoVisitante."'
										  , '".$horaEntrada."'
										  , '".$tipoVeiculo."'
										  , '".$placaVeiculo."'
										  , '".$numeroCartao."'
										  , '".$_SESSION['codigoUsuario']."')");
				if($query){
					echo false;
				}else{
					echo "[Erro] - Não foi possível inserir o Acesso Visitante no momento.";
				}
			}
			
		}
				
	}
	
?>