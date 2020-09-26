<?php 
	$url = explode('/',$_GET['url']);

    $categoria = MySql::conectar()->prepare("SELECT * FROM `tb_admin.categoria` WHERE slug = ?");
    $categoria->execute(array($url[1]));
    $categoria = $categoria->fetchAll();
    foreach($categoria as $key => $value){
        $tipo = MySql::conectar()->prepare("SELECT * FROM `tb_admin.subcategoria` WHERE categoria_id = ?");
          $tipo->execute(array($value['id']));
          $tipoNome = $tipo->fetchAll();
          if($tipo->rowCount() > 0){
           ?>

                <?php foreach($tipoNome as $key => $subcategoria){ ?>          
<div class="titulo-categoria-h2"><h2><?php  echo $subcategoria['subcategoria']; ?></h2></div>
    <div class="lista-items-categoria">
      <div class="owl-carousel">

        <?php 
        $query = "";
          if(isset($_POST['busca_produto']) && $_POST['busca_produto'] == 'Buscar!'){
            $nome = $_POST['busca'];
            $query = "WHERE (nome LIKE '%$nome%')";

          }
          if($query == ''){
            $query2 = "";
          }else{
            $query2 = "";
          }
          $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query ORDER BY id ASC ");
          $sql->execute();
          $items = $sql->fetchAll();
          if($query != ''){
              echo '<div style="width:100%" ><p>Foram encontrado(s):<b>'.count($items).'</b></p></div>';
            }
          foreach ($items as $key => $value) {
          $sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_admin.categoria` WHERE id = ?");
          $sql->execute(array($value['categoria_id']));
          $categoriaNome = $sql->fetch()['slug'];
          $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id]");
          $imagem->execute();
          $imagem = $imagem->fetch()['imagem'];
         if($subcategoria['id'] == $value['subcategoria_id']){
            
        ?>
          
          <div class="produto-single-box">
          <a class="detalhe" href="<?php echo INCLUDE_PATH; ?>produtos/<?php echo $categoriaNome; ?>/<?php echo $value['slug'];?>/<?php echo $value['id']; ?>">
            <div class="time-produto">NOVO</div>
          <img class="img-categoria" src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>uploads/<?php echo $imagem; ?>">
          <p><?php echo ucfirst($value['nome']); ?><br>
            <?php if($value['promocao'] != 0){ ?>
              <p><strike>Preço: R$<?php echo Painel::convertMoney($value['preco']); ?></strike><br> 
              Promoção: R$ <?php echo Painel::convertMoney($value['promocao']); ?></p>
          <?php }else{ ?><br>
            <p>Preço: R$ <?php echo Painel::convertMoney($value['preco']); ?></p>
            <?php } ?>
          </a>
        </div><!--Produto-single-box-->

      <?php } } ?>

      <div class="clear"></div>
      </div>
    </div><!--Lista de items-->
  </div><!-- Pages-container -->
</div><!-- Page produto -->

        
                <?php } ?>

        <?php }else{
           ?>
           <div class="container">
                <div class="verification">
                        <div class="titulo-h2"><h2>No momento não a categorias</h2></div>
                </div>
           </div>
           <?php
        }
    }
?>

<script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>js/OwlCarousel2-2.3.4/docs/assets/vendors/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo INCLUDE_PATH; ?>js/OwlCarousel2-2.3.4/dist/owl.carousel.js"></script>
    <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
      stagePadding: 50,
      loop:true,
      margin:10,
      nav:true,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:4
          }
      }
  })
  </script>