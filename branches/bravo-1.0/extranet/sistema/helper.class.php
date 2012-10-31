<?php
/**
 * Classe com helpers uteis
 * @author Ricardo S. Alvarenga
 * @since 25/10/2012
 *
 */
class helper{
	
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
}