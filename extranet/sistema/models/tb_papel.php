<?php
/**
 * Classe da camada de acesso a dados da tabela de papeis
 * @author Ricardo S. Alvarenga
 * @since 13/11/2012
 */

class tb_papel{

	private $conexaoERP;
	private $_helper;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}
	
	/**
	 * Metodo para retornar um papel
	 * @param int $co_papel
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	public function getPapel($co_papel){
		$query = "SELECT * FROM tb_papel WHERE co_papel = ".addslashes(trim($co_papel));
		$row = mysql_fetch_assoc(mysql_query($query,$this->conexaoERP));
		return $row;				
		
	}
}
	
