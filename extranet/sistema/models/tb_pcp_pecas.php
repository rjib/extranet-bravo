<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_ac_peca
 * @author Ricardo S. Alvarenga
 * @since 07/11/2012
 *
 */

class tb_pcp_pecas{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}

	/**
	 * Metodo para listar todos os planos de corte
	 * @author Ricardo S. Alvarenga
	 * @since 07/11/2012
	 * @return array
	 */
	public function listaTodosArquivos(){
		try {
			$sql = "SELECT * FROM tb_pcp_ac_peca ORDER BY CO_PCP_PECA ASC";
			$row = mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return $row;
	}


	/**
	 * Metodo para inserir nova peca originada de um plano de corte do optisave
	 * @param int $nu_schema
	 * @param string $nu_comprimento
	 * @param string $nu_largura
	 * @param string $nu_espessura
	 * @param string $co_int_produdo	codigo interno do produto
	 * @param int $co_cor
	 * @param int $qtd_pecas
	 * @param int $co_pcp_ac	nome do arquivo
	 * @author Ricardo S. Alvarenga
	 * @since 07/11/2012
	 */
	public function insert($co_pcp_op,$co_cor,$nu_schema, $nu_comprimento, $nu_largura, $nu_espessura, $qtd_pecas, $co_int_produto, $co_pcp_ac)
	{
		$sql = "INSERT INTO tb_pcp_ac_peca (CO_PCP_OP, 
											CO_COR,  
											NU_SCHEMA,
											NU_COMPRIMENTO,
											NU_LARGURA,
											NU_ESPESSURA,
											QTD_PECAS,
											CO_INT_PRODUTO,
											CO_PCP_AC)
				VALUES ('".$co_pcp_op."', 
						'".$co_cor."',
						".addslashes($nu_schema).",
						'".(int)addslashes($nu_comprimento)."',
						'".(int)addslashes($nu_largura)."',
						'".(int)addslashes($nu_espessura)."',
						".(int)addslashes($qtd_pecas).",
						'".addslashes($co_int_produto)."',
						".addslashes($co_pcp_ac).")";
		try {
			mysql_query($sql,$this->conexaoERP);
		}catch (Exception $e){
			return $e;
		}

	}
	
	/**
	 * Metodo para deletar os planos de corte otimizados pela optisave
	 * @param int $co_pcp_ac	nome do arquivo ac
	 * @author Ricardo S. Alvarenga
	 * @since 08/11/2012
	 */
	public function delete($co_pcp_ac){
		$sql = "DELETE FROM tb_pcp_ac_peca WHERE co_pcp_ac = ".$co_pcp_ac;
		mysql_query($sql,$this->conexaoERP);
	}
	
	/**
	 * Metodo para listar todos os dados de um arquivo .ac importado
	 * @param int $co_pcp_ac	chave primaria da tabela de arquivo ac
	 * @author Ricardo S. Alvarenga
	 * @since 22/11/2012
	 */
	public function findByPecas($co_pcp_ac){
		$query = "SELECT SUM(qtd_pecas) qtd_processada, 
					co_pcp_op, 
					co_int_produto, 
					co_cor
				  FROM tb_pcp_ac_peca
					WHERE co_pcp_ac = ".$co_pcp_ac."
					GROUP BY co_pcp_op;";
		$result = mysql_query($query, $this->conexaoERP);
		
		return $result;
	
	}
}
?>