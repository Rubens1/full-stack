<?php include('../config.php'); 
    include('../pages/includes/header.php');

    $url = isset($_GET['url']) ? $_GET['url'] : 'cadastro';
    switch ($url) {

      case 'cadastra-loja':
        echo '<target target="cadastra-loja" />';
        break;

      case 'recuperar_senha':
        echo '<target target="recuperar_senha" />';
        break;

      case 'recuperar_senha_de_empresa':
        echo '<target target="recuperar_senha_de_empresa" />';
        break;
    }
      

    if(file_exists('pages/'.$url.'.php')){
      include('pages/'.$url.'.php');
    }else{
      //Podemos fazer o que quiser, pois a página não existe.
      if($url != 'cadastra-loja'){
        $pagina404 = true;
        include('pages/404.php');
      }else{
        include('pages/cadastro.php');
      }
    }
   include('../pages/includes/footer.php'); ?>
