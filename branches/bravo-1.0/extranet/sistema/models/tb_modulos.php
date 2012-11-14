<?php
/**
 * Classe da camada de acesso a dados da tabela de modulos
 * @author Ricardo S. Alvarenga
 * @since 11/11/2012
 */

class tb_modulos{

	private $conexaoERP;
	private $_helper;
	protected $_html = NULL;
	protected $_j = 1;
	protected $_caminho = '';

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;
		$this->_helper = new helper();

	}
	
	/**
	 * Metodo para retornar se existe 
	 * @param int $co_modulo	codigo do modulo
	 * @param string $no_modulo	nome do modulo
	 * @param string $fl_ativo 	ativo do modulo
	 * @author Ricardo S. Alvarenga
	 * @since 12/11/2012
	 */
	public function PossuiPermissaoParaModuloPrincipal($co_papel, $no_modulo_pai,$no_modulo_a_liberar){
		//$_SESSION['codigoUsuario'] 
		$query = "SELECT * 
					FROM tb_papel_modulo PAPEL_MODULO
				  INNER JOIN tb_modulos MODULOS
						ON PAPEL_MODULO.co_modulo = MODULOS.co_modulo
				  WHERE PAPEL_MODULO.co_papel = ".$co_papel."
				  		AND MODULOS.no_modulo = '".$no_modulo_a_liberar."' 
					    AND MODULOS.fl_ativo = 1 ";
		$result = mysql_query($query, $this->conexaoERP);
		while($dados = mysql_fetch_array($result)){
			$return = $this->recursivaPai($no_modulo_pai, $dados['CO_PAI']);
			if($return){
				return true;
			}else{
				//return false;
			}
		}
		return false;
		
	}
	
	public function recursivaPai($no_modulo_pai,$co_pai){
		$query = "SELECT * FROM tb_modulos WHERE co_modulo = ".$co_pai;
		$result = mysql_query($query, $this->conexaoERP);
		while($dados = mysql_fetch_array($result)){
			if($dados['NO_MODULO']==$no_modulo_pai){
				return true;
			}else{
				$this->recursivaPai($no_modulo_pai, $dados['CO_PAI']);
			}
		}
		
	}
	
	/**
	 * Metodo para editar um modulo existente
	 * @param int $co_modulo	codigo do modulo
	 * @param string $no_modulo	nome do modulo
	 * @param string $fl_ativo 	ativo do modulo
	 * @author Ricardo S. Alvarenga
	 * @since 12/11/2012
	 */
	public function editar($co_modulo, $no_modulo, $fl_acoes,$fl_ativo,$ds_modulo){
		$sql = "UPDATE tb_modulos 
				SET no_modulo = '".$no_modulo."', fl_ativo ='".$fl_ativo."', fl_acoes ='".$fl_acoes."', ds_modulo ='".$ds_modulo."' WHERE co_modulo = ".$co_modulo;
		mysql_query($sql, $this->conexaoERP);
		
	}
	
	/**
	 * Metodo para excluír novo modulo
	 * @param int $co_pai
	 * @param string $no_modulo
	 * @param int $fl_ativo
	 * @since 12/11/2012
	 */
	public function excluir($co_modulo){
		
		$filho = $this->getFilho($co_modulo);
		while($dados = mysql_fetch_array($filho)){			
			$query = "DELETE FROM tb_modulos WHERE co_pai = ".$dados['CO_MODULO'];
			mysql($query,$this->conexaoERP);
			$this->excluir($dados['CO_MODULO']);
		}
		
		$sqlFilho = "DELETE FROM tb_modulos WHERE co_pai = ".$co_modulo;
		$sqlPai   = "DELETE FROM tb_modulos WHERE co_modulo = ".$co_modulo;
				
		mysql_query($sqlFilho, $this->conexaoERP);
		mysql_query($sqlPai, $this->conexaoERP);
	}
	
	/**
	 * Metodo para inserir novo modulo
	 * @param int $co_pai
	 * @param string $no_modulo
	 * @param int $fl_ativo
	 * @since 12/11/2012
	 */
	public function inserirModulo($co_pai, $no_modulo, $fl_ativo, $fl_acoes, $ds_modulo){
		$sql = "INSERT INTO tb_modulos (co_pai, no_modulo, fl_ativo, fl_acoes, ds_modulo) VALUES (".$co_pai.",'".addslashes($no_modulo)."', '".addslashes($fl_ativo)."','".$fl_acoes."','".$ds_modulo."')";		
		mysql_query($sql, $this->conexaoERP);
	}
	
	/**
	 * Metodo para listar todos os modulos
	 * @return multitype:
	 * @since 11/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function listaModulos(){
		$sql = "SELECT *
				FROM tb_modulos";
		$row = mysql_query($sql,$this->conexaoERP);
		return $row;
	}
	
	/**
	 * Metodo para listar todos os modulos ativos e com ações
	 * @return multitype:
	 * @since 13/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function listaModulosAtivosComAcoes(){
		$sql = "SELECT *
				FROM tb_modulos 
				WHERE fl_ativo = 1 
				AND fl_acoes = 1";
		$row = mysql_query($sql,$this->conexaoERP);
		return $row;
	}
	
	/**
	 * Metodo para listar todos os modulos ativos de um papel
	 * @return multitype:
	 * @since 14/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function listaModulosPorPapel($co_papel_modulo){
		$query = "SELECT * FROM tb_papel_modulo PAPEL_MODULO
  					INNER JOIN tb_modulos MODULOS
  						ON PAPEL_MODULO.CO_MODULO = MODULOS.CO_MODULO
				  	INNER JOIN tb_acoes ACOES 
						ON PAPEL_MODULO.co_papel_modulo = ACOES.co_papel_modulo
				   WHERE PAPEL_MODULO.co_papel = ".$co_papel_modulo;
		$row = mysql_query($query, $this->conexaoERP);
		return $row;
	}
	
	/**
	 * Metodo para retornar um modulo apartir de seu codigo
	 * @param int $co_modulo
	 * @since 11/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function getModulo($co_modulo){
		$sql = "SELECT 
					co_modulo, 
					co_pai,
					no_modulo,
					fl_ativo,
					ds_modulo,
					fl_acoes
				FROM tb_modulos
				WHERE co_modulo =".$co_modulo;
		$row = mysql_fetch_assoc(mysql_query($sql,$this->conexaoERP));
		return $row;
		
	}
	
	/**
	 * Metodo para retornar filho da arvore
	 * @param int $co_pai
	 * @return multitype:
	 * @since 11/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function getFilho ($co_pai){
		
		$sql = "SELECT * 
				FROM tb_modulos
				WHERE co_pai =".$co_pai." 
				ORDER BY co_modulo";
		$row = mysql_query($sql, $this->conexaoERP);
		return $row;
	}
	
	/**
	 * Metodo para retornar pai da arvore
	 * @param int $co_pai
	 * @return multitype:
	 * @since 11/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function getPai($co_pai){
	
		$sql = "SELECT *
				FROM tb_modulos
				WHERE co_pai =".$co_pai;
		$row = mysql_query($sql, $this->conexaoERP);
		return $row;
	}
	
	/**
	 * Metodo recursivo para listar todos os submodulos
	 * @param boolean $continua
	 * @param int $co_pai
	 * @param string $html
	 * @author Ricardo S. Alvarenga
	 * @since 11/11/2012
	 * @return string
	 */
	public function recursivaSubcaterorias($continua, $co_pai, $i, $html =''){
	 $j = 1;
		if($continua){
			$filho = $this->getFilho($co_pai);
				while($dados = mysql_fetch_array($filho)){
					$dados['FL_ATIVO']==0? $class="class='INATIVO'":$class="";
					$this->_html.="<tr ".$class.">";
					$this->_html.="<td>".$dados['CO_MODULO']."</td>";
					$this->_html.="<td><div title='".$dados['DS_MODULO']."' id='".$dados['CO_MODULO']."'>".$i.".".$j." ".$dados['NO_MODULO']."</div></td>";
					$this->_html.= "<td align='center'><a href='javascript:addSub(".$dados['CO_MODULO'].");'><img title='Adicionar Sub-módulo' src='img/btn/btn_mais.gif' /></a> <a href='javascript:editar(".$dados[CO_MODULO].");'><img title='Editar' src='img/btn/btn_editar.gif' /></a> <a href='javascript:excluir(".$dados[CO_MODULO].");'><img title='Excluír' src='img/btn/btn_excluir.gif' /></a></td>";
					$this->_html.="</tr>";
					$this->_j .= '.'.$j	;
					$j++;
					$this->recursivaSubcaterorias(TRUE, $dados['CO_MODULO'], $this->_j, $this->_html);
				}
				$this->setJ(1);
		}
		$this->setHtml($this->_html);
		
		
	}
	
	/**
	 * Metodo para retornar o caminho completo da arvore até o nó atual
	 * @param int $co_pai
	 * @since 13/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function recursivaFilhos($co_pai){		
		$sql = "SELECT 
					co_modulo, 
					co_pai, 
					no_modulo 
				FROM 
					tb_modulos 
				WHERE co_modulo = '".$co_pai."'";
		$row = mysql_fetch_assoc(mysql_query($sql, $this->conexaoERP));
		if($row['co_pai']!='0'){
				$this->setCaminho($row['no_modulo'].'/'.$this->_caminho);
				$this->recursivaFilhos($row['co_pai']);
		}else{
			$this->setCaminho($row['no_modulo'].'/'.$this->_caminho);
		}
			
		
	}
	
	/**
	 * Metodo para retonrar o caminho completo até um nó
	 * @param string $co_modulo
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 * @return string
	 */
	public function getCaminho ($co_modulo){
		$this->recursivaFilhos($co_modulo);
		return $this->_caminho;
	}
	
	/**
	 * Metodo para setar o caminho até um nó
	 * @param string $caminho
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 * @return string
	 */
	public function setCaminho($caminho){
		$this->_caminho = $caminho;
	}
	
	/**
	 * Metodo para setar o html dos submodulos 
	 * @author Ricardo S. Alvarenga
	 * @param string $html	codigo html
	 * @since 11/11/2012
	 * @return string
	 */
	public function setHtml($html){
		$this->_html = $html;
		
	}
	
	/**
	 * Metodo para retornar o html dos submodulos 
	 * @author Ricardo S. Alvarenga
	 * @since 11/11/2012
	 * @return string
	 */
	public function getHtml(){
		return $this->_html;
	}
	
	/**
	 * Metodo para setar o valor do submodulo 
	 * @author Ricardo S. Alvarenga
	 * @param int $j	valor atual do nivel submodulo
	 * @since 12/11/2012
	 * @return string
	 */
	public function setJ($j){
		$this->_j = $j;
	}
	
	/**
	 * Metodo para verificar permissao de um modulo princial, que nao possua ações
	 * @param unknown_type $co_papel
	 * @param unknown_type $no_modulo
	 * @return boolean
	 */
	public function verificaPermissaoModuloPrincipal($co_papel, $no_modulo){
		$query = "select * from tb_papel_modulo PAPEL_MODULO
					inner join tb_modulos MODULO
					on PAPEL_MODULO.co_modulo = MODULO.co_modulo
					where PAPEL_MODULO.co_papel = ".$co_papel."
					and MODULO.co_pai in(select MODULO2.co_modulo from tb_modulos MODULO2 WHERE MODULO2.no_modulo = '".$no_modulo."' AND MODULO2.fl_acoes = 0)";
		$num = mysql_num_rows(mysql_query($query, $this->conexaoERP));
		if($num ==0){
			return false;
		}else{
			return true;
		}
		
	}
	
}