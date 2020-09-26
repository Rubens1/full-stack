<?php
	
	include('../config.php');

	if(Painel::logado() == false){
		include('login2.php');
	}else{
		include('main.php');
	}

	ob_end_flush();
?>
