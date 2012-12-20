<?php
	
	session_start();
	
    require("../../../setup.php");
	
	$codigoAcessoConsultor = $_POST["codigoAcessoConsultor"];
	$horaSaidaInserir      = $_POST["horaSaidaInserir"];
	$horaEntrada 		   = $_POST["horaEntrada"];
	if($horaEntrada > $horaSaidaInserir){	
		echo("O Horário de saída não deve ser menor que o horário de entrada!");		
		exit;
	}		
	if($horaSaidaInserir == "0" or $horaSaidaInserir == "") {
		echo "Informe a Hora Saída";
	}else {
		
		$query = mysql_query("UPDATE tb_acesso_prestador SET 
		                          HR_SAIDA             = '".$horaSaidaInserir."'
							      , CO_USUARIO_SAIDA = '".$_SESSION['codigoUsuario']."' 
							  WHERE CO_ACESSO_PRESTADOR = '".$codigoAcessoConsultor."'");
		if($query){
			echo false;
		}else{
			echo "[Erro] - Não foi possível inserir Hora de Saída do Acesso Consultor no momento.";
		}
		
	}
	
?>