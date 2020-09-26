<div class="box-content">
		<div class="body-box">
			<h1 class="disolay-4"><i class="fas fa-users"></i> Cadastrar de cliente</h1>
		

			<div class="col-sm-9 col-md-9 col-lg-9">
				<form class="form-row mt-4 ajax" action="<?php echo INCLUDE_PATH_PAINEL_LOJA ?>ajax/forms.php" method="post" enctype="multipart/form-data">


				<div class="form-group col-sm-12">
					<label>Nome: </label>
					<input type="text" class="form-control" name="nome">
				</div>
				<div class="form-group col-sm-12">
					<label>Email: </label>
					<input type="email" class="form-control" name="email">
				</div>
				
				<div ref="cpf" class="form-group col-sm-12">
					<label>CPF: </label>
					<input type="text" class="form-control" name="cpf">
				</div>
				
				<div class="form-group col-sm-12">
					<label>Imagem: </label>
					<input type="file" class="form-control" name="imagem">
				</div>
				<div class="form-group col-sm-12">
					<label>CEP: </label>
					<input type="text" class="form-control" name="cep">
				</div>
				<div class="form-group col-sm-12">
					<label>Estado: </label>
					<input type="text" class="form-control" name="estado">
				</div>
				<div class="form-group col-sm-12">
					<label>Cidade: </label>
					<input type="text" class="form-control" name="cidade">
				</div>
				<div class="form-group col-sm-12">
					<label>Endereço: </label>
					<input type="text" class="form-control" name="estado">
				</div>
				<div class="form-group col-sm-12">
					<label>Complemento: </label>
					<input type="text" class="form-control" name="ccomplemento">
				</div>		
				<div class="form-group col-sm-12">
			<input type="hidden" name="order_id" value="0">
			<input type="hidden" name="nome_tabela" value="tb_admin.cliente" />
					<input class="btn btn-info" type="submit" name="acao" value="Cadastra">
				</div>
				</form>
		</div>	
	</div>
	<div class="clear"></div>
</div>