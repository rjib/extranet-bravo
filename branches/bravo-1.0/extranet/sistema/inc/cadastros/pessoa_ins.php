<?php
	
	session_start();
	
    require("../../setup.php");
	
	$pessoaTipo      = $_POST["pessoaTipo"];
	$nome            = addslashes(trim(ucwords(strtolower($_POST["nome"]))));
	$email           = $_POST["email"];
	$site            = $_POST["site"];
		
	$cnpj            = $_POST["cnpj"];
	$ie              = $_POST["ie"];
		
	$cpf             = $_POST["cpf"];
	$rg              = $_POST["rg"];
	$orgaoExpedidor  = $_POST["orgaoExpedidor"];
	
	$dataEmissao     = $_POST["dataEmissao"];
	$sexo            = $_POST["sexo"];
	$dataNascimento  = $_POST["dataNascimento"];
	$estadoCivil     = $_POST["estadoCivil"];
	$nacionalidade   = $_POST["nacionalidade"];
	$codigoEstado    = $_POST["codigoEstado"];
	$codigoCidade    = $_POST["codigoCidade"];
	$nivelFormacao   = $_POST["nivelFormacao"];
	$profissao       = $_POST["profissao"];
	$nomePai         = addslashes(trim(ucwords(strtolower($_POST["nomePai"]))));
	$nomeMae         = addslashes(trim(ucwords(strtolower($_POST["nomeMae"]))));
	
	if($pessoaTipo == 'F'){
		
		if (empty($nome)) {
		    echo "Informe o Nome";
		}elseif (empty($cpf)){
			echo "Informe o CPF";
		}elseif (empty($rg)){
			echo "Informe o RG";
		}elseif ($sexo == "0"){			
		    echo "Informe o Sexo";
		}elseif (empty($dataNascimento)){	
		    echo "Informe a Data Nascimento";
		}elseif ($nacionalidade == "0"){			
		    echo "Informe a Nacionalidade";
		}elseif ($codigoEstado == "0"){			
		    echo "Informe a Unidade Federativa";
		}elseif ($codigoCidade == "0"){			
		    echo "Informe o Municipio";
		}else{
			
			$query = mysql_query("INSERT INTO tb_pessoa (NO_PESSOA
							          , TP_PESSOA
							          , EM_PESSOA
							          , SITE_PESSOA) 
							      VALUES ('".addslashes(trim(ucwords(strtolower($nome))))."' 
							          , '".$pessoaTipo."'
							          , '".$email."'
							          , '".$site."')");
			if($query){
			
		    	$codigoPessoa = mysql_insert_id();
				
				list ($dataEmissaoDia, $dataEmissaoMes, $dataEmissaoAno) = split ('[/.-.]', $dataEmissao);
				$dataEmissaoFormatada = $dataEmissaoAno."-".$dataEmissaoMes."-".$dataEmissaoDia;
				
				list ($dataNascimentoDia, $dataNascimentoMes, $dataNascimentoAno) = split ('[/.-.]', $dataNascimento);
				$dataNascimentoFormatada = $dataNascimentoAno."-".$dataNascimentoMes."-".$dataNascimentoDia;
				
			    if (empty($profissao)){	
				    $sql = "INSERT INTO tb_pessoa_fisica (CO_PESSOA
							    , CO_ESTADO_CIVIL
							    , CPF_PESSOA_FISICA
							    , RG_PESSOA_FISICA
							    , RG_ORGAO_PESSOA_FISICA
							    , DT_EMISSAO_RG_PESSOA_FISICA
							    , DT_NASCIMENTO_PESSOA_FISICA
							    , TP_SEXO_PESSOA_FISICA
							    , CO_NACIONALIDADE
							    , CO_UF
							    , CO_MUNICIPIO
							    , CO_NIVEL_FORMACAO
							    , NO_PAI
							    , NO_MAE) 
						    VALUES ('".$codigoPessoa."' 
							    , '".$estadoCivil."'
							    , '".$cpf."'
						        , '".$rg."'
							    , '".$orgaoExpedidor."'
							    , '".$dataEmissaoFormatada."'
							    , '".$dataNascimentoFormatada."'
							    , '".$sexo."'
							    , '".$nacionalidade."'
							    , '".$codigoEstado."'
							    , '".$codigoCidade."'
							    , '".$nivelFormacao."'
							    , '".addslashes(trim(ucwords(strtolower($nomePai))))."'
							    , '".addslashes(trim(ucwords(strtolower($nomeMae))))."')";					
				}else{
			
					$sql = "INSERT INTO tb_pessoa_fisica (CO_PESSOA
							    , CO_ESTADO_CIVIL
							    , CPF_PESSOA_FISICA
							    , RG_PESSOA_FISICA
							    , RG_ORGAO_PESSOA_FISICA
							    , DT_EMISSAO_RG_PESSOA_FISICA
							    , DT_NASCIMENTO_PESSOA_FISICA
							    , TP_SEXO_PESSOA_FISICA
							    , CO_NACIONALIDADE
							    , CO_UF
							    , CO_MUNICIPIO
							    , CO_NIVEL_FORMACAO
							    , CO_PROFISSAO
							    , NO_PAI
							    , NO_MAE) 
							VALUES ('".$codigoPessoa."' 
							    , '".$estadoCivil."'
							    , '".$cpf."'
							    , '".$rg."'
							    , '".$orgaoExpedidor."'
							    , '".$dataEmissaoFormatada."'
						        , '".$dataNascimentoFormatada."'
							    , '".$sexo."'
							    , '".$nacionalidade."'
							    , '".$codigoEstado."'
							    , '".$codigoCidade."'
							    , '".$nivelFormacao."'
							    , '".$profissao."'
							    , '".addslashes(trim(ucwords(strtolower($nomePai))))."'
							    , '".addslashes(trim(ucwords(strtolower($nomeMae))))."')";
				}
				
				$query = mysql_query($sql);		
				
				if($query){
					$_SESSION['codigoPessoa'] = $codigoPessoa; 
				    echo false;
				}else{
					
					mysql_query("DELETE FROM tb_pessoa WHERE CO_PESSOA = '".$codigoPessoa."'")
					or die(mysql_error());
				    
					echo "[Erro] - Não foi possível inserir a pessoa no momento.";
					
				}
				
			}else{
			    echo "[Erro] - Não foi possível inserir a pessoa no momento.";
		    }
				
		}
		
	}else{
		
		if (empty($nome)) {
		    echo "Informe o Nome";
		}elseif (empty($cnpj)){
			echo "Informe o CNPJ";
		}else{
			
			$query = mysql_query("INSERT INTO tb_pessoa (NO_PESSOA
							          , TP_PESSOA
							          , EM_PESSOA
							          , SITE_PESSOA) 
							      VALUES ('".addslashes(trim(ucwords(strtolower($nome))))."' 
							          , 'J'
							          , '".$email."'
							          , '".$site."')");
			if($query){
			
		    	$codigoPessoa = mysql_insert_id();
			
				$query = mysql_query("INSERT INTO tb_pessoa_juridica (CO_PESSOA
										  , CNPJ_PESSOA_JURIDICA
										  , IE_PESSOA_JURIDICA) 
									  VALUES ('".$codigoPessoa."'
										  , '".$cnpj."'
									      , '".$ie."')");
				if($query){
					$_SESSION['codigoPessoa'] = $codigoPessoa;
				    echo false;
				}else{
					mysql_query("DELETE FROM tb_pessoa WHERE CO_PESSOA = '".$codigoPessoa."'",$conexaoERP)
					or die(mysql_error());
				    echo "[Erro] - Não foi possível inserir a pessoa no momento.";
				}
				
			}else{
			    echo "[Erro] - Não foi possível inserir a pessoa no momento.";
		    }
				
		}
	
	}
	
	//echo json_encode($codigoPesosa);
	
?>