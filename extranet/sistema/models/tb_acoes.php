<?php
/**
 * Classe da camada de acesso a dados da tabela de acoes
 * @author Ricardo S. Alvarenga
 * @since 13/11/2012
 */

class tb_acoes{

	private $conexaoERP;
	private $_helper;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}
	
	/**
	 * Metodo inserir uma nova acao a um modulo
	 * @param int $co_papel_modulo
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	public function inserir($co_papel_modulo){
		$query = "INSERT INTO tb_acoes (co_papel_modulo) VALUES(".$co_papel_modulo.")";
		mysql_query($query,$this->conexaoERP);
	}
	
	/**
	 * Metodo para deletar uma açao de um modulo
	 * @param int $co_papel_modulo	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 13/11/2012
	 */
	Public function delete($co_papel_modulo){
		$query = "DELETE FROM tb_acoes WHERE co_papel_modulo = ".$co_papel_modulo;
		mysql_query($query,$this->conexaoERP);
	}

	/**
	 * Metodo atualizar a acao editar
	 * @param int $co_acao	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 14/11/2012
	 */
	public function updateEditar($co_acao, $fl_editar){
		$query = "UPDATE tb_acoes SET fl_editar = ".$fl_editar." WHERE co_acao = ".$co_acao;
		mysql_query($query, $this->conexaoERP);
		
	}
	/**
	 * Metodo atualizar a acao incluir
	 * @param int $co_acao	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 14/11/2012
	 */
	public function updateIncluir($co_acao, $fl_incluir){
		$query = "UPDATE tb_acoes SET fl_adicionar = ".$fl_incluir." WHERE co_acao = ".$co_acao;
		mysql_query($query, $this->conexaoERP);
	
	}
	/**
	 * Metodo atualizar a acao excluir
	 * @param int $co_acao	chave primaria
	 * @param int $fl_excluir
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 14/11/2012
	 */
	public function updateExcluir($co_acao, $fl_excluir){
		$query = "UPDATE tb_acoes SET fl_excluir = ".$fl_excluir." WHERE co_acao = ".$co_acao;
		mysql_query($query, $this->conexaoERP);
	
	}
	
	/**
	 * Metodo atualizar todoas acoes de uma ação
	 * @param int $co_papel_modulo	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 14/11/2012
	 */
	public function updateAll($fl_editar,$fl_excluir, $fl_incluir,$co_acao){
		$query = "UPDATE tb_acoes SET fl_excluir = ".$fl_excluir.", fl_editar = ".$fl_editar.", fl_adicionar = ".$fl_incluir." WHERE co_acao = ".$co_acao;
		mysql_query($query, $this->conexaoERP);
	}
	
	/**
	 * Metodo verifica se uma acao excluir esta ativa
	 * @param int $co_acao	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 14/11/2012
	 */
	public function excluirAtivo($co_acao){
		$query = "SELECT fl_excluir FROM tb_acoes WHERE co_acao = ".$co_acao;
		$row = mysql_fetch_assoc(mysql_query($query, $this->conexaoERP));
		if($row['fl_excluir']=="0"){
			return false;
		}else{
			return true;
		}
	}
	
	/**
	 * Metodo verifica se uma acao incluir esta ativa
	 * @param int $co_acao	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 14/11/2012
	 */
	public function incluirAtivo($co_acao){
		$query = "SELECT fl_adicionar FROM tb_acoes WHERE co_acao = ".$co_acao;
		$row = mysql_fetch_assoc(mysql_query($query, $this->conexaoERP));
		if($row['fl_adicionar']=="0"){
			return false;
		}else{
			return true;
		}
	}
	/**
	 * Metodo verifica se uma acao editar esta ativa
	 * @param int $co_acao	chave primaria
	 * @return multitype:
	 * @author Ricardo S. Alvarenga
	 * @since 14/11/2012
	 */
	public function editarAtivo($co_acao){
		$query = "SELECT fl_editar FROM tb_acoes WHERE co_acao = ".$co_acao;
		$row = mysql_fetch_assoc(mysql_query($query, $this->conexaoERP));
		if($row['fl_editar']=="0"){
			return false;
		}else{
			return true;
		}
	}
}
	
