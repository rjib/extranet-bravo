<?php
	
	//CONECTA COM O BANCO DE DADOS LOCAL
	$conexao = mysql_connect ("localhost","root","")
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
	
	$arquivo[0]="importar_SB1010.csv";
	
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
			
			$sqlPcpProduto = mysql_query ("SELECT null FROM tb_pcp_produto WHERE CO_RECNO = '".addslashes (trim ($linha[11]))."'",$conexao)
			or die (mysql_error ());
			
			if (mysql_num_rows ($sqlPcpProduto) == 0){
			    mysql_query ("INSERT INTO tb_pcp_produto (CO_PRODUTO
								  ,CO_INT_PRODUTO
								  ,CO_COR
								  ,DS_PRODUTO
								  ,TP_PRODUTO
								  ,TP_UNIDADE
								  ,CO_LINHA
								  ,NU_COMPRIMENTO
								  ,NU_LARGURA
								  ,NU_ESPESSURA
								  ,NU_PESO
								  ,CO_RECNO) 
				              VALUES ('".addslashes (trim ($linha[0]))."'
							      , '".addslashes (trim ($linha[1]))."'
								  , '".addslashes (trim ($linha[2]))."'
								  , '".addslashes (trim ($linha[3]))."'
								  , '".addslashes (trim ($linha[4]))."'
								  , '".addslashes (trim ($linha[5]))."'
								  , '".addslashes (trim ($linha[6]))."'
								  , '".addslashes (trim ($linha[7]))."'
								  , '".addslashes (trim ($linha[8]))."'
								  , '".addslashes (trim ($linha[9]))."'
								  , '".addslashes (trim ($linha[10]))."'
								  , '".addslashes (trim ($linha[11]))."')",$conexao)
			    or die  (mysql_error ()." ->  (insereProduto)".$linha[11]);
			}
			
			$count++;
			
		}
		
		fclose ($arquivo);
		
		//rename($outputPath.$myfile, $outputPath."importados/".$myfile);
		
		echo "Arquivo: ".$myfile." importado com sucesso!<br>";
		echo "CO_RECNO = ".$linha[11].'</br>';
				  
    }