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
	 * Metodo para inserir novo arquivo AC e retornar o id
	 * @param int $cod_pcp_ad
	 * @param int $un_complementar
	 * @return boolean
	 * @author Ricardo S. Alvarenga
	 * @since 07/11/2012
	 */
	public function insertReturnId($cod_pcp_ad)
	{
		$sql = "INSERT INTO tb_pcp_ac (co_pcp_ad)
				VALUES (".addslashes($cod_pcp_ad).")";
		if(!mysql_query($sql,$this->conexaoERP)){
			throw new Exception('Erro na inserção dos dados, favor contacte o suporte!');
		}
		$id = mysql_insert_id();
		return $id;
	}
}
?>