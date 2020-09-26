<?php 
$url = explode('/',$_GET['url']); if(!isset($url[2])){
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
			<div class="header-conteudo-portal">
				
			
			</div>
	
			 
		<div class="box-single-conteudo">
			<h2>Sobre a Empresa</h2>
			<p>CEP: <?php echo $lojas['cep']; ?></p>
			<p>Estado: <?php echo $lojas['estado']; ?></p>
			<p>Cidade: <?php echo $lojas['cidade']; ?></p>
			<p>Complemento: <?php echo $lojas['complemento']; ?></p>
			<p>Número: <?php echo $lojas['numero']; ?></p>

			
		</div>

	</div>
		
		<div class="clear"></div>
	</div>
</section>
<?php } } ?>
