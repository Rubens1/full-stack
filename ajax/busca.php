<?php
	include('../config.php');
	$data = array();
  $data ['sucesso'] = true;
  
    
      $preco_min = Painel::formatarMoedaBd(str_replace('R$ ','',$_POST['preco_min']));
      if($preco_min === ''){
        $preco_min = 0;
    }
      $preco_max = Painel::formatarMoedaBd(str_replace('R$ ','',$_POST['preco_max']));
      if($preco_max === ''){
        $preco_max = 0;
    }
  $sql = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE
   `tb_admin.estoque`.`preco` >= ? AND
    `tb_admin.estoque`.`preco` <= ? ");
  $sql->execute(array($preco_min,$preco_max));
  $produtos = $sql->fetchAll();
  //print_r($produtos);
  ?>

  <div class="container">
       
          
       <?php 
        foreach ($produtos as $key => $value) { 
             $categoria = MySql::conectar()->prepare("SELECT `slug` FROM `tb_admin.categoria` WHERE id = ?");
             $categoria->execute(array($value['categoria_id']));
             $categoriaNome = $categoria->fetch()['slug'];
             $categoriaID = $categoria->fetch()['id'];
             $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id]");
             $imagem->execute();
             $imagem = $imagem->fetch()['imagem'];
             
            ?>
        <div class="produto-single-box">
          <a class="detalhe" href="<?php echo INCLUDE_PATH; ?>produtos/<?php echo $categoriaNome; ?>/<?php echo $value['slug'];?>">
            <div class="time-produto">NOVO</div>
          <img src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>uploads/<?php echo $imagem; ?>">
          <p><?php echo ucfirst($value['nome']); ?><br>
            <?php if($value['promocao'] != 0){ ?>
              <p><strike>Preço: R$<?php echo Painel::convertMoney($value['preco']); ?></strike><br> 
              Promoção: R$ <?php echo Painel::convertMoney($value['promocao']); ?></p>
          <?php }else{ ?><br>
            <p>Preço: R$ <?php echo Painel::convertMoney($value['preco']); ?></p>
            <?php } ?>
          </a>
        </div><!--Produto-single-box-->
      <?php }  ?>

      <div class="clear"></div>
      </div><!--Container-->
