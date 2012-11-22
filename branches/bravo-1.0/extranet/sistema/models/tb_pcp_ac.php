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
	 * @return boolean
	 * @author Ricardo S. Alvarenga
	 * @since 07/11/2012
	 */
	public function insertReturnId($co_pcp_ad)
	{
		$sql = "INSERT INTO tb_pcp_ac (co_pcp_ad)
				VALUES (".addslashes($co_pcp_ad).")";
		if(!mysql_query($sql,$this->conexaoERP)){
			throw new Exception('Erro na inserção dos dados, favor contacte o suporte!');
		}
		$id = mysql_insert_id();
		return $id;
	}
	

	/**
	 * Metodo para deletar o registro de arquivo do arquivo otimizado pelo optisave
	 * @param int $co_pcp_ac	chave primaria da tabela de arquivo ac
	 * @author Ricardo S. Alvarenga
	 * @since 08/11/2012
	 */
	public function delete($co_pcp_ac){
		$sql = "DELETE FROM tb_pcp_ac WHERE co_pcp_ac = ".$co_pcp_ac;
		mysql_query($sql,$this->conexaoERP);
	}
	
}
?>