<?php
/**
 * Classe da camada de acesso a dados da tabela modulo papel
 * @author Ricardo S. Alvarenga
 * @since 13/11/2012
 */

class tb_papel_modulo{

	private $conexaoERP;
	private $_helper;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}
	
	/**
	 * Metodo inserir um novo modulo a um papel
	 * @param int $co_papel
	 * @param int $co_modulo
	 * @return co_papel_modulo
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	public function inserir($co_papel, $co_modulo){
		$query = "INSERT INTO tb_papel_modulo (co_papel, co_modulo) VALUES (".$co_papel.", ".$co_modulo.")";
		mysql_query($query,$this->conexaoERP);		
		$id = mysql_insert_id();
		return $id;
	}
	
	
	/**
	 * Metodo verificar existencia de um modulo a um papel
	 * @param int $co_papel
	 * @param int $co_modulo
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	public function verificaExistencia($co_modulo, $co_papel){
		
		$query = "SELECT * 
				 FROM tb_papel_modulo 
				 WHERE co_papel = ".$co_papel. " 
				 AND co_modulo = ".$co_modulo;
		
		$result = mysql_query($query, $this->conexaoERP);
		return mysql_num_rows($result);
		
	}
	
	/**
	 * Metodo para listar todos os modulos cujo um papel possui
	 * @param int $co_papel
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	public function listaModuloPorPapel($co_papel, $co_modulo){
		$query = "SELECT * FROM tb_papel_modulo WHERE co_papel = ".$co_papel;
		$row = mysql_query($query, $this->conexaoERP);
		return $row;		
	}
	
	/**
	 * Metodo para deletar um modulo de um papel
	 * @param int $co_papel_modulo	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	Public function delete($co_papel_modulo){
		$query = "DELETE FROM tb_papel_modulo WHERE co_papel_modulo = ".$co_papel_modulo;
		mysql_query($query,$this->conexaoERP);
	}
	
	/**
	 * Metodo para deletar um modulo geral de um papel
	 * @param int $co_papel_modulo	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	Public function deleteModuloByPapel($co_papel){
		$query = "DELETE FROM tb_papel_modulo WHERE co_papel = ".$co_papel;
		mysql_query($query,$this->conexaoERP);
	}
}
	
