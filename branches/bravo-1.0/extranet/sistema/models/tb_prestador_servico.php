<?php
/**
 * Classe da camada de acesso a dados da tabela de prestadores de serviço
 * @author Ricardo S. Alvarenga
 * @since 05/12/2012
 */
//session_start();

class tb_prestador_servico{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}
	

	
	/**
	 * Metodo para inserir uma empresa a um prestador de servico
	 * @return multitype:
	 * @since 05/12/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function inserirEmpresa($codigoPessoa, $codigoJuridica){
		$sql = "INSERT INTO tb_prestador_servico (CO_PESSOA, CO_PESSOA_JURIDICA) VALUES (".$codigoPessoa.", ".$codigoJuridica.")";
		try {
		mysql_query($sql, $this->conexaoERP);
		}catch (Exception $e){
			return false;
		}
		return true;
		
	}
	/**
	 * Metodo para buscar um codigo da empresa pelo codigo da pessoa juridica
	 * @return multitype:
	 * @since 05/12/2012
	 * @author Ricardo S. Alvarenga
	 */
	
	public function findEmpresaByCodJuridica ($codigoJuridica){
		$query = "SELECT co_pessoa_juridica FROM tb_pessoa_juridica WHERE co_pessoa = ".$codigoJuridica;
		$row = mysql_fetch_array(mysql_query($query, $this->conexaoERP));
		return $row;
		
	}
	
	/**
	 * Metodo para listar a empresa de um prestador de servico
	 * @return multitype:
	 * @since 05/12/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function findByEmpresa($codigoPessoa){
		$sql = "SELECT PESSOA.NO_PESSOA EMPRESA
				, JURIDICA.CNPJ_PESSOA_JURIDICA CNPJ
				, JURIDICA.CO_PESSOA CO_PESSOA
				FROM tb_prestador_servico PRESTADOR
					INNER JOIN tb_pessoa_juridica JURIDICA
						ON PRESTADOR.co_pessoa_juridica = JURIDICA.co_pessoa_juridica
					INNER JOIN tb_pessoa PESSOA ON JURIDICA.co_pessoa = PESSOA.co_pessoa
				WHERE PRESTADOR.co_pessoa = ".$codigoPessoa;
		$row = mysql_fetch_array(mysql_query($sql,$this->conexaoERP));
		return $row;
	}
		
}