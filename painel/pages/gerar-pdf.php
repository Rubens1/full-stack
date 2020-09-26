<?php
	ob_start();
	require('../composer/vendor/autoload.php');
	include('cliente_pdf.php');
	$conteudo = ob_get_contents();
	ob_end_clean();
    
	$mdpf = new mPDF();
	$mdpf->WriteHTML($conteudo);
	$mdpf->Output();
?>

