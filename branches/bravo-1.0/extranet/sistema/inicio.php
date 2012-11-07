<?php
	
	session_start();
	
	require("setup.php");
	
	require("verifica.php");
	
	@$pg	= $_REQUEST['pg'];
	@$sub	= $_REQUEST['sub'];
		
	/****** Administrativo ******/
	if( $pg == "logout" && !$sub ){
	    $inicio = "logout.php";
	}
	
	elseif($pg	== "cliente" && !$sub){
	    $inicio	= "cadastros/cliente.php";
	}
	
	elseif($pg	== "setor" && !$sub){
	    $inicio	= "cadastros/setor.php";
	}elseif($pg	== "setor_ins" && !$sub){
	    $inicio	= "cadastros/setor_ins.php";
	}elseif($pg	== "setor_alt" && !$sub){
	    $inicio	= "cadastros/setor_alt.php";
	}
	
	elseif($pg	== "cargo" && !$sub){
	    $inicio	= "cadastros/cargo.php";
	}elseif($pg	== "cargo_ins" && !$sub){
	    $inicio	= "cadastros/cargo_ins.php";
	}elseif($pg	== "cargo_alt" && !$sub){
	    $inicio	= "cadastros/cargo_alt.php";
	}
	
	elseif($pg	== "cartao_identificacao" && !$sub){
	    $inicio	= "cadastros/cartao_identificacao.php";
	}elseif($pg	== "cartao_identificacao_ins" && !$sub){
	    $inicio	= "cadastros/cartao_identificacao_ins.php";
	}elseif($pg	== "cartao_identificacao_alt" && !$sub){
	    $inicio	= "cadastros/cartao_identificacao_alt.php";
	}
	
	elseif($pg	== "consultor" && !$sub){
	    $inicio	= "cadastros/consultor.php";
	}elseif($pg	== "consultor_ins" && !$sub){
	    $inicio	= "cadastros/consultor_ins.php";
	}elseif($pg	== "consultor_alt" && !$sub){
	    $inicio	= "cadastros/consultor_alt.php";
	}
	
	elseif($pg	== "colaborador" && !$sub){
	    $inicio	= "cadastros/colaborador.php";
	}elseif($pg	== "colaborador_ins" && !$sub){
	    $inicio	= "cadastros/colaborador_ins.php";
	}elseif($pg	== "colaborador_alt" && !$sub){
	    $inicio	= "cadastros/colaborador_alt.php";
	}
	
	if($pg	== "usuario" && !$sub){
	    $inicio	= "cadastros/usuario.php";
	}elseif($pg	== "usuario_ins" && !$sub){
	    $inicio	= "cadastros/usuario_ins.php";
	}elseif($pg	== "usuario_alt" && !$sub){
	    $inicio	= "cadastros/usuario_alt.php";
	}
	
	if($pg	== "pessoa" && !$sub){
	    $inicio	= "cadastros/pessoa.php";
	}elseif($pg	== "pessoa_ins" && !$sub){
	    $inicio	= "cadastros/pessoa_ins.php";
	}elseif($pg	== "pessoa_alt" && !$sub){
	    $inicio	= "cadastros/pessoa_alt.php";
	}
	
	elseif($pg	== "estado_civil" && !$sub){
	    $inicio	= "cadastros/estado_civil.php";
	}elseif($pg	== "estado_civil_ins" && !$sub){
	    $inicio	= "cadastros/estado_civil_ins.php";
	}elseif($pg	== "estado_civil_alt" && !$sub){
	    $inicio	= "cadastros/estado_civil_alt.php";
	}
	
	elseif($pg	== "nivel_formacao" && !$sub){
	    $inicio	= "cadastros/nivel_formacao.php";
	}elseif($pg	== "nivel_formacao_ins" && !$sub){
	    $inicio	= "cadastros/nivel_formacao_ins.php";
	}elseif($pg	== "nivel_formacao_alt" && !$sub){
	    $inicio	= "cadastros/nivel_formacao_alt.php";
	}
	
	elseif($pg	== "nacionalidade" && !$sub){
	    $inicio	= "cadastros/nacionalidade.php";
	}elseif($pg	== "nacionalidade_ins" && !$sub){
	    $inicio	= "cadastros/nacionalidade_ins.php";
	}elseif($pg	== "nacionalidade_alt" && !$sub){
	    $inicio	= "cadastros/nacionalidade_alt.php";
	}

	
	elseif($pg	== "papel" && !$sub){
	    $inicio	= "cadastros/papel.php";
	}elseif($pg	== "papel_ins" && !$sub){
	    $inicio	= "cadastros/papel_ins.php";
	}elseif($pg	== "papel_alt" && !$sub){
	    $inicio	= "cadastros/papel_alt.php";
	}	
	
	elseif($pg	== "tipo_sanguineo" && !$sub){
	    $inicio	= "cadastros/tipo_sanguineo.php";
	}elseif($pg	== "tipo_sanguineo_ins" && !$sub){
	    $inicio	= "cadastros/tipo_sanguineo_ins.php";
	}elseif($pg	== "tipo_sanguineo_alt" && !$sub){
	    $inicio	= "cadastros/tipo_sanguineo_alt.php";
	}
	
	elseif($pg	== "tipo_email" && !$sub){
	    $inicio	= "cadastros/tipo_email.php";
	}elseif($pg	== "tipo_email_ins" && !$sub){
	    $inicio	= "cadastros/tipo_email_ins.php";
	}elseif($pg	== "tipo_email_alt" && !$sub){
	    $inicio	= "cadastros/tipo_email_alt.php";
	}
	
	elseif($pg	== "tipo_telefone" && !$sub){
	    $inicio	= "cadastros/tipo_telefone.php";
	}elseif($pg	== "tipo_telefone_ins" && !$sub){
	    $inicio	= "cadastros/tipo_telefone_ins.php";
	}elseif($pg	== "tipo_telefone_alt" && !$sub){
	    $inicio	= "cadastros/tipo_telefone_alt.php";
	}
	
	elseif($pg	== "tipo_veiculo" && !$sub){
	    $inicio	= "cadastros/tipo_veiculo.php";
	}elseif($pg	== "tipo_veiculo_ins" && !$sub){
	    $inicio	= "cadastros/tipo_veiculo_ins.php";
	}elseif($pg	== "tipo_veiculo_alt" && !$sub){
	    $inicio	= "cadastros/tipo_veiculo_alt.php";
	}
		
	elseif($pg	== "uf" && !$sub){
	    $inicio	= "uf.php";
	}
	
	elseif($pg	== "municipio" && !$sub){
	    $inicio	= "municipio.php";
	}
		
	elseif($pg	== "cep" && !$sub){
	    $inicio	= "cep.php";
	}
	
	elseif($pg	== "bairro" && !$sub){
	    $inicio	= "bairro.php";
	}
	
	/****** Controle de Acesso ******/
	if($pg	== "acesso_consultor" && !$sub){
	    $inicio	= "cadastros/controle_acesso/acesso_consultor.php";
	}elseif($pg	== "acesso_consultor_ins" && !$sub){
	    $inicio	= "cadastros/controle_acesso/acesso_consultor_ins.php";
	}elseif($pg	== "acesso_consultor_alt" && !$sub){
	    $inicio	= "cadastros/controle_acesso/acesso_consultor_alt.php";
	}
	
	if($pg	== "acesso_visitante" && !$sub){
	    $inicio	= "cadastros/controle_acesso/acesso_visitante.php";
	}elseif($pg	== "acesso_visitante_ins" && !$sub){
	    $inicio	= "cadastros/controle_acesso/acesso_visitante_ins.php";
	}elseif($pg	== "acesso_visitante_alt" && !$sub){
	    $inicio	= "cadastros/controle_acesso/acesso_visitante_alt.php";
	}
	
	/**	Ordem de Produção **/
	elseif($pg	== "ordem_producao" && !$sub){
	    $inicio	= "cadastros/ordem_producao/ordem_producao.php";
	}elseif($pg	== "importar_ad" && !$sub){
		$inicio	= "cadastros/ordem_producao/importarAD.php";
	}elseif($pg	== "lista_cores" && !$sub){
		$inicio	= "cadastros/ordem_producao/lista_cores.php";
	}elseif($pg	== "lista_op" && !$sub){
		$inicio	= "cadastros/ordem_producao/lista_op.php";
	}elseif($pg	== "lista_plano_corte" && !$sub){
		$inicio	= "cadastros/ordem_producao/lista_plano_corte.php";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="author" content="RouterNet - Soluções em Tecnologia [ comercial@routernet.com.br ]" />
<meta name="language" content="pt-br" />
<title>.:: Bravo Moveis - Extranet ::.</title>
<link href="css/style_global.css" rel="stylesheet" type="text/css" />
<link href="css/style_menu_header.css" rel="stylesheet" type="text/css" />
<link type="text/css" href="css/jquery-ui-1.8.16.custom.css" rel="stylesheet" />	
<link rel="shortcut icon" href="../img/favicon.ico" type="image/x-icon">
<!--[if IE 6]>
<link href="css/style_fixa_painel_ie6.css" rel="stylesheet" type="text/css" />
<![endif]-->
<script type="text/javascript" src="js/jquery-1.3.2.js" language="javascript"></script>
<script type="text/javascript" src="js/jquery-1.6.2.min.js" language="javascript"></script>
<script type="text/javascript" src="js/jquery.maskedinput-1.3.min.js"/></script>
<script type="text/javascript" src="js/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="js/menu_header.js"></script>
<script type="text/javascript" src="js/eventos.js"></script>
<script type="text/javascript" src="js/jquery.tablesorter.js" language="javascript"></script>
<script type="text/javascript" src="js/simpleAutoComplete.js"></script>
<script type="text/javascript" src="js/jquery.price_format.1.5.js"/></script>
<script type="text/javascript" src="js/jquery.alphanumeric.js"/></script>
<script type="text/javascript" src="js/helper.js"/></script>
<script src="js/jquery.form.js" type="text/javascript"></script>
</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" bgcolor="FFFFFF">
<?php
	if( (isset($inicio)) and (file_exists($inicio)) ) {
		include($inicio);
	}else{
		include ("principal.php");
	}
?>
</body>
</html>