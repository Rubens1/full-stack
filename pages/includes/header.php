<?php
  $infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.descricao`");
  $infoSite->execute();
  $infoSite = $infoSite->fetch();
?>

<?php
  if(isset($_GET['consumido_loggout'])){
    Painel::consumido_loggout();
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>font/css/all.css">

    
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_REGISTRO; ?>css/main.css">
    <!--CDN do carrossel de coruja-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/global.css">
    <title>Inicio</title>
    
  </head>
  <body>
    <base base="<?php echo INCLUDE_PATH; ?>" />
  <header>
       <div class="menu-superio">
        <div class="logo">
          <a href="<?php echo INCLUDE_PATH; ?>"><img src="<?php echo INCLUDE_PATH; ?>img/lordlis.png" alt=""></a>
        </div> 
        
          <form method="post" class="form-menu" action="<?php echo INCLUDE_PATH; ?>produtos">
              <input name="busca" class="form" type="search"  placeholder="Busque o seu produto aqui...">
              <button name="busca_produto" value="Buscar!" class="btn-lup button-lup" type="Submit"><i class="fas fa-search"></i></button>
            </form>
            </div>

 <nav class="desktop bg-menu menu">
 
          <ul>
          <li>
            <a  href="<?php echo INCLUDE_PATH; ?>produtos">Produtos</a>
          </li>
          <li>
            <a  href="<?php echo INCLUDE_PATH; ?>empresas">Empresas</a>
          </li>
          <li>
            <a  href="<?php echo INCLUDE_PATH; ?>oferta">Ofertas</a>
          </li>
         
          <li>
            <a  href="<?php echo INCLUDE_PATH; ?>contato">Contato</a>
          </li>
         <!-- <li>
          <a href="<?php echo INCLUDE_PATH; ?>finalizar" class=" car"><i class="fas fa-shopping-cart"></i> Meus pedidos<sup>(<?php echo \models\produtosModel::getTotalItemsCarrinho(); ?>)</sup></a>
        </li>-->
        <li>
          <?php 
          if(Painel::consumido_logado() == ''){ ?>
          <a  href="<?php echo INCLUDE_PATH; ?>painel" ><i class="fas fa-user"></i> Entrar</a>
        <?php }else{ ?>
        <a href="<?php echo INCLUDE_PATH_PAINEL_CLIENTE; ?>meuperfil"><i class="fas fa-user"></i> <?php echo $_SESSION['nome']; ?></a>
        <a style="margin-left: 12px; " href="<?php echo INCLUDE_PATH_PAINEL_CLIENTE; ?>meuspedidos"><i class="far fa-list-alt"></i> Meus pedidos</a>
        <a style="margin-left: 12px; " href="<?php echo INCLUDE_PATH; ?>?consumido_loggout"><i class="fas fa-sign-out-alt"></i> Sair</a>
       <?php } ?>
        </li> 
            </ul>
      </nav> 
      <nav class="mobile menu-top menu"> 
        <div class="botao-menu-mobile">
          <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
      <ul>  
        <li>
          <?php if(Painel::consumido_logado() == ''){ ?>
            <a  href="<?php echo INCLUDE_PATH; ?>painel" ><i class="fas fa-user"></i> Entrar</a>
          <?php }else{ ?>
            <a href="<?php echo INCLUDE_PATH_PAINEL_CLIENTE; ?>meuperfil"><i class="fas fa-user"></i> <?php echo $_SESSION['nome']; ?></a>
            <a style="margin-left: 8px; " href="<?php echo INCLUDE_PATH_PAINEL_CLIENTE; ?>meuspedidos"><i class="far fa-list-alt"></i> Meus pedidos</a>
            <a style="margin-left: 8px; " href="<?php echo INCLUDE_PATH; ?>?consumido_loggout"><i class="fas fa-sign-out-alt"></i> Sair</a>
           <?php } ?>
          </li> 
          <!--<li>
          <a href="" class="nav-link car"><i class="fas fa-shopping-cart"></i> Meus pedidos<sup>(<?php echo \models\produtosModel::getTotalItemsCarrinho(); ?>)</sup></a>
        </li> -->                    
         
          <li>
            <a href="<?php echo INCLUDE_PATH; ?>produtos">Produtos</a>
          </li>
          <li>
            <a href="<?php echo INCLUDE_PATH; ?>empresas">Empresas</a>
          </li>
          <li>
            <a href="<?php echo INCLUDE_PATH; ?>oferta">Ofertas</a>
          </li>
          <li>
            <a href="<?php echo INCLUDE_PATH; ?>contato">Contato</a>
          </li>
          
            </ul>
      </nav> 
      <div class="clear"></div>
</header>