<div class="titulo">
    <h2>Anúncia já</h2>
</div>
<div class="lista-categoria">
    <div class="categoria">
        <a href="">
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>cadastra-roupa">
            <div class="img-categoria">
            <i class="fas fa-tshirt"></i>
            </div>
            <div class="titulo-categoria">
                <p>Roupas</p>
            </div>
        </a>
    </div>
    <div class="categoria">
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>cadastra-acessorio">
            <div class="img-categoria">
            <i class="far fa-clock"></i>
            </div>
            <div class="titulo-categoria">
                <p>Acessórios</p>
            </div>
        </a>
    </div>
    <div class="categoria">
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>cadastra-calcado">
            <div class="img-categoria">
            <i class="fas fa-shoe-prints"></i>
            </div>
            <div class="titulo-categoria">
                <p>Calçados</p>
            </div>
        </a>
    </div>
    <div class="categoria">
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>cadastra-eletronico">
            <div class="img-categoria">
            <i class="far fa-keyboard"></i>
            </div>
            <div class="titulo-categoria">
                <p>Eletrônicos</p>
            </div>
        </a>
    </div>
    <div class="categoria">
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>cadastra-moveis">
            <div class="img-categoria">
            <i class="fas fa-couch"></i>
            </div>
            <div class="titulo-categoria">
                <p>Móveis</p>
            </div>
        </a>
    </div>
    <div class="categoria">
        <a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>cadastra-outros">
            <div class="img-categoria">
            <i class="fas fa-network-wired"></i>
            </div>
            <div class="titulo-categoria">
                <p>Outros</p>
            </div>
        </a>
    </div>
   
    </div>
    
    <?php 
	if(isset($_GET['pendentes']) == false){
 ?>
<div class="box-content">
        <div class="titulo">
            <h2>Meus produtos</h2>
        </div>
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
			Painel::alert('sucesso','Produto atualizado com sucesso');
			}
		}
		$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE quantidade = 0");
		$sql->execute();
		if($sql->rowCount() >0){
		Painel::alert('atencao', 'Você está com produtos em falta! Clique <a href="'.INCLUDE_PATH_PAINEL_LOJA.'anuncio?pendentes">aqui</a> para visualizar-los');
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
				$query2 = "AND quantidade > 0";
			}
			$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` $query $query2");
			$sql->execute();
			$produtos = $sql->fetchAll();
			
			foreach ($produtos as $key => $value) {
				$imagemSingle = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $value[id] LIMIT 1");
				$imagemSingle->execute();
				$imagemSingle = $imagemSingle->fetch()['imagem'];

				if($value['loja_id'] == $_SESSION['id_loja']){
				
		 ?>
		<div class="box-single-wraper">
		  <div class="box-single">
			
			<div class="body-box">
				<div class="box-imagem">
					<?php 
						if($imagemSingle == ''){
					?>
						<h1 class="icon-produtos"><i class="fas fa-shopping-basket"></i></h1>
					<?php
						}else{
					 ?>
				<img class="img-produto-lista" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $imagemSingle; ?>" />
				<?php } ?>
			</div>
				<p><b class=""><i></i>Nome do Produto:</b> <?php echo $value['nome']; ?></p>
                <?php if($value['promocao'] != 0){ ?>    
                <p style="color: green;"><b class=""><i class="fas fa-percentage"></i> Promoção:</b> R$ <?php echo Painel::convertMoney($value['promocao']); ?></p>
                <p style="color: red;"><b><i class="fas fa-donate"></i> Preço: </b><strike> R$ <?php echo Painel::convertMoney($value['preco']); ?></strike></p>

                <?php }else{ ?>
                    <p><b><i class="fas fa-percentage"></i> Promoçao: não</b></p>
                    <p><b><i class="fas fa-donate"></i> Preço: </b>R$ <?php echo Painel::convertMoney($value['preco']); ?></p>

                    <?php } ?>
				<div class="group-btn" style="border-bottom: 1px solid #ccc;">
					<form method="post">
						<label>Quantidade atual: </label>
						<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade']; ?>">
						<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
						<input type="submit" name="atualizar" value="Atualizar!">
					</form>
				</div>
				<div class="group-btn">
					<a item_id="<?php echo $value['id']; ?>" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_LOJA;?>anuncio?deletar=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Excluir</a>
					<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL_LOJA;?>editar-produto?id=<?php echo $value['id'] ?> "><i class="fas fa-pencil-alt"></i> Editar</a>
				</div>
			</div>
		</div>
	  </div>
	  <?php } } ?>
	  <div class="clear"></div>
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
			Painel::alert('sucesso','Você atualizou a quantidade do produto com ID : <b>'.$_POST['produto_id'].'</b> Para ver a Lista clique <a href="'.INCLUDE_PATH_PAINEL_LOJA.'anuncio">aqui</a>');
			}
		}
		echo '<br>';
		Painel::alert('atencao', 'Todos os produtos listados a baixo estão em falta no seu estoque');
		
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
		  <div class="box-single">
			
			<div class="body-box">
				<div class="box-imagem ">
					<?php 
						if($imagemSingle == ''){
					?>
						<h1 class="icon-produto"><i class="fas fa-shopping-basket"></i></h1>
					<?php
						}else{
					 ?>
				<img class="img-produto-lista"  src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $imagemSingle; ?>" />
				<?php } ?>
			</div>
			<p><b class=""><i></i>Nome do Produto:</b> <?php echo $value['nome']; ?></p>
                <?php if($value['promocao'] != 0){ ?>    
                <p style="color: green;"><b class=""><i class="fas fa-percentage"></i> Promoção:</b> R$ <?php echo Painel::convertMoney($value['promocao']); ?></p>
                <p style="color: red;"><b><i class="fas fa-donate"></i> Preço: </b><strike> R$ <?php echo Painel::convertMoney($value['preco']); ?></strike></p>

                <?php }else{ ?>
                    <p><b><i class="fas fa-percentage"></i> Promoçao: não</b></p>
                    <p><b><i class="fas fa-donate"></i> Preço: </b>R$ <?php echo Painel::convertMoney($value['preco']); ?></p>

                    <?php } ?>
				<div class="group-btn" style="border-bottom: 1px solid #ccc;">
					<form method="post">
						<label>Quantidade atual: </label>
						<input type="number" name="quantidade" min="0" max="900" step="1" value="<?php echo $value['quantidade']; ?>">
						<input type="hidden" name="produto_id" value="<?php echo $value['id']; ?>">
						<input type="submit" name="atualizar" value="Atualizar!">
					</form>
				</div>
				<div class="group-btn">
					<a item_id="<?php echo $value['id']; ?>" class="btn delete" href="<?php echo INCLUDE_PATH_PAINEL_LOJA?>anuncio?deletar=<?php echo $value['id'];?>"><i class="fa fa-times"></i> Excluir</a>
					<a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>editar-produto?id=<?php echo $value['id'] ?>"><i class="fas fa-pencil-alt"></i> Editar</a>
				</div>
			</div>
		</div>
	  </div>
	  <?php } ?>
	  <div class="clear"></div>
	</div>

</div>
<?php } ?>
</div>

