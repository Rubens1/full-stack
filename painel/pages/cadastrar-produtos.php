<div class="box-content">
		<div class="body-box">
			<h1 class="disolay-4"><i class="fas fa-users"></i> Cadastrar Produto</h1>
		

			<div class="col-sm-9 col-md-9 col-lg-9">
				<form class="form-row mt-4 ajax" method="post" enctype="multipart/form-data">

			<?php
			if(isset($_POST['acao'])){
				$nome = $_POST['nome'];
				$descricao = $_POST['descricao'];
				$tamanho = implode(' , ', $_POST['tamanho']);
				$cor = implode(' , ', $_POST['cor']);
				$largura = $_POST['largura'];
				$altura = $_POST['altura'];
				$peso = $_POST['peso'];
				$comprimento = $_POST['comprimento'];
				$quantidade = $_POST['quantidade'];
				$preco = \Painel::formatarMoedaBd($_POST['preco']);
				$loja_id = $_SESSION['id_loja'];
				$categoria = $_POST['categoria_id'];
				$slug = Painel::generateSlug($_POST['nome']);

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
									
					$sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.estoque` VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?)");
					$sql->execute(array($loja_id,$categoria,$nome,$descricao,$tamanho,$cor,$largura,$altura,$peso,$comprimento,$quantidade,$preco,$slug));
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
				<label>Categoria:</label>
					<select name="categoria_id" class="form-control">
						<?php
						$slide = Painel::select('tb_admin.estoque','id = ?',array($id));
							$categorias = Painel::selectAll('tb_admin.categoria');
							foreach ($categorias as $key => $value) {

						?>
						<option <?php if($value['id'] == $slide['categoria_id']) echo 'selected'; ?> value="<?php echo $value['id'] ?>"><?php echo $value['id']," - ", $value['nome']; ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="form-group col-sm-12">
					<label>Descrição do produto: </label>
					<textarea class="form-control tinymce" name="descricao"></textarea>
				</div>
				<div class="form-group col-sm-12">
				<label>Tamanho do produto: P, M, G e GG </label><br>
				<input type="checkbox" name="tamanho[]" value="P"> P
				<input type="checkbox" name="tamanho[]" value="M"> M
				<input type="checkbox" name="tamanho[]" value="G"> G
				<input type="checkbox" name="tamanho[]" value="GG"> GG
				</div>
				<div class="form-group col-sm-12">
				<label>Tamanho do produto: de 30 a 60 </label><br>
				<?php for($i = 34; $i <= 60; $i++){ ?>
					<input type="checkbox" name="tamanho[]" value="<?php echo $i; ?>"> <?php echo $i; ?>
				<?php } ?>
				
				</div>
				<div class="form-group col-sm-12">
					<label>Cores: </label>
				<input type="checkbox" name="cor[]" value="Estampado"> Estampado
				<input type="checkbox" name="cor[]" value="Azul"> Azul
				<input type="checkbox" name="cor[]" value="Amarelo"> Amarelo
				<input type="checkbox" name="cor[]" value="Branco"> Branco
				<input type="checkbox" name="cor[]" value="Preto"> Preto
				<input type="checkbox" name="cor[]" value="Verde"> Verde
				<input type="checkbox" name="cor[]" value="Vermeio"> Vermeio
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
					<input type="hidden" name="loja_id">
					<input class="btn btn-info" type="submit" name="acao" value="Cadastrar Produto">
				</div>
				</form>
		</div>	
	<div class="clear"></div>
</div>