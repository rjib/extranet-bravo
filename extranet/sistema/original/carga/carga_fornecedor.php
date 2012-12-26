<?php
	
	//CONECTA COM O BANCO DE DADOS LOCAL
	$conexao = mysql_connect ("192.168.0.15","root","")
	or die (mysql_error ());
	
	//SELECIONA O BANCO DE DADOS LOCAL
	$db = mysql_select_db ("extranet")
	or die  ("<script>
			     alert ('[Erro] - CONFIGURAÇÃO DO BANCO DE DADOS!');
				 window.close ()';
			 </script>");
	
	ini_set("max_execution_time",3600);
	ini_set("memory_limit","50M");
    set_time_limit(0);
	
   	$outputPath = "";
	
	$arquivo[0]="tabela_fornecedor.csv";
	
	$ArquivoImportar = $arquivo;
	$loops = count ($ArquivoImportar);
	
	for ($i=0; $i<$loops; $i++){	
	 
		$myfile = $ArquivoImportar[$i];
						
		//ABRI O ARQUIVO COM 'r' SOMENTE LEIRURA
		//COLOCA O PONTEIRO DO ARQUIVO NO COMECO DO ARQUIVO
		$abre = fopen ($outputPath.$myfile, "r");
				
		//LER ARQUIVO
	    $informacao = trim (fread ($abre, filesize ($outputPath.$myfile)));
				
		//FECHA ARQUIVO
		fclose ($abre);	
				
		//EXPLODE AS LINHAS QUANDO SALTAR UMA LINHA "\n"
        $linha = explode ("\n", $informacao);	
			
		$count = 0;
			
		//PERCORREMOS CADA LINHA DO ARQUIVO
		$arquivo = fopen ($outputPath.$myfile, "r");
		
		while($linha_arquivo = fgets ($arquivo)) {
			
		    $linha = explode (";",$linha_arquivo);
		    $queryInserirPessoa = "INSERT INTO tb_pessoa (NO_PESSOA
		    							, TP_PESSOA
		    							, EM_PESSOA
		    							, SITE_PESSOA) 
		    					VALUES('".addslashes(trim(ucwords(strtolower($linha[0]))))."' 
		    							,'J' 
		    							,'".addslashes(trim(ucwords(strtolower($linha[10]))))."' 
		    							,'".addslashes(trim(ucwords(strtolower($linha[11]))))."')";
		    
		    $dcep = substr($linha[7], 5,3);
		    $cep = substr($linha[7],0,5)."-".$dcep;
		    $queryBuscaCEP 		  = "SELECT * FROM tb_cep WHERE NU_CEP = '".$cep."'";
		    $_CEP = mysql_fetch_row(mysql_query($queryBuscaCEP,$conexao));
		    if($_CEP !=false){
		    	$co_cep = $_CEP[0];
		    }else{
		    	$co_cep = false;
		    }

		    
		    mysql_query($queryInserirPessoa,$conexao);
		    
		    $co_pessoa = mysql_insert_id();
		    //05.281.996/0001-74
		    
		    $x = substr(trim($linha[1]), 0,2);
		    $y = substr(trim($linha[1]), 2,3);
		    $z = substr(trim($linha[1]), 5,3);
		    $a = substr(trim($linha[1]), 8,4);
		    $b = substr(trim($linha[1]), 12,2);
		    
		    
		   $cnpj = $x.".".$y.".".$z."/".$a."-".$b;
		    
		   $queryInserirJuridica = "INSERT INTO tb_pessoa_juridica (CO_PESSOA
		    							, CNPJ_PESSOA_JURIDICA
		    							, IE_PESSOA_JURIDICA)
		    						VALUES(".$co_pessoa."
		    								,'".$cnpj."'
		    								,'".trim($linha[2])."')";
		    
		    mysql_query($queryInserirJuridica);
		    $co_juridica = mysql_insert_id();
		    
		    if($co_cep!=false){
		    	
		    	$queryInserirEndereco = "INSERT INTO tb_endereco (
									    	 CO_PESSOA
									    	, CO_CEP
									    	, NU_ENDERECO
									    	, TP_PRINCIPAL)
								    	VALUES(
									    	$co_pessoa
									    	, $co_cep
									    	, '*'
									    	, 'S') ";
		    	mysql_query($queryInserirEndereco,$conexao);
		    }
		    
		    $queryInserirContato  = "INSERT INTO tb_contato (CO_PESSOA, NO_CONTATO) VALUES (".$co_pessoa."
		    								, '".addslashes(trim(ucwords(strtolower($linha[0]))))."')";
		    mysql_query($queryInserirContato,$conexao);
		    
		    $co_contato = mysql_insert_id();
		    $ddd = trim($linha[8]);
		    if(!empty($ddd)){ 
		    	$x = substr(trim($linha[9]), 0,4);
		    	$y = substr(trim($linha[9]),4,4);
		    	$tel = $x."-".$y;
			    $queryInserirTelefone = "INSERT INTO tb_telefone (CO_PESSOA, CO_CONTATO, CO_TIPO_TELEFONE, NU_TELEFONE)
			    						 VALUES (".$co_pessoa."
			    		    						 ,$co_contato
			    		    						 ,1
			    		    						 ,'(".trim($linha[8]).") ".$tel."')";
			    mysql_query($queryInserirTelefone, $conexao);
		    }
		    $email = trim($linha[10]);
		    
		    if(!empty($email)){
			    $queryInserirEmail = "INSERT INTO tb_email (CO_PESSOA, CO_CONTATO, CO_TIPO_EMAIL, NO_EMAIL)
			    					  VALUES (".$co_pessoa.",".$co_contato.",2, '".addslashes(trim(strtolower($linha[10])))."')";
			    mysql_query($queryInserirEmail, $conexao);
		    }
		    
		    $count++;
			}
		}
		
		fclose ($arquivo);
		
		//rename($outputPath.$myfile, $outputPath."importados/".$myfile);
		
		echo "Arquivo: ".$myfile." importado com sucesso!<br>";
		echo "<strong>".$count."</strong> Registros inseridos";
