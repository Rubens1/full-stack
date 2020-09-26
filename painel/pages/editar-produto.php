
 <?php
	if(isset($_GET['deletarImagem'])){
		$idImagem = $_GET['deletarImagem'];
		@unlink(BASE_DIR_PAINEL_LOJA.'/uploads/'.$idImagem);
		MySql::conectar()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE imagem = '$idImagem'");
	}
 ?>
 <div class="box-content">

	
<?php 
	$id = (int)$_GET['id'];
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
	$sql->execute(array($id));
	if($sql->rowCount() == 0){
		Painel::alert('erro','O produto que você quer editar não existe!');
		die();
	}
	$infoProduto = $sql->fetch();
?>
<h2><i class="fas fa-pencil-alt"></i> Editar Produto: <?php echo $infoProduto['nome']; ?></h2>
<?php
	$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
	$pegaImagens->execute();
	$pegaImagens = $pegaImagens->fetchAll();

	if(isset($_GET['deletarImagem'])){
		Painel::alert('sucesso','A imagem foi deletada com sucesso!');
	}
 ?>
	
<div class="card-title"><i class="fas fa-edit"></i> Informações do produto</div>
	<form method="post" enctype="multipart/form-data">
		<?php 
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$descricao = $_POST['descricao'];
				$promocao = \Painel::formatarMoedaBd($_POST['promocao']);
				$quantidade = $_POST['quantidade'];
				$slug =  Painel::generateSlug($_POST['nome']);

				$imagens = [];

				$sucesso = true;
				
				$amountFiles = count($_FILES['imagem']['name']);
				
				if($_FILES['imagem']['name'][0] != ''){
					
						for($i = 0; $i < $amountFiles; $i++){

						$imagemAtual = ['type'=>$_FILES['imagem']['type'][$i], 'size'=>$_FILES['imagem']['size'][$i]];
						if(Painel::imagemValida($imagemAtual) == false){
							$sucesso = false;
							Painel::alert('erro','Uma das imagem selecionadas são invalidas!');
							break;
							}
						}
					}
				
				if($sucesso){
					if($_FILES['imagem']['name'][0] != ''){
						if($amountFiles <= 5){
							for($i = 0; $i < $amountFiles; $i++){
								
								$imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i], 'name'=>$_FILES['imagem']['name'][$i]];
							$imagens[] = Painel::uploadFile($imagemAtual);
							}
							foreach($imagens as $key => $value){
							MySql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$id,'$value')");
								}
						}else{
						Painel::alert('atencao','Atenção adicione 6 fotos para cada produto');
					}
					}

					$sql = MySql::conectar()->prepare("UPDATE `tb_admin.estoque` SET nome = ?,descricao = ?, promocao = ?, quantidade = ?, slug = ? WHERE id = $id");
					$sql->execute(array($nome,$descricao,$promocao,$quantidade,$slug));

					Painel::alert('secesso','Voê atualizou seu produto com sucesso!');
					$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
					$sql->execute(array($id));

					$infoProduto = $sql->fetch();
					$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
					$pegaImagens->execute();
					$pegaImagens = $pegaImagens->fetchAll();
				}

			}
		 ?>

		<div class="form-group col-sm-12">
					<label>Nome do produto: </label>
					<input type="text" class="form-control" name="nome" value="<?php echo $infoProduto['nome']; ?>">
				</div>
				<div class="form-group col-sm-12">
					<label>Descrição do produto: </label>
					<textarea class="form-control" name="descricao"><?php echo $infoProduto['descricao']; ?></textarea>
				</div>
				
				<div class="form-group col-sm-12">
					<label>Quantidade atual do produto: </label>
					<input type="text" class="form-control" name="quantidade" value="<?php echo $infoProduto['quantidade']; ?>">
				</div>
				
				<div class="form-group col-sm-12">
					<label>Promocao atual do produto: </label>
					<input type="text" class="form-control" name="promocao" value="<?php echo Painel::convertMoney($infoProduto['promocao']); ?>">
				</div>
				<div class="form-group col-sm-12">
					<label>Selecione uma Imagem: </label>
					<input multiple type="file" class="form-control" name="imagem[]">
				</div>
				

				<div class="form-group col-sm-12 center">
					
					<input class="btn btn-info " type="submit" name="acao" value="Atualizar Produto">
				</div>
			</form>
			<div class="card-title"><i class="fas fa-edit"></i> Imagens do produto</div>
	<div class="boxes">
	
<?php 
foreach ($pegaImagens as $key => $value){
 ?>
	<div class="box-single-wraper">
		  <div class="box-single editar">
			<div class="box-imagem">
				<img class="img-produto"  src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $value['imagem']; ?>" />
			</div>
			<div class="group-btn center">
				<a class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>editar-produto?id=<?php echo $id; ?>&deletarImagem=<?php echo $value['imagem']; ?>"><i class="fa fa-times"></i> Excluir</a>
			</div>
		</div>
	  </div>
<?php } ?>
<div class="clear"></div>
</div>

</div>
</div>