<?php
	ob_start();
	include('cliente_pdf.php');
	$conteudo = ob_get_contents();
	ob_end_clean();
	require('../composer/vendor/autoload.php');

	$mdpf = new mPDF();
	$mdpf->WriteHTML($conteudo);
	$mdpf->Output();
?>

