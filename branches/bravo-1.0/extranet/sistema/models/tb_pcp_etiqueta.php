<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_etiqueta
* @author Ricardo S. Alvarenga
* @since 11/12/2012
*
*/
class tb_pcp_etiqueta{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}
	

	/**
	 * Metodo para inserir novas etiquetas por pilha
	 * @param string $nu_pcp_op
	 * @param string $qtd_produzir
	 * @param string $qtd_produto
	 * @param string $dt_emissao
	 * @param string $ds_produto
	 * @param string $co_int_produto
	 * @param string $nu_lote
	 * @param string $nu_comprimento
	 * @param string $nu_largura
	 * @param string $nu_espessura
	 * @param int $co_pcp_ac
	 * @param string $tp_produto
	 * @param string $no_cor
	 * @return array
	 * @author Ricardo S. Alvarenga
	 * @since 11/12/2012
	 */
	public function insert($nu_pcp_op, $qtd_produzir, $qtd_produto,$dt_emissao, $ds_produto, $co_int_produto, $nu_lote, $nu_comprimento, $nu_largura, $nu_espessura, $co_pcp_ac, $tp_produto, $no_cor)
	{
		$sql = "INSERT INTO tb_pcp_etiqueta (
					nu_pcp_op
				,	qtd_produzir
				,	qtd_produto
				,	dt_emissao
				,	ds_produto
				,	co_int_produto
				,	nu_lote
				,	nu_comprimento
				,	nu_largura
				,	nu_espessura
				,	co_pcp_ac
				,	tp_produto
				,	no_cor)
				VALUES (
				'".addslashes($nu_pcp_op)."'
				, '".addslashes($qtd_produzir)."'
				, '".addslashes($qtd_produto)."'
				, '".addslashes($dt_emissao)."'
				, '".addslashes($ds_produto)."'
				, '".addslashes($co_int_produto)."'
				, '".addslashes($nu_lote)."'
				, '".addslashes($nu_comprimento)."'
				, '".addslashes($nu_largura)."'
				, '".addslashes($nu_espessura)."'
				, ".$co_pcp_ac."
				, '".addslashes($tp_produto)."'
				, '".addslashes($no_cor)."')";
		mysql_query($sql,$this->conexaoERP);
	}
	
	/**
	 * Metodo para verificar se uma etiqueta ja foi gerada.
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 11/12/2012
	 * @return array
	 */
	public function findByAc($co_pcp_ac){
		$query = "SELECT * FROM tb_pcp_etiqueta ETIQUETA WHERE ETIQUETA.co_pcp_ac = ".$co_pcp_ac;
		$result = mysql_query($query, $this->conexaoERP);
		$row = mysql_num_rows($result);
		return $row;
		
	}
	
	public function delete ($co_pcp_ac){
		$query = "DELTE FROM tb_pcp_etiqueta WHERE co_pcp_ac = ".$co_pcp_ac;
		mysql_query($query, $this->conexaoERP);
		
	}
	
	/**
	 * Metodo para listar todas as etiquetas de um plano de corte
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 18/12/2012
	 * @return array
	 */
	public function listaCodigoBarra($co_pcp_ac){
		$query = "SELECT
					   DISTINCT ETIQUETA.NU_PCP_OP,
					   DATE_FORMAT(ETIQUETA.DT_EMISSAO,'%m/%d/%Y') DT_EMISSAO
					FROM
					    TB_PCP_ETIQUETA ETIQUETA
					WHERE
					    ETIQUETA.CO_PCP_AC = ".$co_pcp_ac;
		$result = mysql_query($query, $this->conexaoERP);
		return $result;
	}
}
?>