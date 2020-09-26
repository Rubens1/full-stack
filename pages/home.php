

<div class="carousel-container">

<i class="fas fa-angle-left" id="prevBtn"></i>
<i class="fas fa-angle-right" id="nextBtn"></i>

<div class="carousel-slide">
  <img class="carousel-img" src="img/4.jpg" id="lastClone">
  <img class="carousel-img" src="img/1.jpg">
  <img class="carousel-img" src="img/2.jpg">
  <img class="carousel-img" src="img/3.jpg">
  <img class="carousel-img" src="img/4.jpg">
  <img class="carousel-img" src="img/1.jpg" id="firstClone">
</div>

</div>	


<div class="container">
  <div class="servicos">
  
    <div class="servico-detalhe detalhe1 w33">
      <i class="fas fa-shopping-cart"></i>
      <p>Nova pataforma de compras online</p>
    </div>
    <div class="servico-detalhe detalhe2 w33">
      <i class="fas fa-store"></i>
      <p>Todas as vendas são por lojas</p>
    </div>
    <div class="servico-detalhe detalhe3 w33">
      <i class="fas fa-address-card"></i>
      <p>Informações pessoal totalmente protegida </p>
    </div>
  </div>
</div>
<?php 
    $items = \models\produtosModel::getLojaItems();     
?>
  <div class="titulo-h2">
      <h2>Em Promoção</h2>
  </div>
  <div class="container">
  <div class="owl-carousel owl-theme">
      <?php 
      
        foreach ($items as $key => $value) {
            if($value['promocao'] > 0){
            $categoriaSlug = MySql::conectar()->prepare("SELECT `slug` FROM `tb_admin.categoria` WHERE id = ?");
            $categoriaSlug->execute(array($value['categoria_id']));
            $categoriaNome = $categoriaSlug->fetch()['slug'];
            $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id]");
            $imagem->execute();
            $imagem = $imagem->fetch()['imagem'];
        ?>
        <!-- SLIDE -->
        <div class="swiper-slide item">
          
          <div class="slider-box">
            <a href="<?php echo INCLUDE_PATH; ?>produtos/<?php echo $categoriaNome; ?>/<?php echo $value['slug'];?>/<?php echo $value['id'];?>">
              <p class="time">NOVO</p>
              <div class="img-box">
                <img src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>uploads/<?php echo $imagem; ?>">
              </div>
                <p class="detail"><?php echo ucfirst($value['nome']); ?>

                <p class="price py-2"><strike>Preço: R$<?php echo Painel::convertMoney($value['preco']); ?></strike><br> 
                Promoção: R$ <?php echo Painel::convertMoney($value['promocao']); ?></p>
              </p>
            </a>
        </div>
      </div>

  <?php } } ?>
  </div><!-- Owl Carousel-->
  </div>
