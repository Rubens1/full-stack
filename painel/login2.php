<?php
    if(isset($_COOKIE['lembrar'])){
        $email = $_COOKIE['email'];
        $senha = $_COOKIE['senha'];
        $loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE email = ? AND senha = ?");
        $loja->execute(array($email,$senha));
        if($loja->rowCount() == 1){
                $info = $loja->fetch();
                $_SESSION['login'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
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
                $_SESSION['consumido'] = true;
                $_SESSION['email'] = $email;
                $_SESSION['senha'] = $senha;
                $_SESSION['id_usuario'] = $info['id'];
                $_SESSION['nome'] = $info['nome']; 
                $_SESSION['email'] = $info['email'];
                header('Location: '.INCLUDE_PATH);
                die();

        }
    }

          if(isset($_POST['loga'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE email = ?");
            $loja->execute(array($email));
            $info = $loja->fetch();
            $senhalogin = $info['senha'];
            if(password_verify($senha,$senhalogin)){
                if($loja->rowCount() == 1){                  
                    $_SESSION['login'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['senha'] = $senha;
                    $_SESSION['id_loja'] = $info['id'];
                    $_SESSION['loja'] = $info['loja'];
                        header('Location: '.INCLUDE_PATH_PAINEL_LOJA);
                        die();
                    }
                    
                }
            }
        
            if(isset($_POST['loga'])){
            $email = $_POST['email'];
            $senha = $_POST['senha'];
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.consumido` WHERE email = ?");
            $sql->execute(array($email));
            $info = $sql->fetch();
            $senhalogin = $info['senha'];
                if(password_verify($senha,$senhalogin)){
                        if($sql->rowCount() == 1){
                        
                            $_SESSION['consumido'] = true;
                            $_SESSION['email'] = $email;
                            $_SESSION['senha'] = $senha;
                            $_SESSION['id_usuario'] = $info['id'];
                            $_SESSION['nome'] = $info['nome'];
                            header('Location: '.INCLUDE_PATH);
                            die();
                        }
                }
            }
      
?>

<?php 
include('../pages/includes/header.php');
 ?>

<div class="container">
<div class="verification" id="verification">
    
    <div class="logar">
        <form method="post" enctype="multipat/form-data">
            <?php 

            if(isset($_POST['loga'])){
                 if(!password_verify($senha,$senhalogin)){
                    echo Painel::alert('erro',' Email ou senha incorretos!'); 
                    $senha_sem_cript = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
                        $senha = password_hash($senha_sem_cript,PASSWORD_DEFAULT);
                       // echo $senha;               
                 }                    
            }
             ?>
            <label>Email</label>
            <input class="form-login" type="email" name="email" require> 
            <label>Senha</label>
            <input class="form-login" type="password" name="senha" require>
            <input name="loga" class="btn-login" type="submit" value="Entrar">
            <a class="senha" href="<?php echo INCLUDE_PATH_REGISTRO; ?>recuperar_senha">Equeci a senha</a>
        </form><!--Formulario de login-->
    </div><!--Logar-->
    <div class="text">
        <span>Ainda não é cadastrado?</span>
        <p>Se você não é cadastrado se cadastra para fazer as suas compras </p>
        <p><a href="<?php echo INCLUDE_PATH_REGISTRO; ?>">Clique aqui</a></p>
    </div><!--Text-->
</div><!--Verification-->
</div><!--container-->
     
<?php 
include('../pages/includes/footer.php');
 ?>
   <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script type="text/javascript" src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>js/login.js"></script>
