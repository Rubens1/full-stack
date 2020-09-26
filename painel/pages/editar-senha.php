<?php
$loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE id = ?");
$loja->execute(array($_SESSION['id_loja']));
$info_loja = $loja->fetch();

?>
<div class="perfil-parent">
<div class="perfil">
    <div class="perfil-img">
        <div class="logo-empresa">
                <img src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>/logo/<?php echo $info_loja['logo']; ?>" alt="" class="img-logo">    
        </div>
    </div>
    <div class="perfil-form">
        <div class="editar-info-loja">
            <a class="senha-loja" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>editar-loja">Editar loja</a>
            <a class="endereco-loja" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>editar-endereco">Editar Edereço</a>
        </div>
        <form action="" method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['atualizar-senha'])){
                $senha_sem_cript = filter_input(INPUT_POST, 'senha', FILTER_DEFAULT);
               
                $confirmasenha = filter_input(INPUT_POST, 'confirmasenha', FILTER_DEFAULT);
                
                
                if($senha_sem_cript == $confirmasenha){
                    $empresa = new Loja();
                    $senha = password_hash($senha_sem_cript,PASSWORD_DEFAULT);
                    if($empresa->atualizarSenhaoja($senha)){
                        Painel::alert('sucesso','Atualizado com sucesso!');
                    } 
                }else{
                        Painel::alert('erro','Ocorreu um erro ao atualizar...');
                    }
                }
            ?>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input class="form-control" type="password" name="senha">
            </div>
            <div class="form-group">
                <label for="confirmasenha">Confirma Senha</label>
                <input class="form-control" type="password" name="confirmasenha">
            </div>
            <button type="submit" name="atualizar-senha" class="btn btn-primariry">Salvar</button>
           
        </form>
        
    </div>
</div>
</div>