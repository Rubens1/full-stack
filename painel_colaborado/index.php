<?php
	
	include('../config.php');

	if(Painel::colaborado_logado() == false){
		include('login_colaborado.php');
	}else{
		include('main.php');
	}

?>