<div class="titulo-h2"><h2>Categorias</h2></div>
<div class="lista-categoria">
 
      <div class="categoria">
          <a href="<?php echo INCLUDE_PATH; ?>categoria/roupa">
              <div class="img-categoria">
              <i class="fas fa-tshirt"></i>
              </div>
              <div class="titulo-categoria">
                  <p>Roupas</p>
              </div>
          </a>
      </div>
      <div class="categoria">
          <a href="<?php echo INCLUDE_PATH; ?>categoria/acessorio">
              <div class="img-categoria">
              <i class="far fa-clock"></i>
              </div>
              <div class="titulo-categoria">
                  <p>Acessórios</p>
              </div>
          </a>
      </div>
      <div class="categoria">
          <a href="<?php echo INCLUDE_PATH; ?>categoria/calcado">
              <div class="img-categoria">
              <i class="fas fa-shoe-prints"></i>
              </div>
              <div class="titulo-categoria">
                  <p>Calçados</p>
              </div>
          </a>
      </div>
      <div class="categoria">
          <a href="<?php echo INCLUDE_PATH; ?>categoria/eletronico">
              <div class="img-categoria">
              <i class="far fa-keyboard"></i>
              </div>
              <div class="titulo-categoria">
                  <p>Eletrônicos</p>
              </div>
          </a>
      </div>
      <div class="categoria">
          <a href="<?php echo INCLUDE_PATH; ?>categoria/moveis">
              <div class="img-categoria">
              <i class="fas fa-couch"></i>
              </div>
              <div class="titulo-categoria">
                  <p>Móveis</p>
              </div>
          </a>
      </div>
      <div class="categoria">
          <a href="<?php echo INCLUDE_PATH; ?>categoria/outros">
              <div class="img-categoria">
              <i class="fas fa-network-wired"></i>
              </div>
              <div class="titulo-categoria">
                  <p>Outros</p>
              </div>
          </a>
      </div>  
  </div>


  <div class="titulo-h2">
      <h2>Moda de hoje</h2>
  </div>
  <div class="container">
    <div class="owl-carousel owl-theme">
      
        <?php 
          foreach ($items as $key => $value) {
            $categoriaSlug = MySql::conectar()->prepare("SELECT `slug` FROM `tb_admin.categoria` WHERE id = ?");
            $categoriaSlug->execute(array($value['categoria_id']));
            $categoriaNome = $categoriaSlug->fetch()['slug'];
          $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id]");
          $imagem->execute();
          $imagem = $imagem->fetch()['imagem'];
            
        ?>
          <!-- SLIDE -->
          <div class="item">

              <div class="slider-box">
                <a href="<?php echo INCLUDE_PATH; ?>produtos/<?php echo $categoriaNome; ?>/<?php echo $value['slug'];?>/<?php echo $value['id'];?>">
                <p class="time">NOVO</p>
                <div class="img-box">
                  <img src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>uploads/<?php echo $imagem; ?>">
                </div>
                  <p class="detail"><?php echo ucfirst($value['nome']); ?>
                  </p>
                  <p class="price py-2">R$ <?php echo Painel::convertMoney($value['preco']); ?></p>
                
              </a>
            </div>
        </div>

    <?php } ?>
    </div><!-- Owl Carousel-->
    </div>
<section class="top-sale">
  <div class="container">
    <div class="owl-carousel owl-theme">
    <?php 
          foreach ($items as $key => $value) {
            $categoriaSlug = MySql::conectar()->prepare("SELECT `slug` FROM `tb_admin.categoria` WHERE id = ?");
            $categoriaSlug->execute(array($value['categoria_id']));
            $categoriaNome = $categoriaSlug->fetch()['slug'];
          $imagem = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id]");
          $imagem->execute();
          $imagem = $imagem->fetch()['imagem'];
            
        ?>
    <div class="item">
      <div class="slider-box font-rale">
      <a href="<?php echo INCLUDE_PATH; ?>produtos/<?php echo $categoriaNome; ?>/<?php echo $value['slug'];?>/<?php echo $value['id'];?>">
        <p class="time">NOVO</p>
                  <div class="img-box">
                    <img class="img-fluid" src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>uploads/<?php echo $imagem; ?>">
                  </div> 
          <div class="text-center">
                  
            <h6><?php echo ucfirst($value['nome']); ?></h6><!--Nome do produto-->
            <div class="price py-2"><span>R$ <?php echo Painel::convertMoney($value['preco']); ?></span></div><!--Preço-->
          </div><!--Text Center-->
        </a>
      </div><!--Produto-->  
    </div><!--Item-->
    <?php } ?>
    </div><!--Owl Carousel-->
  </div>
</section><!--Top Sale-->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script type="text/javascript">
    $(".owl-carousel").owlCarousel({
      loop:true,
      nav:true,
      margin:10,
      dots:false,
      responsive:{
          0:{
              items:1
          },
          600:{
              items:3
          },
          1000:{
              items:5
          }
      }
  });
  
  </script>