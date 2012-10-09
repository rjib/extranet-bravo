<?php
	
	session_start();
	
    require("../../../setup.php");
	
	$codigoAcessoVisitante = $_POST["codigoAcessoVisitante"];
	$horaSaidaInserir      = $_POST["horaSaidaInserir"];
	$horaEntrada 		   = $_POST["horaEntrada"];
	if($horaEntrada > $horaSaidaInserir){	
		echo("O Horário de saída não deve ser menor que o horário de entrada!");
		exit;
	}
	if($horaSaidaInserir == "0" or $horaSaidaInserir == "") {
		echo "Informe a Hora Saída";
	}else {
		
		$query = mysql_query("UPDATE tb_acesso_visitante SET 
		                          HR_SAIDA             = '".$horaSaidaInserir."'
							      , CO_USUARIO_SAIDA = '".$_SESSION['codigoUsuario']."' 
							  WHERE CO_ACESSO_VISITANTE = '".$codigoAcessoVisitante."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir Hora de Saída do Acesso Visitante no momento.";
		}
		
	}
	
?>