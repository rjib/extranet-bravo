<?php
/**
 * Classe da camada de acesso a dados da tabela tb_pcp_etiqueta
* @author Ricardo S. Alvarenga
* @since 11/12/2012
*
*/
class tb_pcp_etiqueta{

	private $conexaoERP;

	/**
	 * @param string $conexaoERP
	 * @return objeto
	 */
	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;
	}
	
	/**
	 * Metodo para retornar as medidas do plano de corte
	 * @param int $co_pcp_ac
	 * @param string $co_int_produto
	 * @author Ricardo S. Alvarenga
	 * @since 06/02/2013
	 */
	public function getMedidaCorte($co_pcp_ac, $co_int_produto){
		$query = "SELECT NU_COMPRIMENTO, NU_LARGURA, NU_ESPESSURA FROM TB_PCP_AC_PECA WHERE CO_PCP_AC = ".$co_pcp_ac." AND CO_INT_PRODUTO = '".$co_int_produto."' LIMIT 1";		
		$result = mysql_query($query, $this->conexaoERP);
		$row = mysql_fetch_array($result);
		return $row;
		
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
	public function insert($nu_pcp_op, $qtd_produzir, $qtd_produto,$dt_emissao, $ds_produto, $co_int_produto, $nu_lote, $nu_comprimento, $nu_largura, $nu_espessura,$corte_espessura, $co_pcp_ac, $tp_produto, $no_cor,$fator)
	{
		$row = $this->getMedidaCorte($co_pcp_ac, $co_int_produto);
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
				,	corte_nu_comprimento
				,	corte_nu_largura
				,	corte_nu_espessura
				,	nu_espessura
				,	co_pcp_ac
				,	tp_produto
				,	no_cor
				,	nu_fator_multiplicador)
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
				, '".addslashes($row[0])."'
				, '".addslashes($row[1])."'
				, '".addslashes($corte_espessura)."'
				, '".addslashes($nu_espessura)."'
				, ".$co_pcp_ac."
				, '".addslashes($tp_produto)."'
				, '".addslashes($no_cor)."'
				, '".addslashes($fator)."')";
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
	
	public function getJob($co_pcp_ad){
		$query = "SELECT no_pcp_ad, fl_tockstok FROM tb_pcp_ad WHERE co_pcp_ad = ".$co_pcp_ad;
		$result = mysql_query($query, $this->conexaoERP);
		$row = mysql_fetch_array($result);
		return $row;
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
	
	/**
	 * Metodo para executar a procedure e gravar na tabela temporaria os dados da etiqueta peca casadei
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 08/01/2013
	 */
	public function proc_etiqueta_casadei($co_pcp_apontamento,$co_usuario){
		try{
			$query = " CALL etiquetaCasadei(".$co_pcp_apontamento.",".$co_usuario.")";
			mysql_query($query, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
	}
	/**
	 * Metodo para executar a procedure e gravar na tabela temporaria os dados da etiqueta peca casadei (relatorio)
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 15/01/2013
	 */
	public function proc_etiqueta_casadei_relatorio($nu_op,$co_usuario){
		try{
			$query = " CALL etiquetaRelatorioCasadei('".$nu_op."',".$co_usuario.")";
			mysql_query($query, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
	}
	/**
	 * Metodo para executar a procedure e gravar na tabela temporaria os dados da etiqueta peca PI (relatorio)
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 17/01/2013
	 */
	public function proc_etiqueta_peca_relatorio($nu_op,$co_usuario){
		try{
			$query = " CALL etiquetaRelatorioPeca('".$nu_op."',".$co_usuario.")";
			mysql_query($query, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
	}
	
	/**
	 * Metodo para executar a procedure e gravar na tabela temporaria os dados da etiqueta de pacote
	 * @param int $co_usuario
	 * @author Ricardo S. Alvarenga
	 * @since 22/01/2013
	 */
	public function proc_etiqueta_relatorio_pacote($nu_op,$co_usuario){
		try{
			$query = " CALL etiquetaRelatorioPacote('".$nu_op."',".$co_usuario.")";
			mysql_query($query, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
	}
	
	/**
	 * Metodo para executar a procedure e gravar na tabela temporaria os dados da etiqueta peca casadei (pcp)
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 15/01/2013
	 */
	public function proc_etiqueta_casadei_pcp($co_pcp_ad,$co_usuario){
		try{
			$query = " CALL etiquetaPecaCasadeiPcp(".$co_pcp_ad.",".$co_usuario.")";
			mysql_query($query, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
	}
	
	/**
	 * Metodo para executar a procedure e gravar na tabela temporaria os dados da etiqueta de peca
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 10/01/2013
	 */
	public function proc_etiqueta_peca($co_pcp_apontamento,$co_usuario){
		try{
			$query = " CALL etiquetaPeca(".$co_pcp_apontamento.",".$co_usuario.")";
			mysql_query($query, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
	}
	
	/**
	 * Metodo para executar a procedure e gravar na tabela temporaria os dados da etiqueta de peca
	 * @param int $co_pcp_ac
	 * @author Ricardo S. Alvarenga
	 * @since 10/01/2013
	 */
	public function proc_etiqueta_peca_pi($co_pcp_ad,$co_usuario){
		try{
			$query = " CALL etiquetaPecaPcp(".$co_pcp_ad.",".$co_usuario.")";
			mysql_query($query, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
	}
	

	
	/**
	 * Metodo para limpar a tabela tb_tmp_etiqueta_peca_casadei (RELATORIO, APONTAMENTO)
	 * @author Ricardo S. Alvarenga
	 * @since 08/01/2013
	 */
	public function limparTemporaria($co_usuario){
		$query = "DELETE FROM tb_tmp_etiqueta_peca_casadei WHERE co_usuario = ".$co_usuario;
		mysql_query($query, $this->conexaoERP);
	}
	
	/**
	 * Metodo para limpar a tabela tb_tmp_etiqueta_peca_casadei_pcp
	 * @author Ricardo S. Alvarenga
	 * @since 15/01/2013
	 */
	public function limparTemporariaCasadeiPcp($co_usuario){
		$query = "DELETE FROM tb_tmp_etiqueta_peca_casadei_pcp WHERE co_usuario = ".$co_usuario;
		mysql_query($query, $this->conexaoERP);
	}
	
	/**
	 * Metodo para limpar a tabela tb_tmp_etiqueta_peca_pcp
	 * @author Ricardo S. Alvarenga
	 * @since 15/01/2013
	 */
	public function limparTemporariaPiPcp($co_usuario){
		$query = "DELETE FROM tb_tmp_etiqueta_peca_pcp WHERE co_usuario = ".$co_usuario;
		mysql_query($query, $this->conexaoERP);
	}
	
	/**
	 * Metodo para limpar a tabela temporaria etiqueta peca 6x1,53cm
	 * @author Ricardo S. Alvarenga
	 * @since 10/01/2013
	 */
	public function limparTemporariaEtiquetaPeca($co_usuario){
		$query = "DELETE FROM tb_tmp_etiqueta_peca WHERE co_usuario = ".$co_usuario;
		mysql_query($query, $this->conexaoERP);
	}
	/**
	 * Metodo para limpar a tabela temporaria etiqueta pacote 10x5cm
	 * @author Ricardo S. Alvarenga
	 * @since 22/01/2013
	 */
	public function limparTemporariaEtiquetaPacote($co_usuario){
		$query = "DELETE FROM tb_tmp_etiqueta_pacote WHERE co_usuario = ".$co_usuario;
		mysql_query($query, $this->conexaoERP);
	}
	
	/**
	 * Metodo para buscar um numero da tabela temporaria
	 * @author Ricardo S. Alvarenga
	 * @since 08/01/2013
	 * @param string $co_pcp_apontamento
	 */
	public function getOPFind($co_pcp_apontamento){
		$query = "SELECT CONCAT(ORDEM_PRODUCAO.CO_NUM,ORDEM_PRODUCAO.CO_ITEM,ORDEM_PRODUCAO.CO_SEQUENCIA) NU_OP 
					FROM TB_PCP_APONTAMENTO APONTAMENTO 
					INNER JOIN TB_PCP_OP ORDEM_PRODUCAO 
						ON APONTAMENTO.CO_PCP_OP = ORDEM_PRODUCAO.CO_PCP_OP WHERE CO_PCP_APONTAMENTO = ".$co_pcp_apontamento;
		$result = mysql_query($query, $this->conexaoERP);
		$row = mysql_fetch_array($result);
		return $row;
		
	}
	
}
?>