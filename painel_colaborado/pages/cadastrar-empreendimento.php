<div class="box-content">
	<h2><i class="fas fa-align-justify"></i> Cadastrar Empreendimento</h2>
<hr>
	<form method="post" enctype="multipart/form-data">

		<?php 
			if(isset($_POST['acao'])){

				$nome = $_POST['nome'];
				$tipo = $_POST['tipo'];
				$preco = $_POST['preco'];
				$imagem = $_FILES['imagem'];
				if($_FILES['imagem']['name'] == ''){
					Painel::alert('erro', 'Você precisa selecionar uma imagem');
				}else{
					if(Painel::imagemValida($imagem) == false){
						Painel::alert('erro', 'Imagem inválida');
					}else{
						$idImagem = Painel::uploadFile($imagem);
						$slug = Painel::generateSlug($nome);
						$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.empreendimento` VALUES (null,?,?,?,?,?,?)");
						$sql->execute(array($nome,$tipo,$preco,$idImagem,$slug,0));
						$lastId = MySql::conectar()->lastInsertId();
						MySql::conectar()->exec("UPDATE `tb_admin.empreendimento` SET order_id = $lastId WHERE id = $lastId");
					Painel::alert('sucesso', 'Cadastro do empreendimento foi feito com sucesso!');
					}
				}
			}
		 ?>

		<div class="form-group">
			<label>Nome:</label>
			<input class="form-control" type="text" name="nome">
		</div>
		<div class="form-group">
			<label>Nome:</label>
			<select class="form-control" name="tipo">
				<option value="residencial">Residencial</option>
				<option value="comercial">Comercial</option>
			</select>
		</div>
		<div class="form-group">
			<label>Preço:</label>
			<input class="form-control" type="text" name="preco">
		</div>
		<div class="form-group">
			<label>Imagem:</label>
			<input class="form-control" type="file" name="imagem">
		</div>
		<div class="form-group">
			<input type="submit" name="acao" value="Cadastrar">
		</div>
	</form>

</div>