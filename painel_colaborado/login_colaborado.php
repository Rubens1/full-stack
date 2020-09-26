<?php
	if(isset($_COOKIE['lembrar'])){
		$user = $_COOKIE['user'];
		$password = $_COOKIE['password'];
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.colaborado` WHERE user = ? AND password = ?");
		$sql->execute(array($user,$password));
		if($sql->rowCount() == 1){
				$info = $sql->fetch();
				$_SESSION['login'] = true;
				$_SESSION['user'] = $user;
				$_SESSION['password'] = $password;
				$_SESSION['cargo'] = $info['cargo'];
				$_SESSION['nome'] = $info['nome']; 
				$_SESSION['email'] = $info['email'];
				$_SESSION['img'] = $info['img'];
				header('Location: '.INCLUDE_PATH_PAINEL_COLABORADO);
				die();

		}
	}
?>
<!DOCTYPE html>
<html>
<head>
	  <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>node_modules/bootstrap/compiler/style.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>font/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO; ?>css/style.css">
    

	<title>Login</title>

</head>
<body>

<div class="container">
	<div class="img mt-4 d-none d-lg-block ">
		<img src="<?php echo INCLUDE_PATH; ?>img/svg/01.svg">
	</div>
	<div class="login-container">
		

		  	
		<form method="post">
			<a href="<?php echo INCLUDE_PATH; ?>"><img class="Logo01" src="<?php echo INCLUDE_PATH; ?>img/LogoMarca.png"></a>
			<h2>Bem-Vindo</h2>
			<?php 
		  if(isset($_POST['acao'])){
		  	$user = $_POST['user'];
		  	$password = $_POST['password'];
		  	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.colaborado` WHERE user = ? AND password = ?");
		  	$sql->execute(array($user, $password));
		  	if($sql->rowCount()== 1){
		  		$info = $sql ->fetch();
		  		$_SESSION['login_colaborado'] = true;
		  		$_SESSION['user'] = $user;
		  		$_SESSION['password'] = $password;
		  		$_SESSION['cargo'] = $info['cargo'];
		  		$_SESSION['nome'] = $info['nome'];
		  		$_SESSION['email'] = $info['email'];
		  		$_SESSION['img'] = $info['img'];
		  		header('Location: '.INCLUDE_PATH_PAINEL_COLABORADO);
		  		die();
		  	}else{ 
			echo'<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
			}
		  }
		 ?>
			<div class="input-div um">
				<div class="i">
					<i class="fas fa-user"></i>
				</div>
				<div>
					<h5>Email</h5>
					<input type="text" class="input" name="user" required>
				</div>
			</div>
			<div class="input-div dois">
				<div class="i">
					<i class="fas fa-lock"></i>
				</div>
				<div>
					<h5>Senha</h5>
					<input type="password" class="input" name="password" required>
				</div>
			</div>
			<input type="submit" value="Entrar" name="acao" class="btn">
		</form>
	</div>
</div>
     

   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo INCLUDE_PATH; ?>node_modules/jquery/dist/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>node_modules/popper.js/dist/umd/popper.js"></script>
    <script src="<?php echo INCLUDE_PATH; ?>node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL_COLABORADO; ?>js/login.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>
  </body>
</html>
