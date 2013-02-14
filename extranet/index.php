<?php	
	
	/**
	 * Formulario de login e script para capturar os dados de acesso: IP, Data e Hora do acesso.
	 * 
	 * @author RouterNet - Soluções em Tecnologia <comercial@routernet.com.br>
	 * @version 1.0 - 19/09/2012 08:00
	 * 
	 */
	date_default_timezone_set('America/Sao_Paulo');
	
	//EFETUA A CAPTURA DO IP DO USUARIO
	$IpAcessoLogin = (isset($_SERVER['REMOTE_ADDR'])?$_SERVER['REMOTE_ADDR']:'unknown');			
	$forward = ( isset($_SERVER['HTTP_X_FORWARDED_FOR'])?$_SERVER['HTTP_X_FORWARDED_FOR']:false);			
	$IpAcessoLogin=( ($IpAcessoLogin=='unknown' &&  $foward && $forward!='unknown' )?$forward:$IpAcessoLogin); 
	
	//PEGANDO A DATA HORA DO ACESSO
	$DtAcessoLogin = date("Y/m/d");
	$HrAcessoLogin = date("H:i:s");
		
	//ARQUIVO DE CONEXAO
	require("sistema/setup.php"); 
	
	mysql_query ("INSERT INTO tb_acesso_login(DT_ACESSO_LOGIN, HR_ACESSO_LOGIN, IP_ACESSO_LOGIN)
				  VALUES('".$DtAcessoLogin."', '".$HrAcessoLogin."', '".$IpAcessoLogin."')")
	or die ("<script>
			     alert('[Erro] - Inserção Banco de Dados.');
				 window.close();
			 </script>");	
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<meta name="author" content="Euripedes B. Silva Junior [ ejunior@bravomoveis.com ]" />
<title>.:: Bravo Moveis - Extranet::.</title>

	<!-- css template -->
    <link href="bootstrap.css" rel="stylesheet" type="text/css">
    <link href="style_login.css" rel="stylesheet" type="text/css">
    
    
</head>
<body>

<div class="container">
    <div class="row">
    <div id="quadro-login" class="span10 offset1">
        <div class="box-login">
            <div class="row">
                <div class="span2 offset1">
                    <h1 class="logoextra"><a href="http://extranet.bravomoveis.com.br/">Bravo Moveis - Extranet</a></h1>
                </div>
                <div class="span5 offset1">
                    <h3>Conecte-se na Extranet:</h3>
                    <form name="myForm" id="myForm" action="autentica.php" method="post">
                    <table class="table table-login">
        				<tbody>
                        <tr>
		        			<th><span class="add-on">Usuário do Membro:</span></th>
		        			<td class="codmem"><input title="Usuário do Membro" style="border: 1px solid rgb(0, 46, 108);" id="loginUsuario" name="loginUsuario" size="10" type="text"></td>
	        			</tr>
		        		<tr>
		        			<th><span class="add-on">Senha:</span></th>
		        			<td class="pwd"><input title="Senha" name="senhaUsuario" id="senhaUsuario" type="password"></td>
		        		</tr>
		        		
		        		<tr>
		        			<td>&nbsp;</td>
		        			<td>
		        	    		<input title="Conectar" value="Conectar" id="enviar" class="btn btn-success span2 conectar" type="submit">
		        			</td>
		        		</tr>
		    	    </tbody>
                    </table>
		            </form>
        		</div><!--span5-->
		</div><!--row-->
    </div><!--box-login-->
        
        <div class="row rodape">
            <p><strong>Atenção:</strong> A Extranet Bravo Moveis devera ser utlizada somente no navegador FireFox e totalmente atualizado.
            <br />
           <?php
	    echo "Por medidas de seguran&ccedil;a, voc&ecirc; est&aacute; sendo monitorado por nosso sistema.<br>";
		echo "O IP $IpAcessoLogin foi gravado em nosso servidores<br>";
		echo "&nbsp;na data ".date("d-m-Y", strtotime($DtAcessoLogin))." e horário ".date("H:i:s", strtotime($HrAcessoLogin));
	?>
    </p>
        </div>
            
    </div><!--quadro-login-->
    </div><!--row-->
</div><!--container-->

</body>
</html>