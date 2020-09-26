<<<<<<< HEAD
<<<<<<< HEAD
<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	require('composer/vendor/autoload.php');
	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoLoad.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);




	define('INCLUDE_PATH','http://localhost/lordlis/');
	define('INCLUDE_PATH_PAINEL_LOJA',INCLUDE_PATH.'painel/');
	define('INCLUDE_PATH_PAINEL_CLIENTE',INCLUDE_PATH.'painel_cliente/');
	define('INCLUDE_PATH_PAINEL_COLABORADO',INCLUDE_PATH.'painel_colaborado/');
	define('INCLUDE_PATH_REGISTRO',INCLUDE_PATH.'registra/');
	define('INCLUDE_PATH_PLATAFORMA',INCLUDE_PATH.'plataforma/');
	

	define('BASE_DIR_PAINEL_LOJA',__DIR__.'/painel');
	define('BASE_DIR_PAINEL_CLIENTE',__DIR__.'/cliente');
	define('BASE_DIR_PAINEL_COLABORADO',__DIR__.'/painel_colaborado');
	define('BASE_DIR_REGISTRO',__DIR__.'/registra');
	define('BASE_DIR_PLATAFORMA',__DIR__.'/plataforma');

	//Conectar com banco de dados!
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','db_imperio');

	//Constantes para o painel de controle
	define('NOME_EMPRESA','LORDLIS');

	//Funções do painel
	function pegaCargo($indice){
		return Painel::$cargos[$indice];
	}

	function selecionadoMenu($par){
		/*<i class="fa fa-angle-double-right" aria-hidden="true"></i>*/
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo 'style="display:none;"';
		}
	}

	function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel/pages/permissao_negada.php');
			die();
		}
	}
	function verificaPermissaoPaginaColaborado($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel_colaborado/pages/permissao_negada.php');
			die();
		}
		
	}
	function recoverPost($post){
			if(isset($_POST[$post])){
				echo $_POST[$post];
			}
		}
=======
<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	require('composer/vendor/autoload.php');
	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoLoad.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);




	define('INCLUDE_PATH','http://localhost/lordlis/');
	define('INCLUDE_PATH_PAINEL_LOJA',INCLUDE_PATH.'painel/');
	define('INCLUDE_PATH_PAINEL_CLIENTE',INCLUDE_PATH.'painel_cliente/');
	define('INCLUDE_PATH_PAINEL_COLABORADO',INCLUDE_PATH.'painel_colaborado/');
	define('INCLUDE_PATH_REGISTRO',INCLUDE_PATH.'registra/');
	define('INCLUDE_PATH_PLATAFORMA',INCLUDE_PATH.'plataforma/');
	

	define('BASE_DIR_PAINEL_LOJA',__DIR__.'/painel');
	define('BASE_DIR_PAINEL_CLIENTE',__DIR__.'/cliente');
	define('BASE_DIR_PAINEL_COLABORADO',__DIR__.'/painel_colaborado');
	define('BASE_DIR_REGISTRO',__DIR__.'/registra');
	define('BASE_DIR_PLATAFORMA',__DIR__.'/plataforma');

	//Conectar com banco de dados!
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','db_imperio');

	//Constantes para o painel de controle
	define('NOME_EMPRESA','LORDLIS');

	//Funções do painel
	function pegaCargo($indice){
		return Painel::$cargos[$indice];
	}

	function selecionadoMenu($par){
		/*<i class="fa fa-angle-double-right" aria-hidden="true"></i>*/
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo 'style="display:none;"';
		}
	}

	function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel/pages/permissao_negada.php');
			die();
		}
	}
	function verificaPermissaoPaginaColaborado($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel_colaborado/pages/permissao_negada.php');
			die();
		}
		
	}
	function recoverPost($post){
			if(isset($_POST[$post])){
				echo $_POST[$post];
			}
		}
>>>>>>> a40275e3a7d3f51fc144a18135949a75f3f9dc93
=======
<?php

	session_start();
	date_default_timezone_set('America/Sao_Paulo');
	require('composer/vendor/autoload.php');
	$autoload = function($class){
		if($class == 'Email'){
			require_once('classes/phpmailer/PHPMailerAutoLoad.php');
		}
		include('classes/'.$class.'.php');
	};

	spl_autoload_register($autoload);




	define('INCLUDE_PATH','http://localhost/lordlis/');
	define('INCLUDE_PATH_PAINEL_LOJA',INCLUDE_PATH.'painel/');
	define('INCLUDE_PATH_PAINEL_CLIENTE',INCLUDE_PATH.'painel_cliente/');
	define('INCLUDE_PATH_PAINEL_COLABORADO',INCLUDE_PATH.'painel_colaborado/');
	define('INCLUDE_PATH_REGISTRO',INCLUDE_PATH.'registra/');
	define('INCLUDE_PATH_PLATAFORMA',INCLUDE_PATH.'plataforma/');
	

	define('BASE_DIR_PAINEL_LOJA',__DIR__.'/painel');
	define('BASE_DIR_PAINEL_CLIENTE',__DIR__.'/cliente');
	define('BASE_DIR_PAINEL_COLABORADO',__DIR__.'/painel_colaborado');
	define('BASE_DIR_REGISTRO',__DIR__.'/registra');
	define('BASE_DIR_PLATAFORMA',__DIR__.'/plataforma');

	//Conectar com banco de dados!
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','db_imperio');

	//Constantes para o painel de controle
	define('NOME_EMPRESA','LORDLIS');

	//Funções do painel
	function pegaCargo($indice){
		return Painel::$cargos[$indice];
	}

	function selecionadoMenu($par){
		/*<i class="fa fa-angle-double-right" aria-hidden="true"></i>*/
		$url = explode('/',@$_GET['url'])[0];
		if($url == $par){
			echo 'class="menu-active"';
		}
	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			echo 'style="display:none;"';
		}
	}

	function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel/pages/permissao_negada.php');
			die();
		}
	}
	function verificaPermissaoPaginaColaborado($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		}else{
			include('painel_colaborado/pages/permissao_negada.php');
			die();
		}
		
	}
	function recoverPost($post){
			if(isset($_POST[$post])){
				echo $_POST[$post];
			}
		}
>>>>>>> a40275e3a7d3f51fc144a18135949a75f3f9dc93
?>