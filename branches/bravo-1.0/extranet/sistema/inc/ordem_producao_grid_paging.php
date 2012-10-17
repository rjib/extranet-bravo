<?php

    require("../setup.php");

	class Paging extends Connection{
	
		public $s_table 		= ''; 		//String com o nome da tabela
		public $s_fields		= ''; 		//String com os campos da tabela, separados por vírgula. Ex: id,name
		public $s_labels		= ''; 		//String com as labels que ficarão no cabeçalho da tabela. Ex: ID,Nome
		public $s_where			= '1'; 		//Clausúla where, se houver
		public $s_orderby		= 'OP.CO_NUM'; 	//Campo utilizado para ordenação inicial
		public $s_orientation	= 'ASC';	//ASC ou DESC
		public $i_rowsperpage	= 50;		//Limite de registros visualizados por página
		public $i_page			= 1;		//Página atual
		public $i_link_limit	= 5;		//Número de links de páginas
		public $a_columns		= null; 	//Array com as colunas inseridas pela função addColumn
		public $a_cols_width	= null;
	
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
		
		//Retorna o total de linhas encontradas, usado para montar o número de páginas principalmente
		public function total_rows(){
						
			$sth = $this->dbh->prepare('SELECT COUNT(*) FROM tb_pcp_op OP WHERE '.$this->s_where);
			$sth->execute();
			$row = $sth->fetch(PDO::FETCH_NUM);
			return $row[0];
			
		}
		
		//Retorna o número de páginas
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
		
		//Utilizada internamente para criar o cabeçalho da tabela
		private function thead(){
		
			$a_th = explode(',',$this->s_labels);
			
			//Se forem adicionadas colunas manualmente, elas serão adicionadas ao array do cabeçalho
			if(!($this->a_columns == null)){
				
				//Adiciona o cabeçalho "thead" dentro do array de cabeçalhos dentro do índice informado
				foreach($this->a_columns as $column){
					
					array_splice($a_th, $column['index'], 0, $column['thead']);
												
				}
				
			}
			
			$a_th = array_map('utf8_encode',$a_th);
			array_unshift($a_th,count($a_th));
			return $a_th;
			
		}
		
		//Cria um 'range' de números, baseado em um número máximo (ntotal), a quantidade de números
		//que devem aparecer (nmax) e em um número dentro da escala, sempre que o dado número apresentado
		//for maior que a métade dos números contidos na escala, a escala incrementa os números até o limite
		private function page_scale($ntotal, $nmax, $n){
			
			//Caso o número de páginas seja menor do que o número limite de links por página
			if($ntotal < $nmax){
				
				$ini = 1;
				$end = $ntotal;
				
			}else{
			
				//Descobre qual o número que representa a metade do número dado como parâmetro
				$mid = ceil($nmax / 2);
				
				//Caso a página atual seja igual ou menor que o número do link do meio
				if($n <= $mid){
				
					$ini = 1;
					$end = $nmax;
				
				//Caso a soma da página + o meio seja igual ou menor que o número total de páginas
				}elseif($n + $mid <= $ntotal){
					
					//Se a página for maior que o meio
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
			
			//Guarda o conteúdo temporário da tabela
			$s_html = '';
			
			//Retorna o array com as labels do cabeçalho da tabela
			$a_th = $this->thead();
			
			//Retorna o array com os campos que irão preencher as celulas da table
			$a_cells = $this->cells();
			
			//Faz os ajustes na página, para definir a número inicial de registros
			if($this->i_page != 1){
				$n = ($this->i_page - 1) * $this->i_rowsperpage;
			}else{
				$n = 0;
			}
			
			//Formula a query			
			$sql = '
				SELECT OP.CO_NUM, OP.CO_ITEM, OP.CO_SEQUENCIA,OP.CO_PRODUTO,OP.QTD_PRODUTO, OP.QTD_PRODUZIDA, OP.DT_EMISSAO, OP.CO_RECNO
				FROM tb_pcp_op OP
				WHERE '.$this->s_where.'
				ORDER BY '.$this->s_orderby.' '.$this->s_orientation.'
				LIMIT '.$n.','.$this->i_rowsperpage;
				
			$sth = $this->dbh->prepare($sql);
			$sth->execute();
			
			//Cria o cabeçalho da tabela
			$s_html .= '<table width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA"><thead><tr>';
			
			for($i = 1; $i <= $a_th[0]; $i++){
				
				if($this->cols_width != null){
					$s_html .= '<th align="left" width="'.$this->cols_width[$i].'">'.$a_th[$i].'</th>';					
				}else{
					$s_html .= '<th>'.$a_th[$i].'</th>';
				}
				
			}
						
			$s_html .= '</tr></thead><tbody>';
			
			//Se não forem inseridas colunas manualmente, então apenas mostra os resultados do banco
			if($this->a_columns == null){
				
				//Cria o corpo da tabela
				while($row = $sth->fetch(PDO::FETCH_NUM)){
					
					$s_html .= '<tr>';
					
					for($i = 0; $i < $a_cells[0]; $i++){
						$s_html .= '<td>'.utf8_encode($row[$i]).'</td>';
					}
					
					$s_html .= '</tr>';
				
				}
			
			//Caso contrário prepara o array(grid) com os valores inseridos manualmente
			}else{
				
				//Matriz com todos os resultados da tabela
				$grid = $sth->fetchAll(PDO::FETCH_NUM);
				
				//Número de linhas retornadas
				$c = $sth->rowCount();
				
				//Insere dentro do grid, no índice informado, as colunas que foram inseridas manualmente
				for($i = 0; $i < $c; $i++){
					
					foreach($this->a_columns as $column){
						
						array_splice($grid[$i], $column['index'], 0, str_replace('$?', $i, $column['content']));
											
					}
					
				}
				
				//Prepara a string com o html que será impresso em tela
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
		
		//Imprime os controles da páginação
		public function show_controls(){
		
			//A url atual
			$url = $_SERVER['REQUEST_URI'];
			
			//Verifica se a url termina em .php, se terminar quer dizer que não possui nenhum parametro ainda
			if(substr($url,-4,4) == '.php'){
				
				//Então concatena a página inicial, para que exista um valor a ser substituido posteriormente
				$url.= '?p=1';
			
			}elseif(preg_match('/\?p=/',$url) == 0 && preg_match('/\?[\w]{1,99}=/',$url) > 0 && preg_match('/&p=/',$url) == 0){
	
				$url.= '&p=1';
			
			}
			
			//Retorna o número de páginas
			$pages = $this->pages_count();
			
			//Mostra os controles apenas se existirem 2 ou mais páginas
			if($pages > 1){
				
				//Remove o parâmetro 'p' caso ouver;
				$url = preg_replace('/\?p=[0-9]{1,9999}/', '?p=', $url);
				$url = preg_replace('/&p=[0-9]{1,9999}/', '&p=', $url);
				
				//Cria o link para enviar para a primeira página
				$s_html = '<table width="1003" border="0" cellpadding="3" cellspacing="2" class="LISTA"><tr><th><a title="Primeira" href="'.$url.'1">Primeira</a></td>';
				
				//Cria o link de anterior caso exista página anterior
				if($this->i_page > 1){
				
					$s_html .= '<th><a title="Anterior" href="'.$url.($this->i_page - 1).'">Anterior</a></td>';
				
				}else{
				
					$s_html .= '<th>Anterior</td>';
	
				}
				
				//Retorna os números da primeira e última página que serão apresentadas
				$n = $this->page_scale($pages,$this->i_link_limit,$this->i_page);
					
				for($i = $n[0];$i <= $n[1]; $i++){
					
					if($this->i_page == $i){
					
						$s_html.= '<th>'.$i.'</a></td>';
					
					}else{
					
						$s_html.= '<th><a title="P&aacute;gina: '.$i.'" href="'.$url.$i.'">'.$i.'</a></td>';
					
					}
					
				}
				
				//Cria o link de próxima caso exista uma próxima página
				if($this->i_page < $pages){
				
					$s_html .= '<th><a title="Pr&oacute;xima" href="'.$url.($this->i_page + 1).'">Pr&oacute;xima</a></td>';
				
				}else{
				
					$s_html .= '<th>Pr&oacute;xima</td>';
				
				}
				
				//Cria o link para enviar para a última página
				$s_html .= '<th><a title="&Uacute;ltima" href="'.$url.$pages.'">&Uacute;ltima</a></td></tr></table>';
				
				echo($s_html);
			
			}
			
		}
	
	
	}

?>