<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_ad_peca
 * @author Ricardo S. Alvarenga
 * @since 26/10/2012
 *
 */
class tb_pcp_ad_peca{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}


	/**
	 * Metodo para inserir novo arquivo AD
	 * @param int $co_pcp_ad	codigo do arquivo
	 * @param int $co_pcp_op codigo da op
	 * @return boolean
	 * @author Ricardo S. Alvarenga
	 * @since 26/11/2012
	 */
	public function insert($co_pcp_ad, $co_pcp_op)
	{
		$sql = "INSERT INTO tb_pcp_ad_peca (co_pcp_ad, co_pcp_op)
				VALUES (".$co_pcp_ad.",".$co_pcp_op.")";
		if(!mysql_query($sql,$this->conexaoERP)){
			throw new Exception('Erro na inserção dos dados, favor contacte o suporte!');
		}
	}
	
	/**
	 * Metodo para retornar o codigo da op
	 * @param int $co_pcp_ad
	 * @return resource
	 * @since 27/12/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function getCodigoOP($co_pcp_ad){
		$query = "SELECT DISTINCT CO_PCP_OP FROM tb_pcp_ad_peca WHERE CO_PCP_AD = ".$co_pcp_ad;
		$result = mysql_query($query, $this->conexaoERP);
		return $result;
		
	}
	
	/**
	 * Metodo para remover um relacionamento de um produto que nao esteja no ad
	 * @param int $co_pcp_op
	 * @param int $co_pcp_ad
	 * @author Ricardo S. Alvarenga
	 * @since 07/01/2013
	 */
	public function delete($co_pcp_op,$co_pcp_ad){
		$query = "DELETE FROM tb_pcp_ad_peca WHERE co_pcp_ad=".$co_pcp_ad." AND co_pcp_op = ".$co_pcp_op;
		mysql_query($query, $this->conexaoERP);		
		
	}
}
?>