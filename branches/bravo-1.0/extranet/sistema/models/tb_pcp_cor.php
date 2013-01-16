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
			$sql = "SELECT CO_COR, DS_COR, CO_RECNO FROM tb_pcp_cor WHERE FL_DELET IS NULL ORDER BY DS_COR ASC";
			$row = mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return $row;
	}

	/**
	 * Metodo para retornar o codigo de uma determina da cor
	 * @param string $ds_cor
	 * @author Ricardo S. Alvarenga
	 * @since 08/11/2012
	 * @return int
	 */
	public function buscarCodCor($ds_cor)
	{
		$sql = "SELECT co_cor
				FROM tb_pcp_cor
				WHERE DS_COR = '".$ds_cor."' AND FL_DELET IS NULL";
		$row = mysql_fetch_assoc(mysql_query($sql,$this->conexaoERP));
		return $row;

	}
}
?>