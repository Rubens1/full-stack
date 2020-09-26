<?php 
if(isset($_GET['deletar'])){
			$id = (int)$_GET['deletar'];
			MySql::conectar()->exec("DELETE FROM `tb_link.pedido` WHERE id = $id");
			MySql::conectar()->exec("DELETE FROM `tb_site.pedido` WHERE id = $id");
		}

	$pedido = "";
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.pedido` $pedido ORDER BY id DESC");
	$sql->execute();
	$pedidos = $sql->fetchAll();

	
					
?>
<div class="tabela-pedidos">
	 <table>
		<?php 
			if(isset($_GET['deletar'])){
			Painel::alert('sucesso','O produto foi deletado da lista de pedidos com sucesso');
		} ?>
		<br>	
			<tr>
				<td class="titulo">Loja</td>
				<td class="titulo">Produto</td>
				<td class="titulo">Quantidade</td>
				<!--<td class="titulo">Tamanho</td>
				<td class="titulo">Cor</td>-->
				<td class="titulo">Valor total</td>
				<td class="titulo">Cancelar pedido</td>
				<td class="titulo" colspan="2">link</td>
			</tr>
			<?php $contapedido = count($pedidos);
			if($contapedido == 0){
			 ?>
			
			<tr><td class="center" colspan="8">Voçê não tem nem uma compra realizada</td></tr>
			<?php
			}
			 foreach ($pedidos as $key => $value) {
					if($value['usuario_id'] == $_SESSION['id_usuario']){
						$loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE id = ? ");
						$loja->execute(array($value['usuario_id']));
						$loja = $loja->fetch()['loja'];
						$estoque = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
						$estoque->execute(array($value['produto_id']));
						$estoque = $estoque->fetch();
						$imagemSingle = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque_imagens` WHERE produto_id = $estoque[id]");
						$imagemSingle->execute();
						$imagemSingle = $imagemSingle->fetch()['imagem'];
						if($value['promocao'] != 0){
							$valor = $value['quantidade'] * $value['promocao'];
						}else{
						$valor = $value['quantidade'] * $value['preco'];
						}
				 ?>
				<tr>
					
					<td>
					<?php 
					
					$loja = MySql::conectar()->prepare("SELECT * FROM `tb_admin.lojas` WHERE id = ?");
					  $loja->execute(array($value['loja_id']));
					  $lojas = $loja->fetchAll();
					  foreach ($lojas as $key => $value2) {
					 ?>
					<a href="<?php echo INCLUDE_PATH; ?>perfilempresa/<?php echo $value2['slug'] ?>"> <?php echo ucfirst($value2['loja']); ?></a><?php } ?>
					</td>
				
					<td><img width="70" src="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>/uploads/<?php echo $imagemSingle; ?>" alt="img"> <?php echo $estoque['nome'];  ?></td>
					<td class="center"><?php echo $value['quantidade']; ?></td>
					<!--<td><?php echo $value['tamanho']; ?></td>
					<td><?php echo $value['cor']; ?></td>-->
					<td>R$ <?php echo Painel::convertMoney($valor); ?></td>
					<td><a item_id="<?php echo $value['id']; ?>" href="<?php echo INCLUDE_PATH_PAINEL_CLIENTE;?>meuspedidos?deletar=<?php echo $value['id'];?>">Cancelar</a></td>
						<?php 
					$link = MySql::conectar()->prepare("SELECT * FROM `tb_link.pedido` WHERE pedido_id = ?");
					  $link->execute(array($value['id']));
					  $link = $link->fetchAll();
					  
					  foreach ($link as $key => $links) { ?>
					<td><a href="<?php echo $links['link'] ?>" target="_blank">Abrir link de pagamento</a></td>					
			<?php  }  ?>
			
				</tr>

			<?php $pedido_count = count($value);}  }
			if(@$pedido_count == 0){ ?>
			<tr><td class="center" colspan="8">Voçê não tem nem uma compra <a href="<?php echo INCLUDE_PATH; ?>produtos"> CLIQUE AQUI</a> para compra</td></tr>
			<?php }	?>
			<div class="clear"></div>
		</table>
</div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <script src="<?php echo INCLUDE_PATH ; ?>js/bootstrap.min.js"></script>