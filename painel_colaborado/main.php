<?php
	if(isset($_GET['colaborado_loggout'])){
		Painel::colaborado_loggout();
	}
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>node_modules/bootstrap/compiler/bootstrap.css">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH; ?>font/css/all.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO; ?>css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO; ?>css/main.css">
     <!-- Bootstrap core CSS -->

  <!-- Custom styles for this template -->
  <link href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO; ?>css/simple-sidebar.css" rel="stylesheet">

    <title>Inicio</title>
  <style type="text/css">
 .menu-top a{
  padding: 9px ;
  float: right;
  margin: 0 1px;
  color: #fff;
}
 .menu-top  a:hover{
  text-decoration: underline;
  color: #fff;
  text-decoration:none;
}

    </style>
  </head>
  <body>
    
<nav class="nav-menu navbar-dark bg-success">
<button class="btn bg-success" type="button" id="menu-toggle"><span class="navbar-toggler-icon"></span></button>
  <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>" class="logo-empresa">LibraImperio</a>
	<div class="collapse-menu " id="navbarSite">
	<ul>
	    <li class="nav-item">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         <?php echo pegaCargo($_SESSION['cargo']); ?>
        </a>
        <ul>
          <li>
          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>editar-usuario">Configuração</a>
          <a class="dropdown-item" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>?colaborado_loggout">Sair</a>
          </li>
        </ul>
    </li>
	</ul>
</div>
</nav>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-success border-right" id="sidebar-wrapper">
     <div class="menu">
      <div class="box-usuario">
      	<?php 
      		if($_SESSION['img'] == ''){ 
      	?>
      	<div class="avatar-usuario">
      		<i class="fas fa-user"></i>
      	</div> 
      <?php }else{ ?>
      	<div class="imagem-usuario">
      		<img src="<?php echo INCLUDE_PATH_PAINEL_COLABORADO?>uploads/<?php echo $_SESSION['img']?>">
      	</div> 
      <?php } ?>
      	<div class="nome-usuario">
<p><?php echo $_SESSION['nome']; ?></p>
	  </div>
	</div>
	</div>
      <div class="list-group list-group-flush">
      	<ul class="navbar-nav menu-top ">
         <h4 style="background: #777; color: #fff;">&ensp; Cadastro</h4>
      	<li class="nav-item">
        <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>site_descricao" class="list-group-item list-group-item-action bg-success">Site</a>
    	   </li>
        <li class="nav-item">
        <a <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>adicionar-colaborado" class="list-group-item list-group-item-action bg-success">Cadastrar Colaborado</a>
        </li>
        <li class="nav-item">
        <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>cadastrar-clientes" class="list-group-item list-group-item-action bg-success">Cadastrar Clientes</a>
       </li>
        <li class="nav-item">
        <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>cadastrar-categoria" class="list-group-item list-group-item-action bg-success">Cadastrar Categoria</a>
       </li>
        <li class="nav-item">
        <a href="#" class="list-group-item list-group-item-action bg-success">Financeiro</a>
        </li>
        <li class="nav-item">
        <a href="#" class="list-group-item list-group-item-action bg-success">Fornecedor</a>
        </li>
        <li class="nav-item">
        <a href="#" class="list-group-item list-group-item-action bg-success">Lojas</a>
        </li>
        <li class="nav-item">
        <a href="#" class="list-group-item list-group-item-action bg-success">Consumidor</a>
        </li>
        <h4 style="background: #777; color: #fff;">&ensp; Gerenciar</h4>
        <li class="nav-item">
        <a href="#" class="list-group-item list-group-item-action bg-success">Categoria</a>
       </li>
       <li class="nav-item">
        <a href="#" class="list-group-item list-group-item-action bg-success">Produtos</a>
       </li>
       <li class="nav-item">
        <a href="#" class="list-group-item list-group-item-action bg-success">E-mail</a>
       </li>
       <h4 style="background: #777; color: #fff;">&ensp; Estoque</h4>
       <li class="nav-item">
        <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>cadastrar-produtos" class="list-group-item list-group-item-action bg-success">Cadastrar Produtos</a>
       </li>
       <li class="nav-item">
        <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>listar-produtos" class="list-group-item list-group-item-action bg-success">Listar de Produtos</a>
       </li>
       <h4 style="background: #777; color: #fff;">&ensp; Imoveis</h4>
       <li class="nav-item">
        <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>cadastrar-empreendimento" class="list-group-item list-group-item-action bg-success">Cadastrar Empreendimento</a>
       </li>
       <li class="nav-item">
        <a href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>listar-empreendimento" class="list-group-item list-group-item-action bg-success">Listar de Empreendimento</a>
       </li>

</ul>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

   <?php 
   		Painel::carregarPaginaColaborado();
   
    ?>

</div>
<!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <?php Painel::loadJS(array('jquery-ui.min.js'),'listar-empreendimento'); ?>
   <!-- Bootstrap core JavaScript -->
<script src="https://cdn.jsdelivr.net/gh/stefangabos/Zebra_Datepicker/dist/zebra_datepicker.min.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>js/jquery.maskMoney.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>js/jquery.ajaxform.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    
  </script>
   <script src="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>js/helperMask.js"></script>
</body>
</html>
