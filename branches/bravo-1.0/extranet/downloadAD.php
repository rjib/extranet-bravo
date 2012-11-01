<?php
/**
 * Arquivo responsavel em enviar para cliente o arquivo AD
 * @author Ricardo S. Alvarenga
 * @since 25/11/2012
 * */
$nome = (int)$_GET['arquivo'];
$link = 'http://localhost/extranet-bravo/extranet/arquivosAD/'.$nome.'.ad';

	header ("Content-Disposition: attachment; filename=".$nome.".ad");
	header ("Content-Type: txt/plain");
	readfile($link);
?>