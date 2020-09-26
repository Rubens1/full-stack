<?php
	verificaPermissaoPaginaColaborado(2);
?>
<div class="container">
	<div class="row">
		<div class="bg-light my-4 col-12 text-center">
			<h1 class="disolay-4"><i class="fas fa-user"></i> Adiciona um novo colaborador</h1>
		</div>
		
	</div>
	<div class="row justify-content-center mb-5">



			<div class=" bg-light col-sm-9 col-md-9 col-lg-9">
				<form class="form-row mt-4" method="post" enctype="multipart/form-data">

					
					<?php 
					if(isset($_POST['acao'])){
						$login = $_POST['login'];
						$nome = $_POST['nome'];
						$senha = $_POST['password'];
						$email = $_POST['email'];
						$imagem = $_FILES['imagem'];
						$cargo = $_POST['cargo'];
						

						if($login == ''){
							Painel::alert('erro','O login está vázio!');
						}else if($nome == ''){
							Painel::alert('erro','O nome está vázio!');
						}else if($senha == ''){
							Painel::alert('erro','O senha está vázio!');
						}else if($email == ''){
							Painel::alert('erro','O email está vázio!');
						}else if($cargo == ''){
							Painel::alert('erro','Você tem que escolher um cargo!');
						}else{
							if($cargo >= $_SESSION['cargo']){
						Painel::alert('erro','Você precisa selecionar um cargo menor que o seu!');
						}else if(Usuario::userExists($login)){
						Painel::alert('erro','O login já existe, selecione outro por favor!');
						}else{
								//Apenas cadastrar no banco de dado//
								$usuario = new Usuario();
								$imagem = Painel::uploadPerfil($imagem);
								$usuario->cadastrarUsuario($login,$senha,$nome,$email,$imagem,$cargo);
								Painel::alert('sucesso','O cadastro foi feito com sucesso!');
							}
						}
					} 
					?>

				<div class="form-group col-sm-6">
					<label for="inputNome">Login: </label>
					<input type="text" class="form-control" id="inputlogin" name="login">
				</div>
				<div class="form-group col-sm-6">
					<label for="inputNome">Nome: </label>
					<input type="text" class="form-control" id="inputNome" name="nome">
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail">Email: </label>
					<input type="email" class="form-control" id="inputEmail" name="email">
				</div>
				<div class="form-group col-sm-6">
					<label for="inputSenha">Senha: </label>
					<input type="password" class="form-control" id="inputSenha" name="password">
				</div>
				<div class="form-group col-sm-6">
					<label for="inputNome">Cargo: </label>
					<select class="form-control" name="cargo">
						<?php 
						foreach (Painel::$cargos as $key => $value) {
						 if($key < $_SESSION['cargo'])	echo '<option value="'.$key.'">'.$value.'</option>';
						 } ?>
					</select>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputImagem">Imagem: </label>
					<input type="file" class="form-control" name="imagem">
				</div>
				<div class="form-group col-sm-6">
					<input class="btn btn-info" type="submit" name="acao" value="Cadastra">
				</div>
				</form>
		</div>	
	</div>
	<div class="clear"></div>
</div>