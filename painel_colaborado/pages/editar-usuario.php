<div class="container">
	<div class="row">
		<div class="bg-light my-4 col-12 text-center">
			<h1 class="disolay-4"><i class="fas fa-user-edit"></i> Editar Perfil</h1>
		</div>
		
	</div>
	<div class="row justify-content-center mb-5">
	<div class=" bg-light  col-sm-3 col-md-3 col-lg-3">
      <div class="box-usuario mt-5">
      	<?php 
      		if($_SESSION['img'] == ''){ 
      	?>
      	<div class="avatar-usuario">
      		<i class="fas fa-user"></i>
      	</div> 
      <?php }else{ ?>
      	<div class="imagem-usuario">
      		<img id="img" src="<?php echo INCLUDE_PATH_PAINEL_COLABORADO?>uploads/<?php echo $_SESSION['img']?>">
      	</div> 
      <?php } ?>
	</div>
	</div>


			<div class=" bg-light col-sm-9 col-md-9 col-lg-9">
				<form class="form-row mt-4" method="post" enctype="multipart/form-data">

					<?php 
					if(isset($_POST['acao'])){
						
						$nome = $_POST['nome'];
						$senha = $_POST['password'];
						$email = $_POST['email'];
						$imagem = $_FILES['imagem'];
						$imagem_atual = $_POST['imagem_atual'];
						$usuario = new Usuario();
						if($imagem['name'] != ''){
							if(Painel::imagemValida($imagem)){
								Painel::deleteFile($imagem_atual);
								
								$imagem = Painel::uploadPerfil($imagem);
								if($usuario->atualizarUsuario($nome,$senha,$email,$imagem)){
									$_SESSION['img'] = $imagem;
									Painel::alert('sucesso','Atualizado com sucesso!');
								}else{
									Painel::alert('erro','Ocorreu um erro ao atualizar...');
								}	
							}
						}else{
							$imagem = $imagem_atual;
							if($usuario->atualizarUsuario($nome,$senha,$email,$imagem)){
								Painel::alert('sucesso','Atualizado com sucesso!');
							}else{
								Painel::alert('erro','Ocorreu um erro ao atualizar...');
							}
						}
					} 
					?>

				<div class="form-group col-sm-6">
					<label for="inputNome">Nome: </label>
					<input type="text" class="form-control" id="inputNome" value="<?php echo $_SESSION['nome']; ?>" name="nome">
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail">Email: </label>
					<input type="email" class="form-control" id="inputEmail" value="<?php echo $_SESSION['email']; ?>" name="email">
				</div>
				<div class="form-group col-sm-6">
					<label for="inputSenha">Senha: </label>
					<input type="password" class="form-control" id="inputSenha" value="<?php echo $_SESSION['password']; ?>" name="password">
				</div>
				<div class="form-group col-sm-6">
					<label for="inputImagem">Imagem: </label>
					<input type="file" class="form-control" id="upload" name="imagem">
					<input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>">
				</div>
				<div class="form-group col-sm-6">
					<input class="btn btn-info" type="submit" name="acao" value="Atualizar!">
				</div>
				</form>
		</div>	
	</div>
	<div class="clear"></div>
</div>