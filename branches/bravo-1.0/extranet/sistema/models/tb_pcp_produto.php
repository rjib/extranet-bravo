<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_produto 
 * @author Ricardo S. Alvarenga
 * @since 31/10/2012
 *
 */
class tb_pcp_produto{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}

	/**
	 * Metodo para listar todas as espessuras maior que zero
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 * @return array
	 */
	public function listaTodasEspessuras(){
		try {
			$sql = "SELECT DISTINCT(NU_ESPESSURA) ESPESSURA 
					FROM tb_pcp_produto WHERE NU_ESPESSURA <>''	OR NU_ESPESSURA >1				
					AND FL_DELET IS NULL OR FL_DELET = '' 
					ORDER BY ABS(NU_ESPESSURA) ASC";
			$row = mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){			
			return false;
		}
		return $row;
	}
}
?>