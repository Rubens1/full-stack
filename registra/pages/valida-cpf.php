<?php 
	
$validaCpf = new Consumido();

if(isset($_POST['acao'])){
	$cpf = $_POST['cpf'];

	if(!Consumido::isCpf($cpf)){
		echo 'CPF Valido';
	}else{
		echo 'CPF Invalido';
	}
}
 ?>

<div class="container">
<div class="verification w50">
   <div class="cadastrar">
	       <form method="post" >
	           <div class="titulo-cadastro"> <h1>Cadastre aqui</h1><a href="<?php echo INCLUDE_PATH_REGISTRO; ?>valida-cnpj-loja" class="btn-cadastro-loja">Registra a minha loja</a></div>
				<div class="cadastro">
				    <label>CPF</label>
				    <input class="form-cadastro" type="text" name="cpf">
				</div>
				<div class="center">
				    <input type="submit" value="registra"  name="acao" class="btn-cadastro" >
				</div>
			</form>
		</div>
	</div>
</div>