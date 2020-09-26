<?php $url = explode('/',$_GET['url']); if(!isset($url[2]))
	{

  		
   ?>
<section class="header-empresa">
<div class="center">
	  <?php $loja_slug = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE slug = ?");
  		$loja_slug->execute(array($url[1]));
  		$loja = $loja_slug->fetchAll();

  		foreach ($loja as $key => $lojas){ ?>
  <h2><?php 
            if($lojas['logo'] == ''){
          ?>
            <i class="fas fa-store-alt"></i>
          <?php
            }else{
           ?>
        <img class="img-loja" width="140" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>logo/<?php echo $lojas['logo']; ?>" />
        <?php } ?></h2>
 
  <h2><?php echo $lojas['loja']; ?></h2>
</div>
</section>

<section class="container-empresa">
		<div class="sidebar">			
			<div class="box-content-sidebar">
				<h3><i class="far fa-caret-square-down"></i> Menu</h3>
				<a href="<?php echo INCLUDE_PATH; ?>sobreaempresa/<?php echo $lojas['slug'] ?>">Sobre a empresa</a>
				<a href="<?php echo INCLUDE_PATH; ?>produtosempresa/<?php echo $lojas['slug'] ?>">Produtos</a>
				<a href="<?php echo INCLUDE_PATH; ?>perfilempresa/<?php echo $lojas['slug'] ?>">Notícias</a>
				<div class="clear"></div>

			</div>
		</div>
		<div class="conteudo-empresa">
			<div class="header-conteudo-empresa">
				<h3>Produtos da empresa</h3>
			</div>
		</div>
<div class="lista-items-empresa">
  <div class="container">


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
      $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query ORDER BY id ASC");
      $sql->execute();
      $items = $sql->fetchAll();
      if($query != ''){
          echo '<div style="width:100%" ><p>Foram encontrado(s):<b>'.count($items).'</b></p></div>';
        }
      foreach ($items as $key => $value) {
      	if($lojas['id'] == $value['loja_id']){
      $sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_admin.categoria` WHERE id = ?");
      $sql->execute(array($value['categoria_id']));
      $categoriaNome = $sql->fetch()['slug'];
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
  <?php } } ?>

  <div class="clear"></div>
  </div><!--Container-->
</div><!--Lista de items-->
		
		<div class="clear"></div>
	</div>
<?php } } ?></section>

