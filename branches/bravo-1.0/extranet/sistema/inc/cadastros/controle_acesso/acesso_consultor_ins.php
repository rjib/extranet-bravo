<?php
	
	session_start();
	
    require("../../../setup.php");
	
	$codigoConsultor = $_POST["codigoConsultor"];
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
	
		
	if(empty($codigoConsultor)){
		echo "Informe o Consultor";
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
		
		$sqlAcessoConsultor= mysql_query("SELECT null FROM tb_acesso_prestador ac WHERE HR_SAIDA = '' AND CO_CARTAO_IDENTIFICACAO = '".$numeroCartao."'")
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
		
		$sqlAcessoVisitante= mysql_query("SELECT null FROM tb_acesso_visitante ac WHERE HR_SAIDA = '' AND CO_CARTAO_IDENTIFICACAO = '".$numeroCartao."'")
		or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
		
		if(mysql_num_rows($sqlAcessoConsultor) > 0 || mysql_num_rows($sqlAcessoVisitante)>0){
			echo "[Erro] - Já existe um Acesso com este Número de Cartão de Identificação.";
		}else{
			$sqlAcessoConsultor= mysql_query("SELECT null FROM tb_acesso_prestador WHERE HR_SAIDA = '' AND CO_PRESTADOR = '".$codigoConsultor."'")
			or die("<script>
						alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
						history.back(-1);
					</script>");
			$sqlAcessoVisitante = mysql_query("SELECT 
   												 av . *
											  FROM
    										  	tb_acesso_visitante av
											  WHERE
											    av.hr_saida = ''
       										 AND av.co_pessoa = (select 
           										p.co_pessoa
        									 FROM
            									tb_prestador_servico c
                							 INNER JOIN
            									tb_pessoa p ON p.co_pessoa = c.co_pessoa
        									 WHERE
            									c.co_prestador = ".$codigoConsultor.");");
			if(mysql_num_rows($sqlAcessoConsultor) > 0 || mysql_num_rows($sqlAcessoVisitante)>0){
				echo "[Erro] - Já existe um Acesso para este Prestador de Serviço em aberto.";
			}else{
				$query = mysql_query("INSERT INTO tb_acesso_prestador (DT_ACESSO_PRESTADOR
										  , CO_PRESTADOR
										  , HR_ENTRADA
										  , CO_TIPO_VEICULO
										  , PL_VEICULO
										  , CO_CARTAO_IDENTIFICACAO
										  , CO_USUARIO_ENTRADA) 
									  VALUES ('".date("Y-m-d")."'
										  , '".$codigoConsultor."'
										  , '".$horaEntrada."'
										  , '".$tipoVeiculo."'
										  , '".$placaVeiculo."'
										  , '".$numeroCartao."'
										  , '".$_SESSION['codigoUsuario']."')");
										
				if($query){
					echo false;
				}else{
					echo "[Erro] - Não foi possível inserir o Acesso Prestador de serviço no momento.";
				}
			}
			
		}
				
	}
	
?>