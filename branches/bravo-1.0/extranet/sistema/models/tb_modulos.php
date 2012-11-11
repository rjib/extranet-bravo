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
	 * Metodo para listar todos os modulos
	 * @return multitype:
	 * @since 11/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function listaModulos(){
		$sql = "SELECT *
				FROM tb_modulos";
		$row = mysql_fetch_row(mysql_query($sql,$this->conexaoERP));
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
					no_modulo
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
					$this->_html.="<td>".$i.".".$j." ".$dados['NO_MODULO']."</td>";
					$this->_html.="</tr>";
					$this->_j .= '.'.$j	;
					$j++;
					$this->recursivaSubcaterorias(TRUE, $dados['CO_MODULO'], $this->_j, $this->_html);
				}
		}
		//substr($this->_j, strrpos($this->_j, '.'),2);
		$this->setHtml($this->_html);
		
	}
	
	
	/**
	 * Metodo para setar o html dos submodulos 
	 * @author Ricardo S. Alvarenga
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
	
}