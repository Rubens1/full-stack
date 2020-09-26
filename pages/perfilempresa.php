<?php

	$url = explode('/',$_GET['url']);
	if(!isset($url[2]))
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
				<h3><i class="fa fa-search"></i> Busca</h3>
				<form method="post">
					<input type="text" name="parametro" placeholder="O que deseja procura?">
					<input type="submit" name="busca" value="Pesquisar">
				</form>
			</div>
			
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
				
			<?php
							$porPagina = 10;
								if(!isset($_POST['parametro'])){
								echo '<h2><i class="fa fa-check"></i> Bem Vindo ao '.ucfirst($lojas['loja']).'</h2>';
							}else{
								echo '<h2><i class="fa fa-check"></i>Notícia não encontrada</h2>';
							}

							$query = "SELECT * FROM `tb_site.noticias` ";
							
							if(isset($_POST['parametro'])){
								if(strstr($query,'WHERE') !== false){
									$busca = $_POST['parametro'];
									$query.=" AND titulo LIKE '%$busca%'";
								}else{
									$busca = $_POST['parametro'];
									$query.=" WHERE titulo LIKE '%$busca%'";
								}
							}
							$query2 = "SELECT * FROM `tb_site.noticias` "; 
							
							if(isset($_POST['parametro'])){
								if(strstr($query2,'WHERE') !== false){
									$busca = $_POST['parametro'];
									$query2.=" AND titulo LIKE '%$busca%'";
								}else{
									$busca = $_POST['parametro'];
									$query2.=" WHERE titulo LIKE '%$busca%'";
								}
							}
							$totalPaginas = MySql::conectar()->prepare($query2);
							$totalPaginas->execute();
							$totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
							if(!isset($_POST['parametro'])){
								if(isset($_GET['pagina'])){
									$pagina = (int)$_GET['pagina'];
									if($pagina > $totalPaginas){
										$pagina = 1;
									}
									
									$queryPg = ($pagina - 1) * $porPagina;
									$query.=" ORDER BY order_id ASC LIMIT $queryPg,$porPagina";
								}else{
									$pagina = 1;
									$query.=" ORDER BY order_id ASC LIMIT 0,$porPagina";
								}
							}else{

								$query.=" ORDER BY order_id ASC";
							}
							$sql = MySql::conectar()->prepare($query);
							$sql->execute();
							$noticias = $sql->fetchAll();
						?>
			</div>
			
		<?php 	

				
		foreach ($noticias as $key => $value){
			
			$sql_loja = MySql::conectar()->prepare("SELECT `slug` FROM `tb_admin.lojas` WHERE id = ?");
				$sql_loja->execute(array($value['loja_id']));
				$loja_slug = $sql_loja->fetch();

				$verifica_loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE slug = ?");
				$verifica_loja->execute(array($url[1]));
				$loja_id = $verifica_loja->fetch()['id'];
				
			if($loja_id == $value['loja_id']){
			 ?>
			 
		<div class="box-single-conteudo">
			<h2><?php echo date('d/m/Y', strtotime($value['data'])); ?> - <?php echo $value['titulo']; ?></h2>
			<p><?php echo substr(strip_tags($value['conteudo']),0,200).'...'; ?></p>
			<a href="<?php echo INCLUDE_PATH;?>perfilempresa/<?php echo $loja_slug['slug']; ?>/<?php echo $value['slug'];?>">Ler mais</a>
		</div>
		<?php } } ?>
		<div class="paginator">
			
		</div>
	</div>
		
		<div class="clear"></div>
	</div>
</section>

<?php 
}
}else{
	include('noticia_single_empresa.php');

} ?>