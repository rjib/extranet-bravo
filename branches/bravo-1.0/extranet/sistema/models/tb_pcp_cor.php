<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_cor * 
 * @author Ricardo S. Alvarenga
 * @since 25/10/2012
 *
 */
class tb_pcp_cor{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}

	/**
	 * Metodo para listar todas as cores
	 * @author Ricardo S. Alvarenga
	 * @since 25/10/2012
	 * @return array
	 */
	public function listaTodasCores(){
		try {
			$sql = "SELECT CO_COR, DS_COR, CO_RECNO FROM tb_pcp_cor ORDER BY DS_COR ASC";
			$row = mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){			
			return false;
		}
		return $row;
	}
}
?>