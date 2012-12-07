<?php

    require("../../../setup.php");
	
	$codigoAcessoConsultor = $_POST["codigoAcessoConsultor"];
	$horaEntradaAlterar    = $_POST["horaEntradaAlterar"];
	$tipoVeiculoAlterar    = $_POST["tipoVeiculoAlterar"];
	$placaVeiculoAlterar   = $_POST["placaVeiculoAlterar"];
	$numeroCartaoAlterar   = $_POST["numeroCartaoAlterar"];
	
	$sqlTipoVeiculo= mysql_query("SELECT fl_exige_placa FROM tb_tipo_veiculo WHERE co_tipo_veiculo = '".$tipoVeiculoAlterar."'")
	or die("<script>
					alert('[Erro] - Ocorreu algum erro durante a consulta, favor entrar em contato com o suporte!');
					history.back(-1);
				</script>");
	$row= mysql_fetch_row($sqlTipoVeiculo);
		
	if($horaEntradaAlterar == "0" or $horaEntradaAlterar == "") {
		echo "Informe a Hora Entrada";
	}elseif(empty($tipoVeiculoAlterar)){
		echo "Informe o Tipo Veiculo";
	}elseif($row[0]!="N" && empty($placaVeiculoAlterar)){
		echo "Informe a Placa do Veiculo".$placaVeiculoAlterar;
	}elseif(empty($numeroCartaoAlterar)){
		echo "Informe o Número do Cartão";
	}elseif ($row[0]!="N" && strlen($placaVeiculoAlterar) < 8) {
		echo "A Placa do Veiculo deve ter 8 caracteres";
	}else {
		
		$query = mysql_query("UPDATE tb_acesso_prestador SET
		                          HR_ENTRADA                = '".$horaEntradaAlterar."'
							      , CO_TIPO_VEICULO         = '".$tipoVeiculoAlterar."'
							      , PL_VEICULO              = '".$placaVeiculoAlterar."'
							      , CO_CARTAO_IDENTIFICACAO = '".$numeroCartaoAlterar."'
							  WHERE CO_ACESSO_CONSULTOR = '".$codigoAcessoConsultor."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível alterar o Acesso Consultor no momento.";
		}
		
	}
	
?>