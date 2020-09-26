<?php

	if(isset($_GET['loggout'])){
		Painel::loggout();
  }
  
  $loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE id = ?");
  $loja->execute(array($_SESSION['id_loja']));
  $info_loja = $loja->fetch();
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>font/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>css/global.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>css/modal.css">
    <script src='https://cdn.tiny.cloud/1/a68nyu6d5gv2harvpjossbby7xiesupnxzt8rdc68sm0ryer/tinymce/5/tinymce.min.js' referrerpolicy="origin">
  </script>
  <script>
    tinymce.init({
      selector: '#mytextarea'
    });
  </script>

     <!-- Bootstrap core CSS -->

  <!-- Custom styles for this template -->

    <title>Inicio</title>

  </head>
  <body>


<div class="flex-dashboard">
  <sidebar id="sidebar">
    <div class="sidebar-title">
      
      <h2><a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>"><?php echo $info_loja['loja']; ?></a></h2>
    </div>
    <div class="menu">
      <div class="logo">
      <?php if($info_loja['logo'] == ''){
        ?>
        <h2><i class="fas fa-store-alt"></i></h2>
        <div class="texto">
        <p>Clica em "Perfil da empresa" para adicionar a logo da empresa abaixo <i class="fas fa-angle-down"></i></p>
        </div>
        <?php
      }else{ ?>
       <img src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>/logo/<?php echo $info_loja['logo']; ?>" alt="">  
      <?php } ?>
        
      </div>
      <ul>
        <li>
          <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>editar-loja"> 
          <i class="fas fa-user-tie"></i> Perfil da Empresa  </a>
        </li>
        <li>
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>pedidos">
          <i class="far fa-handshake"></i> Vendas
        </a>
        </li>
        <li>
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>anuncio">
          <i class="fas fa-tags"></i> Produtos
        </a>
        </li>
        <li>
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>gerenciar-noticias">
          <i class="far fa-comments"></i> Publicações 
        </a>
        </li>
        <li class="sadebar_logout">
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>?loggout"><i class="fas fa-sign-out-alt"></i> Sair</a>
        </li>
      </ul>
    </div>
  </sidebar>
  
  <main id="mainContent">
    <header>
        <i id="iconMenu" onclick="responsiveSidebar()" class="fas fa-bars"></i>
      <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>?loggout"><i class="fas fa-sign-out-alt"></i> Sair</a>
    </header>
     
    <div class="main-content">
    
    <?php 
      Painel::carregarPaginaLoja();
    ?>

    </div>
  </main>
 
  </div>


   <!-- JavaScript -->
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>js/jquery.maskMoney.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>js/jquery-img.js"></script>
  <script src="<?php echo INCLUDE_PATH ?>js/constants.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>js/jquery.ajaxform.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>js/helperMask.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>js/modal.js"></script>
  <script src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>js/menu.js"></script>
  <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <script>tinymce.init({selector:'.tinymce', plugins: "image", height: 400});</script>
  
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });

    $(function(){
      $('#upload').change(function(){
        const file = $(this)[0].files[0]
        const fileReader = new FileReader()
        fileReader.onloadend = function(){
          $('#img').attr('src', fileReader.result)
        }
        fileReader.readAsDataURL(file)
      });
    });
    
  </script>
 
</body>
</body>
</html>
