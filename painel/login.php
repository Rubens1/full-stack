<?php
    if(isset($_COOKIE['lembrar'])){
        $email = $_COOKIE['email'];
        $password = $_COOKIE['password'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE email = ? AND password = ?");
        $sql->execute(array($email,$password));
        if($sql->rowCount() == 1){
                $info = $sql->fetch();
                $_SESSION['login'] = true;
                
                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['id_loja'] = $info['id'];
                $_SESSION['loja'] = $info['loja']; 
                $_SESSION['logo'] = $info['logo'];
                header('Location: '.INCLUDE_PATH_PAINEL_LOJA);
                die();

        }
    }



    if(isset($_COOKIE['lembrar'])){
        $email = $_COOKIE['email'];
        $senha = $_COOKIE['senha'];
        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.consumido` WHERE email = ? AND senha = ?");
        $sql->execute(array($email,$senha));
        if($sql->rowCount() == 1){
                $info = $sql->fetch();
                $_SESSION['login'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                $_SESSION['id_usuario'] = $info['id'];
                $_SESSION['nome'] = $info['nome']; 
                $_SESSION['email'] = $info['email'];
                header('Location: '.INCLUDE_PATH);
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
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>css/style.css">

    <title>Login</title>

</head>
<body>
    <br>
<a href="<?php echo INCLUDE_PATH; ?>"><img style="width: 130px;" src="<?php echo INCLUDE_PATH; ?>img/LogoMarca.png"></a>
<div class="container" id="container">
    <div class="form-container sign-up-container">
        <form method="post">
            
            <h1>Entra com a loja</h1>
            <span>Informe a sua conta</span>
            <?php 
          if(isset($_POST['acao'])){
            $email = $_POST['email'];
            $password = $_POST['password'];
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE email = ? AND password = ?");
            $sql->execute(array($email, $password));
            if($sql->rowCount()== 1){
                $info = $sql->fetch();
                $_SESSION['login'] = true;

                $_SESSION['email'] = $email;
                $_SESSION['password'] = $password;
                $_SESSION['id_loja'] = $info['id'];
                $_SESSION['loja'] = $info['loja'];
                $_SESSION['logo'] = $info['logo'];
                header('Location: '.INCLUDE_PATH_PAINEL_LOJA);
                die();
            }else{
            echo'<div class="erro-box"><i class="fa fa-times"></i> Email ou senha incorretos!</div>';
            }
          }
         ?>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Senha" required>
            <input class="button" type="submit" value="Entrar" name="acao">
        </form>
    </div>

    <div class="form-container sign-in-container">
        <form method="post">
           <?php
            if(isset($_POST['entrar'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.consumido` WHERE email = ? AND senha = ?");
            $sql->execute(array($email, $senha));
            if($sql->rowCount()== 1){
                $info = $sql->fetch();
                $_SESSION['consumido'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                $_SESSION['id_usuario'] = $info['id'];
                $_SESSION['nome'] = $info['nome'];
                header('Location: '.INCLUDE_PATH);
                die();
            }else{ 
            echo'<div class="erro-box"><i class="fa fa-times"></i> Email ou senha incorretos!</div>';
            }
          }
         ?>
            <div class="social-container">
                <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
            </div>
            <span>Informe a sua conta</span>
            <input type="email" placeholder="Email" name="email" />
            <input type="password" placeholder="Senha" name="senha" />
            <a href="#">Esqueci minha senha</a>
            <input class="button" type="submit" value="Entrar" name="entrar">
            <a href="">Criar Conta</a>
        </form>
    </div>
    <div class="overlay-container">
        <div class="overlay">
            <div class="overlay-panel overlay-left">
                <h1>Comprar</h1>
                <p>Para você compra um produto entrar com o seu Login pessoal clicando no botão a baixo</p>
                <button class="ghost" id="signIn">Minha Conta</button>
                <a style="color: #fff;" href="">Criar conta</a>
            </div>
            <div class="overlay-panel overlay-right">
                <h1>Loja</h1>
                <p>Para entrar com a sua loja clica no botão a baixo</p>
                <button class="ghost" id="signUp">Minha Loja</button>
                <a style="color: #fff;" href="<?php echo INCLUDE_PATH_REGISTRO; ?>">Registra a sua Loja agora</a>
            </div>
        </div>
    </div>
</div>

  <!-- Optional JavaScript -->

    <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>painel/js/main.js"></script>
    <script src="https://kit.fontawesome.com/a81368914c.js"></script>

  </body>
</html>