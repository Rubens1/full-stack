<?php 
	if(isset($_GET['pendentes']) == false){
 ?>
<div class="box-content">
	<h2>Lista de Produto</h2>
		<div class="busca">
		<h4>Realizar busca</h4>
		<form method="post">
			<input type="text" class="form-control" name="busca" placeholder="Procure pelo nome do produto">
			<input type="submit" name="acao" value="Buscar!">
		</form>
	</div>
	<?php 

		if(isset($_GET['deletar'])){
			$id = (int)$_GET['deletar'];
			$imagens = MySql::conectar()->prepare ("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
			$imagens->execute();
			$imagens = $imagens->fetchAll();
			foreach ($imagens as $key => $value) {
				@unlink(BASE_DIR_PAINEL_LOJA.'/uploads/'.$value['imagem']);
			}
			MySql::conectar()->exec("DELETE FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
			MySql::conectar()->exec("DELETE FROM `tb_admin.estoque` WHERE id = $id");
			Painel::alert('sucesso','O produto foi deletado do estoque com sucesso');
		}

		if(isset($_POST['atualizar'])){
			$quantidade = $_POST['quantidade'];
			$produto_id = $_POST['produto_id'];
			if($quantidade < 0){
				Painel::alert('erro','Você não pode cadastra quantidade para igual ou menor a 0!');
			}else{
				MySql::conectar()->exec("UPDATE `tb_admin.estoque` SET quantidade = $quantidade WHERE id = $produto_id");
			Painel::alert('sucesso','Você atualizou a quantidade de um dos produtos ');
			}
		}
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
		$sql->execute();
		if($sql->rowCount() >0){
		Painel::alert('atencao', 'Você está com produtos em falta! Clique <a href="'.INCLUDE_PATH_PAINEL_COLABORADO.'listar-produtos?pendentes">aqui</a> para visualizar-los');
		}
	 ?>
	<div class="boxes">
		<?php 
			$query = "";
			if(isset($_POST['acao']) && $_POST['acao'] == 'Buscar!'){
				$nome = $_POST['busca'];
				$query = "WHERE (nome LIKE '%$nome%' OR descricao LIKE '%$nome%')";

			}
			if($query == ''){
				$query2 = "WHERE quantidade > 0";
			}else{
				$query2 = "AND quantidade >0";
			}
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query $query2");
			$sql->execute();
			$produtos = $sql->fetchAll();
			if($query != ''){
					echo '<div style="width:100%" ><p>Foram encontrado(s):<b>'.count($produtos).'</b></p></div>';
				}
			foreach ($produtos as $key => $value) {
				$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
				$imagemSingle->execute();
				$imagemSingle = $imagemSingle->fetch()['imagem'];

				
		 ?>
	
		<div class="box-single-wraper">
			<div style="padding:8px 15px;height: 100%;">
				<div style="width: 100%;float: left;" class="box-imagem">
					<?php 
						if($imagemSingle == ''){
					?>
						<h1><i class="fas fa-shopping-basket"></i></h1>
					<?php
						}else{
					 ?>
				<img class="img-produto" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $imagemSingle; ?>" />
				<?php } ?>
			</div>
			<div class="box-single">
			<div class="body-box">
				<p><b class=""><i></i>Nome do Produto:</b> <?php echo $value['nome']; ?></p>
				<p><b class=""><i></i>Descrição:</b> <?php echo $value['descricao']; ?></p>
				<p><b class=""><i></i>Largura:</b> <?php echo $value['largura']; ?> cm</p>
				<p><b class=""><i></i>Altura:</b> <?php echo $value['altura']; ?> cm</p>
				<p><b class=""><i></i>comprimeto:</b> <?php echo $value['comprimento']; ?> cm</p>
				<p><b class=""><i></i>Peso:</b> <?php echo $value['peso']; ?> kg</p>
				<p><b class=""><i></i>Preço:</b>R$ <?php echo Painel::convertMoney($value['preco']); ?></p>
				<div class="group-btn" style="border-bottom: 1px solid #ccc;">
					<form method="post">
						<label>Quantidade atual: </label>
						<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade']; ?>">
						<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
						<input type="submit" name="atualizar" value="Atualizar!">
					</form>
				</div>
				<div class="group-btn">
					<a item_id="<?php echo $value['id']; ?>" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO?>listar-produtos?deletar=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Excluir</a>
					<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>editar-produto?id=<?php echo $value['id'] ?> "><i class="fas fa-pencil-alt"></i> Editar</a>
				</div>
			</div>
		</div>
			<div class="clear"></div>
	  </div>
	</div>
	  <?php } ?>
	  
	</div>
</div>

<?php }else{ ?>

<div class="box-content">
	<h2>Produto em falta!</h2>
	<?php 
		if(isset($_POST['atualizar'])){
			$quantidade = $_POST['quantidade'];
			$produto_id = $_POST['produto_id'];
			if($quantidade < 0){
				Painel::alert('erro','Você não pode cadastra quantidade para igual ou menor a 0!');
			}else{
				MySql::conectar()->exec("UPDATE `tb_admin.estoque` SET quantidade = $quantidade WHERE id = $produto_id");
			Painel::alert('sucesso','Você atualizou a quantidade do produto com ID : <b>'.$_POST['produto_id'].'</b> Para ver a Lista clique <a href="'.INCLUDE_PATH_PAINEL_COLABORADO.'listar-produtos">aqui</a>');
			}
		}
		Painel::alert('atencao', 'Todos os produtos listados a baixo estão em falta no seu estoque')
		
	 ?>
	<div class="boxes">
		<?php 
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
			$sql->execute();
			$produtos = $sql->fetchAll();
			foreach ($produtos as $key => $value) {
				$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
				$imagemSingle->execute();
				$imagemSingle = $imagemSingle->fetch()['imagem'];

				
		 ?>
		<div class="box-single-wraper">
			<div style="padding:8px 15px;height: 100%;">
				<div style="width: 100%;float: left;" class="box-imagem">
					<?php 
						if($imagemSingle == ''){
					?>
						<h1><i class="fas fa-shopping-basket"></i></h1>
					<?php
						}else{
					 ?>
				<img class="img-produto" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $imagemSingle; ?>" />
				<?php } ?>
			</div>
			<div class="box-single">
			<div class="body-box">
				<p><b class=""><i></i>Nome do Produto:</b> <?php echo $value['nome']; ?></p>
				<p><b class=""><i></i>Descrição:</b> <?php echo $value['descricao']; ?></p>
				<p><b class=""><i></i>Largura:</b> <?php echo $value['largura']; ?> cm</p>
				<p><b class=""><i></i>Altura:</b> <?php echo $value['altura']; ?> cm</p>
				<p><b class=""><i></i>comprimeto:</b> <?php echo $value['comprimento']; ?> cm</p>
				<p><b class=""><i></i>Peso:</b> <?php echo $value['peso']; ?> kg</p>
				<div class="group-btn" style="border-bottom: 1px solid #ccc;">
					<form method="post">
						<label>Quantidade atual: </label>
						<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade']; ?>">
						<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
						<input type="submit" name="atualizar" value="Atualizar!">
					</form>
				</div>
				<div class="group-btn">
					<a item_id="<?php echo $value['id']; ?>" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO?>listar-produtos?deletar=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Excluir</a>
					<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL_COLABORADO ?>editar-produto?id=<?php echo $value['id'] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
				</div>
			</div>
		</div>
			<div class="clear"></div>
		</div>
	  </div>
	  <?php } ?>
	  
	</div>

</div>
<?php } ?>