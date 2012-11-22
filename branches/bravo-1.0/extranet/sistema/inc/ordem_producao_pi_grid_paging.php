<?php

    require("../setup.php");

	class Paging extends Connection{
	
		public $s_table 		= ''; 		//String com o nome da tabela
		public $s_fields		= ''; 		//String com os campos da tabela, separados por v�rgula. Ex: id,name
		public $s_labels		= ''; 		//String com as labels que ficar�o no cabe�alho da tabela. Ex: ID,Nome
		public $s_where			= ''; 		//Claus�la where, se houver
		public $s_orderby		= 'PCP_PRODUTO.CO_COR'; 	//Campo utilizado para ordena��o inicial
		public $s_orientation	= 'ASC';	//ASC ou DESC
		public $i_rowsperpage	= 50;		//Limite de registros visualizados por p�gina
		public $i_page			= 1;		//P�gina atual
		public $i_link_limit	= 5;		//N�mero de links de p�ginas
		public $a_columns		= null; 	//Array com as colunas inseridas pela fun��o addColumn
		public $a_cols_width	= null;
		public $_title			= array();
	
		public function __construct(){
			$this->dbh = new Connection;
		}
		
		public function table($s_table){
			$this->s_table = $s_table;
		}
		
		public function fields($s_fields){
			$this->s_fields = $s_fields;
		}
		
		public function labels($s_labels){
			$this->s_labels = $s_labels;
		}
		
		public function where($s_where){
			$this->s_where = '1 AND ' . $s_where;
		}
		
		public function orderby($s_orderby){
			$this->s_orderby = $s_orderby;
		}
		
		public function orientation($s_orientation){
			
			if($s_orientation != 'ASC' OR $s_orientation != 'DESC'){
			
				$this->s_orientation = 'ASC';
			
			}else{
				
				$this->s_orientation = $s_orientation;
				
			}
		}
		
		public function rowsperpage($i_rowsperpage){
			$this->i_rowsperpage = $i_rowsperpage;
		}
		
		public function page($i_page){
			$this->i_page = $i_page;
		}
		
		public function link_limit($i_link_limit){
			$this->i_link_limit = $i_link_limit;
		}
		
		//Retorna o total de linhas encontradas, usado para montar o n�mero de p�ginas principalmente
		public function total_rows(){
						
			$sth = $this->dbh->prepare('SELECT 
											COUNT(*)
										FROM
											tb_pcp_op AS PCP_OP 
										INNER JOIN tb_pcp_produto AS PCP_PRODUTO ON PCP_OP.CO_PRODUTO = PCP_PRODUTO.CO_PRODUTO
										INNER JOIN tb_pcp_cor AS PCP_COR ON PCP_PRODUTO.CO_COR = PCP_COR.CO_COR
										WHERE '.$this->s_where);
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_NUM);
			return $row[0];
			
		}
		
		//Retorna o n�mero de p�ginas
		public function pages_count(){
		
			return ceil($this->total_rows() / $this->i_rowsperpage);
		
		}
		
		//Utilizada internamente para retornar os campos das tabelas
		private function cells(){
			
			$a_cells = explode(',',$this->s_fields);
			array_unshift($a_cells,count($a_cells));
			return $a_cells;
			
		}
		
		public function cols_width($a_cols_width){
			
			$this->cols_width = explode(',', $a_cols_width);
			array_unshift($this->cols_width,count($this->cols_width));
			
		}
			
		//Guarda os valores das colunas inseridas manualmente
		public function add_column($s_head, $m_content, $i_index = 99){
		
			$this->a_columns[] = array(
				'thead' 	=>	$s_head,
				'content'	=>	$m_content,
				'index'		=>	$i_index
			);
		
		}
		
		//Utilizada internamente para criar o cabe�alho da tabela
		private function thead(){
		
			$a_th = explode(',',$this->s_labels);
			
			//Se forem adicionadas colunas manualmente, elas ser�o adicionadas ao array do cabe�alho
			if(!($this->a_columns == null)){
				
				//Adiciona o cabe�alho "thead" dentro do array de cabe�alhos dentro do �ndice informado
				foreach($this->a_columns as $column){
					
					array_splice($a_th, $column['index'], 0, $column['thead']);
												
				}
				
			}
			
			$a_th = array_map('utf8_encode',$a_th);
			array_unshift($a_th,count($a_th));
			return $a_th;
			
		}
		
		
		//Cria um 'range' de n�meros, baseado em um n�mero m�ximo (ntotal), a quantidade de n�meros
		//que devem aparecer (nmax) e em um n�mero dentro da escala, sempre que o dado n�mero apresentado
		//for maior que a m�tade dos n�meros contidos na escala, a escala incrementa os n�meros at� o limite
		private function page_scale($ntotal, $nmax, $n){
			
			//Caso o n�mero de p�ginas seja menor do que o n�mero limite de links por p�gina
			if($ntotal < $nmax){
				
				$ini = 1;
				$end = $ntotal;
				
			}else{
			
				//Descobre qual o n�mero que representa a metade do n�mero dado como par�metro
				$mid = ceil($nmax / 2);
				
				//Caso a p�gina atual seja igual ou menor que o n�mero do link do meio
				if($n <= $mid){
				
					$ini = 1;
					$end = $nmax;
				
				//Caso a soma da p�gina + o meio seja igual ou menor que o n�mero total de p�ginas
				}elseif($n + $mid <= $ntotal){
					
					//Se a p�gina for maior que o meio
					if($n > $mid){
					
						$ini = ($n - $mid) + 1;
						$end = ($n + $mid) - 1;
					
					}
				
				}else{
					
					$ini = ($ntotal - $nmax) +1;
					$end = $ntotal;
				
				}
			
			}
			
			return array($ini,$end);
			
		}
		
		
		//Imprime a tabela de resultados
		public function show_table(){
			
			//Guarda o conte�do tempor�rio da tabela
			$s_html = '';
			
			//Retorna o array com as labels do cabe�alho da tabela
			$a_th = $this->thead();
			
			//Retorna o array com os campos que ir�o preencher as celulas da table
			$a_cells = $this->cells();
			
			//Faz os ajustes na p�gina, para definir a n�mero inicial de registros
			if($this->i_page != 1){
				$n = ($this->i_page - 1) * $this->i_rowsperpage;
			}else{
				$n = 0;
			}
			
			//Formula a query			
			$sql = 'SELECT 
						CASE  
							WHEN PCP_OP.CO_PCP_AD is null THEN 0
							WHEN PCP_OP.CO_PCP_AD is not null THEN pcp_op.co_pcp_ad
						END AS PCP_OP_AD,
						CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA) NUM_OP,
						PCP_OP.CO_PCP_OP,
						PCP_PRODUTO.CO_INT_PRODUTO,						
						PCP_PRODUTO.DS_PRODUTO ,
						PCP_OP.QTD_PRODUTO,
						PCP_OP.QTD_PROCESSADA,
						PCP_OP.QTD_PRODUZIDA,
						PCP_OP.NU_LOTE,																		
						CONCAT(SUBSTRING(PCP_OP.DT_EMISSAO ,7,2),"/", SUBSTRING(PCP_OP.DT_EMISSAO ,5,2), "/", SUBSTRING(PCP_OP.DT_EMISSAO ,1,4)) DT_EMISSAO
					FROM
						tb_pcp_op AS PCP_OP 
					INNER JOIN tb_pcp_produto AS PCP_PRODUTO ON PCP_OP.CO_PRODUTO = PCP_PRODUTO.CO_PRODUTO
					INNER JOIN tb_pcp_cor AS PCP_COR ON PCP_PRODUTO.CO_COR = PCP_COR.CO_COR			
					WHERE '.$this->s_where.'
					ORDER BY '.$this->s_orderby.' '.$this->s_orientation.'
					LIMIT '.$n.','.$this->i_rowsperpage;
					
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			
			//Cria o cabe�alho da tabela
			$s_html .= '<table align="center" width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA"><thead><tr><th id="th_none" width="9px"></th>';
			
			for($i = 1; $i <= $a_th[0]; $i++){
				
				if($this->cols_width != null){
					$s_html .= '<th align="left" title="'.$this->_title[$i-1].'" width="'.$this->cols_width[$i].'">'.$a_th[$i].'</th>';					
				}else{
					$s_html .= '<th>'.$a_th[$i].'</th>';
				}
				
			}
						
			$s_html .= '</tr></thead><tbody>';
			
			//Se n�o forem inseridas colunas manualmente, ent�o apenas mostra os resultados do banco
			if($this->a_columns == null){
				
				$ordem = 2; //ordem do pi inicia-se com 2
				
				//Cria o corpo da tabela
				while($row = $sth->fetch(PDO::FETCH_NUM)){
					if($row[5]!=$row[6]){
						$s_html .= '<tr><td align="center"><input type="hidden" name="piOrdem[]" id="piOrdem" value="'.$ordem.'"/><input type="checkbox" id="pi_selecionado" name="pi_selecionado[]" value="'.utf8_encode($row[2]).'"/></td>';
					}else{
						$s_html .= '<tr><td align="center"><input type="hidden" name="piOrdem[]" id="piOrdem" value="'.$ordem.'"/><input type="checkbox" id="pi_selecionado" name="pi_selecionado[]" disabled=true value="'.utf8_encode($row[2]).'"/></td>';
					}
					
					for($i = 0; $i < $a_cells[0]; $i++){
						if($i==0){
							if($row[$i]==0){
								$row[$i]="<img title='Não processado' vspace='4px' src='img/status-nao.gif'/>";
							}else{
								if($row[5]==$row[6]){
									$row[$i]="<img title='Processado' src='img/status-sim.gif'/>";
								}else{
									$row[$i]="<img title='Processado e Pendente' src='img/status-pendente.gif'/>";
								}
							}
							$s_html .= '<td align="center">'.$row[$i].'</td>';
						}else{
							if($i!=2){
								if($i==6){
									$s_html .= "<td><font>".utf8_encode($row[$i])."</font></td>";
								}else{
									$s_html .= '<td>'.utf8_encode($row[$i]).'</td>';
								}
							}
						}
					}
					
					$s_html .= '</tr>';
					$ordem++; //incrementa para nova ordem, ja que esta agrupado por espessura
				
				}
			
			//Caso contr�rio prepara o array(grid) com os valores inseridos manualmente
			}else{
				
				//Matriz com todos os resultados da tabela
				$grid = $sth->fetchAll(PDO::FETCH_NUM);
				
				//N�mero de linhas retornadas
				$c = $sth->rowCount();
				
				//Insere dentro do grid, no �ndice informado, as colunas que foram inseridas manualmente
				for($i = 0; $i < $c; $i++){
					
					foreach($this->a_columns as $column){
						
						array_splice($grid[$i], $column['index'], 0, str_replace('$?', $i, $column['content']));
											
					}
					
				}
				
				//Prepara a string com o html que ser� impresso em tela
				for($i = 0; $i < $c; $i++){
					
					$s_html .='<tr>';
					
					foreach($grid[$i] as $value){
						
						$s_html .='<td>'.utf8_encode($value).'</td>';
						
					}
					
					$s_html .='</tr>';
				
				}
			
			}
			
			$s_html .= '</tbody></table>';
			
			echo($s_html);
			
		}
		
		//Imprime os controles da p�gina��o
		public function show_controls(){
		
			//A url atual
			$url = $_SERVER['REQUEST_URI'];
			
			//Verifica se a url termina em .php, se terminar quer dizer que n�o possui nenhum parametro ainda
			if(substr($url,-4,4) == '.php'){
				
				//Ent�o concatena a p�gina inicial, para que exista um valor a ser substituido posteriormente
				$url.= '?p=1';
			
			}elseif(preg_match('/\?p=/',$url) == 0 && preg_match('/\?[\w]{1,99}=/',$url) > 0 && preg_match('/&p=/',$url) == 0){
	
				$url.= '&p=1';
			
			}
			
			//Retorna o n�mero de p�ginas
			$pages = $this->pages_count();
			
			//Mostra os controles apenas se existirem 2 ou mais p�ginas
			if($pages > 1){
				
				//Remove o par�metro 'p' caso ouver;
				$url = preg_replace('/\?p=[0-9]{1,9999}/', '?p=', $url);
				$url = preg_replace('/&p=[0-9]{1,9999}/', '&p=', $url);
				
				//Cria o link para enviar para a primeira p�gina
				$s_html = '<table align="center" width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA"><tr><th><a title="Primeira" href="'.$url.'1">Primeira</a></td>';
				
				//Cria o link de anterior caso exista p�gina anterior
				if($this->i_page > 1){
				
					$s_html .= '<th><a title="Anterior" href="'.$url.($this->i_page - 1).'">Anterior</a></td>';
				
				}else{
				
					$s_html .= '<th>Anterior</td>';
	
				}
				
				//Retorna os n�meros da primeira e �ltima p�gina que ser�o apresentadas
				$n = $this->page_scale($pages,$this->i_link_limit,$this->i_page);
					
				for($i = $n[0];$i <= $n[1]; $i++){
					
					if($this->i_page == $i){
					
						$s_html.= '<th>'.$i.'</a></td>';
					
					}else{
					
						$s_html.= '<th><a title="P&aacute;gina: '.$i.'" href="'.$url.$i.'">'.$i.'</a></td>';
					
					}
					
				}
				
				//Cria o link de pr�xima caso exista uma pr�xima p�gina
				if($this->i_page < $pages){
				
					$s_html .= '<th><a title="Pr&oacute;xima" href="'.$url.($this->i_page + 1).'">Pr&oacute;xima</a></td>';
				
				}else{
				
					$s_html .= '<th>Pr&oacute;xima</td>';
				
				}
				
				//Cria o link para enviar para a �ltima p�gina
				$s_html .= '<th><a title="&Uacute;ltima" href="'.$url.$pages.'">&Uacute;ltima</a></td></tr></table>';
				
				echo($s_html);
			
			}
			
		}
	
	
	}

?>