<?php
/**
 * Classe com helpers uteis
 * @author Ricardo S. Alvarenga
 * @since 25/10/2012
 *
 */
class helper{
	
	/**
	 * Metodo para ajustar a data e hora no padrao portugues brasil
	 * @param String $data	retorno do banco de dados exemplo: 2012-11-05 16:21:15
	 * @author Ricardo S. Alvarenga
	 * @since 05/11/2012
	 * @return string YYYY/MM/DD h:i:s
	 */
	public function ajustarDataHoraPt_Br($dataHora){
		//2012-11-05 16:21:15
		$dia			= substr($dataHora,8,2);
		$mes 			= substr($dataHora,5,2);
		$ano			= substr($dataHora,0,4);
		$horaMinSec			= substr($dataHora,11,8);
		return $dia.'/'.$mes.'/'.$ano.' '.$horaMinSec;
	}

	/**
	 * Metodo para ajustar data (DD/MM/YYYY) para (YYYYMMDD)
	 * @param string $data
	 * @return string
	 * @author Ricardo S. Alvarenga
	 * @since 25/10/2012
	 */
	public function ajustarDataYYYYmmdd($data){
		$data 	 = substr($data ,6,4).substr($data ,3,2).substr($data ,0,2);
		return $data;
	}

	/**
	 * Metodo para mostrar o alerta de erro e voltar para pagina anterior
	 * @param String $msg	mensagem do erro
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 */
	public function alertError($msg){
		echo "<script>
				alert('[Erro] - ".$msg."');
						history.back(-1);
						</script>";
	}

	/**
	 * Metodo para mostrar o alerta de erro e voltar para pagina parametrizada inicio.php?pg=x
	 * @param String $msg	mensagem
	 * @param String $pag	action da pagina
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 */
	public function alertErrorBackParam($msg, $pag){
		echo "<script>
				alert('[Erro] - ".$msg."');
			   $(window.document.location).attr('href','inicio.php?pg=".$pag."');
			   		</script>";
	}


	/**
	 * Metodo para mostrar alerta no formato dialog jquery e redirecionando para inicio.php
	 * @param String $msg
	 * @author Ricardo S. Alvarenga
	 * @since 31/10/2012
	 */
	public function alertDialog($msg){
		echo "<script type='text/javascript' language='javascript'>
				$(function($) {
					$('<p>[Erro] ".$msg."</p>').dialog({
							modal: true,
							resizable: false,
							title: 'Aten&ccedil;&atilde;o',
							buttons: {
								Ok: function() {
									$( this ).dialog( 'close' );
									$(window.document.location).attr('href','inicio.php');
								}
							}
					});
				});
			</script>";
	}
	
	/**
	 * Metodo para capturar o nome temporario do arquivo a ser enviado para o servidor
	 * @param String $nomeDoCampo	nome do campo do qual veio o arquivo
	 * @return boolean
	 * @since 06/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function getNomeTempArquivo($nomeDoCampo){
		$nometmp    = $_FILES[$nomeDoCampo]['tmp_name'];
		if ($nometmp != ""){
			return $nometmp;
		}else{
			return false;
		}
	}
	/**
	 * Metodo para gerar a matriz de dados contendo as linhas do arquivo
	 * @param String $nomeTemporario
	 * @return array
	 * @since 06/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function gerarMatrizDeDadosDoArquivo($nomeTemporario){
		$linhas = file($nomeTemporario,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
		for ($x=0; $x < count($linhas); $x++){
			$dados = explode('\n',$linhas[$x]);
			$matrizDados[] = $dados;
		}
		return $matrizDados;
	}

	/**
	 * @param string $dir	diretorio onde sera salvo o arquivo
	 * @param string $novoNomeArquivo	novo nome do arquivo com extensão
	 * @param string $nomeTemporario	nome temporario do arquivo 
	 * @return boolean
	 * @since 06/11/2012
	 * @author Ricardo S. Alvarenga
	 */
	public function importarArquivo ($dir, $novoNomeArquivo,$nomeTemporario){
		if (!file_exists($dir))
		{
			mkdir($dir, 0755);
		}
		$caminho = $dir.$novoNomeArquivo;
		move_uploaded_file($nomeTemporario,$caminho);
	}
	
}