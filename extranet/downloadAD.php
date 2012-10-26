<?php
$link = 'http://localhost/extranet-bravo/extranet/arquivosAD/'.trim($_GET['arquivo']).'.ad';
	header ("Content-Disposition: attachment; filename='".trim($_GET['arquivo']).".ad'");
	header ("Content-Type: txt/plain");
	readfile($link);

/* 	echo "<script>
			alert('[Erro] - Arquivo não existe, favor entrar em contato com o suporte!');
			history.back(-1);
			</script>"; */

?>