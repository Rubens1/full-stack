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
            <a class="senha-loja" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>editar-senha">Editar Senha</a>
            <a class="endereco-loja" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>editar-loja">Editar Perfil</a>
        </div>
        <form action="" method="post">
            <?php
            if(isset($_POST['atualizar-endereco'])){
                $cep = $_POST['cep'];
                $estado = $_POST['estado'];
                $cidade = $_POST['cidade'];
                $bairro = $_POST['bairro'];
                $complemento = $_POST['complemento'];
                $numero = $_POST['numero'];
                $empresa = new Loja();
        
                    if($empresa->atualizarEnderecoLoja($cep,$estado,$cidade,$bairro,$complemento,$numero)){
                        Painel::alert('sucesso','Atualizado com sucesso!');
                    }else{
                        Painel::alert('erro','Ocorreu um erro ao atualizar...');
                    }
                }
            ?>
            <div class="form-group">
                <label for="cep">CEP</label>
                <input class="form-control" type="text" name="cep" value="<?php echo $info_loja['cep'] ?>">
            </div>
            <div class="form-group">
                <label for="estado">Estado</label>
                <input class="form-control" type="text" name="estado" value="<?php echo $info_loja['estado'] ?>">
            </div>
            <div class="form-group">
                <label for="cidade">Cidade</label>
                <input class="form-control" type="text" name="cidade" value="<?php echo $info_loja['cidade'] ?>">
            </div>
            <div class="form-group">
                <label for="bairro">Bairro</label>
                <input class="form-control" type="text" name="bairro" value="<?php echo $info_loja['bairro'] ?>">
            </div>
            <div class="form-group">
                <label for="complemento">Complmento</label>
                <input class="form-control" type="text" name="complemento" value="<?php echo $info_loja['complemento'] ?>">
            </div>
            <div class="form-group">
                <label for="numero">Número</label>
                <input class="form-control" type="text" name="numero" value="<?php echo $info_loja['numero'] ?>">
            </div>
            
            <button type="submit" name="atualizar-endereco" class="btn btn-primariry">Salvar</button>
           
        </form>
    </div>
</div>
</div>