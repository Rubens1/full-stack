<?php
	verificaPermissaoPaginaColaborado(2);
?>
<div class="container">
	<div class="row">
		<div class="bg-light my-4 col-12 text-center">
			<h1 class="disolay-4"><i class="fas fa-users"></i> Cadastrar Clientes</h1>
		</div>
		
	</div>
	<div class="row justify-content-center mb-5">



			<div class=" bg-light col-sm-9 col-md-9 col-lg-9">
				<form class="form-row mt-4 ajax" method="post" enctype="multipart/form-data">

							<?php
			if(isset($_POST['acao'])){
			
				if(Painel::insert($_POST)){
					Painel::alert('sucesso','O cadastro de cliente foi realizado com sucesso!');
				}else{
					Painel::alert('erro','Campos vázios não são permitidos!');
				}
			

			}
		?>

				<div class="form-group col-sm-12">
					<label>Nome: </label>
					<input type="text" class="form-control" name="nome">
				</div>
				<div class="form-group col-sm-12">
					<label>Email: </label>
					<input type="email" class="form-control" name="email">
				</div>
				<div class="form-group col-sm-12">
					<label>Tipo: </label>
					<select name="tipo_cliente" class="form-control">
						<option value="fisico">Fisico</option>
						<option value="juridico">Juritico</option>
					</select>
				</div>
				<div ref="cpf" class="form-group col-sm-12">
					<label>CPF: </label>
					<input type="text" class="form-control" id="cpf" name="cpf">
				</div>
				<div style="display: none;" ref="cnpj" class="form-group col-sm-12">
					<label>CNPJ: </label>
					<input type="text" class="form-control" id="cnpj" name="cnpj">
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