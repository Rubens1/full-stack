<div class="tabela-pedidos">
	<div class="container">
		<h2><i class="fa fa-shopping-cart"></i> Carrinho</h2>
		
			
			<?php
			if(isset($_SESSION['carrinho']) == ''){
				\Painel::alert('erro','Você precisa adicionar um item no carrinho');
			}else{
			?>
			<table>	
			<tr>
				<td class="titulo">Nome do Produto</td>
				<td class="titulo">Quantidade</td>
				<td class="titulo">Valor</td>
			</tr>

			<?php
				$itemsCarrinho = $_SESSION['carrinho'];
				$total = 0;
				foreach ($itemsCarrinho as $key => $value) {
				$idProduto = $key;
				$produto = \MySql::conectar()->prepare("SELECT * FROM `tb_admin.estoque` WHERE id = $idProduto");
				$produto->execute();
				$produto = $produto->fetch();
				$valor = $value * $produto['preco'];
				$total+=$valor;

			?>
			<tr>
				<td><?php echo $produto['nome']; ?></td>
				<td>
      
      	<a class="btn " href="?removerCart=<?php echo $produto['id']; ?>">-</a>
					<?php echo $value; ?>
		<a class="btn " href="?addCart=<?php echo $produto['id']; ?>">+</a></td>
			
				<td>R$ <?php echo Painel::convertMoney($valor); ?></td>
</tr>
				
		<?php }?>
		</table>
		<div class="form-correios">
			
			 <?php 
			 
			 Correios::correios();
			  ?>
			  <form method="post">
			<label>CEP</label>
			<input class="form-group" name="cep" type="text" id="cep" maxlength="8" placeholder="Digite o seu CEP">
			<input onclick="calculo();" class="group-btn" type="submit" value="Calcular"></form>
        <div id="retorno">

        </div>
		<div class="clear"></div><!--Clear-->
</div><!--Container-->
</div><!--Tabela de Pedido-->
<div class="finalizar-pedidos">
	<div class="container">
		<h2>Total: R$ <?php echo Painel::convertMoney($total); ?></h2>
		<a href="" class="btn-pagamento">Finalizar a compra</a>
		<div class="clear"></div>
	</div><!--Container-->
<?php } ?>
<br><br><br><br>
</div><!--Finalizar pedidos-->
 <script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
<script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.lightbox.js"></script>
 <script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
 <script src="<?php echo INCLUDE_PATH; ?>js/finalizarcompra.js"></script>

