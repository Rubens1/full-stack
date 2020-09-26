<?php 
	$query = "";
	if($query == ''){
		$query2 = "WHERE quantidade > 0";
	}else{
		$query2 = "AND quantidade > 0";
	}
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query $query2");
	$sql->execute();
	$produtos = $sql->fetchAll();

	$pedido = "";
	$pedidos = MySql::conectar()->prepare("SELECT * FROM `tb_site.pedido` $pedido ORDER BY id DESC");
	$pedidos->execute();
	$pedidos = $pedidos->fetchAll();

	$noticia = "";
	$noticias = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` $noticia ORDER BY id DESC");
	$noticias->execute();
	$noticias = $noticias->fetchAll();

	$comentario = "";
	$comentarios = MySql::conectar()->prepare("SELECT * FROM `tb_site.comentarios` $comentario ORDER BY id DESC");
	$comentarios->execute();
	$comentarios = $comentarios->fetchAll();
			
?>

<div class="titulo">
	<h2>Dashboard</h2>
</div>
<div class="dashboard-content">
	<div class="dashboard-flex-paret">
		
		<div class="dashboard-box box-pedido">
			<div class="dashboard-box-wrapper">
				<div class="box-icon">
				<i class="far fa-clone"></i>
				</div><!-- Box-icon -->
				<div class="value">
				<?php 
						$pedidos1 = 0;
						
						foreach ($pedidos as $key => $value) {
							if($value['loja_id'] == $_SESSION['id_loja']){
							$pedidos1++;
						?><?php } } echo $pedidos1; ?>

				</div><!-- Value -->
				<div class="type">
					Pedidos
				</div><!-- Type -->
			</div><!-- Dashboard-box-wrapper -->
		</div><!-- Dashboard-box Box-pedido -->
		<div class="dashboard-box box-produto">
			<div class="dashboard-box-wrapper">
				<div class="box-icon">
						<i class="fas fa-dolly"></i>
					</div><!-- Box-icon -->
					<div class="value">
					<?php 
							$count = 0;
							
							foreach ($produtos as $key => $value) {
								if($value['loja_id'] == $_SESSION['id_loja']){
								$count++;
							?><?php } } echo $count; ?>
					</div><!-- Value -->
					<div class="type">
						Produtos
				</div><!-- Type -->
			</div><!-- Dashboard-box-wrapper -->
		</div><!-- Dashboard-box Box-pedido -->
		<div class="dashboard-box box-noticia">
			<div class="dashboard-box-wrapper">
				<div class="box-icon ">
					<i class="far fa-newspaper"></i>
					</div><!-- Box-icon -->
					<div class="value">
					<?php 
							$noticiatotal = 0;
							
							foreach ($noticias as $key => $value) {
								if($value['loja_id'] == $_SESSION['id_loja']){
								$noticiatotal++;
								$id_noticia = $value['id'];
								$loja_id = $value['loja_id'];
							?><?php } } echo $noticiatotal; ?>
					</div><!-- Value -->
					<div class="type">
						Notícias
					</div><!-- Type -->
				</div><!-- Dashboard-box-wrapper -->
		</div><!-- Dashboard-box Box-pedido -->
		<div class="dashboard-box box-comentario">
			<div class="dashboard-box-wrapper">
				<div class="box-icon">
				<i class="far fa-comment"></i>
					</div><!-- Box-icon -->
					<div class="value">
					<?php 
							$comentariototal = 0;
							
							foreach ($comentarios as $key => $value) {
								if($value['loja_id'] ==  $_SESSION['id_loja']){
								$comentariototal++;
							?><?php } } echo $comentariototal; ?>
					</div><!-- Value -->
					<div class="type">
						Comentarios
					</div><!-- Type -->
				</div><!-- Dashboard-box-wrapper -->
		</div><!-- Dashboard-box Box-pedido -->
	</div><!-- Dashboard-flex-paret -->
</div><!-- Dashboard-content -->


<div class="container">
<div class="row">




<div class="box-content">
	<h2><i class="fas fa-dolly"></i> Meus Produtos</h2>
	<div class="table-responsive">
		<div class="rows-table">
			<div class="col">
				<span>Nome</span>
		</div>
			<div class="col">
				<span>quantidade</span>
		</div>

		</div>
		 <?php 
		 	foreach ($produtos as $key => $value) {
				$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
				$imagemSingle->execute();
				$imagemSingle = $imagemSingle->fetch()['imagem'];

				if($value['loja_id'] == $_SESSION['id_loja']){
		  ?>
		 <hr>
		<div class="col"> <?php echo $value['nome']; ?></div>
		 <div class="col"> <?php echo $value['quantidade']; ?></div>
		 <hr sttyle="black">
		
		<?php } } ?>
	</div>
	<div class="clear"></div>
</div>
</div>
</div>


