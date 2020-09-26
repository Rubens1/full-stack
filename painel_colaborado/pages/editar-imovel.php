
 <div class="box-content">
	
<?php 
	$id = (int)$_GET['id'];
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.imoveis` WHERE id = ?");
	$sql->execute(array($id));
	if($sql->rowCount() == 0){
		Painel::alert('erro','O imovel que você quer editar não existe!');
		die();
	}
	$infoImovel = $sql->fetch();
?>
<h2><i class="fas fa-pencil-alt"></i> Editar Imovel: <?php echo $infoImovel['nome']; ?></h2>
<?php
	$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $id");
	$pegaImagens->execute();
	$pegaImagens = $pegaImagens->fetchAll();

	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL_LOJA.'/uploads/'.$idImagem);
		MySql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE imagem = '$idImagem'");
		Painel::alert('sucesso','A imagem foi deletada com sucesso!');
	}else if(isset($_GET['deletarImovel'])){
		foreach ($pegaImagens as $key => $value) {
			@unlink(BASE_DIR_PAINEL_LOJA.'/uploads/'.$value['imagem']);
		}
		MySql::conectar()->exec("DELETE FROM `tb_admin.imagens_imoveis` WHERE imovel_id = $id");
		MySql::conectar()->exec("DELETE FROM `tb_admin.imoveis` WHERE id = $id");
		Painel::alertJS("O imóvel foi deletado com sucesso");
		Painel::redirect(INCLUDE_PATH_PAINEL_COLABORADO.'listar-empreendimento');
	}
 ?>
	
<div class="card-title"><i class="fas fa-edit"></i> Informações do Imovel</div>
	<form method="post" action="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>editar-imovel?id=<?php echo $id;?>" enctype="multipart/form-data">

		<div class="form-group">
					<label>Nome do Imóvel: </label>
					<input disabled="" type="text" class="form-control" name="nome" value="<?php echo $infoImovel['nome']; ?>">
				</div>
				<div class="form-group">
					<label>Preço: </label>
					<input disabled="" type="text" class="form-control" name="preco" value="R$ <?php echo $infoImovel['preco']; ?>">
				</div>
				<div class="form-group">
					<label>Área: </label>
					<input disabled="" type="text" class="form-control" name="area" value="<?php echo $infoImovel['area']; ?>">
				</div>

				<div class="form-group center">
					<a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO?>editar-imovel?id=<?php echo $id; ?>&deletarImovel"><i class="fa fa-times"></i> Excluir</a>
				</div>
			</form>
			<div class="card-title"><i class="fas fa-edit"></i> Imagens do Imóvel</div>
	<div class="boxes">
	
<?php 
foreach ($pegaImagens as $key => $value){
 ?>

	<div class="box-single-wraper">
			<div style="padding:8px 15px;">
		  <div class="box-single editar">
			<div class="box-imagem">
				<img style="width: 100%;" class="img-produto"  src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $value['imagem']; ?>" />
			</div>
			<div class="group-btn center">
				<a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO?>editar-imovel?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem']; ?>"><i class="fa fa-times"></i> Excluir</a>
			</div>
		</div>
	</div>
	  </div>
<?php } ?>
</div>

</div>
</div>