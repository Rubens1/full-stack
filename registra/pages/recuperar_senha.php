<div class="container">
    <div class="verification" id="verification">
        
        <div class="logar">
        <h2 class="center">Recuperamento de senha</h2>
            <form action="" method="post">
                <?php 
                if(isset($_POST['acao'])){
                    $consumido = new Consumido();
                    echo Consumido::verificaDados($_POST['email']);
                }
                ?>
            <label>Email</label>
                <input class="form-login" type="email" name="email" placeholder="Digita o email cadastrado">
                <input type="submit" name="acao" value="Enviar" class="btn-login">
                <input type="hidden" name="enviar" value="form">
                <a class="senha-empresa" href="<?php echo INCLUDE_PATH_REGISTRO ?>recuperar_senha_da_empresa">Recuperar senha da Empresa</a>
            </form>
        </div>
    </div>
</div>