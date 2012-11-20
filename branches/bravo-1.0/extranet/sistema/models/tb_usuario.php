<?php
/**
 * Classe da camada de acesso a dados da tabela tb_usuario
* @author Ricardo S. Alvarenga
* @since 19/11/2012
*
*/
class tb_usuario{

	private $conexaoERP;

	public function __construct($conexaoERP){
		$this->conexaoERP = $conexaoERP;

	}
	
	/**
	 * Metodo para alterar a senha
	 * @param int $cod_pcp_ad
	 * @return boolean
	 * @author Ricardo S. Alvarenga
	 * @since 19/11/2012
	 */
	public function updateSenha($co_usuario, $pass_usuario)
	{
		$query = "UPDATE tb_usuario SET pass_usuario = '".$pass_usuario."' WHERE co_usuario = ".$co_usuario;
		mysql_query($query, $this->conexaoERP);
	}
	
	/**
	 * Metodo para listar os dados do usuario
	 * @param int $co_usuario codigo do usuario
	 * @author Ricardo S. Alvarenga
	 * @since 19/11/2012
	 */
	public function findByUser($co_usuario){
		$query = "SELECT  * 
				  FROM tb_usuario USUARIO 
				  INNER JOIN tb_colaborador COLABORADOR ON USUARIO.co_colaborador = COLABORADOR.co_colaborador
				  INNER JOIN tb_pessoa PESSOA ON COLABORADOR.co_pessoa = PESSOA.co_pessoa
				  WHERE CO_USUARIO = ".$co_usuario;
		$result = mysql_query($query, $this->conexaoERP);
		$row = mysql_fetch_assoc($result);
		return $row;
	}
	
	public function finByUserPass($co_usuario, $pass_usuario){
		$query = "SELECT *
					FROM tb_usuario 
					WHERE pass_usuario = '".$pass_usuario."' 
				  	AND co_usuario = ".$co_usuario;
		$result = mysql_query($query, $this-> conexaoERP);
		$row = mysql_num_rows($result);
		return $row;
	}

}
?>