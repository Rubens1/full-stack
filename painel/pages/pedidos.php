<?php 
	$pedido = "";
	$sql = MySql::conectar()->prepare("SELECT * FROM `tb_site.pedido` $pedido ORDER BY id DESC");
	$sql->execute();
	$pedidos = $sql->fetchAll();


		
?>
<div class="box-content">
			<div class="wraper-table">
				<?php if(isset($_POST['acao'])){ echo \Painel::alert('sucesso','Link enviado com sucesso.');} ?>

			 <table>	
			<tr>
				<td class="titulo">Cliente</td>
				<td class="titulo">Produto</td>
				<td class="titulo">Quantidade</td>
				<td class="titulo">Tamanho</td>
				<td class="titulo">Cor</td>
				<td class="titulo">Valor total</td>
				<td class="titulo center" colspan="2">Ação</td>
			</tr>

			<?php
			
			 foreach ($pedidos as $key => $value) {
			 	
					if($value['loja_id'] == $_SESSION['id_loja']){

						$consumido = MySql::conectar()->prepare("SELECT * FROM `tb_admin.consumido` WHERE id = ? ");
						$consumido->execute(array($value['usuario_id']));
						$consumido = $consumido->fetchAll();
						$estoque = MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = ?");
						$estoque->execute(array($value['produto_id']));
						$estoque = $estoque->fetch()['nome'];
						$pedido_id = $value['id'];
						$loja_id = $value['loja_id'];
						$usuario_id = $value['usuario_id'];
						if($value['promocao'] != 0){
							$valor = $value['quantidade'] * $value['promocao'];
						}else{
						$valor = $value['quantidade'] * $value['preco'];
						}
						foreach ($consumido as $key => $usuario) {
							$_SESSION['cliente_id'] = $usuario['id'];
				 ?>

				<tr>

					<td><a href="<?php echo INCLUDE_PATH_PAINEL_LOJA; ?>gerar-pdf.php?cliente=<?php echo $usuario['id']; ?>" target="_blank"><?php echo ucfirst($usuario['nome']); ?></a></td>

					<td><?php echo $estoque;  ?></td>
					<td class="center"><?php echo $value['quantidade']; ?></td>
					<td><?php echo $value['tamanho']; ?></td>
					<td><?php echo $value['cor']; ?></td>
					<td>R$ <?php echo Painel::convertMoney($valor); ?></td>
					<td class="center"><div class="btn-link"><a href="#">Enviar link de pagamento</a></div></td>
					
				</tr>
			
			<?php 
				} 

		$pedido_count = count($value);	} 
		} if(@$pedido_count == 0){ ?>
		<tr><td class="center" colspan="8">Voçê não tem nem um pedido</td></tr>
		<?php }	?>
		</table>

</div>

<div class="bg">
	<div class="form">
		<div class="closeBtn">x</div>
		<form id="form1" method="post">
			<?php 
				if(isset($_POST['acao'])){
							if(Painel::insert($_POST)){
					Painel::alert('sucesso','Link enviado');
				}else{
					Painel::alert('erro','Campos vázios não são permitidos!');
				}
			}
								
			 ?>
			<input required type="text" name="link" placeholder="Link de pagamento" />
			<input type="hidden" name="pedido_id" value="<?php echo $pedido_id; ?>">
			<input type="hidden" name="loja_id" value="<?php echo $loja_id; ?>">
			<input type="hidden" name="order_id" value="0">
					<input type="hidden" name="nome_tabela" value="tb_link.pedido" />
			<input type="submit" name="acao" value="ENVIAR">
		</form>
	</div><!--form-->
</div><!--bg-->


</div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo INCLUDE_PATH ; ?>js/bootstrap.min.js"></script>