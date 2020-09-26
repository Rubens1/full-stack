 <?php 
$parametros = \views\mainView::$par;
 ?>

<section class="lista-imoveis">
	<div class="container">
		<h2 class="titulo-busca">Nome do empreedimento de <?php echo $parametros['nome_empreendimento']; ?></h2>
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