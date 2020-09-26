<?php
$empresa = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE id = ?");
$empresa->execute(array($_SESSION['id_loja']));
$info_loja = $empresa->fetch();
 
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
                <a class="senha-loja" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>editar-senha">Editar Senha</a>
                <a class="endereco-loja" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>editar-endereco">Editar Edereço</a>
            </div>
            <form method="post" enctype="multipart/form-data">
            <?php
            if(isset($_POST['atualizar-endereco'])){
                $empresario = $_POST['empresario'];
                $loja = $_POST['loja'];
                $email = $_POST['email'];
                $cnpj = $_POST['cnpj'];
                $logo = $_POST['logo'];
                $slug =  Painel::generateSlug($_POST['loja']);
                $empresa = new Loja();
        
                    if($empresa->atualizarLoja($empresario,$loja,$email,$cnpj,$logo,$slug)){
                        Painel::alert('sucesso','Atualizado com sucesso!');
                    }else{
                        Painel::alert('erro','Ocorreu um erro ao atualizar...');
                    }
                }
            ?>
                <div class="form-group">
                    <label for="empresario">Empresario</label>
                    <input class="form-control" type="text" name="empresario" value="<?php echo $info_loja['empresario'] ?>">
                </div>
                <div class="form-group">
                    <label for="empresa">Empresa</label>
                    <input class="form-control" type="text" name="loja" value="<?php echo $info_loja['loja'] ?>">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input class="form-control" type="email" name="email" value="<?php echo $info_loja['email'] ?>">
                </div>
                <div class="form-group">
                    <label>CNPJ:</label>
                    <input class="form-control" type="text" name="cnpj" value="<?php echo $info_loja['cnpj']; ?>" disabled>  
                </div>
                <div class="custom-file">
                    <input style="width: 40px;" type="file" name="logo" id="logo" onchange="previewImagem()">
                    <label for="logo" class="custom-file-label">Logo</label>
                    <input type="hidden" name="logo_atual" value="<?php echo $info_loja['logo']; ?>">
                </div>
                <button type="submit" name="atualizar" class="btn btn-primariry">Salvar</button>
            
            </form>
            
        </div>
    </div>
</div>