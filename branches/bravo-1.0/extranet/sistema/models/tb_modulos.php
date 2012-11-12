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

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;
		$this->_helper = new helper();

	}
	
	/**
	 * Metodo para editar um modulo existente
	 * @param int $co_modulo	codigo do modulo
	 * @param string $no_modulo	nome do modulo
	 * @param string $fl_status 	status do modulo
	 * @author Ricardo S. Alvarenga
	 * @since 12/11/2012
	 */
	public function editar($co_modulo, $no_modulo, $fl_status){
		$sql = "UPDATE tb_modulos 
				SET no_modulo = '".$no_modulo."', fl_status =".$fl_status."  
				WHERE co_modulo = ".$co_modulo;
		mysql_query($sql, $this->conexaoERP);
		
	}
	
	/**
	 * Metodo para excluír novo modulo
	 * @param int $co_pai
	 * @param string $no_modulo
	 * @param int $fl_status
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
	 * @param int $fl_status
	 * @since 12/11/2012
	 */
	public function inserirModulo($co_pai, $no_modulo, $fl_status){
		$sql = "INSERT INTO tb_modulos (co_pai, no_modulo, fl_status) VALUES (".$co_pai.",'".addslashes($no_modulo)."', '".addslashes($fl_status)."')";		
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
					fl_status
				FROM tb_modulos
				WHERE fl_status = 1 
				AND co_modulo =".$co_modulo;
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
				WHERE fl_status = 1
				AND co_pai =".$co_pai." 
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
				WHERE fl_status = 1
				AND co_pai =".$co_pai;
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
					
					$this->_html.="<tr>";
					$this->_html.="<td>".$dados['CO_MODULO']."</td>";
					$this->_html.="<td><div id='".$dados['CO_MODULO']."'>".$i.".".$j." ".$dados['NO_MODULO']."</div></td>";
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
	
}