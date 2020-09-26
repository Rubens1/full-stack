<?php
	verificaPermissaoPaginaColaborado(2);
?>
<div class="container">
	<div class="row">
		<div class="bg-light my-4 col-12 text-center">
			<h1 class="disolay-4"><i class="fas fa-users"></i> Cadastrar Produto</h1>
		</div>
		

	</div>
	<div class="row justify-content-center mb-5">


			<div class=" bg-light col-sm-9 col-md-9 col-lg-9">
				<form class="form-row mt-4 ajax" method="post" enctype="multipart/form-data">

			<?php
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$descricao = $_POST['descricao'];
				$largura = $_POST['largura'];
				$altura = $_POST['altura'];
				$peso = $_POST['peso'];
				$comprimento = $_POST['comprimento'];
				$quantidade = $_POST['quantidade'];
				$preco = Painel::formatarMoedaBd($_POST['preco']);

				$imagens = array();
				$amountFiles = count($_FILES['imagem']['name']);

				$sucesso = true;

				if($_FILES['imagem']['name'][0] != ''){
				for($i = 0; $i < $amountFiles; $i++){
					$imagemAtual = ['type'=>$_FILES['imagem']['type'][$i], 'size'=>$_FILES['imagem']['size'][$i]];
					if(Painel::imagemValida($imagemAtual) == false){
						$sucesso = false;
						Painel::alert('erro','Uma das imagem selecionadas são invalidas!');
						break;
						}
					}
				}else{
					$sucesso = false;
					Painel::alert('erro','Você precisa selecionar pelo menos uma imagem!');
				}

				if($sucesso){
					for($i = 0; $i < $amountFiles; $i++){
						$imagemAtual = ['tmp_name'=>$_FILES['imagem']['tmp_name'][$i], 'name'=>$_FILES['imagem']['name'][$i]];
					$imagens[] = Painel::uploadFile($imagemAtual);
					}
					$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.estoque` VALUES (null,?,?,?,?,?,?,?,?)");
					$sql->execute(array($nome,$descricao,$largura,$altura,$peso,$comprimento,$quantidade,$preco));
					$lastId = MySql::conectar()->lastInsertId();
					foreach($imagens as $key => $value){
						MySql::conectar()->exec("INSERT INTO `tb_admin.estoque_imagens` VALUES (null,$lastId,'$value')");
					}
					Painel::alert('sucesso','O produto foi cadastrado com sucesso!');
				}

			}
		?>

				<div class="form-group col-sm-12">
					<label>Nome do produto: </label>
					<input type="text" class="form-control" name="nome">
				</div>
				<div class="form-group col-sm-12">
					<label>Descrição do produto: </label>
					<textarea class="form-control" name="descricao"></textarea>
				</div>
				<div class="form-group col-sm-12">
					<label>Largura do produto: </label>
					<input type="number" class="form-control col-lg-3" min="0" max="900" step="5" value="0" name="largura">
				</div>
				<div class="form-group col-sm-12">
					<label>Altura do produto: </label>
					<input type="number" class="form-control col-lg-3" min="0" max="900" step="5" value="0" name="altura">
				</div>
				<div class="form-group col-sm-12">
					<label>Comprimento do produto: </label>
					<input type="number" class="form-control col-lg-3" min="0" max="900" step="5" value="0" name="comprimento">
				</div>
				<div class="form-group col-sm-12">
					<label>Peso do produto: </label>
					<input type="number" class="form-control col-lg-3" min="0" max="900" step="5" value="0" name="peso">
				</div>
				<div class="form-group col-sm-12">
					<label>Quantidade atual do produto: </label>
					<input type="text" class="form-control" name="quantidade">
				</div>
				<div class="form-group col-sm-12">
					<label>Preço: </label>
					<input type="text" class="form-control" name="preco">
				</div>
				<div class="form-group col-sm-12">
					<label>Selecione uma Imagem: </label>
					<input multiple type="file" class="form-control" name="imagem[]">
				</div>
				

				<div class="form-group col-sm-12">
					
					<input class="btn btn-info" type="submit" name="acao" value="Cadastrar Produto">
				</div>
				</form>
		</div>	
	</div>
	<div class="clear"></div>
</div>