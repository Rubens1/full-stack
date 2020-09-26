<?php include('../config.php'); 
    include('../pages/includes/header.php');

    $url = isset($_GET['url']) ? $_GET['url'] : 'sobre_plataforma';
    switch ($url) {

      case 'politica':
        echo '<target target="politica" />';
        break;

      case 'termos':
        echo '<target target="termos" />';
        break;

      case 'suporte':
        echo '<target target="suporte" />';
        break;
    }
      

    if(file_exists('pages/'.$url.'.php')){
      include('pages/'.$url.'.php');
    }else{
      //Podemos fazer o que quiser, pois a página não existe.
      if($url != 'sobre_plataforma'){
        $pagina404 = true;
        include('pages/404.php');
      }else{
        include('pages/sobre_plataforma.php');
      }
    }
   include('../pages/includes/footer.php'); ?>
