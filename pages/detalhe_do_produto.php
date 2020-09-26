<?php 
	$slug_categoria = explode('/', $_GET['url']);
	$verifica_categoria = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.categoria` WHERE slug = ?");
	$verifica_categoria->execute(array($url[1]));
	if($verifica_categoria->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'/');
	}
	
	$categoria_info = $verifica_categoria->fetch();
	$produto =  \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ? AND slug = ? AND categoria_id = ?");
	$produto->execute(array($url[3],$url[2],$categoria_info['id']));
	if($produto->rowCount() == 0){
		Painel::redirect(INCLUDE_PATH.'detalhe_do_produto');
	}

	$produto = $produto->fetch();
 ?>
<section class="produto-single">
		
			<h1 class="center"> <?php echo $produto['nome']; ?></h1>
		<div class="container">
				<div  class="w50 left-produto">
					<?php 
 				
				
				$imagemSingle = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $produto[id]");
				$imagemSingle->execute();
				$imagemSingle = $imagemSingle->fetch()['imagem'];

					if($imagemSingle == ''){
					?>
						<h1><i class="fas fa-shopping-basket"></i></h1>
					<?php
						}else{
					 ?>
				<div class="box-img-detalhe">
					<img id="imageBox" class="img-produto" src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>uploads/<?php echo $imagemSingle; ?>" />
				</div>
				<div class="min-img">
					<?php 

					$id = $produto['id'];
					$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
					$sql->execute(array($id));
					$infoProduto = $sql->fetch();
					$pegaImagens = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $id");
					$pegaImagens->execute();
					$pegaImagens = $pegaImagens->fetchAll();
						foreach ($pegaImagens as $key => $value){
 					?>
				<img class="img-produto" src="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>uploads/<?php echo $value['imagem']; ?>" onclick="myFunction(this)" />
				<?php } ?>
				</div>
				<?php } ?>
				</div>
				<div class="w50 right-produto box-info">
				
					<form method="POST" action="" enctype="multipart/form-data">
						<?php 
						if(isset($_POST['pedido'])){
							$quantidade = $_POST['quantidade'];
							$preco = $_POST['preco'];
							$promocao =  $_POST['promocao'];
							$tamanho = $_POST['tamanho'];
							$cor = $_POST['cor'];
							$produto_id = $_POST['produto_id'];
							$usuario_id = $_POST['usuario_id'];
							$loja_id = $_POST['loja_id'];
							$sql = \MySql::conectar()->prepare("INSERT INTO `tb_site.pedido` VALUES (null,?,?,?,?,?,?,?,?)");
							$sql->execute(array($preco,$promocao,$quantidade,$tamanho,$cor,$produto_id,$usuario_id,$loja_id));
							\Painel::alert('sucesso','pedido realizado com sucesso');

						}
						 ?>
						
						<div class="form-group">
						<h2>Faça o seu pedido</h2>
						
						<p>Quantidade disponível: <?php echo $produto['quantidade']; ?></p>
							<label>Quantidade: </label>
							
							<select name="quantidade">
								
								<?php for ($i=1; $i <=$produto['quantidade'] ; $i++) { ?>

									<option value="<?php echo $i;?>">
									 <?php echo $i;?>
									 </option>
										<?php } ?>
							
						</select>
						<?php if($produto['tamanho'] == '0' ){}else{ ?>
						<p>Tamanhos  disponível: <?php echo $produto['tamanho']; ?></p>
						<?php 
							if(isset($_POST['acao']) && $_POST['produto_id'] == $produto['id']){
								$tamanho = $_POST['tamanho'];
															
							}
							$tamanho_item = $produto['tamanho'];
							$array = explode(",", $tamanho_item);
							?>
							<select name="tamanho">
						<?php foreach($array as $valores){	?>
						
								<option value="<?php echo $valores;?>">
								 <?php echo $valores;?>
								 </option>
							<?php } ?>
							
						</select>
						<?php } ?>
						<p>Cores  disponível: <?php echo $produto['cor']; ?></p>
						<?php 
							if(isset($_POST['acao']) && $_POST['produto_id'] == $produto['id']){
								$tamanho = $_POST['cor'];
							}
							$cor_item = $produto['cor'];
							$array = explode(",", $cor_item);
							?>
							<select name="cor">
						<?php foreach($array as $valores){	?>
						
								<option value="<?php echo $valores;?>">
								 <?php echo $valores;?>
								 </option>
							<?php } ?>
							
						</select>
						<div class="valor">
							
			<?php if($produto['promocao'] != 0){ ?>
	          <p><strike>Preço: R$<?php echo Painel::convertMoney($produto['preco']); ?></strike><br> 
	          <h3>R$ <?php echo Painel::convertMoney($produto['promocao']); ?></h3></p>
	       <?php }else{ ?><br>
	        <h3>R$ <?php echo  Painel::convertMoney($produto['preco']); ?></h3>
	        <?php } ?>
						</div>
						
						</div><!--form-group-->
						<input type="hidden" name="produto_id" value="<?php echo $produto['id']; ?>">
						<input type="hidden" name="loja_id" value="<?php echo $produto['loja_id']; ?>">
						<input type="hidden" name="preco" value="<?php echo $produto['preco']; ?>">
						<input type="hidden" name="promocao" value="<?php echo $produto['promocao']; ?>">
						<input type="hidden" name="usuario_id" value="<?php echo $_SESSION['id_usuario']; ?>">
						<?php if(Painel::logadoconsumido() == false){
							?>
							<div class="container-erro-login">
						<p><i class="fa fa-times"></i> Entre na sua conta para compra</p>
						</div>
						<?php }else{ ?>
						<button type="submit" name="pedido" class="btn-add">Realizar Pedido</button>
						<?php 
						}
					  		$loja_nome = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE id = ?");
					  		$loja_nome->execute(array($produto['loja_id']));
					  		$loja = $loja_nome->fetch();
					  		
					   ?>
						<p>Loja: <a href="<?php echo INCLUDE_PATH; ?>perfilempresa/<?php echo $loja['slug'] ?>"><?php echo $loja['loja']; ?></a></p>
						</form>
					
				</div>
				<div class="clear"></div>
				</div>
			<hr>
				<div class="container ">
				<h3 class="center">Descrição</h3>
					<p><?php echo $produto['descricao'] ?></p>
			</div>


</section>

<script type="text/javascript">
	function myFunction(smallImg){
		var fullImg = document.getElementById("imageBox");
		fullImg.src = smallImg.src;

	}
</script>