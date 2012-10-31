<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_ac
* @author Ricardo S. Alvarenga
* @since 31/10/2012
*
*/
class tb_pcp_ac{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}

	/**
	 * Metodo para listar todas os arquivos AC
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 * @return array
	 */
	public function listaTodosArquivos(){
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