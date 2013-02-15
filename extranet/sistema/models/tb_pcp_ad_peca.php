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
	
	/**
	 * Metodo para retornar uma numero das ops de um ad
	 * @param int $co_pcp_ad
	 * @author Ricardo S. Alvarenga
	 * @since 15/01/2013
	 */
	public function getOPbyAD($co_pcp_ad){
		$query = "SELECT DISTINCT CONCAT(PCP_OP.CO_NUM, PCP_OP.CO_ITEM, PCP_OP.CO_SEQUENCIA) NU_OP
					FROM
					    tb_pcp_ad_peca AD_PECA
					        INNER JOIN
					    tb_pcp_op PCP_OP ON AD_PECA.co_pcp_op = PCP_OP.co_pcp_op
					WHERE
					    AD_PECA.co_pcp_ad = ".$co_pcp_ad;
		$row = mysql_query($query, $this->conexaoERP);
		return $row;
		
	}
	
	/**
	 * Metodo para retornar os codigos das ops adicionadas no apontamento pelo job
	 */
	public function getOrdemProducaoPorJob($job){
		$query = "SELECT 
				    AC_PECA.CO_INT_PRODUTO, PRODUTO.DS_PRODUTO, AC_PECA.QTD_PECAS, ORDEM_PRODUCAO.NU_LOTE, CONCAT(ORDEM_PRODUCAO.CO_NUM,ORDEM_PRODUCAO.CO_ITEM,ORDEM_PRODUCAO.CO_SEQUENCIA) NU_OP
				FROM
				    TB_PCP_APONTAMENTO APONTAMENTO
				        INNER JOIN
				    TB_PCP_AC_PECA AC_PECA ON APONTAMENTO.CO_PCP_OP = AC_PECA.CO_PCP_OP
				        INNER JOIN
				    TB_PCP_OP ORDEM_PRODUCAO ON ORDEM_PRODUCAO.CO_PCP_OP = APONTAMENTO.CO_PCP_OP
				        INNER JOIN
				    TB_PCP_PRODUTO PRODUTO ON PRODUTO.CO_PRODUTO = ORDEM_PRODUCAO.CO_PRODUTO
				WHERE
				    AC_PECA.CO_PCP_AC = (SELECT 
				            AC.CO_PCP_AC
				        FROM
				            TB_PCP_AD AD
				                INNER JOIN
				            TB_PCP_AC AC ON AC.CO_PCP_AD = AD.CO_PCP_AD
				        WHERE
				            AD.NO_PCP_AD = ".$job.")
				        AND APONTAMENTO.HR_FIM IS NULL
				        AND APONTAMENTO.FL_APONTAMENTO = 2 
				        AND APONTAMENTO.FL_DELET IS NULL";

	$result = mysql_query($query, $this->conexaoERP);
	return $result;
	}
}
?>