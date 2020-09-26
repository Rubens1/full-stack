 <?php 
$parametros = \views\mainView::$par;
 ?>
<section class="search1">
	<div class="container">
		<h2>O que você procura?</h2>
		<input type="text" name="texto-busca">
	</div>
</section>

<section class="search2">
	<div class="container">
		<form method="post" action="<?php echo INCLUDE_PATH ?>ajax/formularios.php">
			<div class="form-group1">
				<label>Área minima: </label>
				<input type="number" name="area-minima" min="0" max="1000000" step="100">
			</div><!--form-group-->
			<div class="form-group1">
				<label>Área máxima: </label>
				<input type="number" name="area-maxima" min="0" max="1000000" step="100">
			</div><!--form-group-->
			<div class="form-group1">
				<label>Preço minimo: </label>
				<input type="text" name="preco_min">
			</div><!--form-group-->
			<div class="form-group1 max">
				<label>Preço máxima: </label>
				<input type="text" name="preco_max">
			</div><!--form-group-->
			<div class="clear"></div>
		</form>
	</div>
</section>

		<ul>
		<?php 
		$selectEmpreend = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.empreendimento` ORDER BY order_id ASC");
		$selectEmpreend->execute();
		$empreendimentos = $selectEmpreend->fetchAll(); 
		foreach ($empreendimentos as $key => $value) {
			
		?>
			<li><a href="<?php echo INCLUDE_PATH.$value['slug']; ?>"><?php echo $value['nome'] ?></a></li>
		<?php } ?>
		</ul>

<section class="lista-imoveis">
	<div class="container">
		<?php 
			foreach($parametros['imoveis'] as $key=>$value) {
				$imagem = \MySql::conectar()->prepare("SELECT imagem FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $value[id]");
				$imagem->execute();
				$imagem = $imagem->fetch()['imagem'];
		 ?>
		<div class="row-imovel">
			<div class="r1">
				<img src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $imagem; ?>">
			</div>
			<div class="r2">
				<p><i class="fa fa-info"></i> Nome do imovel: <?php echo $value['nome']; ?></p>
				<p><i class="fa fa-info"></i> Área: <?php echo $value['area']; ?></p>
				<p><i class="fa fa-info"></i> Preço: <?php echo \Painel::convertMoney($value['preco']); ?></p>
			</div>
		</div>
	<?php } ?>
	</div>
</section>